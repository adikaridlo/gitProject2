<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 *
 * @property City[] $cities
 * @property Customer[] $customers
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['country_id' => 'id']);
    }

     public static function getOptions(){
        $data=  static::find()->all();
       $value=(count($data)==0)? [''=>'']: \yii\helpers\ArrayHelper::map($data, 'id','name');

        return $value;
    }

}
