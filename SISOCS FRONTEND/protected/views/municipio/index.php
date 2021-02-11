<?php
/* @var $this MunicipioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Municipios',
);

$this->menu=array(
	array('label'=>'Crear Municipio', 'url'=>array('create')),
	array('label'=>'Administrar Municipio', 'url'=>array('admin')),
);
?>

<h1>Municipios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
