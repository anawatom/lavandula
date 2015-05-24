<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\LoginForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

// $this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$model = new LoginForm();
?>
<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #666666;
      }

      .form-signin {
        max-width: 400px;
/*         padding: 19px 49px 39px; */
        margin: 0 auto 200px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading {
        margin-bottom: 10px;
         font-size: 22px;
      }
       .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
      .form-input{
      	padding: 19px 49px 39px;
      }
      .form-header{
      	height: 100px;
      	background: url("images/banner-login.png");
      }
      .form-error {
        padding: 3px 6px;
      }
</style>
<div class="container">
	<div class="form-signin">
	
		<div class="form-header">
<!-- 			ABCD -->
		</div>
    <?php if (isset($msg)) { ?>
      <div class="form-error bg-danger">
        <span class="text-danger"><?= $msg; ?></span>
      </div>
    <?php } ?>
		<div class="form-input">

		    <?php $form = ActiveForm::begin([
		        'id' => 'login-form',
		        'options' => ['class' => 'form-horizontal'],
		        //'fieldConfig' => [
		          //  'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
		           // 'labelOptions' => ['class' => 'col-lg-1 control-label'],
		      //  ],
		    ]); ?>
		      <?= $form->field($model, 'username') ?>
		
		      <?= $form->field($model, 'password')->passwordInput() ?>
		
          <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
		    <?php ActiveForm::end(); ?>
	    </div>
	</div>
  
</div>
