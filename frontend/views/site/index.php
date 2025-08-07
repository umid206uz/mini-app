<?php

/** @var yii\web\View $this */
/** @var common\models\Category $categories */
/** @var common\models\Category $category */

$this->title = 'Mini app';
?>
<!-- main page content -->
<div class="main-container container">

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

    <div class="row">
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow-sm product mb-4" data-category="lemon">
                <div class="card-body">
                    <figure class="text-center">
                        <img src="template/img/product1.png" alt="">
                    </figure>
                    <p class="mb-1">
                        <small class="text-opac">Fresh</small>
                        <small class="float-end"><span class="text-opac">4.5</span> <i class="bi bi-star-fill text-warning"></i></small>
                    </p>
                    <a href="product.html" class="text-normal">
                        <h6 class="text-color-theme">Red Apple</h6>
                    </a>
                    <div class="row">
                        <div class="col">
                            <p class="mb-0">$12.00<br><small class="text-opac">per 1 kg</small></p>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle shadow btn-gradient"
                                    data-bs-toggle="modal" data-bs-target="#addproductcart">
                                <i class="bi bi-plus size-22"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow-sm product mb-4">
                <div class="card-body">
                    <figure class="text-center">
                        <img src="template/img/product2.png" alt="">
                    </figure>
                    <p class="mb-1">
                        <small class="text-opac">Protein</small>
                        <small class="float-end"><span class="text-opac">4.5</span> <i class="bi bi-star-fill text-warning"></i></small>
                    </p>
                    <a href="product.html" class="text-normal">
                        <h6 class="text-color-theme">Best Banana</h6>
                    </a>
                    <div class="row">
                        <div class="col">
                            <p class="mb-0">$8.00<br><small class="text-opac">per 12 pcs</small></p>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle shadow btn-gradient"
                                    data-bs-toggle="modal" data-bs-target="#addproductcart">
                                <i class="bi bi-plus size-22"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow-sm product mb-4">
                <div class="card-body">
                    <figure class="text-center">
                        <img src="template/img/product3.png" alt="">
                    </figure>
                    <p class="mb-1">
                        <small class="text-opac">Fresh</small>
                        <small class="float-end"><span class="text-opac">4.5</span> <i class="bi bi-star-fill text-warning"></i></small>
                    </p>
                    <a href="product.html" class="text-normal">
                        <h6 class="text-color-theme">Watermelon</h6>
                    </a>
                    <div class="row">
                        <div class="col">
                            <p class="mb-0">$11.00<br><small class="text-opac">per 1 kg</small></p>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle shadow btn-gradient"
                                    data-bs-toggle="modal" data-bs-target="#addproductcart">
                                <i class="bi bi-plus size-22"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow-sm product mb-4">
                <div class="card-body">
                    <figure class="text-center">
                        <img src="template/img/product4.png" alt="">
                    </figure>
                    <p class="mb-1">
                        <small class="text-opac">Fresh</small>
                        <small class="float-end"><span class="text-opac">4.5</span> <i class="bi bi-star-fill text-warning"></i></small>
                    </p>
                    <a href="product.html" class="text-normal">
                        <h6 class="text-color-theme">Yellow Lemon</h6>
                    </a>
                    <div class="row">
                        <div class="col">
                            <p class="mb-0">$8.00<br><small class="text-opac">per 1 kg</small></p>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle shadow btn-gradient"
                                    data-bs-toggle="modal" data-bs-target="#addproductcart">
                                <i class="bi bi-plus size-22"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="row mb-3">
        <div class="col">
            <h5 class="mb-0">Are you looking for </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-2">
            <div class="badge-new me-2 mb-3 shadow-sm">Free Delivery</div>
            <div class="badge-new active me-2 mb-3 shadow-sm">$ 1.00 - $ 10.00</div>
            <div class="badge-new me-2 mb-3 shadow-sm">New</div>
            <div class="badge-new me-2 mb-3 shadow-sm">$ 11.00 - $ 20.00</div>
            <div class="badge-new me-2 mb-3 shadow-sm">Fresh</div>
            <div class="badge-new me-2 mb-3 shadow-sm">Protein</div>
        </div>
    </div>

    <!-- trending items -->
    <div class="row mb-3">
        <div class="col">
            <h5 class="mb-0">Trending Items</h5>
        </div>
    </div>
    <!-- trending -->
    <div class="swiper-container trendingslides">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <div class="card shadow-sm product mb-4">
                    <figure class="text-center mb-0 bg-light-warning">
                        <img src="template/img/product1.png" alt="">
                    </figure>
                    <div class="card-body">
                        <p class="mb-1">
                            <small class="text-opac">Fresh</small>
                            <small class="float-end"><span class="text-opac">4.5</span> <i class="bi bi-star-fill text-warning"></i></small>
                        </p>
                        <a href="product.html" class="text-normal">
                            <h6 class="text-color-theme">Red Apple</h6>
                        </a>
                        <div class="row">
                            <div class="col">
                                <p class="mb-0">$12.00<br><small class="text-opac">per 1 kg</small></p>
                            </div>
                            <div class="col-auto">
                                <!-- button counter increamenter-->
                                <div class="counter-number">
                                    <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                        <i class="bi bi-dash size-22"></i>
                                    </button>
                                    <span>1</span>
                                    <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                        <i class="bi bi-plus size-22"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="card shadow-sm product mb-4">
                    <figure class="text-center mb-0 bg-light-warning">
                        <img src="template/img/product2.png" alt="">
                    </figure>
                    <div class="card-body">
                        <p class="mb-1">
                            <small class="text-opac">Protein</small>
                            <small class="float-end"><span class="text-opac">4.5</span> <i class="bi bi-star-fill text-warning"></i></small>
                        </p>
                        <a href="product.html" class="text-normal">
                            <h6 class="text-color-theme">Best Banana</h6>
                        </a>
                        <div class="row">
                            <div class="col">
                                <p class="mb-0">$8.00<br><small class="text-opac">per 12 pcs</small></p>
                            </div>
                            <div class="col-auto">
                                <!-- button counter increamenter-->
                                <div class="counter-number">
                                    <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                        <i class="bi bi-dash size-22"></i>
                                    </button>
                                    <span>1</span>
                                    <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                        <i class="bi bi-plus size-22"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="card shadow-sm product mb-4">
                    <figure class="text-center mb-0 bg-light-warning">
                        <img src="template/img/product3.png" alt="">
                    </figure>
                    <div class="card-body">
                        <p class="mb-1">
                            <small class="text-opac">Fresh</small>
                            <small class="float-end"><span class="text-opac">4.5</span> <i class="bi bi-star-fill text-warning"></i></small>
                        </p>
                        <a href="product.html" class="text-normal">
                            <h6 class="text-color-theme">Watermelon</h6>
                        </a>
                        <div class="row">
                            <div class="col">
                                <p class="mb-0">$11.00<br><small class="text-opac">per 1 kg</small></p>
                            </div>
                            <div class="col-auto">
                                <!-- button counter increamenter-->
                                <div class="counter-number">
                                    <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                        <i class="bi bi-dash size-22"></i>
                                    </button>
                                    <span>1</span>
                                    <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                        <i class="bi bi-plus size-22"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="card shadow-sm product mb-4">
                    <figure class="text-center mb-0 bg-light-warning">
                        <img src="template/img/product4.png" alt="">
                    </figure>
                    <div class="card-body">
                        <p class="mb-1">
                            <small class="text-opac">Fresh</small>
                            <small class="float-end"><span class="text-opac">4.5</span> <i class="bi bi-star-fill text-warning"></i></small>
                        </p>
                        <a href="product.html" class="text-normal">
                            <h6 class="text-color-theme">Yellow Lemon</h6>
                        </a>
                        <div class="row">
                            <div class="col">
                                <p class="mb-0">$8.00<br><small class="text-opac">per 1 kg</small></p>
                            </div>
                            <div class="col-auto">
                                <!-- button counter increamenter-->
                                <div class="counter-number">
                                    <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                        <i class="bi bi-dash size-22"></i>
                                    </button>
                                    <span>1</span>
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

    <!-- Near by shops -->
    <div class="row mb-3">
        <div class="col">
            <h5 class="mb-0">Near by shop</h5>
        </div>
    </div>
    <!-- shop slides -->
    <div class="row">
        <div class="col-12 px-0">
            <div class="swiper-container shopslides mb-4">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <div class="card shadow-sm ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <figure class="text-center mb-0 avatar avatar-60 page-bg rounded">
                                            <i class="bi bi-shop size-24 text-color-theme"></i>
                                        </figure>
                                    </div>
                                    <div class="col">
                                        <a href="#" class="text-normal text-color-theme">
                                            <h6 class="mb-1">Atlanicaa Food <i class="bi bi-arrow-up-right-circle text-color-theme float-end"></i></h6>
                                        </a>
                                        <p class="mb-1">B-49, Feirra Street</p>
                                        <p class="small d-block">
                                            <span class="text-opac">10:00am - 11:00pm</span>
                                            <span class="float-end"><span class="text-opac">2.5km</span> <i
                                                        class="bi bi-geo-alt"></i></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <figure class="text-center mb-0 avatar avatar-60 page-bg rounded">
                                            <i class="bi bi-shop size-24 text-color-theme"></i>
                                        </figure>
                                    </div>
                                    <div class="col">
                                        <a href="#" class="text-normal text-color-theme">
                                            <h6 class="mb-1">Milbar Food <i class="bi bi-arrow-up-right-circle text-color-theme float-end"></i></h6>
                                        </a>
                                        <p class="mb-1">A-39, Axaar Street</p>
                                        <p class="small d-block">
                                            <span class="text-opac">10:00am - 11:00pm</span>
                                            <span class="float-end"><span class="text-opac">2.5km</span> <i
                                                        class="bi bi-geo-alt"></i></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <figure class="text-center mb-0 avatar avatar-60 page-bg rounded">
                                            <i class="bi bi-shop size-24 text-color-theme"></i>
                                        </figure>
                                    </div>
                                    <div class="col">
                                        <a href="#" class="text-normal text-color-theme">
                                            <h6 class="mb-1">Amazon Fresh<i class="bi bi-arrow-up-right-circle text-color-theme float-end"></i></h6>
                                        </a>
                                        <p class="mb-1">C-49, Lothal at</p>
                                        <p class="small d-block">
                                            <span class="text-opac">10:00am - 11:00pm</span>
                                            <span class="float-end"><span class="text-opac">2.5km</span> <i
                                                        class="bi bi-geo-alt"></i></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- toast messages -->
    <div class="row mb-3">
        <div class="col">
            <h5 class="mb-0">Helpful actions</h5>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="card shadow-sm">
                <ul class="list-group list-group-flush bg-none">
                    <li class="list-group-item" id="toastprouctaddedtinybtn">
                        <div class="row gx-3">
                            <div class="col-auto"><i class="bi bi-check-circle text-color-theme"></i></div>
                            <div class="col">Product Added Tiny</div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-chevron-right text-opac small"></i>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item" id="toastprouctaddedbtn">
                        <div class="row gx-3">
                            <div class="col-auto"><i class="bi bi-check-circle text-color-theme"></i></div>
                            <div class="col">Product Added Simple</div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-chevron-right text-opac small"></i>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item" id="toastprouctaddedrichbtn">
                        <div class="row gx-3">
                            <div class="col-auto"><i class="bi bi-check-circle text-color-theme"></i></div>
                            <div class="col">Product Added Rich</div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-chevron-right text-opac small"></i>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item" data-bs-toggle="modal" data-bs-target="#addproductcart">
                        <div class="row gx-3">
                            <div class="col-auto"><i class="bi bi-check-circle text-color-theme"></i></div>
                            <div class="col">Product Added Modal</div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-chevron-right text-opac small"></i>
                            </div>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--News and announcements -->
    <div class="row mb-3">
        <div class="col">
            <h5 class="mb-0">News and Updates</h5>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="text-center mb-0 avatar avatar-90 coverimg page-bg rounded">
                                <img src="template/img/news1.jpg" alt="">
                            </figure>
                        </div>
                        <div class="col ps-0">
                            <p class="small d-block mb-2">
                                <span class="text-opac">Trend setter</span>
                                <span class="float-end"><span class="text-opac">26 July 2021</span> <i class="bi bi-clock"></i></span>
                            </p>
                            <a href="#" class="text-normal text-color-theme">
                                <h6>Best UI UX design with your loving frameworks</h6>
                            </a>
                            <div class="mb-1">
                                <figure class="text-center mb-0 avatar avatar-20 coverimg">
                                    <img src="template/img/user2.jpg" alt="">
                                </figure>
                                Archana Singh
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="text-center mb-0 avatar avatar-90 coverimg page-bg rounded">
                                <img src="template/img/news2.jpg" alt="">
                            </figure>
                        </div>
                        <div class="col ps-0">
                            <p class="small d-block mb-2">
                                <span class="text-opac">ReadOut</span>
                                <span class="float-end"><span class="text-opac">26 July 2021</span> <i class="bi bi-clock"></i></span>
                            </p>
                            <a href="#" class="text-normal text-color-theme">
                                <h6>Make a distance from bad design & accept the change</h6>
                            </a>
                            <div class="mb-1">
                                <figure class="text-center mb-0 avatar avatar-20 coverimg">
                                    <img src="template/img/user1.jpg" alt="">
                                </figure>
                                John Doe
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="text-center mb-0 avatar avatar-90 coverimg page-bg rounded">
                                <img src="template/img/news3.jpg" alt="">
                            </figure>
                        </div>
                        <div class="col ps-0">
                            <p class="small d-block mb-2">
                                <span class="text-opac">FoodTechy</span>
                                <span class="float-end"><span class="text-opac">26 July 2021</span> <i class="bi bi-clock"></i></span>
                            </p>
                            <a href="#" class="text-normal text-color-theme">
                                <h6>Never regret of buying and trying new things</h6>
                            </a>
                            <div class="mb-1">
                                <figure class="text-center mb-0 avatar avatar-20 coverimg">
                                    <img src="template/img/user3.jpg" alt="">
                                </figure>
                                Laxmisho Johnson
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main page content ends -->
