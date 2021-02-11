<?php
/* @var $this AvancesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Avances',
);

$this->menu=array(
	//array('label'=>'Crear Avances', 'url'=>array('create')),
	array('label'=>'Administrar Avances', 'url'=>array('admin')),
);
?>

<h1>Avances en la ejecuci&oacute;n</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
