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
            [['cityId'], 'integer'],
            [['activeTo'], 'date', 'format' => 'php:Y-m-d'],
            [['name', 'code'], 'string', 'max' => 255],
            [['cityId'], 'exist', 'targetClass' => City::class, 'targetAttribute' => ['cityId' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cityId' => 'City',
        ];
    }

    public function getCityList()
    {
        return City::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();
    }
}