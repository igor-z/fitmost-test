<?php

use common\models\Service;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ServiceLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Log Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-log-item-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'author_id',
                'value' => 'author.username',
                'filter' => $searchModel->getAuthorList(),
            ],
            [
                'attribute' => 'service_id',
                'value' => 'service.name',
                'filter' => $searchModel->getServiceList(),
            ],
            'service_name',
            'service_code',
            'service_price',
            [
                'attribute' => 'service_status_id',
                'value' => function ($model) {
    	            return $model->service_status_id === Service::STATUS_ON ? 'On' : 'Off';
                },
                'filter' => $searchModel->getServiceStatusList(),
            ],
            'service_active_to:date',
            [
                'attribute' => 'service_city_id',
                'value' => 'city.name',
                'filter' => $searchModel->getCityList(),
            ],
            'created_at:date',
        ],
    ]); ?>
</div>
