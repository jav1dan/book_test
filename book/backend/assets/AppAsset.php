<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        'css/sbadmin.css'
    ];
    public $js = [
        'https://use.fontawesome.com/releases/v6.3.0/js/all.js',
        'js/bootstrap.bundle.min.js',
        'js/script.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap5\BootstrapAsset',
    ];
}
