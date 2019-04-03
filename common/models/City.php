<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property Service[] $services
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::class, ['city_id' => 'id']);
    }
}
