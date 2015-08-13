<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = array(
    		'position' => \yii\web\View::POS_HEAD
    );
    public $js = [
    'web-assets/jquery-ui/jquery-ui.js',
    'vendor/bower/bootstrap/dist/js/bootstrap.js',
    'web-assets/taginput/bootstrap-tagsinput.js',
	'web-assets/ajaxfileupload/ajaxfileupload.js',
	'web-assets/js/common.js',
    'web-assets/select2/select2.min.js',
    'web-assets/ckeditor/ckeditor4/plugins/ckeditor_wiris/core/display.js',
    'web-assets/ckeditor/ckeditor4/ckeditor.js',
    'web-assets/jssorslider/js/jssor.js',
    'web-assets/jssorslider/js/jssor.slider.js',
    'web-assets/js/loading.js'
    ];
    public $css = [
       'vendor/bower/bootstrap/dist/css/bootstrap-theme.min.css',
       'web-assets/jquery-ui/jquery-ui.css',
       'web-assets/select2/select2.css',
       'web-assets/taginput/bootstrap-tagsinput.css',
       'web-assets/css/loading.css',
       'web-assets/css/all-krajee.css',
       'web-assets/css/main.css',
       'web-assets/css/override.css',
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
