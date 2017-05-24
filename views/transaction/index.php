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

<div class="col-md-12">
    <?= Html::a(' PRINT ALL DATA', ['transaction/excel'], ['class' => 'btn btn-success glyphicon glyphicon-print'], ['method' => 'POST'])?>
    <?= Html::a('',['create'], ['class' => 'btn btn-success glyphicon glyphicon-plus'])?>
</div>

<script>
    $(function() {
       $( "#datepicker" ).datepicker();
    });
</script>

<?php $this->registerJs('
    $((#datepicker).click(function() {
       $( "#datepicker" ).datepicker();
    }));
'); ?>

<div class="col-md-4">
<h1>Tabel Transaksi</h1>
<?php Pjax::begin(); ?>
    <?= Html::beginForm(['transaction/fil'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
    <?= Html::input('text', 'transdate', Yii::$app->request->post('transdate'), ['class' => 'form-control']) ?>
    <?= Html::input('text', 'todate', Yii::$app->request->post('todate'), ['class' => 'form-control']) ?>
    <?= Html::input('text', 'customer', Yii::$app->request->post('customer'), ['class' => 'form-control']) ?>
    <?= Html::submitButton('Cari', ['class' => 'btn btn-primary waves-effect waves-light']) ?>
<?= Html::endForm() ?>
<?php Pjax::end(); ?>
            <!-- Bagaiman caranya biar Datepicker bisa di panggil di inputan -->
</div>

<div class="col-md-12">
<div class="table-responsive">

<?php echo Html::beginForm(array('transaction/excel')); ?>

<table class="table table-bordered table-striped">
        <tr>
        <th>Nomor Jurnal</th>
        <th>Customer Name</th>
        <th>Nama Transaksi</th>
        <th>Tipe Pembayaran</th>
        <th>Sejumlah</th>
        <th>Tanggal Transaksi</th>
        <th>Cetak</th>
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
            <td class="text-right"><?= $item['currency']." ".$item['amount']?></td>
            <td><?= $item['trans_date']?></td>
            <td class="text-center"><?=  Html::a('',['cetak', 'id' => $item['id']], ['class' => 'glyphicon glyphicon-download-alt'])?></td>
            <!--  -->
        </tr>
    <?php endforeach;?>
    </table>
<?php 

    if($filter == "YES") {
       echo Html::a(' PRINT DATA FILTER', ['transaction/filter', 'id' => $item['customer_id']], ['class' => 'btn btn-success glyphicon glyphicon-print'], ['method' => 'POST']);
    }elseif($filter == "NO"){
       echo Html::a('');
    }
?>
<?php echo Html::endForm(); ?>
<?php echo LinkPager::widget([
    'pagination' => $pages,
]);?>
</div>
</div>
