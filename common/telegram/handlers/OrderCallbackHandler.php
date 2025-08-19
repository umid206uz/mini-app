<?php
namespace common\telegram\handlers;

use Yii;
use common\models\Cart;
use common\models\Orders;
use common\models\OrderItems;

class OrderCallbackHandler
{
    public function handle($chatId, $message, $info, $session)
    {

        if (!$chatId || !$info) return;

        if ($info == 'order_cancel') {
            Yii::$app->telegram->sendMessage($chatId, "❌ Buyurtma bekor qilindi.");
            return;
        }

        if ($info === 'order_confirm') {
            $db = Yii::$app->db;
            $tx = $db->beginTransaction();
            try {
                $cartItems = Cart::find()->where(['chat_id' => $chatId, 'status' => 0])->all();
                if (!$cartItems) {
                    Yii::$app->telegram->sendMessage($chatId, "Savatchangiz bo‘sh 😕");
                    $tx->rollBack();
                    return;
                }

                $order = new Orders();
                $order->user_id = $chatId;
                $order->status = 1;
                $order->total_price = 0;
                $order->created_at = time();
                $order->save(false);

                $total = 0;
                foreach ($cartItems as $c) {
                    /** @var Cart $c */
                    $sum = $c->quantity * $c->product->price;
                    $item = new OrderItems();
                    $item->order_id   = $order->id;
                    $item->product_id = $c->product_id;
                    $item->product_name       = $c->product->name;
                    $item->price      = $c->product->price;
                    $item->quantity   = $c->quantity;
                    $item->total_price        = $sum;
                    $item->created_at        = time();
                    $item->save(false);

                    $total += $sum;
                    // cartni yopamiz
                    $c->status = 1;
                    $c->save(false);
                }

                $order->total_price = $total;
                $order->save(false);

                $tx->commit();

                Yii::$app->telegram->sendMessage(
                    $chatId,
                    "✅ Buyurtma qabul qilindi!\nBuyurtma raqami: #{$order->id}\nJami: <b>{$total} so‘m</b>",
                    [],
                    'HTML'
                );
            } catch (\Throwable $e) {
                $tx->rollBack();
                Yii::error($e->getMessage(), __METHOD__);
                Yii::$app->telegram->sendMessage($chatId, "❌ Xatolik yuz berdi. Keyinroq urinib ko‘ring.");
            }
        }
    }
}
