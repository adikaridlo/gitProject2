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
		            	'excel'  => ['POST'],
		            	'cetak'  => ['GET'],
	            		],
            	],

		        [
		        	'class' => 'yii\filters\ContentNegotiator',
		        	'only' => ['insert','update', 'excel', 'cetak'],
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
	     }elseif($action->id == "excel") {
	     	$post = parent::beforeAction($action);
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

    public function actionExcel()
    {
        $objPHPExcel = new \PHPExcel();
        $post = Yii::$app->request->post('Transaction');
        $data = Transaction::find()
                ->joinWith('customer')
                ->all();

                $sheet=0;
                  
                $objPHPExcel->setActiveSheetIndex($sheet);

                 
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                
            $objPHPExcel->getActiveSheet()->setTitle('xxx')                     
             ->setCellValue('A1', 'Nomor Jurnal')
             ->setCellValue('B1', 'Nama Customer')
             ->setCellValue('C1', 'Jenis Transaksi')
             ->setCellValue('D1', 'Tipe Pembayaran')
             ->setCellValue('E1', 'Biaya')
             ->setCellValue('F1', 'Tanggal Transaksi');
                 
         $row=2; //Mengatur tata letak data yang akan ditampilkan berada di baris keberapa...

                $type = "";             
                foreach ($data as $foo) {  
                    
                    if ($foo['type'] == "c") {
                        $type = "Kredit";
                    }elseif ($foo['type'] == "d") {
                        $type = "Debet";
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$foo['jurnal_no']); 
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$foo->customer->name);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$foo['trans_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$type);
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$foo['currency']." ".$foo['amount']);
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$foo['trans_date']);
                    $row++ ;
                }
                        
        header('Content-Type: application/vnd.ms-excel');
        $filename = "Data Transaksi_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');    
  }

  public function actionCetak($id)
    {
        $objPHPExcel = new \PHPExcel();
        $data = Transaction::find()
                ->joinWith('customer')
                ->Where(['transaction.id' => $id])
                ->all();

                $sheet=0;
                  
                $objPHPExcel->setActiveSheetIndex($sheet);

                 
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                
            $objPHPExcel->getActiveSheet()->setTitle('xxx')                     
             ->setCellValue('A1', 'Nomor Jurnal')
             ->setCellValue('B1', 'Nama Customer')
             ->setCellValue('C1', 'Jenis Transaksi')
             ->setCellValue('D1', 'Tipe Pembayaran')
             ->setCellValue('E1', 'Biaya')
             ->setCellValue('F1', 'Tanggal Transaksi');
                 
         $row=2; //Mengatur tata letak data yang akan ditampilkan berada di baris keberapa...

                $type = "";             
                foreach ($data as $foo) {  
                    
                    if ($foo['type'] == "c") {
                        $type = "Kredit";
                    }elseif ($foo['type'] == "d") {
                        $type = "Debet";
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$foo['jurnal_no']); 
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$foo->customer->name);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$foo['trans_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$type);
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$foo['currency']." ".$foo['amount']);
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$foo['trans_date']);
                    $row++ ;
                }
                        
        header('Content-Type: application/vnd.ms-excel');
        $filename = "Bukti Transaksi_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');    
  }

}
?>