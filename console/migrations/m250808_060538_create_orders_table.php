<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m250808_060538_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'operator_id' => $this->integer(),
            'full_name' => $this->string(200),
            'phone' => $this->string(20)->notNull(),
            'region_id' => $this->integer()->notNull()->defaultValue(0),
            'district_id' => $this->integer()->notNull()->defaultValue(0),
            'address' => $this->string(200),
            'additional_information' => $this->string(200),
            'total_price' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
            'updated_at' => $this->integer()->notNull()->defaultValue(time()),
            'approved_at' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-orders-user_id',
            'orders',
            'user_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk-orders-operator_id',
            'orders',
            'operator_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk-orders-region_id',
            'orders',
            'region_id',
            'regions',
            'id'
        );

        $this->addForeignKey(
            'fk-orders-district_id',
            'orders',
            'district_id',
            'regions',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-orders-user_id', 'orders');
        $this->dropForeignKey('fk-orders-operator_id', 'orders');
        $this->dropForeignKey('fk-orders-region_id', 'orders');
        $this->dropForeignKey('fk-orders-district_id', 'orders');
        $this->dropTable('{{%orders}}');
    }
}
