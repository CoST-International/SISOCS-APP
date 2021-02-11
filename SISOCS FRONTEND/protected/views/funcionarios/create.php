<?php
/* @var $this FuncionariosController */
/* @var $model Funcionarios */

$this->breadcrumbs=array(
	//'Funcionarios'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Funcionarios', 'url'=>array('index')),
	array('label'=>'Gestionar Funcionarios', 'url'=>array('admin')),
);
?>

<h1>Crear Funcionarios</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
