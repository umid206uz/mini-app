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
            $db = Yii::$app->db;
            $tx = $db->beginTransaction();
            try {
                $cart_items = Cart::find()->where(['user_id' => $chatId, 'status' => Cart::STATUS_ACTIVE])->all();
                if (!$cart_items) {
                    Yii::$app->telegram->sendMessage($chatId, TextFactory::emptyCartText());
                    $tx->rollBack();
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
                foreach ($cart_items as $cart_item) {
                    /** @var Cart $cart_item */
                    $sum = $cart_item->quantity * $cart_item->price;
                    $item = new OrderItems();
                    $item->order_id = $order->id;
                    $item->product_id = $cart_item->product_id;
                    $item->product_name = $cart_item->product->name;
                    $item->price = $cart_item->price;
                    $item->quantity = $cart_item->quantity;
                    $item->total_price = $sum;
                    if ($item->save()){
                        $cart_item->status = Cart::STATUS_INACTIVE;
                        $cart_item->save();
                    }

                    $total += $sum;
                }

                $order->total_price = $total;
                $order->save();

                $tx->commit();
                $session->setStep(TelegramSession::STEP_MENU);
                Yii::$app->telegram->sendMessage($chatId, TextFactory::orderAcceptedText($order->id, $total));
            } catch (\Throwable $e) {
                $tx->rollBack();
                Yii::error($e->getMessage(), __METHOD__);
                Yii::$app->telegram->sendMessage($chatId, "❌ Xatolik yuz berdi. Keyinroq urinib ko‘ring.");
            }
        }
    }
}
