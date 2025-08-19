<?php

/** @var yii\web\View $this */
/** @var common\models\Cart $cart */
/** @var common\models\Cart $cart_item */
/** @var integer $cart_item */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\Modal;

$this->title = 'Cart';

$this->registerJsVar('chatId', Yii::$app->session->get('user_id'));

$this->registerJs(<<<JS
    $("#checkoutBtn").on("click", function() {
        alert(chatId);
        const tg = window.Telegram.WebApp;

        $.ajax({
            url: "https://shop.sugo.uz/checkout",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify({
                chat_id: chatId
            }),
            success: function(res) {
                alert("Tasdiq yuborildi!");
                tg.close();
            },
            error: function(xhr) {
                alert("Xatolik: " + xhr.status);
            }
        });
    });
JS);
?>
<!-- main page content -->
<div class="main-container container top-20">
    <!-- wizard links -->
    <div class="row justify-content-between wizard-wrapper mb-4 shadow-sm">
        <div class="col">
            <a href="cart.html" class="wizard-link active">
                <i class="bi bi-bag shadow-sm"></i>
                <span class="wizard-text">Products</span>
            </a>
        </div>
        <div class="col">
            <a href="address.html" class="wizard-link">
                <i class="bi bi-geo-alt shadow-sm"></i>
                <span class="wizard-text">Address</span>
            </a>
        </div>
        <div class="col">
            <a href="payment.html" class="wizard-link">
                <i class="bi bi-credit-card shadow-sm"></i>
                <span class="wizard-text">Payment</span>
            </a>
        </div>
    </div>

    <!-- cart items -->
    <div class="row mb-3">
        <div class="col align-self-center">
            <h5 class="mb-0">3 products in cart</h5>
        </div>
        <div class="col-auto pe-0 align-self-center">
            <a href="home-2.html" class="link text-color-theme">Shop more <i class="bi bi-chevron-right"></i></a>
        </div>
    </div>
    <div class="row mb-2">
        <?php foreach ($cart as $cart_item):?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm product mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="text-center avatar-90 avatar">
                                <img src="/template/img/product1.png" alt="">
                            </figure>
                        </div>
                        <div class="col ps-0">
                            <p class="mb-0">
                                <small class="text-opac">Fresh</small>
                                <small class="float-end"><i class="bi bi-star-fill text-warning"></i> <span
                                        class="text-opac">4.0 (165 Reviews)</span></small>
                            </p>
                            <h6 class="text-color-theme">Apple</h6>
                            <div class="row">
                                <div class="col">
                                    <p class="mb-0"><?=$cart_item->price?><br></p>
                                </div>
                                <div class="col-auto">
                                    <div class="counter-number">
                                        <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                            <i class="bi bi-dash size-22"></i>
                                        </button>
                                        <span><?=$cart_item->quantity?></span>
                                        <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                            <i class="bi bi-plus size-22"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>

    <!-- pricing -->
    <div class="row mb-3">
        <div class="col align-self-center">
            <h5 class="mb-0">Pricing</h5>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <p>Shipping Cost</p>
        </div>
        <div class="col-auto">$ 10.00</div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <p>Subtotal</p>
        </div>
        <div class="col-auto">$ 32.00</div>
    </div>

    <div class="row fw-bold mb-4">
        <div class="mb-3 col-12">
            <div class="dashed-line"></div>
        </div>
        <div class="col">
            <p>Total</p>
        </div>
        <div class="col-auto">$ 42.00</div>
    </div>

    <!-- Button -->
    <div class="row mb-3">
        <div class="col align-self-center d-grid">
            <button id="checkoutBtn" class="btn btn-default btn-lg shadow-sm">Tasdiqlash</button>
        </div>
    </div>

</div>
<!-- main page content ends -->