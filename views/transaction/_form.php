<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Customer; 

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-4">
    <?= $form->field($model, 'jurnal_no')->textInput()->input('jurnal_no', ['placeholder' => "Nomor Journal"] )?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'customer_id')->dropDownList(
        ArrayHelper::map(Customer::find()->all(),'id','name'),
        ['prompt'=>'Pilih Nama Customer']

    ) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'trans_name')->textInput(['maxlength' => true])->input('trans_name', ['placeholder' => "Transaction Name"] ) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'type')->dropDownList(
        ['c' => 'Kredit', 'd' => 'Debet'],
        ['prompt'=>'Pilih Type Transaksi']

    ) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'amount')->textInput()->input('amount', ['placeholder' => "Amount"] ) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'currency')->dropDownList(
        ['IDR' => 'Rupiah', 'MYR' => 'Ringgit', 'SGD' => 'Singapura'],
        ['prompt'=>'Pilih Type Mata Uang']) ?>
    </div>
        <div class="col-md-4">
            <?= $form->field($model, 'trans_date')->widget(
                DatePicker::className(),[
                    'inline' => false,
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]
            ) ?>
        </div>
    <div class="form-group col-md-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
