<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<!-- main page content -->
<div class="main-container h-100 container">
    <div class="row h-100 ">
        <div class="col-12 col-md-6 col-lg-5 col-xl-3 mx-auto pt-4 text-center d-grid gap-2 align-self-center">
            <figure class="mw-100 text-center mb-0">
                <img src="template/img/404.png" alt="" class="mw-100">
            </figure>
            <h1 class="mb-0 fw-bold text-color-theme">Oops!...</h1>
            <h3 class="mb-3"><?= Html::encode($this->title) ?></h3>
            <p class="text-opac mb-4"><?= nl2br(Html::encode($message)) ?></p>

        </div>
    </div>
</div>