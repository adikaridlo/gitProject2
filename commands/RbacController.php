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
                $index              = $auth->createPermission('transaction/index');
                $index->description = 'Create a index';
                $auth->add($index);

                $create     = $auth->createPermission('transaction/create');
                $create->description = 'Create a transaction';
                $auth->add($create);

                $view     = $auth->createPermission('transaction/view');        
                $view->description = 'view a transaction';
                $auth->add($view);

                $update     = $auth->createPermission('transaction/update');        
                $update->description = 'Update a transaction';
                $auth->add($update);

                $delete     = $auth->createPermission('transaction/delete');        
                $delete->description = 'Delete a transaction';
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


                //Buat Rulles..

                // $index = $auth->createPermission('country/index');
                // $create = $auth->createPermission('country/create');
                // $view = $auth->createPermission('country/view');
                // $update = $auth->createPermission('country/update');
                // $delete = $auth->createPermission('country/delete');

                //Author....
                // $author = $auth->createRole('author');
                // $auth->add($author);
                // $auth->addChild($author, $index);
                // $auth->addChild($author, $create);
                // $auth->addChild($author, $view);

                // //Admin.....
                // $admin = $auth->createRole('admin');
                // $auth->add($admin);
                // $auth->addChild($admin, $author);
                // $auth->addChild($admin, $update);
                // $auth->addChild($admin, $delete);



                // Create Assigment...
                // $admin = $auth->createRole('admin');
                // $author = $auth->createRole('author');

                // $auth->assign($admin, 20);
                // $auth->assign($author, 21);



	}
}

?>