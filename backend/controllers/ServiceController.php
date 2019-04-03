<?php

namespace backend\controllers;

use backend\models\CreateServiceForm;
use backend\models\ServiceDetailView;
use backend\models\ToggleServiceForm;
use backend\models\UpdateServiceForm;
use Yii;
use common\models\Service;
use backend\models\ServiceSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['updateOtherServiceParams'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['createService'],
                    ],
                    [
                        'actions' => ['toggle'],
                        'allow' => true,
                        'roles' => ['toggleService'],
                    ],
                    [
                        'actions' => ['view', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Service model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $service = $this->findModel($id);
        $model = new ServiceDetailView([
            'service' => $service,
        ]);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreateServiceForm();

        if ($model->load(Yii::$app->request->post())) {
            $serviceId = $model->create();
            if ($serviceId) {
                return $this->redirect(['view', 'id' => $serviceId]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionToggle()
    {
        $model = new ToggleServiceForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->toggle()) {
                $errors = [];
                foreach ($model->getErrors() as $error) {
                    $errors[] = $error;
                }

                Yii::$app->session->setFlash('error', implode("\n", $errors));
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $service = $this->findModel($id);

        $model = new UpdateServiceForm();
        $model->setService($service);

        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->redirect(['view', 'id' => $service->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
