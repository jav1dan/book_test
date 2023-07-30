<?php

namespace common\models;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Author;
use common\models\Book;

class BookAuthor extends ActiveRecord{
    public static function tableName(){
        return 'book_author';
    }

    public function rules(){
        return [
            [['book_id','author_id'],'required'],
            [['book_id','author_id'],'integer'],
        ];
    }

    public function attributeLabels(){
        return [
            'book_id'=>'Book',
            'author_id'=>'Author',
        ];
    }

    public function getAuthor(){
        return $this->hasOne(Author::class,['id'=>'author_id']);
    }

    public function getBook(){
        return $this->hasOne(Book::class,['id'=>'book_id']);
    }
}