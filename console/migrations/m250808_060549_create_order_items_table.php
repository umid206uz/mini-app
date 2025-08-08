<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_items}}`.
 */
class m250808_060549_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_items}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'product_name' => $this->string()->notNull(),
            'quantity' => $this->string()->notNull()->defaultValue(1),
            'price' => $this->string()->notNull()->defaultValue(1),
            'total_price' => $this->string()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
        ]);
        $this->addForeignKey(
            'fk-order_items-order_id',
            'order_items',
            'order_id',
            'orders',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-order_items-order_id', 'order_items');
        $this->dropTable('{{%order_items}}');
    }
}
