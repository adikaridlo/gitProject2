<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $telp
 * @property string $address
 * @property integer $country_id
 * @property integer $city_id
 *
 * @property Country $country
 * @property City $city
 * @property Transaction[] $transactions
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'telp', 'address', 'country_id', 'city_id'], 'required'],
            [['country_id', 'city_id'], 'integer'],
            [['name', 'email', 'telp', 'address'], 'string', 'max' => 225],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'email' => 'Email',
            'telp' => 'Telp',
            'address' => 'Alamat',
            'country_id' => 'Warga Negara',
            'city_id' => 'Kota Asal',
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
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['customer_id' => 'id']);
    }

}
