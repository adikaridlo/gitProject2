<?php

namespace app\controllers;

use Yii;
use app\models\Customer;
use app\models\City;
use app\models\CustomerForm;
use app\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\depdrop\DepDrop;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\filters\AccessControl;


/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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

    /**
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = new CustomerForm();

        if($model->load(yii::$app->request->post()) && $model->validate()){

            $nama = Html::encode($model->nama);
            $negara = Html::encode($model->negara);
            $kota = Html::encode($model->kota);
            echo $nama;
            echo $negara;
            echo $kota;

            $query = Customer::find()
                    ->joinWith('country')
                    ->joinWith('city')
                    ->Where(['customer.id' => $nama])
                    ->andwhere(['customer.country_id' => $negara])
                    ->andwhere(['customer.city_id' => $kota])
                    ->andwhere(['status' => 'YES'])
                    ->orderBy(['customer.id' => SORT_ASC]);

            $countQuery = clone $query;

            $pages = new Pagination([
                'defaultPageSize' => 3,
                'totalCount' => $countQuery->count()]);
            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            $CustomerForm = new CustomerForm();

            return $this->render('index',[
                'models' => $models,
                 'pages' => $pages,
                'models'=> $models,
                'CustomerForm' => $CustomerForm,
                ]);
            
        }else{

            $query = Customer::find()
                ->joinWith('country')
                ->joinWith('city')
                ->where(['status' => 'YES']);

            $countQuery = clone $query;

            $pages = new Pagination([
                'defaultPageSize' =>3,
                'totalCount' => $countQuery->count()]);

            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            $CustomerForm = new CustomerForm();

            return $this->render('index', [
                 'models' => $models,
                 'pages' => $pages,
                 'CustomerForm' => $CustomerForm,
            ]);
        }



    }

    /**
     * Displays a single Customer model.
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
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new Customer();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status = "NO";
            $model->save();
            $data = $model->load(Yii::$app->request->post());
            $idCustom = Customer::find()->orderBy(['id'=>SORT_DESC])->one();
            $fromEmail = "webs.art.info@gmail.com";
            $isiEmail = "<p>Terimakasih telah bergabung bersama Web A.R.T ! Untuk mengaktifkan akun anda, silahkan klik yang ada dibawah ini:</p><p><a href='".Url::home(true) . '/customer/validation?id='.$idCustom->id."'>Aktifkan</a>Aktifkan</p>" ;
            
             Yii::$app->mailer->compose()
                -> setFrom('web.art.info@gmail.com')
                -> setTo($model->email)
                -> setSubject("Activation".date("Y-m-d H:i:s"))
                -> setHtmlBody($isiEmail)
                -> send();
               
                 return $this->redirect(['view', 'id' => $model->id]);
        }else{
            return $this->render('create', [
                    'model' => $model,
                ]);
        }
        
    }



    public function actionValidation($id){

        $model = $this->findModel($id);

        $status = Customer::findOne($id);
        $status->status = "YES";
        $status->save();

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Updates an existing Customer model.
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
     * Deletes an existing Customer model.
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
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

        // TEST
public function actionSubcat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = \common\models\City::getOptionsbyCountry($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

 public function actionLists($id)
    {
        // echo $id;exit;
        $countCity = City::find()
                    ->where(['country_id'=>$id])
                    ->count();
        $citys = City::find()
                    ->where(['country_id'=>$id])
                    ->all();
        if ($countCity > 0) {
            foreach ($citys as $city) {
                echo "<option value='".$city->id."'>".$city->name."</option>";
            }
        }else{
                echo "<option>Not Found</option>";
        }        

    }
}
