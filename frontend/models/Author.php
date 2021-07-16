<?php


namespace frontend\models;

use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%author}}".id
 *
 * @property integer $id
 * @property string $name
 *
 * @property BookAuthor[] $bookAuthors
 * @property Book[] $books
 */
class Author extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%author}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getBookAuthors(): ActiveQuery
    {
        return $this->hasMany(BookAuthor::className(), ['author_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getBooks(): ActiveQuery
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])->viaTable('{{%book_author}}', ['author_id' => 'id']);
    }

}