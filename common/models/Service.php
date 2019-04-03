<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%service}}".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $price
 * @property string $description
 * @property int $status_id
 * @property int $active_to
 * @property int $city_id
 *
 * @property City $city
 */
class Service extends \yii\db\ActiveRecord
{
    const STATUS_ON = 1;
    const STATUS_OFF = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%service}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['status_id', 'active_to', 'city_id'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
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
            'code' => 'Code',
            'price' => 'Price',
            'description' => 'Description',
            'status_id' => 'Status ID',
            'active_to' => 'Active To',
            'city_id' => 'City ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $userIdentity = Yii::$app->user;

        $serviceLogItem = new ServiceLogItem();
        $serviceLogItem->service_id = $this->id;
        $serviceLogItem->author_id = $userIdentity ? $userIdentity->getId() : null;
        foreach ($changedAttributes as $attribute => $value) {
            $serviceLogItem->setAttribute('service_'.$attribute, $value);
        }
        $serviceLogItem->save();

        parent::afterSave($insert, $changedAttributes);
    }
}
