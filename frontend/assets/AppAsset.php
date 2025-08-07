<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&amp;display=swap',
        'https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400&amp;display=swap',
        'template/font/bootstrap-icons.css',
        'template/vendor/nouislider/nouislider.min.css',
        'template/vendor/swiperjs-6.6.2/swiper-bundle.min.css',
        'template/css/style.css',
    ];
    public $js = [
        "template/js/jquery-3.3.1.min.js",
        "template/js/popper.min.js",
        "template/vendor/bootstrap-5/js/bootstrap.bundle.min.js",
        "template/js/jquery.cookie.js",
        "template/js/pwa-services.js",
        "template/vendor/swiperjs-6.6.2/swiper-bundle.min.js",
        "template/vendor/nouislider/nouislider.min.js",
        "template/js/main.js",
        "template/js/color-scheme.js",
        "template/js/app.js"
    ];
    public $depends = [
    ];
}
