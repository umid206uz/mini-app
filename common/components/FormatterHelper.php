<?php

namespace common\components;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\i18n\Formatter;

class FormatterHelper extends Formatter {

    public function asPhone($value) {
        return preg_replace("/^(\d{2})(\d{3})(\d{2})(\d{2})$/", "($1) $2-$3-$4", $value);
    }

    public function currentUser(): ?User
    {
        return User::findOne(Yii::$app->user->id);
    }

    public function cleanPhone($value): string
    {
        return strtr($value, [
            '+998' => '',
            '-' => '',
            '(' => '',
            ')' => '',
            ' ' => '',
            '_' => '',
        ]);
    }

    function removePrefixIfValid($input) {
        if (preg_match('/^\d{12}$/', $input)) {
            if (substr($input, 0, 3) === '998') {
                return substr($input, 3);
            }
        }
        return $input;
    }

    public function asPhoneOperator($value, $order, $operator_id): string
    {
        return ($order->operator_id && $order->operator_id == $operator_id) ? preg_replace("/^(\d{2})(\d{3})(\d{2})(\d{2})$/", "($1) $2-$3-$4", $value) : '(**) ***-**-**';
    }

    public function getPrice($value): string
    {
        return number_format((float) $value, 0 , '.', ' ') . ' ' . Yii::t("app", "sum");
    }

    public function getDryPrice($value): string
    {
        return number_format((float) $value, 0 , '.', ' ');
    }

    public function getDate($date){
        return ($date) ? date( 'd.m.Y H:i:s', $date) : null;
    }

    public function getDateWithoutTime($date){
        return ($date) ? date( 'd.m.Y', $date) : null;
    }

    public function getCourier(): array
    {
        return ArrayHelper::map(User::find()->joinWith('assignment')->where(['auth_assignment.item_name' => 'courier'])->all(), 'id', function ($model){
            return $model->fullName;
        });
    }

    public function getOperator(): array
    {
        return ArrayHelper::map(User::find()->joinWith('assignment')->where(['auth_assignment.item_name' => 'operator'])->all(), 'id', function ($model){
            return $model->fullName;
        });
    }

    public function getAdminList(): array
    {
        return ArrayHelper::map(User::find()->all(), 'id', function ($model){
            return $model->fullName;
        });
    }
    
    public function getSelectStatusForPayment(): array
    {
        return [
            '0' => Yii::t("app","Waiting"),
            '1' => Yii::t("app","Paid"),
        ];
    }

    public function getRegions(): array
    {
        return [
            'Not Set' => 'Not Set',
            'Toshkent shaxri' => 'Toshkent shaxri',
            'Toshkent viloyati' => 'Toshkent viloyati',
            'Buxoro' => 'Buxoro',
            'Navoiy' => 'Navoiy',
            'Samarqand' => 'Samarqand',
            'Jizzax' => 'Jizzax',
            'Andijon' => 'Andijon',
            'Farg`ona' => 'Farg`ona',
            'Namangan' => 'Namangan',
            'Sirdaryo' => 'Sirdaryo',
            'Qoraqalpog`iston' => 'Qoraqalpog`iston',
            'Xorazm' => 'Xorazm',
            'Qashqadaryo' => 'Qashqadaryo',
            'Surxondaryo' => 'Surxondaryo',
        ];
    }

    public function getRegionsForClient(): array
    {
        return [
            'Toshkent shaxri' => 'Toshkent shaxri',
            'Toshkent viloyati' => 'Toshkent viloyati',
            'Buxoro' => 'Buxoro',
            'Navoiy' => 'Navoiy',
            'Samarqand' => 'Samarqand',
            'Jizzax' => 'Jizzax',
            'Andijon' => 'Andijon',
            'Farg`ona' => 'Farg`ona',
            'Namangan' => 'Namangan',
            'Sirdaryo' => 'Sirdaryo',
            'Qoraqalpog`iston' => 'Qoraqalpog`iston',
            'Xorazm' => 'Xorazm',
            'Qashqadaryo' => 'Qashqadaryo',
            'Surxondaryo' => 'Surxondaryo',
        ];
    }
}