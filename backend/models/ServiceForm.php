<?php
namespace backend\models;

use common\models\City;
use common\models\Service;
use yii\base\Model;

abstract class ServiceForm extends Model
{
    public $code;
    public $price;
    public $description;
    public $statusId = Service::STATUS_ON;
    public $name;
    public $cityId;
    public $activeTo;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'cityId'], 'required'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['statusId', 'cityId'], 'integer'],
            [['activeTo'], 'date', 'format' => 'php:Y-m-d'],
            [['statusId'], 'in', 'range' => array_keys($this->getStatusList())],
            [['name', 'code'], 'string', 'max' => 255],
            [['cityId'], 'exist', 'targetClass' => City::class, 'targetAttribute' => ['cityId' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cityId' => 'City',
            'statusId' => 'Status',
        ];
    }

    public function getCityList()
    {
        return City::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();
    }

    public function getStatusList()
    {
        return [
            Service::STATUS_OFF => 'Off',
            Service::STATUS_ON => 'On',
        ];
    }
}