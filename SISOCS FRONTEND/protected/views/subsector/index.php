<?php
/* @var $this SubsectorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Subsectors',
);

$this->menu=array(
	array('label'=>'Crear Subsector', 'url'=>array('create')),
	array('label'=>'Gestionar Subsector', 'url'=>array('admin')),
);
?>

<h1>Subsectors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
