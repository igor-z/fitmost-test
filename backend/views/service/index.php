<?php

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
            //'status_id',
            //'active_to',
            //'city_id',

            [
                'class' => 'yii\grid\ActionColumn',
	            'template' => '{view}&nbsp;{update}&nbsp;{delete}&nbsp;{toggle}',
	            'buttons' => [
                    'toggle' => function ($url, $model, $key) {
						$newStatusId = $model->status_id == Service::STATUS_ON ? Service::STATUS_OFF : Service::STATUS_ON;

						return Html::a('Toggle', ['service/toggle', 'statusId' => $newStatusId], [
							'data-method' => 'post',
						]);
                    },
	            ],
            ],
        ],
    ]); ?>
</div>
