<?php
namespace operator\widget\orders;

use yii\bootstrap5\Widget;

class OrdersWidget extends Widget
{
    public $model;

    public function init(){}

    public function run() {

        return $this->render('orders', [
            'item' => $this->model
        ]);
    }

}