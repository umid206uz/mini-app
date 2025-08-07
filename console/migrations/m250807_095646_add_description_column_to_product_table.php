<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m250807_095646_add_description_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}','description_uz', $this->text()->after('name_en'));
        $this->addColumn('{{%product}}','description_ru', $this->text()->after('description_uz'));
        $this->addColumn('{{%product}}','description_en', $this->text()->after('description_ru'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}','description_uz');
        $this->dropColumn('{{%product}}','description_ru');
        $this->dropColumn('{{%product}}','description_en');
    }
}
