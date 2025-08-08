<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\models\Cart;
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
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
    <link rel="apple-touch-icon" href="template/img/favicon180.png" sizes="180x180">
    <link rel="icon" href="template/img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="template/img/favicon16.png" sizes="16x16" type="image/png">
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

<!-- Sidebar main menu -->
<div class="sidebar-wrap  sidebar-overlay">
    <!-- Add pushcontent or fullmenu instead overlay -->
    <div class="closemenu text-opac">Close Menu</div>
    <div class="sidebar">
        <div class="row mt-4 mb-3">
            <div class="col-auto">
                <figure class="avatar avatar-60 rounded mx-auto my-1">
                    <img src="template/img/user2.jpg" alt="">
                </figure>
            </div>
            <div class="col align-self-center ps-0">
                <h6 class="mb-0">Selvy Smith</h6>
                <p class="text-opac">Australia, UK</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="stats.html">
                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-door"></i></div>
                            <div class="col">Dashboard</div>
                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                           aria-expanded="false">
                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-shop"></i></div>
                            <div class="col">Shop</div>
                            <div class="arrow"><i class="bi bi-plus plus"></i> <i class="bi bi-dash minus"></i>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item nav-link active" href="home.html">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-bag"></i></div>
                                    <div class="col">Shop home</div>
                                    <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                </a></li>
                            <li><a class="dropdown-item nav-link" href="product.html">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-binoculars"></i></div>
                                    <div class="col">Product</div>
                                    <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                </a></li>
                            <li><a class="dropdown-item nav-link" href="cart.html">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-basket3"></i></div>
                                    <div class="col">Cart</div>
                                    <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                </a></li>
                            <li><a class="dropdown-item nav-link" href="payment.html">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-credit-card"></i></div>
                                    <div class="col">Payment</div>
                                    <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                </a></li>
                            <li><a class="dropdown-item nav-link" href="my-orders.html">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-box-seam"></i></div>
                                    <div class="col">My Orders</div>
                                    <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                </a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="chat.html" tabindex="-1">
                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-chat-text"></i></div>
                            <div class="col">Messages</div>
                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="notifications.html" tabindex="-1">
                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-bell"></i></div>
                            <div class="col">Notification</div>
                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="settings.html" tabindex="-1">
                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-gear"></i></div>
                            <div class="col">Settings</div>
                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="pages.html" tabindex="-1">
                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-file-earmark-text"></i></div>
                            <div class="col">Pages <span class="badge bg-info fw-light">new</span></div>
                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="signin.html" tabindex="-1">
                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-box-arrow-right"></i></div>
                            <div class="col">Logout</div>
                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar main menu ends -->

<!-- Begin page -->
<main class="h-100 has-header has-footer">

    <!-- Header -->
    <header class="container-fluid header">
        <div class="row">
            <div class="col-auto align-self-center">
                <button type="button" class="btn btn-link menu-btn text-color-theme">
                    <i class="bi bi-list size-24"></i>
                </button>
            </div>
            <div class="col text-center">
                <div class="logo-small">
                    <img src="template/img/logo.png" alt="" class="img">
                    <h6>GO<br><small>MobileUX</small></h6>
                </div>
            </div>
            <div class="col-auto align-self-center">
                <a href="profile.html" class="link text-color-theme">
                    <i class="bi bi-person-circle size-22"></i>
                </a>
            </div>
        </div>
    </header>
    <!-- Header ends -->

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
                <a class="nav-link" href="#">
                    <span>
                        <i class="nav-icon bi bi-bag"></i>
                        <span class="nav-text"><?=Yii::t("app","Cart")?></span>
                        <span class="countercart"><?= Cart::find()->where(['user_id' => Yii::$app->user->id])->count()?></span>
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

<!-- filter menu -->
<div class="filter">
    <div class="card shadow h-100">
        <div class="card-header">
            <div class="row">
                <div class="col align-self-center">
                    <h6 class="mb-0">Filter Criteria</h6>
                    <p class="text-opac">2154 products</p>
                </div>
                <div class="col-auto px-0">
                    <button class="btn btn-link text-danger filter-close">
                        <i class="bi bi-x size-22"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body overflow-auto">
            <div class="mb-4">
                <h6>Select Range</h6>
                <div id="rangeslider" class="mt-4"></div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div class="form-floating">
                        <input type="number" class="form-control" min="0" max="500" value="100" step="1" id="input-select">
                        <label for="input-select">Minimum</label>
                    </div>
                </div>
                <div class="col-auto align-self-center"> to </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="number" class="form-control" min="0" max="500" value="200" step="1" id="input-number">
                        <label for="input-number">Maximum</label>
                    </div>
                </div>
            </div>

            <div class="form-floating mb-4">
                <select class="form-control" id="filtertype">
                    <option selected>Cloths</option>
                    <option>Electronics</option>
                    <option>Furniture</option>
                </select>
                <label for="filtertype">Select Shopping Type</label>
            </div>

            <div class="form-group floating-form-group active mb-4">
                <h6 class="mb-3">Select Facilities</h6>

                <div class="form-check form-switch mb-2">
                    <input type="checkbox" class="form-check-input" id="men" checked>
                    <label class="form-check-label" for="men">Men</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" class="form-check-input" id="woman" checked>
                    <label class="form-check-label" for="woman">Women</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" class="form-check-input" id="Sport">
                    <label class="form-check-label" for="Sport">Sport</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" class="form-check-input" id="homedecor">
                    <label class="form-check-label" for="homedecor">Home Decor</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" class="form-check-input" id="kidsplay">
                    <label class="form-check-label" for="kidsplay">Kid's Play</label>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Keyword">
                <label for="input-select">Keyword</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-control" id="discount">
                    <option>10% </option>
                    <option>30%</option>
                    <option>50%</option>
                    <option>80%</option>
                </select>
                <label for="discount">Offer Discount</label>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-lg btn-default w-100 shadow-sm">Search</button>
        </div>
    </div>
</div>
<!-- filter menu ends-->

<!-- event action toast messages -->
<div class="position-fixed top-0 start-50 translate-middle-x p-3  z-index-999">
    <div id="toastprouctaddedtiny" class="toast bg-primary border-0 shadow hide mb-3" role="alert" aria-live="assertive"
         aria-atomic="true">
        <div class="toast-body">
            <div class="row">
                <div class="col text-white">
                    <p>Your product has been added to cart</p>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- event action toast messages ends -->

<!-- PWA app install toast message -->
<div class="position-fixed bottom-0 start-50 translate-middle-x  z-index-9">
    <div class="toast mb-3" role="alert" aria-live="assertive" aria-atomic="true" id="toastinstall"
         data-bs-animation="true">
        <div class="toast-header">
            <img src="template/img/favicon32.png" class="rounded me-2" alt="...">
            <strong class="me-auto">Install PWA App</strong>
            <small>now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <div class="row">
                <div class="col">
                    Click "Install" to install PWA app and experience as indepedent app.
                </div>
                <div class="col-auto align-self-center">
                    <button class="btn-default btn btn-sm" id="addtohome">Install</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
