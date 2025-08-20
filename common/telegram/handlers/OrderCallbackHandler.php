<?php
namespace common\telegram\handlers;

use common\models\TelegramSession;
use common\telegram\keyboards\KeyboardFactory;
use common\telegram\text\TextFactory;
use Yii;
use common\models\Cart;
use common\models\Orders;
use common\models\OrderItems;

class OrderCallbackHandler
{
    public function handle($chatId, $text_button, $callback, $session)
    {
        if (!$chatId || !$text_button) return;

        if ($text_button == 'order_cancel') {
            $cart_items = Cart::find()->where(['user_id' => $chatId, 'status' => Cart::STATUS_ACTIVE])->all();
            foreach ($cart_items as $cart_item){
                /** @var Cart $cart_item */
                $cart_item->status = Cart::STATUS_INACTIVE;
                $cart_item->save();
            }
            Yii::$app->telegram->sendMessage($chatId, TextFactory::orderCancelledText());

            $session->setStep(TelegramSession::STEP_MENU);
            Yii::$app->telegram->sendMessage($chatId, TextFactory::mainMenuText(), KeyboardFactory::mainMenu());
            return;
        }

        if ($text_button == 'order_confirm') {
            $cartItems = Cart::find()->where(['user_id' => $chatId, 'status' => Cart::STATUS_ACTIVE])->all();
            foreach ($cartItems as $asd){
                Yii::$app->telegram->sendMessage($chatId, $asd->created_at);
            }

            if (!$cartItems) {
                Yii::$app->telegram->sendMessage($chatId, TextFactory::emptyCartText());
                return;
            }

            $order = new Orders();
            $order->user_id = $chatId;
            $order->full_name = $callback['from']['last_name'] . ' ' . $callback['from']['first_name'];
            $order->phone = $session->phone;
            $order->total_price = $session->phone;
            $order->total_price = 0;
            $order->save();

            $total = 0;
            foreach ($cartItems as $cartItem) {
                /** @var Cart $cartItem */

                $sum = $cartItem->quantity * $cartItem->price;
                $item = new OrderItems();
                $item->order_id = $order->id;
                $item->product_id = $cartItem->product_id;
                $item->product_name = $cartItem->product->name_uz;
                $item->price = $cartItem->price;
                $item->quantity = $cartItem->quantity;
                $item->total_price = $sum;
                $item->save();
                if ($cartItem->hasErrors()){
                    Yii::$app->telegram->sendMessage($chatId, json_encode($cartItem->getErrors()));
                }
                if ($item->save()){
                    $cartItem->status = Cart::STATUS_INACTIVE;
                    $cartItem->save();
                    if ($cartItem->hasErrors()){
                        Yii::$app->telegram->sendMessage($chatId, json_encode($cartItem->getErrors()));
                    }
                    if ($item->hasErrors()){
                        Yii::$app->telegram->sendMessage($chatId, json_encode($item->getErrors()));
                    }
                }

                $total += $sum;
            }

            $order->total_price = $total;
            $order->save();

            $session->setStep(TelegramSession::STEP_MENU);
            Yii::$app->telegram->sendMessage($chatId, TextFactory::orderAcceptedText($order->id, $total));
        }
    }
}
