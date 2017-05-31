<?php

namespace app\models;
use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $comment;
    public $authKey;
    public $accessToken;

   public static function findIdentity($id)
    {
        //mencari user login berdasarkan IDnya dan hanya dicari 1.
        $user = Login::findOne($id); 
        if(count($user)){
            return new static($user);
        }
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        //mencari user login berdasarkan accessToken dan hanya dicari 1.
        $user = Login::find()->where(['accessToken'=>$token])->one(); 
        if(count($user)){
            return new static($user);
        }
        return null;
    }

    public static function findByUsername($username)
    {
        //mencari user login berdasarkan username dan hanya dicari 1.
        $user = Login::find()->where(['email'=>$username])->one(); 
        if(count($user)){
            return new static($user);
        }
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
         return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function hashPassword($password) {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }
}
