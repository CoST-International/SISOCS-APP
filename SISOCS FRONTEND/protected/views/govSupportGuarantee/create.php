<?php
/* @var $this GovSupportGuaranteeController */
/* @var $model GovSupportGuarantee */

$this->breadcrumbs=array(
	'Gov Support Guarantees'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar GovSupportGuarantee', 'url'=>array('index')),
	array('label'=>'Gestionar GovSupportGuarantee', 'url'=>array('admin')),
);
?>

<h1>Crear GovSupportGuarantee</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>