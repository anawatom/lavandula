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
//     'assets/js/jquery-2.1.1.js',
    'web-assets/jquery-ui/jquery-ui.js',
   // 'assets/mmenu/src/js/jquery.mmenu.min.all.js',
	'web-assets/metisMenu/js/metismenu.min.js',
	'web-assets/metisMenu/js/bootstrap.min.js',
	'web-assets/metisMenu/js/bootstrap-dialog.min.js',
	'web-assets/ajaxfileupload/ajaxfileupload.js',
	'web-assets/js/common.js',
    'web-assets/gmaps/map.js',
    'web-assets/gmaps/jquery.ui.map.js',
    'web-assets/gmaps/common.js',
    'web-assets/gmaps/controls.js',
    'web-assets/gmaps/infowindow.js',
    'web-assets/gmaps/map.js',
    'web-assets/gmaps/marker.js',
    'web-assets/gmaps/onion.js',
    'web-assets/gmaps/stats.js',
    'web-assets/gmaps/util.js',
    'web-assets/gmaps/overlay.js',
    'web-assets/select2/select2.min.js',
    'web-assets/js/loading.js'
    		];
    public $css = [
       'css/site.css',
       'web-assets/mmenu/src/css/jquery.mmenu.all.css',
       'web-assets/jquery-ui/jquery-ui.css',
       'web-assets/mmenu/css/demo.css',
       'web-assets/metisMenu/css/demo.css',
       'web-assets/metisMenu/css/font-awesome.min.css',
       'web-assets/metisMenu/css/metismenu.min.css',
       'web-assets/metisMenu/css/prism.min.css',
       'web-assets/metisMenu/css/bootstrap.min.css',
       'web-assets/metisMenu/css/bootstrap-dialog.min.css',
       'web-assets/select2/select2.css',
       'css/loading.css'
       
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
