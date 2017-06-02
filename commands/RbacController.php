<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

/**
* 
*/
class RbacController extends Controller
{
	
	public function actionInit()
	{
		$auth = Yii::$app->authManager;
                
                //Buat permission untuk city
                //index

                // Country
                $index              = $auth->createPermission('country/index');
                $index->description = 'Create a index';
                $auth->add($index);

                $create     = $auth->createPermission('country/create');
                $create->description = 'Create a country';
                $auth->add($create);

                $view     = $auth->createPermission('country/view');        
                $view->description = 'view a country';
                $auth->add($view);

                $update     = $auth->createPermission('country/update');        
                $update->description = 'Update a country';
                $auth->add($update);

                $delete     = $auth->createPermission('country/delete');        
                $delete->description = 'Delete a country';
                $auth->add($delete);

                // city
                $index              = $auth->createPermission('city/index');
                $index->description = 'Create a index';
                $auth->add($index);

                $create     = $auth->createPermission('city/create');
                $create->description = 'Create a city';
                $auth->add($create);

                $view     = $auth->createPermission('city/view');        
                $view->description = 'view a city';
                $auth->add($view);

                $update     = $auth->createPermission('city/update');        
                $update->description = 'Update a city';
                $auth->add($update);

                $delete     = $auth->createPermission('city/delete');        
                $delete->description = 'Delete a city';
                $auth->add($delete);

                //customer
                $index              = $auth->createPermission('customer/index');
                $index->description = 'Create a index';
                $auth->add($index);

                $create     = $auth->createPermission('customer/create');
                $create->description = 'Create a customer';
                $auth->add($create);

                $view     = $auth->createPermission('customer/view');        
                $view->description = 'view a customer';
                $auth->add($view);

                $update     = $auth->createPermission('customer/update');        
                $update->description = 'Update a customer';
                $auth->add($update);

                $delete     = $auth->createPermission('customer/delete');        
                $delete->description = 'Delete a customer';
                $auth->add($delete);

                $excel     = $auth->createPermission('transaction/excel');        
                $excel->description = 'Print All Data transaction';
                $auth->add($excel);

                $cetak     = $auth->createPermission('transaction/cetak');        
                $cetak->description = 'Print Data Record transaction';
                $auth->add($cetak);

                $filter     = $auth->createPermission('transaction/filter');        
                $filter->description = 'Print Data Filter transaction';
                $auth->add($filter);

                $sigup     = $auth->createPermission('sigup/sigup');        
                $sigup->description = 'Tambah Author';
                $auth->add($sigup);


                // Buat Rulles..

                // country
                $index = $auth->createPermission('country/index');
                $create = $auth->createPermission('country/create');
                $view = $auth->createPermission('country/view');
                $update = $auth->createPermission('country/update');
                $delete = $auth->createPermission('country/delete');

                 // city
                $index = $auth->createPermission('city/index');
                $create = $auth->createPermission('city/create');
                $view = $auth->createPermission('city/view');
                $update = $auth->createPermission('city/update');
                $delete = $auth->createPermission('city/delete');

                // customer
                $index = $auth->createPermission('customer/index');
                $create = $auth->createPermission('customer/create');
                $view = $auth->createPermission('customer/view');
                $update = $auth->createPermission('customer/update');
                $delete = $auth->createPermission('customer/delete');

                // transaction
                $excel  = $auth->createPermission('transaction/excel');
                $cetak  = $auth->createPermission('transaction/cetak');
                $filter = $auth->createPermission('transaction/filter');
                $sigup  = $auth->createPermission('sigup/sigup');

                // Author....
                $author = $auth->createRole('author');
                $auth->add($author);
                $auth->addChild($author, $index);
                $auth->addChild($author, $create);
                $auth->addChild($author, $view);

                //Admin.....
                $admin = $auth->createRole('admin');
                $auth->add($admin);
                $auth->addChild($admin, $author);
                $auth->addChild($admin, $update);
                $auth->addChild($admin, $delete);
                $auth->addChild($admin, $excel);
                $auth->addChild($admin, $cetak);
                $auth->addChild($admin, $filter);
                $auth->addChild($admin, $sigup);



                // Create Assigment...
                $admin = $auth->createRole('admin');
                $author = $auth->createRole('author');

                // $auth->assign($admin, 20);
                // $auth->assign($author, 21);



	}
}

?>