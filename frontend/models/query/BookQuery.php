<?php


namespace frontend\models\query;

use Book;
use frontend\models\BookAuthor;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\frontend\models\Book]].
 *
 * @see \frontend\models\Book
 */

class BookQuery extends ActiveQuery
{

    /**
     * @param integer $id
     * @return self
     */
    public function forAuthor(int $id): BookQuery
    {
        return $this->joinWith(['bookAuthor'], false)->andWhere([BookAuthor::tableName() . '.author_id' => $id]);
    }

    /**
     * @inheritdoc
     * @return Book[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Book|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}