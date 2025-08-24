<?php

namespace common\order\status;

use common\models\Orders;
use Yii;

class statusText
{
    public static function getStatusName($status): string
    {
        if ($status == Orders::STATUS_NEW){
            return '<span class="badge bg-primary">'. Yii::t("app", "New") .'</span>';
        }else{
            return (string) $status;
        }
    }
}
