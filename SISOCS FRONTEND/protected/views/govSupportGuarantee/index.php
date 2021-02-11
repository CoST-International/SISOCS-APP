<?php
/* @var $this GovSupportGuaranteeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gov Support Guarantees',
);

$this->menu=array(
	array('label'=>'Crear GovSupportGuarantee', 'url'=>array('create')),
	array('label'=>'Gestionar GovSupportGuarantee', 'url'=>array('admin')),
);
?>

<h1>Gov Support Guarantees</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
