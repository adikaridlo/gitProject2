<?php

namespace app\models;

use Yii;
/**
* 
*/
class Logs extends \yii\db\ActiveRecord
{
	public static function tableName()
	{
		return 'logs';
	}
	
	public function rules()
    {
        return [
            [['request', 'ip_address', 'created_date'], 'required'],
            [['id'], 'integer']
        ];
    }
}

?>