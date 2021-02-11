<?php
/* @var $this TariffsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tariffs',
);

$this->menu=array(
	array('label'=>'Crear Tariffs', 'url'=>array('create')),
	array('label'=>'Gestionar Tariffs', 'url'=>array('admin')),
);
?>

<h1>Tariffs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
