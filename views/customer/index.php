<?php

use yii\helpers\Html;
 use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Country;
use app\models\City;
use app\models\Customer;
use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Table Customer</h1>

<div class="col-md-4">
<?php $form = ActiveForm::begin(['action' =>Url::to(['customer/index']), 'id' => 'forum_post', 'method' => 'post',]); ?>
<!-- Filter Negara -->
    <?= $form->field($CustomerForm, 'negara')->dropDownList(
        ArrayHelper::map(Country::find()->all(), 'id','name'),
        [
            'prompt'=>'Select Country',
            'onchange'=>'
                $.post( "http://filter.com/city/lists?id='.'"+$(this).val(), function( data ){
                    $( "select#customerform-kota" ).html(data);
                });'
        ]);?>
<!-- Filter Kota -->
    <?= $form->field($CustomerForm, 'kota')->dropDownList(
        ArrayHelper::map(City::find()->all(), 'id','name'),
        [
            'prompt'=>'Select City',
        ]);?>
<!-- Filter Nama -->
    <?= $form->field($CustomerForm, 'nama')->widget(Select2::classname(), [
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
<?= Html::a('Tambah Data Customer', array('customer/create', 'class' => 'btn btn-primary waves-effect waves-light'))?>
<table class="table table-bordered table-striped">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Alamat</th>
            <th>Negara</th>
            <th>Kota</th>
        </tr>
        <?php foreach($models as $item):?>
        <tr>
            <td><?= $item->name?></td>
            <td><?= $item->email?></td>
            <td><?= $item->telp?></td>
            <td><?= $item->address?></td>
            <td><?= $item->country->name?></td>
            <td><?= $item->city->name?></td>
            <!--  -->
        </tr>
    <?php endforeach;?>
    </table>
<?php echo LinkPager::widget([
    'pagination' => $pages,
]);?>
</div>
