<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m210713_102622_create_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{book_author}}', [
            'book_id' => $this->integer()->notNull(),
            'author_ad' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-book_author', '{{book_author}}', ['book_id', 'author_id']);

        $this->createIndex('idx-book_author-book_id', '{{%book_author}}', 'book_id');
        $this->createIndex('idx-book_author-author_id', '{{%book_author}}', 'author_id');

        $this->addForeignKey('fk-book_author-book', '{{%book_author}}', 'book_id', '{{%books}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-book_author-author', '{{%book_author}}', 'author_id', '{{%author}}', 'id', 'CASCADE', 'RESTRICT');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author}}');
        $this->dropTable('{{book_author}}');
    }
}
