<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%telegram_session}}`.
 */
class m250818_141027_create_telegram_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%telegram_session}}', [
            'id' => $this->primaryKey(),
            'chat_id' => $this->bigInteger()->notNull()->unique(),
            'step' => $this->integer()->defaultValue(0)->notNull(),
            'phone' => $this->string(50),
            'phone_verified' => $this->integer()->defaultValue(0)->notNull(),
            'verification_token' => $this->string(191)->unique(),
            'updated_at' => $this->integer()->defaultValue(time())->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%telegram_session}}');
    }
}
