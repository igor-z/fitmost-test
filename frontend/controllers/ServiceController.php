<?php
namespace frontend\controllers;

use frontend\models\Service;
use yii\base\DynamicModel;
use yii\data\DataFilter;
use yii\rest\ActiveController;
use yii\rest\IndexAction;

class ServiceController extends ActiveController
{
    public $modelClass = Service::class;

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $actions = parent::actions();

        $searchModel = (new DynamicModel([
            'city_id' => null,
            'id' => null,
        ]))
            ->addRule(['city_id', 'id'], 'integer');

        $actions['index'] = [
            'class' => IndexAction::class,
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],
            'dataFilter' => [
                'class' => DataFilter::class,
                'searchModel' => $searchModel,
            ],
        ];

        return $actions;
    }
}