<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sms_log}}`.
 */
class m250822_072054_create_sms_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sms_log}}', [
            'id' => $this->primaryKey(),
            'provider_id' => $this->string(64)->null(),
            'user_sms_id' => $this->string(64)->null(),
            'phone' => $this->string(32)->null(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(0),
            'raw' => $this->text()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sms_log}}');
    }
}
