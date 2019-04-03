<?php

namespace backend\models;

use common\models\City;
use common\models\Service;
use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServiceLogItem;

/**
 * ServiceLogSearch represents the model behind the search form of `common\models\ServiceLogItem`.
 *
 * @property int $service_status_id
 * @property int $service_price
 * @property int $service_active_to
 * @property int $service_city_id
 * @property int $created_at
 * @property int $author_id
 * @property int $service_id
 * @property int $service_code
 * @property int $service_name
 */
class ServiceLogSearch extends ServiceLogItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'service_status_id', 'service_active_to', 'service_city_id', 'created_at', 'author_id', 'service_id'], 'integer'],
            [['service_name', 'service_code', 'service_description'], 'safe'],
            [['service_price'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'service_status_id' => 'Service Status',
            'author_id' => 'Author',
            'service_id' => 'Service',
            'service_city_id' => 'Service City',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ServiceLogItem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'service_price' => $this->service_price,
            'service_status_id' => $this->service_status_id,
            'service_active_to' => $this->service_active_to,
            'service_city_id' => $this->service_city_id,
            'created_at' => $this->created_at,
            'author_id' => $this->author_id,
            'service_id' => $this->service_id,
        ]);

        $query->andFilterWhere(['like', 'service_name', $this->service_name])
            ->andFilterWhere(['like', 'service_code', $this->service_code])
            ->andFilterWhere(['like', 'service_description', $this->service_description]);

        return $dataProvider;
    }

    public function getServiceList()
    {
        return Service::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();
    }

    public function getServiceStatusList()
    {
        return [
            Service::STATUS_OFF => 'Off',
            Service::STATUS_ON => 'On',
        ];
    }

    public function getAuthorList()
    {
        return User::find()
            ->select(['username', 'id'])
            ->indexBy('id')
            ->column();
    }

    public function getCityList()
    {
        return City::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();
    }
}
