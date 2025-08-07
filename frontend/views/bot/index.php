<?php

/* @var $admin_bot_token common\models\Setting */
/* @var $user common\models\User */

use common\models\AdminOrders;
use common\models\Click;
use common\models\Orders;
use common\models\User;

define('API_KEY', $admin_bot_token);

header("Content-Type: text/html; charset=UTF-8");

function ty($ch){
    return bot('sendChatAction', [
        'chat_id' => $ch,
        'action' => 'typing',
    ]);
}

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$cidtyp = $message->chat->type;
$miid = $message->message_id;
$name = $message->chat->first_name;
$user = $message->from->username;
$tx = $message->text;
$longitude = $message->location->longitude;
$latitude = $message->location->latitude;
$callback = $update->callback_query;
$mmid = $callback->inline_message_id;
$mes = $callback->message;
$mid = $mes->message_id;
$cmtx = $mes->text;
$mmid = $callback->inline_message_id;
$idd = $callback->message->chat->id;
$cbid = $callback->from->id;
$cbuser = $callback->from->username;
$data = $callback->data;
$phone = $message->contact->phone_number;
$ida = $callback->id;
$cqid = $update->callback_query->id;
$cbins = $callback->chat_instance;
$cbchtyp = $callback->message->chat->type;

if(isset($tx)){
    ty($cid);
}
//if ($tx){
//    bot('sendMessage', [
//        'chat_id'=>$cid,
//        'parse_mode' => 'html',
//        'text'=> "Bunday foydalanuvchi topilmadi!",
//    ]);
//}
if ($tx == "/profile"){

    $user = User::findOne(['user_chat_id' => $cid]);

    if ($user){
        $balance_debt = AdminOrders::find()->where(['admin_id' => $user->id, 'status' => AdminOrders::STATUS_NOT_PAID, 'debit' => AdminOrders::DEBIT_DEBT])->sum('amount');
        $balance_right = AdminOrders::find()->where(['admin_id' => $user->id, 'status' => AdminOrders::STATUS_NOT_PAID, 'debit' => AdminOrders::DEBIT_RIGHT])->sum('amount');
        $balance = $balance_right - $balance_debt;
        $probable = Orders::find()->joinWith('product')->where(['orders.user_id' => $user->id, 'orders.status' => Orders::STATUS_BEING_DELIVERED])->sum('product.pay');
        $new = Orders::find()->where(['status' => Orders::STATUS_NEW])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->andWhere(['user_id' => $user->id])->count();
        $read_to_delivery = Orders::find()->where(['status' => Orders::STATUS_READY_TO_DELIVERY])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->andWhere(['user_id' => $user->id])->count();
        $being_delivered = Orders::find()->where(['status' => Orders::STATUS_BEING_DELIVERED])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->andWhere(['user_id' => $user->id])->count();
        $archive_order = Orders::find()->where(['user_id' => $user->id, 'status' => Orders::STATUS_ARCHIVE])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();
        $returned_order = Orders::find()->where(['user_id' => $user->id, 'status' => Orders::STATUS_RETURNED])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();
        $sold_order = Orders::find()->where(['user_id' => $user->id, 'status' => Orders::STATUS_DELIVERED])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();
        $takes_tomorrow = Orders::find()->where(['status' => Orders::STATUS_THEN_TAKES])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->andWhere(['user_id' => $user->id])->count();
        $hold = Orders::find()->where(['status' => Orders::STATUS_HOLD])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->andWhere(['user_id' => $user->id])->count();
        $preparing = Orders::find()->where(['status' => Orders::STATUS_PREPARING])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->andWhere(['user_id' => $user->id])->count();
        $black_list = Orders::find()->where(['status' => Orders::STATUS_BLACK_LIST])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->andWhere(['user_id' => $user->id])->count();
        $count_order = Orders::find()->where(['user_id' => $user->id])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();

        $text = '';
        $text .= "🚆 Profilingiz haqida ma'lumotlar" . "\n \n";
        $text .= "📲 Tizimdagi ID raqamingiz: " . $user->id . "\n \n";
        $text .= "💰 Asosiy balans: " . Yii::$app->formatter->getPrice($balance) . "\n \n";
        $text .= "💎 Hold balans: " . Yii::$app->formatter->getPrice($probable) . "\n \n";
        $text .= "▶️ Ism: " . $user->first_name . "\n \n";
        $text .= "▶️ Familiya: " . $user->last_name . "\n \n";
        $text .= "☎️ Telefon raqam: " . Yii::$app->formatter->asPhone($user->tell) . "\n \n";
        $text .= "📝 Bugungi hisobot : ⏬" . "\n \n";
        $text .= "🆕 Yangi :" . $new . "\n";
        $text .= "🛍 Dostavkaga tayyor :" . $read_to_delivery . "\n";
        $text .= "🚖 Yetkazilmoqda :" . $being_delivered . "\n";
        $text .= "🗑 Arxiv :" . $archive_order . "\n";
        $text .= "❌ Qaytarilgan :" . $returned_order . "\n";
        $text .= "✅ Yetkazilgan :" . $sold_order . "\n";
        $text .= "⏱ Keyin oladi :" . $takes_tomorrow . "\n";
        $text .= "❄️ Hold :" . $hold . "\n";
        $text .= "🎁 Tayyorlanmoqda :" . $preparing . "\n";
        $text .= "📵 Qora ro'yxat :" . $black_list . "\n \n";
        $text .= "🗂 Jami :" . $count_order . "\n";
        bot('sendMessage', [
            'chat_id'=>$cid,
            'parse_mode' => 'html',
            'text'=> $text,
        ]);
        exit();
    }
    else{
        bot('sendMessage', [
            'chat_id'=>$cid,
            'parse_mode' => 'html',
            'text'=> "Bunday foydalanuvchi topilmadi!",
        ]);
        exit();
    }
}
//if ($tx == "/umid"){
//    bot('sendMessage', [
//        'chat_id' => $cid,
//        'text' => '🍽 Menyuni ochish uchun tugmani bosing:',
//        'reply_markup' => json_encode([
//            'keyboard' => [
//                [[
//                    'text' => '🍽 Menyu',
//                    'web_app' => [
//                        'url' => 'https://inbaza.uz'
//                    ]
//                ]]
//            ],
//            'resize_keyboard' => true
//        ])
//    ]);
//}
if ($tx == "/check_daily"){

    $user = User::findOne(['user_chat_id' => $cid]);

    if ($user){

        $total_balance = AdminOrders::find()->where(['admin_id' => $user->id])->andWhere(['between', 'created_date', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->sum('amount');

        $click = Click::find()->where(['user_id' => $user->id])->andWhere(['between', 'date', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();
        $count_new_orders = Orders::find()->where(['user_id' => $user->id, 'status' => Orders::STATUS_NEW])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();
        $count_read_to_delivery_orders = Orders::find()->where(['user_id' => $user->id, 'status' => Orders::STATUS_READY_TO_DELIVERY])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();
        $count_being_delivered_orders = Orders::find()->where(['user_id' => $user->id, 'status' => Orders::STATUS_BEING_DELIVERED])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();
        $count_delivered_orders = Orders::find()->where(['user_id' => $user->id, 'status' => Orders::STATUS_DELIVERED])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();
        $count_returned_orders = Orders::find()->where(['user_id' => $user->id, 'status' => Orders::STATUS_RETURNED])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();
        $count_returned_operator_orders = Orders::find()->where(['user_id' => $user->id, 'status' => Orders::STATUS_RETURNED_OPERATOR])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();
        $count_then_takes_orders = Orders::find()->where(['user_id' => $user->id, 'status' => Orders::STATUS_THEN_TAKES])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();
        $count_black_list_orders = Orders::find()->where(['user_id' => $user->id, 'status' => Orders::STATUS_BLACK_LIST])->andWhere(['between', 'text', strtotime(date('d-m-Y')), strtotime(date('d-m-Y')) + 3600 * 24])->count();

        $text = '📊 ';
        $text .= "00:00:00 dan " . date("H:i:s") . " gacha bugungi hisobot." . "\n";
        $text .= "👟 Tashrif: " . $click . " ta\n";
        $text .= "📲 Yangi: " . $count_new_orders . " ta\n";
        $text .= "🧰 Dostafkaga tayyor: " . $count_read_to_delivery_orders . " ta\n";
        $text .= "🚖 Yetkazilmoqda: " . $count_being_delivered_orders . " ta\n";
        $text .= "✅ Yetkazildi: " . $count_delivered_orders . " ta\n";
        $text .= "❌ Qaytarildi: " . number_format($count_returned_orders + $count_returned_operator_orders) . " ta\n";
        $text .= "⏰ Keyin oladi: " . $count_then_takes_orders . " ta\n";
        $text .= "📵 Qora ro'yhat: " . $count_black_list_orders . " ta\n";
        $text .= "\n";
        $text .= "💶 Bugungi summa: " . number_format($total_balance) . " so'm \n";

        bot('sendMessage', [
            'chat_id'=>$cid,
            'parse_mode' => 'html',
            'text'=> $text,
        ]);
        exit();
    }
    else{
        bot('sendMessage', [
            'chat_id'=>$cid,
            'parse_mode' => 'html',
            'text'=> "Bunday foydalanuvchi topilmadi!",
        ]);
        exit();
    }
}
if ($tx == "/activlashtirish"){

    $user = User::findOne(['user_chat_id' => $cid]);
    if ($user){
        if ($user->step == 2){
            bot('sendMessage', [
                'chat_id'=>$cid,
                'parse_mode' => 'html',
                'text'=> "Aktivlashtirish kodini kiriting: Kodni `mening profilim` bo'limidan olishingiz mumkin.",
            ]);
            exit();
        }
        elseif ($user->step == 1){
            $user->step = 2;
            $user->save(false);
            bot('sendMessage', [
                'chat_id'=>$cid,
                'parse_mode' => 'html',
                'text'=> "Aktivlashtirish kodini kiriting: Kodni `mening profilim` bo'limidan olishingiz mumkin.",
            ]);
            exit();
        }
        elseif ($user->step == 3){
            bot('sendMessage', [
                'chat_id'=>$cid,
                'text'=> 'Bot allaqachon aktivlashtirib bo`lingan!',
            ]);
            exit();
        }
        elseif ($user->step == null){
            bot('sendMessage', [
                'chat_id'=>$cid,
                'parse_mode' => 'html',
                'text'=> "Assalom aleykum, " . Yii::$app->params['og_site_name']['content'] . " (For Admin) botiga xush kelibsiz.",
            ]);
            exit();
        }
    }
    else{
        bot('sendMessage', [
            'chat_id'=>$cid,
            'parse_mode' => 'html',
            'text'=> "Assalom aleykum, " . Yii::$app->params['og_site_name']['content'] . " (For Admin) botiga xush kelibsiz. Aktivlashtirish uchun " . Yii::$app->params['og_site_name']['content'] . " saytidan `mening profilim` menyusiga kirib botni aktivlashtirishni bosing!",
        ]);
        exit();
    }
}
if($tx){

    $asd = strtr($tx, [
        '/start ' => '',
    ]);

    $model = User::findOne($asd);
    $model1 = User::findOne(['user_chat_id' => $cid]);
    if ($model){

        if ($model->step == null){

            $model->user_chat_id = $cid;
            $model->step = 1;
            $model->save(false);

            bot('sendMessage', [
                'chat_id'=>$cid,
                'parse_mode' => 'html',
                'text'=> "Assalom aleykum, " . Yii::$app->params['og_site_name']['content'] . " (For Admin) botiga xush kelibsiz! Botdan to'liq foydalanish uchun /activlashtirish komandasi bilan botni aktivlashtiring.",
            ]);
            exit();
        }
        elseif ($model->step == 1){
            bot('sendMessage', [
                'chat_id'=>$cid,
                'parse_mode' => 'html',
                'text'=> "Assalom aleykum, " . Yii::$app->params['og_site_name']['content'] . " (For Admin) botiga xush kelibsiz! Botdan to'liq foydalanish uchun /activlashtirish komandasi bilan botni aktivlashtiring.",
            ]);
            exit();
        }
        elseif ($model->step == 2){
            if ($model->access_token == $tx)
            {
                $model->step = 3;
                $model->save(false);
                bot('sendMessage', [
                    'chat_id'=>$cid,
                    'text'=> 'Bot aktivlashtirildi!',
                ]);
                exit();
            }else{
                bot('sendMessage', [
                    'chat_id'=>$cid,
                    'text'=> 'Kiritilgan kod xato!',
                ]);
                exit();
            }
        }
        elseif ($model1->step == 3){
            bot('sendMessage', [
                'chat_id'=>$cid,
                'parse_mode' => 'html',
                'text'=> "Assalom aleykum, " . Yii::$app->params['og_site_name']['content'] . " (For Admin) botiga xush kelibsiz.",
            ]);
            exit();
        }

    }
    elseif($model1)
    {
        if($model1->step == 1){
            bot('sendMessage', [
                'chat_id'=>$cid,
                'parse_mode' => 'html',
                'text'=> "Assalom aleykum, " . Yii::$app->params['og_site_name']['content'] . " (For Admin) botiga xush kelibsiz! Botdan to'liq foydalanish uchun /activlashtirish komandasi bilan botni aktivlashtiring.",
            ]);
            exit();
        }
        elseif ($model1->step == 2){
            if ($model1->access_token == $tx)
            {
                $model1->step = 3;
                $model1->save(false);
                bot('sendMessage', [
                    'chat_id'=>$cid,
                    'text'=> 'Bot aktivlashtirildi!',
                ]);
                exit();
            }else{
                bot('sendMessage', [
                    'chat_id'=>$cid,
                    'text'=> 'Kiritilgan kod xato!',
                ]);
                exit();
            }
        }
        elseif ($model1->step == 3){
            bot('sendMessage', [
                'chat_id'=>$cid,
                'text'=> "Assalom aleykum, " . Yii::$app->params['og_site_name']['content'] . " (For Admin) botiga xush kelibsiz.",
            ]);
            exit();
        }
    }else{
        bot('sendMessage', [
            'chat_id'=>$cid,
            'text'=> "Assalom aleykum, " . Yii::$app->params['og_site_name']['content'] . " (For Admin) botiga xush kelibsiz! Botdan to'liq foydalanish uchun /activlashtirish komandasi bilan botni aktivlashtiring.",
        ]);
        exit();
    }
}

?>