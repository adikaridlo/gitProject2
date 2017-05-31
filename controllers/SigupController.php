<?php

namespace app\controllers;

use Yii;
use app\models\Sigups;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CityController implements the CRUD actions for City model.
 */
class SigupController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        // return [
        //     'verbs' => [
        //         'class' => VerbFilter::className(),
        //         'actions' => [
        //             'delete' => ['POST'],
        //         ],
        //     ],
        // ];

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

     public function actionSigup()
    {
        $model = new Sigups();

        return $this->render('/sigup/index',[
            'model' => $model,
            ]);
    }

    public function actionUser()
    {
        
        $post = Yii::$app->request->post('Sigups');
        //print_r($post);
      
        $model = new Sigups();
        $user = new User();
        
        $model->username = $post['username'];
        $model->password = Yii::$app->getSecurity()->generatePasswordHash($post['password']);
        $model->email    = $post['email'];
        $model->comment  = $post['comment'];
        $model->authKey  = $post['authKey'];
        // $model->attributes = $post;
        /*foreach ($post as $key => $value) {
            $model->$key = $value;
        }*/
        $model->save(false);

        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('author');
        $auth->assign($authorRole, 2);

        return $user;
        
    }
}
