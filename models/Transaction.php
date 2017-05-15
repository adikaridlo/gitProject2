<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $jurnal_no
 * @property integer $customer_id
 * @property string $trans_name
 * @property string $type
 * @property integer $amount
 * @property string $currency
 * @property string $trans_date
 *
 * @property Customer $customer
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurnal_no', 'customer_id', 'trans_name', 'type', 'amount', 'currency', 'trans_date'], 'required'],
            [['jurnal_no', 'customer_id', 'amount'], 'integer'],
            [['trans_date'], 'safe'],
            [['trans_name', 'currency'], 'string', 'max' => 225],
            [['type'], 'string', 'max' => 3],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        
        return [
            'id' => 'ID',
            'jurnal_no' => 'Jurnal Nomor',
            'customer_id' => 'Customer ID',
            'trans_name' => 'Transaction Name',
            'type' => 'Type',
            'amount' => 'Amount',
            'currency' => 'Currency',
            'trans_date' => 'From Transaction Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
