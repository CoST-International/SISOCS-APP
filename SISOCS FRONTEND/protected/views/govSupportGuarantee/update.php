<?php
/* @var $this GovSupportGuaranteeController */
/* @var $model GovSupportGuarantee */

$this->breadcrumbs=array(
	'Gov Support Guarantees'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar GovSupportGuarantee', 'url'=>array('index')),
	array('label'=>'Crear GovSupportGuarantee', 'url'=>array('create')),
	array('label'=>'View GovSupportGuarantee', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar GovSupportGuarantee', 'url'=>array('admin')),
);
?>

<h1>Actualizar GovSupportGuarantee <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>