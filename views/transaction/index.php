<?php

use yii\helpers\Html;
 use yii\helpers\Url;
use yii\grid\GridView;
//use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Transaction;
use app\models\TransaksiForm;
use app\models\Customer;
use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12 del">
    <?= Html::a(' PRINT ALL DATA', ['transaction/excel'], ['class' => 'btn btn-success glyphicon glyphicon-print'], ['method' => 'POST'])?>
    <?= Html::a('',['create'], ['class' => 'btn btn-success glyphicon glyphicon-plus'])?>
</div>
<div class="col-md-6">
<h1>Tabel Transaksi</h1>

    <?php $form = ActiveForm::begin(['action' =>Url::to(['transaction/index']),'method' => 'post',]); ?>

    <!-- Filter Name -->
<?= $form->field($transaksiForm, 'customer')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Customer::find()->all(), 'id','name'),
            'options' => ['prompt' => 'Select a name ...', 'class' => 'cust'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);?>
        
    <?= $form->field($transaksiForm, 'transdate')->widget(
                DatePicker::className(),[
                    'inline' => false,
                    'options' => ['placeholder' => 'Enter birth date ...', 'class' => 'from'],
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
                    'options' => ['placeholder' => 'Enter birth date ...', 'class' => 'to'],
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]
            ) ?>

            <div>
                <?= Html::button('Cari', ['class' => 'btn btn-primary waves-effect waves-light', 'id' => 'cari']) ?>
            </div>
<?php ActiveForm::end(); ?>
            <!-- Bagaiman caranya biar Datepicker bisa di panggil di inputan -->
</div>
<div class="col-md-12" id="mytable">
<div class="table-responsive">
<?php echo Html::beginForm(array('transaction/excel')); ?>
<table class="table table-bordered table-striped" >
        <tr>
        <th>Nomor Jurnal</th>
        <th>Customer Name</th>
        <th>Nama Transaksi</th>
        <th>Tipe Pembayaran</th>
        <th>Sejumlah</th>
        <th>Tanggal Transaksi</th>
        <th>Cetak</th>
        </tr>

        <?php if ($models == NULL) {
            echo "<tr>
                    <td> Not Result </td>
                </tr>
            </table>
            ";

        }else{?>

                <?php foreach($models as $item):?>

                    <?php 
                        if ($item['type'] == "c") {
                            $type = "Kredit";
                        }elseif ($item['type'] == "d") {
                            $type = "Debit";
                        }

                        $data[] = array(
                        'jurnal_no' => $item['jurnal_no'],
                        'customer' => $item->customer->name,
                        'trans_name' => $item['trans_name'],
                        'type' => $type,
                        'trans_date' => $item['trans_date']
                        );

                    ?>

                    <tr>
                        <td><?= $item['jurnal_no']?></td>
                        <td><?= $item->customer->name?></td>
                        <td><?= $item['trans_name']?></td>
                        <td><?= $type?></td>
                        <td class="text-right"><?= $item['currency']." ".$item['amount']?></td>
                        <td><?= $item['trans_date']?></td>
                        <td class="text-center"><?=  Html::a('',['cetak', 'id' => $item['id']], ['class' => 'glyphicon glyphicon-download-alt'])?></td>
                    </tr>

            <?php endforeach;?>

            </table>
<?php }?>

<?php echo Html::endForm(); ?>

<?php
    if ($datacetak != NULL) {
        foreach ($datacetak as $cetak) {
                  if ($cetak['type'] == "c") {
                            $type = "Kredit";
                        }elseif ($cetak['type'] == "d") {
                            $type = "Debit";
                        }
                        $currency = $cetak['currency'];
                        $amount   = $cetak['amount'];
                        $data2[] = array(
                        'jurnal_no' => $cetak['jurnal_no'],
                        'customer' => $cetak->customer->name,
                        'trans_name' => $cetak['trans_name'],
                        'type' => $type,
                        'biaya' => $currency." ".$amount,
                        'trans_date' => $cetak['trans_date']
                        );
        }

                    if($filter == "YES") {
                       
                       echo Html::a(' PRINT DATA FILTER', ['transaction/filter', 'data' => $data2], ['class' => 'btn btn-success glyphicon glyphicon-print'], ['method' => 'POST']);

                    }elseif($filter == "NO"){

                       echo Html::a('');

                    }

    }elseif ($datacetak == NULL) {

        echo "";
    }
?>


<?php echo LinkPager::widget([
    'pagination' => $pages,
]);?>

</div>
</div>


<?php $this->registerJs("
    $(document).ready(function(){
        
        

        $('#cari').click(function(){
            var From = $('.from').val();
            var to   = $('.to').val();
            var customer   = $('.cust').val();

            if (From != '' && to == '' && customer == '') {

                alert('Please To Date Harus Di Isi..');

            }else if(From == '' && to != ''  && customer == ''){

                alert('Please Transaksi Date Harus Di Isi..');

            }else if(From == '' && to == '' && customer == ''){

                alert('Data Harap di Isi..');

            }else if(From != '' && to == '' && customer != ''){

                alert('Please To Date Harus Di Isi..');

            }else if(From == '' && to != '' && customer != ''){

                alert('Please Transaksi Date Harus Di Isi..');

            }else if(From == '' && to == ''  && customer != '' || From != '' && to != '' && customer == '' ||  From != '' && to != '' && customer != ''){
                 
                var dataString = 'From1='+ From + '&to1='+ to + '&customer1='+ customer;
                $.ajax({
                        type: 'POST',
                        url: '".Url::home(true) . '/transaction/index'."',
                        data: dataString,
                        cache: false,
                        success: function(data){
                             $('#mytable').html($(data).find('.table-responsive').html());
                          

                        }
                });
            }

        });
    });

"); ?>

