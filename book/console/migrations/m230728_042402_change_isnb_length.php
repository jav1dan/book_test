<?php

use yii\db\Migration;

/**
 * Class m230728_042402_change_isnb_length
 */
class m230728_042402_change_isnb_length extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('book', 'isbn', $this->string(30)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230728_042402_change_isnb_length cannot be reverted.\n";
        
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230728_042402_change_isnb_length cannot be reverted.\n";

        return false;
    }
    */
}
