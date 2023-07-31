<?php

use yii\db\Migration;

/**
 * Class m230731_005013_subscriber_to_author
 */
class m230731_005013_subscriber_to_author extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('subscriber_author',[
            'id'=>$this->primaryKey(),
            'subscriber_id'=>$this->integer(),
            'author_id'=>$this->integer(),
        ]);
        $this->createIndex(
            'idx-subscriber_author-subscriber_id',
            'subscriber_author',
            'subscriber_id'
        );
        $this->addForeignKey(
            'fk-subscriber_author-subscriber_id',
            'subscriber_author',
            'subscriber_id',
            'subscriber',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-subscriber_author-author_id',
            'subscriber_author',
            'author_id'
        );
        $this->addForeignKey(
            'fk-subscriber_author-author_id',
            'subscriber_author',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230731_005013_subscriber_to_author cannot be reverted.\n";
        $this->dropTable('subscriber_author');
        return false;
    }

}
