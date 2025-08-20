<?php

namespace common\order\status;

use common\models\Orders;
use Yii;

class statusText
{
    public static function getStatusName($status): string
    {
        if ($status == Orders::STATUS_NEW){
            return '<span class="label label-primary">'. Yii::t("app", "New") .'</span>';
        }
    }
}
