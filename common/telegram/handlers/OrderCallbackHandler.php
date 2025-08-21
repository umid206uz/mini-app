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
            Yii::$app->telegram->answerCallbackQuery($callback['id']);
            Yii::$app->telegram->deleteMessage($chatId, $callback['message']['message_id']);
            Yii::$app->telegram->sendMessage($chatId, TextFactory::orderCancelledText(), KeyboardFactory::openMenuInline($chatId));
            $session->setStep(TelegramSession::STEP_MENU);
            return;
        }

        if ($text_button == 'order_confirm') {
            $cartItems = Cart::find()->where(['user_id' => $chatId, 'status' => Cart::STATUS_ACTIVE])->all();
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
            $lines = [];
            foreach ($cartItems as $cartItem) {
                /** @var Cart $cartItem */
                $name = $cartItem->product->name_uz ?? 'Mahsulot';
                $qty  = $cartItem->quantity;
                $price = $cartItem->price;
                $sum = $cartItem->quantity * $cartItem->price;
                $item = new OrderItems();
                $item->order_id = $order->id;
                $item->product_id = $cartItem->product_id;
                $item->product_name = $name;
                $item->price = $price;
                $item->quantity = $qty;
                $item->total_price = $sum;
                if ($item->save()){
                    $cartItem->status = Cart::STATUS_INACTIVE;
                    $cartItem->save();
                }

                $total += $sum;
                $lines[] = "{$name} x {$qty} = {$sum} so‘m";
            }

            $order->total_price = $total;
            $order->save();

            $session->setStep(TelegramSession::STEP_MENU);
            Yii::$app->telegram->answerCallbackQuery($callback['id']);
            Yii::$app->telegram->deleteMessage($chatId, $callback['message']['message_id']);
            Yii::$app->telegram->sendMessage($chatId, TextFactory::orderAcceptedText($order->id, $lines, $total));
        }
    }
}
