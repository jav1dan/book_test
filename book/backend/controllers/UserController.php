<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

use yii\data\ActiveDataProvider;
use yii\web\Response;
use common\models\User;

class UserController extends Controller{
    public function actionIndex(){
        $users = User::find()->where(['status'=>User::STATUS_ACTIVE])->orderBy(['id'=>SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$users,
            'pagination'=>[
                'pageSize'=>10,
            ],

        ]);
        $templateData = [
            'dataProvider'=>$dataProvider,
        ];
        return $this->render('index',$templateData);
    }

    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions'=>['login','error'],
                        'allow'=>true,
                    ],
                    [
                        'actions'=>['logout','index','create'],
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                ],
            ],
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions'=>[
                    'logout'=>['post'],
                ],
            ],
        ];
    }

    public function actions(){
        return [
            'error'=>[
                'class'=>\yii\web\ErrorAction::class,
            ],
        ];
    }

    /*
        * Create user action
    */
    public function actionCreate(){
        $user = new User();
        if($user->load(Yii::$app->request->post()) && $user->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend', 'User has been created'));
            return $this->redirect(['user/index']);
        }
        $templateData = [
            'model'=>$user,
        ];
        return $this->render('form',$templateData);
    }
}