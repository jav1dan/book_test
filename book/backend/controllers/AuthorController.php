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
                        'actions'=>['create','update','delete','unsubscribe'],
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
        $subscriber = new Subscriber();
        if(!$author){
            Yii::$app->session->setFlash('error',Yii::t('backend','Author not found'));
            return $this->redirect(['author/index']);
        }
        if($subscriber->load(Yii::$app->request->post())){
            
            //check if subscriber with this number already exists
            //Check if there any Subscriber with this phone number
            if(Subscriber::find()->where(['phone'=>$subscriber->phone])->exists() == true){
                $subscriber = Subscriber::find()->where(['phone'=>$subscriber->phone])->one();
                $subscriber->save();
                //check if subscriber is already subscribed to this author
                if($author->getSubscribers()->where(['id'=>$subscriber->id])->exists() == true){
                    Yii::$app->session->setFlash('error',Yii::t('backend','Subscriber already subscribed to this author'));
                    return $this->redirect(['author/index']);
                }
                $author->link('subscribers',$subscriber);
                Yii::$app->session->setFlash('success',Yii::t('backend', 'Subscriber has been created'));
                return $this->redirect(['author/index']);
            }
            
            $subscriber->save();
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


    public function actionUnsubscribe($id,$author_id){
        $subscriber = Subscriber::findOne($id);
        if(!$subscriber){
            Yii::$app->session->setFlash('error',Yii::t('backend','Subscriber not found'));
            return $this->redirect(['author/index']);
        }
        //unlink subscriber from author
        $author = $subscriber->getAuthors()->where(['id'=>$author_id])->one();
        $author->unlink('subscribers',$subscriber,true);

        //check if subscriber has any other authors
        if($subscriber->getAuthors()->exists() == false){
            $subscriber->delete();
            Yii::$app->session->setFlash('success',Yii::t('backend', 'Subscriber has been deleted'));
            return $this->redirect(['author/index']);
        }
        Yii::$app->session->setFlash('success',Yii::t('backend', 'Subscriber has been deleted'));
    }
}