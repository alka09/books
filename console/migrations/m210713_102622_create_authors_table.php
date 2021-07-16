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

        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

        $this->createIndex('idx-author-name', '{{%author}}', 'name');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author}}');
    }
}
