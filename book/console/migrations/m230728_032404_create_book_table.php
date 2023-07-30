<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m230728_032404_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'description'=>$this->text(),
            'isbn'=>$this->string(13)->notNull()->unique(),
            'year'=>$this->integer(4)->notNull(),
            'photo'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
