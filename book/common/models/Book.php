<?php
namespace common\models;
use Yii;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Author;
use yii\imagine\Image;

 /**
  * This is the model class for table "book".
  *
    * @property int $id
    * @property string $name
    * @property string|null $description
    * @property string $isbn
    * @property int $year
    * @property string|null $photo
    * @property int|null $created_at
    * @property int|null $updated_at
  */
class Book extends ActiveRecord
{   
    const SCENARIO_CREATE = 'create';
    const SCENARIO_VIEW = 'view';
    const SCENARIO_UPDATE = 'update';


    public static function tableName()
    {
        return 'book';
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('book_author', ['book_id' => 'id'])
            ->orderBy('name');
    }

    public static function listAll($keyField = 'id', $valueField = 'name', $asArray = true)
    {
        $query = static::find();
        if ($asArray) {
                $query->select([$keyField, $valueField])->asArray();
        }

        return ArrayHelper::map($query->all(), $keyField, $valueField);
    }

    public static function primaryKey()
    {
        return array('id');
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'saveRelations' => [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['authors'],
            ],
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['name', 'isbn', 'year'], 'required'],
            [['description'], 'string'],
            [['year', 'created_at', 'updated_at'], 'integer'],
            [['name', 'isbn', 'photo'], 'string', 'max' => 255],
            [['isbn'], 'unique'],
            //name letters russian plus space and dash allowed
            [['year'], 'match', 'pattern' => '/^[0-9]{4}$/u', 'message' => 'Only 4 numbers allowed'],
            [['photo'], 'file', 'extensions' => 'jpg, jpeg, png'],
            [['authors'],function($attribute, $params, $validator){
                if (empty($this->authors)) {
                    $this->addError($attribute, 'Authors cannot be blank.');
                }
            }],          
            // [['name', 'isbn', 'photo'], 'trim'],
            // [['name', 'isbn', 'photo','description'], 'filter', 'filter' => 'strip_tags'],
            // [['name', 'isbn', 'photo','description'], 'filter', 'filter' => 'htmlentities'],
            // [['name', 'isbn', 'photo','description'], 'filter', 'filter' => 'htmlspecialchars']
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Book ID'),
            'name' => Yii::t('app', 'Book Name'),
            'description' => Yii::t('app', 'Book Description'),
            'isbn' => Yii::t('app', 'Book ISBN'),
            'year' => Yii::t('app', 'Book Year'),
            'photo' => Yii::t('app', 'Book Photo'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'authors'=>Yii::t('app', 'Book Authors')    
        ];
    }
}