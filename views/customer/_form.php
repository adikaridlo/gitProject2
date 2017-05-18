<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Country;
use app\models\City;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker;




/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
<!--  -->
<!-- TEST -->
 <?= $form->field($model, 'country_id')->dropDownList(
        ArrayHelper::map(Country::find()->all(), 'id','name'),
        [
            'prompt'=>'Select Country',
            'onchange'=>'
                $.post( "http://filter.com/city/lists?id='.'"+$(this).val(), function( data ){
                    $( "select#customer-city_id" ).html(data);
                });'
        ]);?>

<?= $form->field($model, 'city_id')->dropDownList(
        ArrayHelper::map(City::find()->all(), 'id','name'),
        [
            'prompt'=>'Select City',
        ]);?>
<!-- TEST -->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
