<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
* 
*/
class CustomerForm extends Model
{
	public $nama;
	public $negara;
	public $kota;
	public function rules()
	{
		return [
            [['nama', 'negara', 'kota'], 'required'],
        ];
	}
}
?>