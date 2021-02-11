<?php
/* @var $this ContratosDocumentsController */
/* @var $model ContratosDocuments */

$this->breadcrumbs=array(
	'Contratos Documents'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ContratosDocuments', 'url'=>array('index')),
	array('label'=>'Crear ContratosDocuments', 'url'=>array('create')),
	array('label'=>'View ContratosDocuments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar ContratosDocuments', 'url'=>array('admin')),
);
?>

<h1>Actualizar ContratosDocuments <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>