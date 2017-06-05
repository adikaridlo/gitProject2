<?php
namespace app\models;

use Yii;

/**
* 
*/
class Sigups extends \yii\db\ActiveRecord
{
	
	public static function tableName(){

			return 'pengguna';
	}

	public function rules(){

		return[
			[['username', 'password', 'email'], 'required'],
            [['comment', 'authKey'], 'string'],
			[['id'], 'integer'],
		];
	}

	public function attributeLabels()
    {
        
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'comment' => 'Comment',
            'authKey' => 'authKey',
            'accessToken' => 'accessToken',
        ];
    }

    public function beforeSave($insert){
        if (parent::beforeSave($insert)) {
        	$a =  time()."_".date('Y-m-d H:i:s');
            $this->accessToken = Yii::$app->getSecurity()->generatePasswordHash($a);
            return true;
        }else{
            return false;
        }
    }

    public static function generatePasswordHash($password)
    {
        $password = Yii::$app->getSecurity()->generatePasswordHash($password);

        return $password;
    }

	
}


?>