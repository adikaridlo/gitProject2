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
            [['jurnal_no', 'customer_id', 'trans_name', 'type', 'amount', 'currency'], 'required'],
            [['jurnal_no', 'customer_id', 'amount'], 'integer'],
            [['trans_date'], 'safe'],
            [['trans_name', 'currency'], 'string'],
            [['type'], 'string'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }
    
    public function beforeSave($insert){
        if (parent::beforeSave($insert)) {
            $this->trans_date = date('Y-m-d H:i:s');
            return true;
        }else{
            return false;
        }
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