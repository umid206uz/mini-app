<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- categories -->
<div class="swiper-container categoriesswiper mb-3">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <?php foreach ($categories as $category):?>
            <div class="swiper-slide" data-category="fruits">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <img src="template/img/berry-small.png" alt="">
                    </div>
                </div>
                <p class="categoryname"><?=$category->name_uz?></p>
            </div>
        <?php endforeach;?>
    </div>
</div>

<!-- Products -->
<div class="row mb-3">
    <div class="col">
        <h5 class="mb-0">Popular</h5>
    </div>
    <div class="col-auto">
        <a href="#" class="link text-color-theme">View All <i class="bi bi-chevron-right"></i></a>
    </div>
</div>
