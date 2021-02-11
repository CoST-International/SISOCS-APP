<?php
/* @var $this PropositoController */
/* @var $model Proposito */

$this->breadcrumbs=array(
	//'Propositos'=>array('index'),
	//$model->idProposito=>array('view','id'=>$model->idProposito),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Proposito', 'url'=>array('index')),
	array('label'=>'Crear Proposito', 'url'=>array('create')),
	//array('label'=>'Ver Proposito', 'url'=>array('view', 'id'=>$model->idProposito)),
	array('label'=>'Gestionar Proposito', 'url'=>array('admin')),
);
?>

<h1>Actualizar Proposito <?php echo $model->idProposito; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
