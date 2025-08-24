<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m250824_121900_add_columns_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'first_name', $this->string(100)->after('username'));
        $this->addColumn('{{%user}}', 'last_name', $this->string(100)->after('first_name'));
        $this->addColumn('{{%user}}', 'tell', $this->integer()->after('last_name'));
        $this->addColumn('{{%user}}', 'occupation', $this->string(150)->after('tell'));
        $this->addColumn('{{%user}}', 'url', $this->string(100)->after('occupation'));
        $this->addColumn('{{%user}}', 'card', $this->integer()->after('url'));
        $this->addColumn('{{%user}}', 'filename', $this->string(100)->after('card'));
        $this->addColumn('{{%user}}', 'about', $this->string(100)->after('filename'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'about');
        $this->dropColumn('{{%user}}', 'filename');
        $this->dropColumn('{{%user}}', 'card');
        $this->dropColumn('{{%user}}', 'url');
        $this->dropColumn('{{%user}}', 'occupation');
        $this->dropColumn('{{%user}}', 'tell');
        $this->dropColumn('{{%user}}', 'last_name');
        $this->dropColumn('{{%user}}', 'first_name');
    }
}
