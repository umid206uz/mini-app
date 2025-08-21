<?php
namespace common\telegram\handlers;

use CartHelper;
use common\models\Cart;
use common\telegram\keyboards\KeyboardFactory;
use common\telegram\text\TextFactory;
use Yii;

class MenuHandler
{
    public function handle($chatId, $message, $info, $session)
    {
        if ($message == '🛍 Mahsulotlar'){
            Yii::$app->telegram->sendMessage($chatId, TextFactory::openMenuText(), KeyboardFactory::openMenuInline($chatId));
        }

        if ($message == '🛒 Savatcha'){
            $model = Cart::find()->where(['user_id' => $session->chat_id, 'status' => Cart::STATUS_ACTIVE])->all();
            if (!$model){
                Yii::$app->telegram->sendMessage($chatId, TextFactory::emptyCartText(), KeyboardFactory::mainMenu());
                return;
            }

            Yii::$app->telegram->sendMessage($chatId, CartHelper::generateCartText($model, "🛒 Sizning savatingiz"), KeyboardFactory::cartInline());
        }
    }
}
