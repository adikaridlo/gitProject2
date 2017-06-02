<?php
 use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
 use app\models\Sigups;

?>

<div class="col-md-6">

	<?php $form = ActiveForm::begin(['action' => ['/sigup/user'],'method' => 'post']); ?>

	<?= $form->field($model, 'username')->textInput()->input('', ['placeholder' => "Masukkan username baru"] )?>
	<?= $form->field($model, 'password')->textInput()->input('password', ['placeholder' => "Masukkan Password baru"] )?>
	<?= $form->field($model, 'email')->textInput()->input('email', ['placeholder' => "Masukkan email"] )?>
	<?= $form->field($model, 'comment')->textInput()->input('',['placeholder' => "Masukkan comment"] )?>
	<?= $form->field($model, 'authKey')->textInput()->input('',['placeholder' => "Masukkan comment"] )?>

	<div>
         <?= Html::submitbutton('Tambah', ['class' => 'btn btn-primary waves-effect waves-light']) ?>
     </div>
	<?php ActiveForm::end(); ?>
</div>