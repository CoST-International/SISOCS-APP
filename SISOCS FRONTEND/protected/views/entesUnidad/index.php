<?php
/* @var $this EntesUnidadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Entes Unidads',
);

$this->menu=array(
	array('label'=>'Crear EntesUnidad', 'url'=>array('create')),
	array('label'=>'Gestionar EntesUnidad', 'url'=>array('admin')),
);
?>

<h1>Entes Unidads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
