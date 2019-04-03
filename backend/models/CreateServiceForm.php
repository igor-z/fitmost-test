<?php
namespace backend\models;

use common\models\Service;

class CreateServiceForm extends ServiceForm
{
    public function rules()
    {
        $rules = parent::rules();

        $rules[] = [['code'], 'unique', 'targetClass' => Service::class];

        return $rules;
    }

    public function create()
    {
        if (!$this->validate())
            return false;

        $service = new Service();

        $service->description = $this->description;
        $service->name = $this->name;
        $service->price = $this->price;
        $service->city_id = $this->cityId;
        $service->active_to = \strtotime($this->activeTo);
        $service->status_id = Service::STATUS_ON;
        $service->code = $this->code;
        $service->save();

        return $service->getPrimaryKey();
    }
}