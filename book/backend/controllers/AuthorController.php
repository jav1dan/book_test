<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Author;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use common\models\Subscriber;

class AuthorController extends Controller{

    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::class,
                'rules'=>[
                    [
                        'actions'=>['index','view','error','subscribe'],
                        'allow'=>true,
                    ],
                    [
                        'actions'=>['create','update','delete'],
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex(){
        
        $this->layout = 'main';
        $authors = Author::find()->orderBy(['id'=>SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$authors,
            'pagination'=>[
                'pageSize'=>10,
            ],
        ]);
        $templateData = [
            'dataProvider'=>$dataProvider,
        ];
        return $this->render('index',$templateData);
    }

    public function actionUpdate($id){
        $author = Author::findOne($id);
        if(!$author){
            Yii::$app->session->setFlash('error',Yii::t('backend','Author not found'));
            return $this->redirect(['author/index']);
        }
        if($author->load(Yii::$app->request->post()) && $author->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend', 'Author has been updated'));
            return $this->redirect(['author/index']);
        }
        $templateData = [
            'model'=>$author,
        ];
        return $this->render('form',$templateData);
    }

    public function actionCreate(){
        $author = new Author();
        if($author->load(Yii::$app->request->post()) && $author->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend', 'Author has been created'));
            return $this->redirect(['author/index']);
        }
        $templateData = [
            'model'=>$author,
        ];
        return $this->render('form',$templateData);
    }

    public function actionDelete($id){
        $author = Author::findOne($id);
        if(!$author){
            Yii::$app->session->setFlash('error',Yii::t('backend','Author not found'));
            return $this->redirect(['author/index']);
        }
        $author->delete();
        Yii::$app->session->setFlash('success',Yii::t('backend', 'Author has been deleted'));
        return $this->redirect(['author/index']);
    }

    public function actionView($id){
        $author = Author::findOne($id);
        if(!$author){
            Yii::$app->session->setFlash('error',Yii::t('backend','Author not found'));
            return $this->redirect(['author/index']);
        }
        $templateData = [
            'model'=>$author,
        ];
        return $this->render('view',$templateData);
    }

    public function actionSubscribe($id){
        $author = Author::findOne($id);
        if(!$author){
            Yii::$app->session->setFlash('error',Yii::t('backend','Author not found'));
            return $this->redirect(['author/index']);
        }
        $subscriber = new Subscriber();
        if($subscriber->load(Yii::$app->request->post()) && $subscriber->save()){
            //check if subscriber with this number already exists
            if($author->getSubscribers()->where(['phone'=>$subscriber->phone])->exists()){
                Yii::$app->session->setFlash('error',Yii::t('backend','Subscriber already exists'));
                return $this->redirect(['author/index']);
            }
            $author->link('subscribers',$subscriber);
            Yii::$app->session->setFlash('success',Yii::t('backend', 'Subscriber has been created'));
            return $this->redirect(['author/index']);
        }
        $templateData = [
            'model'=>$subscriber,
            'author'=>$author,
        ];
        // var_dump($templateData);
        return $this->render('subscribe',$templateData);
    }
}