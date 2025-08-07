<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m250807_063720_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name_uz' => $this->string(100)->notNull(),
            'name_ru' => $this->string(100)->notNull(),
            'name_en' => $this->string(100)->notNull(),
            'filename' => $this->string(100)->notNull(),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
            'updated_at' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-product-category_id',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-product-category_id','product');
        $this->dropTable('{{%product}}');
    }
}
