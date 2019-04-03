<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%city}}`
 */
class m190402_220212_create_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'code' => $this->string()->notNull()->unique(),
            'price' => $this->money(),
            'description' => $this->text(),
            'status_id' => $this->tinyInteger(),
            'active_to' => $this->integer(),
            'city_id' => $this->integer(),
        ]);

        // creates index for column `city_id`
        $this->createIndex(
            '{{%idx-service-city_id}}',
            '{{%service}}',
            'city_id'
        );

        // add foreign key for table `{{%city}}`
        $this->addForeignKey(
            '{{%fk-service-city_id}}',
            '{{%service}}',
            'city_id',
            '{{%city}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%city}}`
        $this->dropForeignKey(
            '{{%fk-service-city_id}}',
            '{{%service}}'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            '{{%idx-service-city_id}}',
            '{{%service}}'
        );

        $this->dropTable('{{%service}}');
    }
}
