<?php

use yii\db\Migration;

/**
 * Class m230731_002919_subscriber
 */
class m230731_002919_subscriber extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscriber}}',[
            'id'=>$this->primaryKey(),
            'phone'=>$this->string()->notNull()->unique(),
            'name'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230731_002919_subscriber cannot be reverted.\n";
        $this->dropTable('{{%subscriber}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230731_002919_subscriber cannot be reverted.\n";

        return false;
    }
    */
}
