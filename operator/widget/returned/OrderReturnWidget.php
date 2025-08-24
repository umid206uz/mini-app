<?php
namespace operator\widget\returned;

use yii\bootstrap5\Widget;

class OrderReturnWidget extends Widget
{
    public $model;

    public function init(){}

    public function run() {

        return $this->render('order-return', [
            'item' => $this->model
        ]);
    }

}