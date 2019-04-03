<?php
namespace backend\models;

use common\models\Service;
use yii\base\BaseObject;

/**
 * Class ServiceDetailView
 * @package backend\models
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $price
 * @property string $description
 * @property integer $activeTo
 * @property string $cityName
 * @property string $statusName
 */
class ServiceDetailView extends BaseObject
{
    public $service;

    public function getId()
    {
        return $this->service->id;
    }

    public function getName()
    {
        return $this->service->name;
    }

    public function getCode()
    {
        return $this->service->code;
    }

    public function getPrice()
    {
        return $this->service->price;
    }

    public function getDescription()
    {
        return $this->service->description;
    }

    public function getActiveTo()
    {
        return $this->service->active_to;
    }

    public function getCityName()
    {
        return $this->service->city->name;
    }

    public function getStatusName()
    {
        $statuses = [
            Service::STATUS_OFF => 'Off',
            Service::STATUS_ON => 'On',
        ];

        return \array_key_exists($this->service->status_id, $statuses) ? $statuses[$this->service->status_id] : '';
    }
}