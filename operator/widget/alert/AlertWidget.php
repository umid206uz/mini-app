<?php
namespace operator\widget\alert;

use yii\bootstrap5\Widget;

class AlertWidget extends Widget
{
    public function init(){}

    public function run() {

        return $this->render('alert');
    }

}