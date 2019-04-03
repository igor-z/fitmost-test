<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%service_log}}".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $price
 * @property string $description
 * @property int $status_id
 * @property int $active_to
 * @property int $city_id
 * @property int $created_at
 * @property int $author_id
 * @property int $service_id
 *
 * @property User $author
 * @property Service $service
 * @property City $city
 */
class ServiceLogItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%service_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_price'], 'number'],
            [['service_description'], 'string'],
            [['service_status_id', 'service_active_to', 'service_city_id', 'created_at', 'author_id', 'service_id'], 'integer'],
            [['service_name', 'service_code'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_name' => 'Name',
            'service_code' => 'Code',
            'service_price' => 'Price',
            'service_description' => 'Description',
            'service_status_id' => 'Status ID',
            'service_active_to' => 'Active To',
            'service_city_id' => 'City ID',
            'created_at' => 'Created At',
            'author_id' => 'Author ID',
            'service_id' => 'Service ID',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'service_city_id']);
    }
}
