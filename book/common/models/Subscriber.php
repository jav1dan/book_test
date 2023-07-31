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
    public static function tableName(){
        return 'subscriber';
    }
    public function rules(){
        return [
            [['phone'],'required'],
            [['phone'],'phone'],
            [['phone'],'unique'],
            [['name'],'string','max'=>255],
            [['name'],'trim'],
            [['name'],'match','pattern'=>'/^[a-zA-Zа-яА-Я]+$/u','message'=>'Only letters allowed'],
            [['name'],'match','pattern'=>'/^[a-zA-Zа-яА-Я]{2,}$/u','message'=>'Minimum 2 letters'],
        ];
    }
    public function attributeLabels(){
        return [
            'phone'=>Yii::t('backend','Phone'),
            'name'=>Yii::t('backend','Name'),
        ];
    }
}