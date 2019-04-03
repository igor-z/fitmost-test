<?php

use backend\models\ServiceForm;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ServiceForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'activeTo')->widget(DatePicker::class, [
        'model' => $model,
	    'attribute' => 'activeTo',
	    'dateFormat' => 'php:Y-m-d',
    ]) ?>

    <?= $form->field($model, 'cityId')->dropDownList($model->getCityList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
