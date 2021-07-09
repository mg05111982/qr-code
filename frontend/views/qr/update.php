<?php

use frontend\assets\QrFormAsset;
use frontend\models\QrForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

/** @var QrForm $model */

QrFormAsset::register($this);

$form = ActiveForm::begin([
    'id' => 'qr_create_form',
    'action' => Url::to(['qr/update']),
    'method' => 'POST',
]);
?>
<?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'title')->textInput(); ?>
<?= $form->field($model, 'params[City]')->textInput()->label('City') ?>
<?= $form->field($model, 'params[Campaign]')->textInput()->label('Campaign'); ?>
<?= $form->field($model, 'params[Source]')->textInput()->label('Source'); ?>
<?= $form->field($model, 'params[Product]')->textInput()->label('Product') ?>
<?= Html::button('Отмена', ['id' => 'form_cancel']); ?>
<?= Html::submitButton('Сохранить', ['id' => 'form_submit']); ?>

<?php
    ActiveForm::end();
