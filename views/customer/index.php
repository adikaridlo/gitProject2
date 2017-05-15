<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Country;
use app\models\City;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'email:email',
            'telp',
            'address',
            [
            'attribute' => 'country_id',
            'filter' => \kartik\select2\Select2::widget([
                'model' => $searchModel,
                'attribute' => 'country_id',
                'data' => ArrayHelper::map(Country::find()->all(), 'id', 'name')
            ]),
            'value' => function($data){
                return $data->country->name;
            }
        ],
        [
            'attribute' => 'city_id',
            'filter' => \kartik\select2\Select2::widget([
                'model' => $searchModel,
                'attribute' => 'city_id',
                'data' => ArrayHelper::map(City::find()->all(), 'id', 'name')
            ]),
            'value' => function($data){
                return $data->city->name;
            }
        ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
