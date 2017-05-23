<?php

namespace app\controllers;
use Yii;
use yii\web\Response;
use app\models\Services;
use yii\rest\Controller;
use app\models\logs;
use yii\web\Request;

class ServicesController extends Controller
{

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

    // [1] Aksi pertama yang di eksekusi
    public function beforeAction($action)
	{
		// $respons = "";
		$logs = new logs();

	    $logs->request         = json_encode(Yii::$app->request->post('Transaction'));
	    $logs->ip_address 		= Request::getUserIP();
	    $logs->created_date    = date("Y-m-d H:i:s");

	    $logs->save();

		if($action->id == "insert"){
	         $post = parent::beforeAction($action);
	     }elseif($action->id == "insert") {
	     	# code...
	     }

	     return $post;
	}
	public function actionInsert(){
    	
    	// echo "<pre>";
    	// print_r(Yii::$app->request->post());exit;
		$post = Yii::$app->request->post('Transaction');
		$tambah = new Services();
		$tambah->attributes = $post;
		$tambah->save();
		$idLogs = Logs::find()->orderBy(['id'=>SORT_DESC])->one();

		if ($tambah->validate()) {
		   return array('status'=> true,'data'=>'Success...','id'=>$idLogs->id);
		  } else {
		   return array('status'=> false, 'data'=>$tambah->getErrors());
		  }

	}

	public function afterAction($action, $result)
	{
		 
		 if($action->id == "insert"){
            $logs = Logs::findOne($result['id']);
            $logs->respons = json_encode($result);
            $logs->save();
            $result = parent::afterAction($action, $result);
        }
        return $result;
	}



	public function actionUpdate($id){

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