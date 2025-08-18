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
            'step' => $this->integer()->defaultValue(0),
            'phone' => $this->string(50),
            'updated_at' => $this->dateTime()->notNull(),
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
