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
class Login extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'pengguna';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','username', 'password', 'email', 'comment','authKey', 'accessToken'], 'required'],
            [['id'], 'interger'],
        ];
    }
}

?>