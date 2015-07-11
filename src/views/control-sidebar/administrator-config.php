<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use johnitvn\f2ngin\assets\F2NginAsset;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model johnitvn\f2ngin\models\AdministratorConfigForm */

?>
<?php $form = ActiveForm::begin([
					'id' => 'adminstrator-config-form', 					
					'action' => ['/f2ngin/default/save-administrator-config'],
					'method'=>'post',
					'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
					]); ?>

<?= $form->field($model, 'default_skin')->dropDownList(F2NginAsset::getAvaibleSkinLabels())?>

<?= Html::submitButton('Save', [
					'class' => 'btn btn-primary btn-block btn-flat', 
					'name' => 'login-button'
					]) ?>
