<?php
namespace common\models;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Author;

/** 
    *This is the model class for table Subscriber
    *
    * @property int $id
    * @property string $phone
    * @property int|null $created_at
    * @property int|null $updated_at
    * @property name $name
*/
class Subscriber extends ActiveRecord{
    public static function primaryKey(){
        return array('id');
    }

    public function behaviors(){
        return [
            TimestampBehavior::class,
        ];
    }
    public function getAuthors(){
        return $this->hasMany(Author::class,['id'=>'author_id'])
            ->viaTable('subscriber_author',['subscriber_id'=>'id'])
            ->orderBy('name');
    }


    public static function tableName(){
        return 'subscriber';
    }
    public function rules(){
        return [
            [['phone','name'],'required'],
            [['phone','name'],'string'],
            // [['phone'],'unique'],

        ];
    }
    public function attributeLabels(){
        return [
            'phone'=>Yii::t('backend','Phone'),
            'name'=>Yii::t('backend','Name'),
        ];
    }
}