<?php

/** @var yii\web\View $this */
/** @var common\models\Category $categories */
/** @var common\models\Category $category */
/** @var common\models\Product $products */
/** @var common\models\Product $product */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\Modal;

$this->title = 'Mini app';
$this->registerJs(<<<JS
$('.modalButton').click(function(){
    $('#myModal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
});
JS
    ,3)
?>
<!-- main page content -->
<div class="main-container container">

    <div class="row">
        <?php foreach ($products as $product):?>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow-sm product mb-4" data-category="lemon">
                <div class="card-body">
                    <figure class="text-center">
                        <img src="template/img/product1.png" alt="">
                    </figure>
                    <p class="mb-1">
                        <small class="text-opac"><?=$product->category->name_uz?></small>
                        <small class="float-end"><span class="text-opac">4.5</span> <i class="bi bi-star-fill text-warning"></i></small>
                    </p>
                    <a href="product.html" class="text-normal">
                        <h6 class="text-color-theme"><?=$product->name_uz?></h6>
                    </a>
                    <div class="row">
                        <div class="col">
                            <p class="mb-0">$12.00<br><small class="text-opac">per 1 kg</small></p>
                        </div>
                        <div class="col-auto">
                            <?= Html::button('<i class="bi bi-plus size-22"></i>', [
                                'class' => 'btn btn-sm avatar avatar-30 p-0 rounded-circle shadow btn-gradient modalButton',
                                'value' => Url::to(['site/product', 'id' => $product->id]),
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>

</div>
<!-- main page content ends -->
<?php
Modal::begin([
    'id' => "myModal",
    "size" => "modal-lg",
]);

echo "<div id='modalContent'>
    
    </div>";

Modal::end();
?>