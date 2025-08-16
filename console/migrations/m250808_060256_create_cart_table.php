<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart}}`.
 */
class m250808_060256_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
        ]);

        $this->addForeignKey(
            'fk-cart-user_id',
            'cart',
            'user_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk-cart-product_id',
            'cart',
            'product_id',
            'product',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-cart-user_id', 'cart');
        $this->dropForeignKey('fk-cart-product_id', 'cart');
        $this->dropTable('{{%cart}}');
    }
}
