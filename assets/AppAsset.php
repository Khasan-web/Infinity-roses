<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/main.min.css',
        'css/magnific-popup.css',
        'css/map/leaflet.css',
        'css/map/mapbox-gl.css',
        'css/map/esri-leaflet-geocoder.css',
        // slider
        'css/nouislider.min.css',
    ];
    public $js = [
        "js/scripts.min.js",
        'js/inputmask.js',
        'js/jquery.inputmask.js',
        'js/jquery.magnific-popup.min.js',
        // slider
        'js/nouislider.min.js',
        'js/common.js',
        // social buttons
        '//yastatic.net/es5-shims/0.0.2/es5-shims.min.js',
        '//yastatic.net/share2/share.js',
        'js/map/leaflet.js',
        'js/map/leaflet-mapbox-gl.js',
        'js/map/esri-leaflet.js',
        'js/map/esri-leaflet-geocoder.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
