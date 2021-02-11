<?php
/* @var $this DepartamentoController */
/* @var $model Departamento */

$this->breadcrumbs=array(
	//'Departamentos'=>array('index'),
	//$model->idDepartamento=>array('view','id'=>$model->idDepartamento),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Departamento', 'url'=>array('index')),
	array('label'=>'Crear Departamento', 'url'=>array('create')),
	//array('label'=>'View Departamento', 'url'=>array('view', 'id'=>$model->idDepartamento)),
	array('label'=>'Gestionar Departamento', 'url'=>array('admin')),
);
?>

<h1>Actualizar Departamento <?php echo $model->idDepartamento; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
