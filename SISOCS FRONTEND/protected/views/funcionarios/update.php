<?php
/* @var $this FuncionariosController */
/* @var $model Funcionarios */

$this->breadcrumbs=array(
	//'Funcionarioses'=>array('index'),
	//$model->idFuncionario=>array('view','id'=>$model->idFuncionario),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Funcionarios', 'url'=>array('index')),
	array('label'=>'Crear Funcionarios', 'url'=>array('create')),
	//array('label'=>'Ver Funcionarios', 'url'=>array('view', 'id'=>$model->idFuncionario)),
	array('label'=>'Gestionar Funcionarios', 'url'=>array('admin')),
);
?>

<h1>Actualizar Funcionario <?php echo $model->idFuncionario; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
