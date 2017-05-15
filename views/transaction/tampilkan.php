<?php

use yii\helpers\Html;
 use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Transaction;
use app\models\Customer;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Tabel Transaksi</h1>

<div class="col-md-4">
<?php $form = ActiveForm::begin(['action' =>Url::to(['transaction/filterdate']), 'id' => 'forum_post', 'method' => 'post',]); ?>
    <?= $form->field($transaksiForm, 'transdate')->widget(
                DatePicker::className(),[
                    'inline' => false,
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]
            ) ?>
            <!-- To Date -->
    <?= $form->field($transaksiForm, 'todate')->widget(
                DatePicker::className(),[
                    'inline' => false,
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]
            ) ?>
            <!-- Filter Name -->
    <?= $form->field($transaksiForm, 'customer')->dropDownList(
        ArrayHelper::map(Customer::find()->all(),'id','name'),
        ['prompt'=>'Pilih Nama Customer']

    ) ?>
            <div class="form-group">
            <?= Html::submitButton('Cari', ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            </div>
<?php ActiveForm::end(); ?>
</div>

<div class="table-responsive">
<table class="table table-bordered table-striped">
        <tr>
            <th>Nomor Jurnal</th>
            <th>ID Customer</th>
            <th>Nama Transaksi</th>
            <th>Tipe Pembayaran</th>
            <th>Sejumlah</th>
            <th>Tanggal Transaksi</th>
        </tr>
        <?php foreach($models as $item):?>
            <?php 
                if ($item['type'] == "c") {
                    $type = "Kridit";
                }elseif ($item['type'] == "d") {
                    $type = "Debit";
                }
            ?>
        <tr>
            <td><?= $item['jurnal_no']?></td>
            <td><?= $item->customer->name?></td>
            <td><?= $item['trans_name']?></td>
            <td><?= $type?></td>
            <td><?= $item['amount']." ".$item['currency']?></td>
            <td><?= $item['trans_date']?></td>
        </tr>
    <?php endforeach;?>
    </table>
<!--  -->
</div>
