<?php
namespace backend\controllers;

use Yii;
use common\models\Book;
use common\models\Author;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\db\Expression;

use yii\web\Controller;

class ReportController extends Controller{
    public function behaviors(){
        return [
            'access'=>[
                'class'=>AccessControl::class,
                'rules'=>[
                    [
                        'actions'=>['top10'],
                        'allow'=>true,
                        'roles'=>['@']
                    ]
                ]
            ],
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions'=>[
                    'top10'=>['GET']
                ]
            ]
        ];
    }

    public function actionTop10($year=null){
        $this->layout = 'main';
        if(!$year){
            $year = date('Y');
        }
        //find authors with the most books in year
        $authors = Author::find()
            ->select(['author.id','author.surname','author.name','COUNT(book.id) as booksCount'])
            ->joinWith('books')
            ->where(['(book.year)'=>$year])
            ->groupBy('author.id')
            ->orderBy(new Expression('booksCount DESC'))
            ->limit(10)
            ->all();
        $templateData = [
            'authors'=>$authors,
            'year'=>$year
        ];
        
        return $this->render('top10',$templateData);
    }
}