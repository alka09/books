<?php

namespace frontend\models;


use frontend\models\query\BookQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\StaleObjectException;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BookAuthor[] $productTags
 * @property Author[] $authors
 */

class Book extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'description'], 'string'],
            [['authorsArray'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название книги',
            'description' => 'Краткое содержание',
            'authorsArray' => 'Авторы',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function(){ return date('Y-m-d');},
            ],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['book_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ['id' => 'author_id'])->viaTable('{{%book_author}}', ['book_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return BookQuery the active query used by this AR class
     */

    public static function find(): BookQuery
    {
        return new BookQuery(get_called_class());
    }

    private $_authorsArray;

    public function getAuthorsArray(): array
    {
        if ($this->_authorsArray === null) {
            $this->_authorsArray = $this->getAuthors()->select('id')->column();
        }
        return $this->_authorsArray;
    }

    public function setAuthorsArray($value)
    {
        $this->_authorsArray = (array)$value;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateAuthors();
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @throws StaleObjectException
     * @throws \Exception
     */
    private function updateAuthors()
    {
        $currentAuthorIds = $this->getAuthors()->select('id')->column();
        $newAuthorIds = $this->getAuthorsArray();

        foreach (array_filter(array_diff($newAuthorIds, $currentAuthorIds)) as $authorId) {
            /** @var Author $author */
            if ($author = Author::findOne($authorId)) {
                $this->link('authors', $author);
            }
        }

        foreach (array_filter(array_diff($currentAuthorIds, $newAuthorIds)) as $authorId) {
            if ($author = Author::findOne($authorId)) {
                $this->unlink('authors', $author);
            }
        }
    }
}