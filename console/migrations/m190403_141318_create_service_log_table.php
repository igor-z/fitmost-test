<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service_log}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m190403_141318_create_service_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service_log}}', [
            'id' => $this->primaryKey(),
            'service_name' => $this->string(),
            'service_code' => $this->string(),
            'service_price' => $this->money(),
            'service_description' => $this->text(),
            'service_status_id' => $this->tinyInteger(),
            'service_active_to' => $this->integer(),
            'service_city_id' => $this->integer(),
            'created_at' => $this->integer(),
            'author_id' => $this->integer(),
            'service_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            '{{%fk_service_log_city}}',
            '{{%service_log}}',
            'service_city_id',
            '{{%city}}',
            'id'
        );

        $this->addForeignKey(
            '{{%fk_service_log_author}}',
            '{{%service_log}}',
            'author_id',
            '{{%user}}',
            'id'
        );

        $this->addForeignKey(
            '{{%fk_service_log_service}}',
            '{{%service_log}}',
            'service_id',
            '{{%service}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk_service_log_city}}',
            '{{%service_log}}'
        );

        $this->dropForeignKey(
            '{{%fk_service_log_author}}',
            '{{%service_log}}'
        );

        $this->dropForeignKey(
            '{{%fk_service_log_service}}',
            '{{%service_log}}'
        );

        $this->dropTable('{{%service_log}}');
    }
}
