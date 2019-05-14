<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '/web';
    public $css = [
        'css/admin/font-awesome.min.css',
        'css/admin/animate.css',
        'css/admin/pace.css',
        'css/admin/skins/all.css',
        'css/admin/themes/style1/orange-blue.css',
        'css/admin/style-responsive.css',
        'css/map/leaflet.css',
        'css/map/mapbox-gl.css',
        'css/map/esri-leaflet-geocoder.css',
    ];
    public $js = [
        'js/admin/jquery-migrate-1.2.1.min.js',
        'js/admin/jquery-ui.js',
        'js/admin/bootstrap-hover-dropdown.js',
        'js/admin/html5shiv.js',
        'js/admin/respond.min.js',
        'js/admin/jquery.metisMenu.js',
        'js/admin/jquery.slimscroll.min.js',
        'js/admin/jquery.cookie.js',
        'js/admin/icheck.min.js',
        'js/admin/custom.min.js',
        'js/admin/jquery.menu.js',
        'js/admin/pace.min.js',
        'js/admin/holder.js',
        // 'vendors/calendar/zabuto_calendar.min.js',
        'js/admin/index.js',
        'js/map/leaflet.js',
        'js/map/leaflet-mapbox-gl.js',
        'js/map/esri-leaflet.js',
        'js/map/esri-leaflet-geocoder.js',
        'js/admin/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
