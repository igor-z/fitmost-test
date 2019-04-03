<?php
namespace backend\models;

use common\models\Service;
use Yii;

/**
 * Class UpdateServiceForm
 * @package backend\models
 * @property int $id
 */
class UpdateServiceForm extends ServiceForm
{
    /**
     * @var Service
     */
    protected $service;

    public function rules()
    {
        $rules = parent::rules();

        $rules[] = [['code'], 'unique', 'targetClass' => Service::class, 'filter' => ['not', ['id' => $this->service->id]]];

        return $rules;
    }

    public function getId()
    {
        return $this->service->id;
    }

    /**
     * @param Service $service
     */
    public function setService($service)
    {
        $this->service = $service;
        $this->code = $service->code;
        $this->description = $service->description;
        $this->name = $service->name;
        $this->price = $service->price;
        $this->cityId = $service->city_id;
        $this->activeTo = Yii::$app->formatter->asDate($service->active_to, 'php:Y-m-d');
        $this->statusId = $service->status_id;
        $this->code = $service->code;
    }

    /**
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }

    public function update()
    {
        if (!$this->validate())
            return false;

        $service = $this->service;

        $service->description = $this->description;
        $service->name = $this->name;
        $service->price = $this->price;
        $service->city_id = $this->cityId;
        $service->active_to = \strtotime($this->activeTo);
        $service->status_id = $this->statusId;
        $service->code = $this->code;
        $service->save();

        return true;
    }
}