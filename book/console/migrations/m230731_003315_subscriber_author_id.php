<?php

use yii\db\Migration;

/**
 * Class m230731_003315_subscriber_author_id
 */
class m230731_003315_subscriber_author_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('subscriber','author_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230731_003315_subscriber_author_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230731_003315_subscriber_author_id cannot be reverted.\n";

        return false;
    }
    */
}
