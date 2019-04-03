<?php
namespace backend\models;

use common\models\Service;
use yii\base\Model;

class ToggleServiceForm extends Model
{
    /**
     * @var Service
     */
    public $service;

    public $statusId;

    public function rules()
    {
        return [
            [['statusId'], 'integer'],
            [['statusId'], 'in', 'range' => [Service::STATUS_OFF, Service::STATUS_ON]],
        ];
    }

    public function toggle()
    {
        if (!$this->validate()) {
            return false;
        }

        $this->service->status_id = $this->statusId;

        return $this->service->save();
    }
}