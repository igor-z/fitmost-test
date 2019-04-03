<?php

use common\models\City;
use common\models\Service;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Service', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'code',
            'price',
            'description:ntext',
            [
                'attribute' => 'status_id',
	            'filter' => $searchModel->getStatusList(),
	            'value' => function ($model) {
					return $model->status_id === Service::STATUS_ON ? 'On' : 'Off';
	            },
			],
            'active_to:date',
	        [
				'attribute' => 'city_id',
		        'filter' => $searchModel->getCityList(),
		        'value' => 'city.name',
			],

            [
                'class' => 'yii\grid\ActionColumn',
	            'template' => '{view}&nbsp;{update}&nbsp;{delete}&nbsp;{toggle}',
	            'buttons' => [
                    'toggle' => function ($url, $model, $key) {
						if ($model->status_id === Service::STATUS_ON) {
							$newStatusId = Service::STATUS_OFF;
							$label = 'Turn off';
						} else {
							$newStatusId = Service::STATUS_ON;
							$label = 'Turn on';
						}

						return Html::a($label, ['service/toggle', 'id' => $model->id], [
							'data' => [
								'method' => 'post',
								'params' => [
                                    'statusId' => $newStatusId,
								],
							],
						]);
                    },
	            ],
            ],
        ],
    ]); ?>
</div>
