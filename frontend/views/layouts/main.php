<?php

/** @var yii\web\View $this */
/** @var string $content */
/** @var integer $user_id */

use common\models\Cart;
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$user_id = Yii::$app->session->get('user_id');
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="apple-touch-icon" href="/template/img/favicon180.png" sizes="180x180">
    <link rel="icon" href="/template/img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/template/img/favicon16.png" sizes="16x16" type="image/png">
</head>
<body class="body-scroll" data-page="home">
<?php $this->beginBody() ?>

<!-- loader section -->
<div class="container-fluid loader-wrap">
    <div class="row h-100">
        <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
            <div class="loader-cube-wrap mx-auto">
                <div class="loader-cube1 loader-cube"></div>
                <div class="loader-cube2 loader-cube"></div>
                <div class="loader-cube4 loader-cube"></div>
                <div class="loader-cube3 loader-cube"></div>
            </div>
            <p>Let's Create Difference<br><strong>Please wait...</strong></p>
        </div>
    </div>
</div>
<!-- loader section ends -->

<!-- Begin page -->
<main class="h-100 has-header has-footer">

    <?=$content?>

</main>
<!-- Page ends-->

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
                <a class="nav-link active" href="/">
                    <span>
                        <i class="nav-icon bi bi-house"></i>
                        <span class="nav-text">Home</span>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>
                        <i class="nav-icon bi bi-bar-chart-line"></i>
                        <span class="nav-text">Stats</span>
                    </span>
                </a>
            </li>
            <li class="nav-item center-item">
                <a class="nav-link" href="<?= Url::to(['/site/cart'])?>">
                    <span>
                        <i class="nav-icon bi bi-bag"></i>
                        <span class="nav-text"><?=Yii::t("app","Cart")?></span>
                        <span class="countercart"><?= Cart::find()->where(['user_id' => $user_id, 'status' => Cart::STATUS_ACTIVE])->count()?></span>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>
                        <i class="nav-icon bi bi-palette"></i>
                        <span class="nav-text">Style</span>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="settings.html">
                        <span>
                            <i class="nav-icon bi bi-gear"></i>
                            <span class="nav-text">Settings</span>
                        </span>
                </a>
            </li>
        </ul>
    </div>
</footer>
<!-- Footer ends-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
