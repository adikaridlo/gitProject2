<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
* 
*/
class TransaksiForm extends Model
{
	public $transdate;
	public $todate;
	public $customer;
	public function rules()
	{
		return [
            [['transdate', 'todate', 'customer'], 'string'],
        ];
	}
}
?>