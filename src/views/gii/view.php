<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\gii\components\ActiveField;
use yii\gii\CodeFile;

/* @var $this yii\web\View */
/* @var $generator yii\gii\Generator */
/* @var $id string panel ID */
/* @var $form yii\widgets\ActiveForm */
/* @var $results string */
/* @var $hasError boolean */
/* @var $files CodeFile[] */
/* @var $answers array */

$this->title = $generator->getName();

$this->params['breadcrumbs'][] = ['label' => 'Gii', 'url' => ['/gii']];
$this->params['breadcrumbs'][] = $this->title;


$templates = [];
foreach ($generator->templates as $name => $path) {
    $templates[$name] = "$name ($path)";
}
?>
<div class="row">
       <?php $form = ActiveForm::begin([
        'id' => "$id-generator",
        'successCssClass' => '',
        'fieldConfig' => ['class' => ActiveField::className()],
    ]); ?>
    <div class="col-lg-7 col-md-8">
        <div class="box box-primary">
            <div class="box-body">  
            <div><?= $generator->getDescription() ?></div>
            <div>
                <?= $this->renderFile($generator->formView(), [
                    'generator' => $generator,
                    'form' => $form,
                ]) ?>
                <?= $form->field($generator, 'template')->sticky()
                    ->label('Code Template')
                    ->dropDownList($templates)->hint('
                        Please select which set of the templates should be used to generated the code.
                ') ?>
                <div class="form-group">
                    <?= Html::submitButton('Preview', ['name' => 'preview', 'class' => 'btn btn-primary']) ?>
                    <?php if (isset($files)): ?>
                        <?= Html::submitButton('Generate', ['name' => 'generate', 'class' => 'btn btn-success']) ?>
                    <?php endif; ?>
                </div>
            </div>     
   
            </div>
        </div>
    </div>     
    <?php
        if (isset($results)) {
            echo '<div class="col-lg-7 col-md-8"><div class="box box-primary"><div class="box-body">';
            echo $this->render('view/results', [
                'generator' => $generator,
                'results' => $results,
                'hasError' => $hasError,
            ]);
            echo '</div></div></div>';
        } elseif (isset($files)) {
            echo '<div class="col-lg-7 col-md-8"><div class="box box-primary"><div class="box-body">';
            echo $this->render('view/files', [
                'id' => $id,
                'generator' => $generator,
                'files' => $files,
                'answers' => $answers,
            ]);
            echo '</div></div></div>';
        }
    ?>
     
    <?php ActiveForm::end(); ?>
</div>
