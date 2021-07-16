<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m210716_133042_create_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_author}}', [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-book_author', '{{%book_author}}', ['book_id', 'author_id']);

        $this->createIndex('idx-book_author-book_id', '{{%book_author}}', 'book_id');
        $this->createIndex('idx-book_author-author_id', '{{%book_author}}', 'author_id');

        $this->addForeignKey('fk-book_author-book', '{{%book_author}}', 'book_id', '{{%book}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-book_author-author', '{{%book_author}}', 'author_id', '{{%author}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book_author}}');
    }
}
