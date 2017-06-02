<?php

namespace app\controllers;

use Yii;
use app\models\Transaction;
use app\models\Customer;
use app\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Tabels;
use app\models\TransaksiForm;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
// use yii\widgets\ActiveForm;
// use yii\web\Response;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {

      $behaviors['access'] = [
             'class' => AccessControl::className(),
             'rules' => [
                 [
                         'allow' => true,
                         'roles' => ['@'],
                         'matchCallback' => function ($rule, $action) {
                        
                        $module             = Yii::$app->controller->module->id; 
                        $action             = Yii::$app->controller->action->id;
                        $controller         = Yii::$app->controller->id;
                        $route                     = "$controller/$action";
                        $post = Yii::$app->request->post();
                        if (\Yii::$app->user->can($route)) {
                             return true;
                        }
                        }
                 ],
             ],
           ];

        return $behaviors;
    }

  public function beforeAction($action)
  {

    if($action->id == "index")
    {
        $model = new TransaksiForm();
        $transDate = Html::encode($model->transdate);
        $toDate = Html::encode($model->todate);

        if ($transDate != NULL ) 
        {
            $todateMessage = "Tidak Boleh Kosong";
            return $this->render('index', [
                 'models' => $models,
                 'pages' => $pages,
                 'transaksiForm' => $transaksiForm,
                 'filter' => $filter,
            ]);
        }


       $post = parent::beforeAction($action);

       }elseif($action->id == "update")
       {

        $post = parent::beforeAction($action);

       }elseif($action->id == "excel") {

        $post = parent::beforeAction($action);

       }elseif($action->id == "cetak") {

        $post = parent::beforeAction($action);

       }elseif($action->id == "filter") {

        $post = parent::beforeAction($action);

       }elseif($action->id == "create") {

        $post = parent::beforeAction($action);

       }elseif($action->id == "fil") {

        $post = parent::beforeAction($action);

       }elseif($action->id == "validasiform") {

        $post = parent::beforeAction($action);

       }

       return $post;
  }

  public function actionValidasiform(array $cekform){
    
  }

    /**
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $post = Yii::$app->request->post();

        if ($post != NULL) {

           $post = Yii::$app->request->post();

              $transDate = $post['From1'];
              $toDate    = $post['to1'];
              $ID        = $post['customer1'];

            $query = Transaction::find()
                    ->joinWith('customer')
                    ->Where(['between','trans_date',$transDate,$toDate])
                    ->orwhere(['transaction.customer_id' => $ID])
                    ->orderBy(['transaction.id' => SORT_ASC]);
            $countQuery = clone $query;

            $pages = new Pagination([
                'defaultPageSize' => 20,
                'totalCount' => $countQuery->count()]);

            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            $transaksiForm = new TransaksiForm();

            $filter = "YES";

            $datacetak = Transaction::find()
                    ->joinWith('customer')
                    ->Where(['between','trans_date',$transDate,$toDate])
                    ->orwhere(['transaction.customer_id' => $ID])
                    ->orderBy(['transaction.id' => SORT_ASC])
                    ->all();
           
        }else{

            $query = Transaction::find()
                ->joinWith('customer');

            $countQuery = clone $query;

            $pages = new Pagination([
                'defaultPageSize' =>3,
                'totalCount' => $countQuery->count()]);

            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
                
            $transaksiForm = new TransaksiForm();
            $message = "";
            $datacetak = NULL;
            $filter = "NO";
        }
         return $this->render('index',[
                 'models' => $models,
                 'pages' => $pages,
                 'transaksiForm' => $transaksiForm,
                 'filter' => $filter,
                 'datacetak' => $datacetak,
                ]);

    }



    public function actionFil(){

        $post = Yii::$app->request->post();
        
        return print_r($post);

        $From ="";
        $to="";
        $custom="";
        $From=$_POST['From1'];
        echo $From;
        $to=$_POST['to1'];
        echo $to;
        $custom=$_POST['customer1'];
        echo $custom;

        $transdate = Yii::$app->request->post('transdate');
        $todate = Yii::$app->request->post('todate');
        $customer = Yii::$app->request->post('customer');

      $query = Transaction::find()
                    ->joinWith('customer')
                    ->orWhere(['between','trans_date',$From,$to])
                    ->orwhere(['transaction.customer_id' => $customer])
                    ->orderBy(['transaction.id' => SORT_ASC]);

            $countQuery = clone $query;

            $pages = new Pagination([
                'defaultPageSize' => 3,
                'totalCount' => $countQuery->count()]);

            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            $transaksiForm = new TransaksiForm();

            $filter = "YES";
            return $this->render('index',[
                'models' => $models,
                 'pages' => $pages,
                'models'=> $models,
                'transaksiForm' => $transaksiForm,
                 'filter' => $filter,
                ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

          $model = new Transaction();

          if ($model->load(Yii::$app->request->post()) && $model->save()) {

              return $this->redirect(['view', 'id' => $model->id]);

          } else {

              return $this->render('create', [
                  'model' => $model,
              ]);
          }
        
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAntri()
    {
      $model = new TransaksiForm();

      if ($model->load(Yii::$app->request->post()) && $model->validate()){
        return $this->render('antri-ok',['model' => $model]);
      }else{
        return $this->render('antri', ['model' => $model]);
      }
    }

    public function actionTampilkan()
    {
        //return $this->render('tampilkan',['query1'=>$query1]);
        $query = transaction::find()->select(['*'])
                    ->from('transaction')
                    ->all();
        return $this->render('tampilkan',['query' => $query]);
    }



    public function actionExcel()
    {
        $objPHPExcel = new \PHPExcel();

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

  public function actionFilter(array $data)
    {

      foreach($data as $cetak):

        endforeach;
     
        $objPHPExcel = new \PHPExcel();
        

                $sheet=0;
                  
                $objPHPExcel->setActiveSheetIndex($sheet);

                 
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                
            $objPHPExcel->getActiveSheet()->setTitle('xxx')                     
             ->setCellValue('A1', 'Nomor Jurnal')
             ->setCellValue('B1', 'Nama Customer')
             ->setCellValue('C1', 'Jenis Transaksi')
             ->setCellValue('D1', 'Tipe Pembayaran')
             ->setCellValue('E1', 'Total Bayar')
             ->setCellValue('F1', 'Tanggal Transaksi');
                 
         $row=2; //Mengatur tata letak data yang akan ditampilkan berada di baris keberapa...

                foreach($data as $foo):  

                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$foo['jurnal_no']); 
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$foo['customer']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$foo['trans_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$foo['type']);
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$foo['biaya']);
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$foo['trans_date']);
                    $row++ ;
                endforeach;
                        
        header('Content-Type: application/vnd.ms-excel');
        $filename = "Bukti Transaksi_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');    
  }
    
}
