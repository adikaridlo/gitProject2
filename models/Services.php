<?php

namespace app\models;

use Yii;
/**
* 
*/
class Services extends \yii\db\ActiveRecord
{
	public static function tableName()
	{
		return 'transaction';
	}
	
	public function rules()
    {
        return [
            [['jurnal_no', 'customer_id', 'trans_name', 'type', 'amount', 'currency', 'trans_date'], 'required'],
            [['jurnal_no', 'customer_id', 'amount'], 'integer'],
            [['trans_date'], 'safe'],
            [['trans_name', 'currency'], 'string'],
            [['type'], 'string'],
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
            'trans_date' => 'Transaction Date',
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

?>