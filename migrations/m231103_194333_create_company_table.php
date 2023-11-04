<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company}}`.
 */
class m231103_194333_create_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
            'cnpj' => $this->string(14)->notNull(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]); 

            $this->addForeignKey(
            'fk_company_created_by', // foreing key
            '{{%company}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',  // pesquiser conceito de cascade
            'CASCADE'
        );
    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()  // pesquisar o que é safeDown()
    {
        $this->dropTable('{{%company}}');
        $this->dropForeignKey('fk_company_created_by', '{{%company}}');
    }
}


