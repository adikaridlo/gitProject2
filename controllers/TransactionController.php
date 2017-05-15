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
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new TransaksiForm();
        if($model->load(yii::$app->request->post()) && $model->validate()){
            // Jalankan Filter.....
            $transDate = Html::encode($model->transdate);
            $toDate = Html::encode($model->todate);
            $ID = Html::encode($model->customer);
            echo $ID;
            $query = Transaction::find()
                    ->joinWith('customer')
                    ->andWhere(['transaction.customer_id' => number_format($ID)])
                    ->andwhere(['between','trans_date',$transDate,$toDate]);
            $countQuery = clone $query;
            $pages = new Pagination([
                'defaultPageSize' => 3,
                'totalCount' => $countQuery->count()]);
            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            $transaksiForm = new TransaksiForm();
            return $this->render('index',[
                'models' => $models,
                 'pages' => $pages,
                'models'=> $models,
                'transaksiForm' => $transaksiForm,
                ]);
        }else{
            // Mentahan...
            $query = Transaction::find()
                ->joinWith('customer');
            $countQuery = clone $query;
            $pages = new Pagination([
                'defaultPageSize' =>2,
                'totalCount' => $countQuery->count()]);
            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            $transaksiForm = new TransaksiForm();
            return $this->render('index', [
                 'models' => $models,
                 'pages' => $pages,
                 'transaksiForm' => $transaksiForm,
            ]);
        }
        
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
    // public function actionFilterdate()
    // {
    //     $model = new TransaksiForm();
    //     if ($model->load(yii::$app->request->post()) && $model->validate()) {
    //         $transDate = Html::encode($model->transdate);
    //         $toDate = Html::encode($model->todate);
            
    //         $models = Transaction::find()
    //                 ->joinWith('customer')
    //                 ->where(['between','trans_date',$transDate,$toDate])->all();
    //         // $countQuery = clone $query;
    //         // $pages = new Pagination([
    //         //     'defaultPageSize' => 3,
    //         //     'totalCount' => $countQuery->count()]);
    //         // $models = $query->offset($pages->offset)
    //         //     ->limit($pages->limit)
    //         //     ->all();
    //         $transaksiForm = new TransaksiForm();
    //         // return $this->render('index', [
    //         //      'models' => $models,
    //         //      'pages' => $pages,
    //         //      'transaksiForm' => $transaksiForm,
    //         // ]);
    //         return $this->render('tampilkan',[
    //             'models' => $models,
    //             //  'pages' => $pages,
    //             // 'models'=> $models,
    //             'transaksiForm' => $transaksiForm,
    //             ]);
    //     }
    // }
    
}
