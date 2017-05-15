<?php
namespace app\models;

use yii\db\ActiveRecord;
class Tabels extends ActiveRecord
{
	public $teamsCount; 
	public static function transaksi()
	{
		
		return 'transaksi';
	}
}

?>