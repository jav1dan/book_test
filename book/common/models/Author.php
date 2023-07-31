<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
//generate model for author with name,surname and fathername
/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $fathername
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Book[] $books
 */
class Author extends ActiveRecord
{

    public static function primaryKey()
    {
        return array('id');
    }

    public $booksCount;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function  getBooks(){
        return $this->hasMany(Book::class,['id'=>'book_id'])
            ->viaTable('book_author',['author_id'=>'id'])
            ->orderBy('name');
    }

    public function getSubscribers(){
        return $this->hasMany(Subscriber::class,['id'=>'subscriber_id'])
            ->viaTable('subscriber_author',['author_id'=>'id'])
            ->orderBy('name');
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'surname', 'fathername'], 'string', 'max' => 255],
            [['name', 'surname', 'fathername'], 'required'],
            [['name', 'surname', 'fathername'], 'trim'],
            [['name', 'surname', 'fathername'], 'match', 'pattern' => '/^[a-zA-Zа-яА-Я]+$/u', 'message' => 'Only letters allowed'],
            [['name', 'surname', 'fathername'], 'match', 'pattern' => '/^[a-zA-Zа-яА-Я]{2,}$/u', 'message' => 'Minimum 2 letters']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'id' => Yii::t('app', 'Author ID'),
            'name' => Yii::t('app', 'Author Name'),
            'surname' => Yii::t('app','Author Surname'),
            'fathername' => Yii::t('app','Author Fathername'),
            'created_at' => Yii::t('app','Created At'),
            'updated_at' => Yii::t('app','Updated At'),
        ];
    }


    //listAll Authors with concat of name and surname
    public static function listAll($keyField = 'id', $valueField = 'name', $asArray = true)
    {
        $query = static::find();
        if ($asArray) {
                $query->select([$keyField, 'CONCAT(name," ",surname) as name'])->asArray();
        }
        $array= ArrayHelper::map($query->all(), $keyField, 'name');
        return $array;
    }

    
            
}