<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $code
 * @property string $name
 *
 * @property Country $country
 * @property Customer[] $customers
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'code', 'name'], 'required'],
            [['country_id'], 'integer'],
            [['code', 'name'], 'string', 'max' => 225],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['city_id' => 'id']);
    }

     public static function getOptionsbyCountry($country_id) {
        $data = static::find()->where(['country_id'=>$country_id])->select(['id','name'])->asArray()->all();;
        $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name');

        return $value;
    }


}
