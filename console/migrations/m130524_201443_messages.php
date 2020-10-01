<?php

use yii\db\Migration;

class m130524_201443_messages extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%messages}}', [
            'id' => $this->primaryKey(),
            'content' => $this->string()->null(),

            'status' => $this->smallInteger()->null()->defaultValue(10),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%messages}}');
    }
}
