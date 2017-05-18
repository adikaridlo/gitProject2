<?php

namespace app\controllers;
use Yii;
use yii\web\Response;
use app\models\Services;
use yii\rest\Controller;

class ServicesController extends Controller
{
	// public $modelClass = "app\models\Service";
	public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'insert' => ['POST'],
                    'update' => ['PUT'],
                ],
            ],
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['insert','update'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

	// return [
 //            [['jurnal_no', 'customer_id', 'trans_name', 'type', 'amount', 'currency', 'trans_date'], 'required'],
 //            [['jurnal_no', 'customer_id', 'amount'], 'integer'],
 //            [['trans_date'], 'safe'],
 //            [['trans_name', 'currency'], 'string', 'max' => 225],
 //            [['type'], 'string', 'max' => 3],
 //            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
 //        ];

	public function actionInsert(){
		$post = Yii::$app->request->post();
		$tambah = new Services();
		$tambah->attributes = $post;
		$tambah->save();

		if ($tambah->validate()) {
		   return array('status'=> true,'data'=>'Service has been created');
		  } else {
		   return array('status'=> false, 'data'=>$tambah->getErrors());
		  }

	}

	public function actionUpdate($id)
    {
    	$post = Yii::$app->request->post();
		$ubah = Services::findOne($id);
		foreach ($post as $key => $value) {
			$ubah->$key = $value;
		}
		$ubah->save();
		if ($ubah->validate()) {
		   return array('status'=> true,'data'=>'Success...');
		  } else {
		   return array('status'=> false, 'data'=>$ubah->getErrors());
		  }
    }
}
?>