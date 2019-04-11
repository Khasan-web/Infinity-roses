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
    ];
    public $js = [
        'js/scripts.min.js',
        'js/inputmask.js',
        'js/jquery.inputmask.js',
        'js/jquery.magnific-popup.min.js',
        // slider mobile touch
        // 'http://code.jquery.com/ui/1.8.17/jquery-ui.min.js',
        'js/jquery.ui.touch-punch.min.js', 
        'js/common.js',
        // social buttons
        '//yastatic.net/es5-shims/0.0.2/es5-shims.min.js',
        '//yastatic.net/share2/share.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
