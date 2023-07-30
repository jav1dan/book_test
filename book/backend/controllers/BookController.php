<?php
namespace backend\controllers;

use Yii;
use common\models\Book;
use common\models\Author;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\imagine\Image;   

class BookController extends Controller{

    /*
    * @inheritdoc
    */
    public function behaviors(){
        return [
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions'=>[
                    'delete'=>['GET'],
                ],
            ],
        ];
    }


    /*
        * @inheritdoc
    */
    public function actions(){
        return [
            'error'=>[
                'class'=>\yii\web\ErrorAction::class,
            ],
        ];
    }

    /*
        * Display list of books
    */
    public function actionIndex(){
        $this->layout = 'main';
        $books = Book::find()->orderBy(['id'=>SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query'=>$books,
            'pagination'=>[
                'pageSize'=>10,
            ],
        ]);
        $templateData = [
            'dataProvider'=>$dataProvider,
        ];
        return $this->render('index',$templateData);
    }

    /*
        * Update book
    */
    public function actionUpdate($id){
        $book = Book::findOne($id);
        if(!$book){
            Yii::$app->session->setFlash('error',Yii::t('backend','Book not found'));
            return $this->redirect(['book/index']);
        }
        if($book->load(Yii::$app->request->post()) && $book->save()){
            // $book->getManyToManyRelation('authors')->fill();
            Yii::$app->session->setFlash('success',Yii::t('backend', 'Book has been updated'));
            return $this->redirect(['book/index']);
        }
        $authors = $book->getAuthors();

        $selected_authors = array();
        // foreach ($authors as $author) {
        //     if($author != null){
        //         var_dump($author);
        //         // $selected_authors[$author->id] = array("selected"=>true);
        //     }

        //     // $selected_authors[$author->id] = array("selected"=>true);
        // }
        $thumb = false;
        if($book->photo == null || $book->photo == '' || !file_exists(Yii::getAlias('@frontend/web/uploads/book/'.$book->photo))){
            $thumb = 'default.jpg';
        } else {
            //make thumbnail
            Image::thumbnail('@frontend/web/uploads/book/'.$book->photo, 200, 200)
            ->save(Yii::getAlias('@frontend/web/uploads/book/thumbs/'.$book->photo), ['quality' => 80]);
            $thumb_url =  '/uploads/book/thumbs/'.$book->photo;
            $thumb = $thumb_url;

        }
        $templateData = [
            'model'=>$book,
            'authors'=>$authors,
            'thumb'=>$thumb,
            'scenario'=>Book::SCENARIO_UPDATE,
            'selected_authors'=>$selected_authors
        ];
        // var_dump($templateData)
        return $this->render('form',$templateData);
    }


    /*
        * Create book
    */
    public function actionCreate(){
        $book = new Book();
        if($book->load(Yii::$app->request->post()) && $book->save()){
            Yii::$app->session->setFlash('success',Yii::t('backend', 'Book has been created'));
            return $this->redirect(['book/index']);
        }
        $templateData = [
            'model'=>$book,
            'thumb'=>false,
            'authors'=>[],
            'selected_authors'=>[],
            'scenario'=>Book::SCENARIO_CREATE
        ];
        return $this->render('form',$templateData);
    }

    /*
        * Delete book
    */
    public function actionDelete($id){
        $book = Book::findOne($id);
        if(!$book){
            Yii::$app->session->setFlash('error',Yii::t('backend','Book not found'));
            return $this->redirect(['book/index']);
        }
        //get file of photo
        $photo = $book->photo;
        //delete photo
        if($photo){
            $photoPath = Yii::getAlias('@frontend/web/uploads/book/'.$photo);
            if(file_exists($photoPath)){
                unlink($photoPath);
            }
        }

        $book->delete();
        
        Yii::$app->session->setFlash('success',Yii::t('backend', 'Book has been deleted'));
        return $this->redirect(['book/index']);
    }

    /*
        * Upload photo
    */
    public function actionUpload(){
        
        $fileName = 'file';
        $uploadPath = Yii::getAlias('@frontend/web/uploads/book');

        if (isset($_FILES[$fileName])) {
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);

            //Print file data
            //print_r($file);
            //generate random name for file
            $fileName = md5($file->baseName.time()) . '.' . $file->extension;
            //save file in uploads folder
            if($file->saveAs($uploadPath.'/'.$fileName)){
                //return data in json format
                Image::thumbnail('@frontend/web/uploads/book/'.$fileName, 200, 200)
                ->save(Yii::getAlias('@frontend/web/uploads/book/thumbs/'.$fileName), ['quality' => 80]);
                $thumb_url =  '/uploads/book/thumbs/'.$fileName;
                $response = [
                    'filelink'=>'/uploads/book/'.$fileName,
                    'filename'=>$fileName,
                    'url'=>Yii::$app->params['frontend_url']."/".$thumb_url,
                    'name'=>$fileName
                ];
                echo \yii\helpers\Json::encode($response);
            }

            // //move file from temp folder to uploads
            // if($file->saveAs($uploadPath.'/'.$fileName)){
                
            //     echo \yii\helpers\Json::encode($file);
            // }
            // if ($file->saveAs($uploadPath . '/' . $file->name)) {
            //     //Now save file data to database

            //     echo \yii\helpers\Json::encode($file);
            // }
        }
    }
}