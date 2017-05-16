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
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Tabel Transaksi</h1>

<div class="col-md-4">
<?php $form = ActiveForm::begin(['action' =>Url::to(['transaction/index']), 'id' => 'forum_post', 'method' => 'post',]); ?>
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
<?= $form->field($transaksiForm, 'customer')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Customer::find()->all(), 'id','name'),
            'options' => ['prompt' => 'Select a name ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);?>
            <div class="form-group">
            <?= Html::submitButton('Cari', ['class' => 'btn btn-primary waves-effect waves-light']) ?>
            </div>
<?php ActiveForm::end(); ?>
</div>

<div class="table-responsive">
<?= Html::a('Tambah Data', array('transaction/create', 'class' => 'btn btn-primary waves-effect waves-light'))?>
<table class="table table-bordered table-striped">
        <tr><th>Nomor Jurnal</th><th>Customer Name</th><th>Nama Transaksi</th><th>Tipe Pembayaran</th><th>Sejumlah</th><th>Tanggal Transaksi</th>
        </tr>
        <?php foreach($models as $item):?>
            <?php 
                if ($item['type'] == "c") {
                    $type = "Kredit";
                }elseif ($item['type'] == "d") {
                    $type = "Debit";
                }
            ?>
        <tr>
            <td><?= $item['jurnal_no']?></td>
            <td><?= $item->customer->name?></td>
            <td><?= $item['trans_name']?></td>
            <td><?= $type?></td>
            <td><?= $item['currency']." ".$item['amount']?></td>
            <td><?= $item['trans_date']?></td>
            <!--  -->
        </tr>
    <?php endforeach;?>
    </table>
<?php echo LinkPager::widget([
    'pagination' => $pages,
]);?>
</div>
