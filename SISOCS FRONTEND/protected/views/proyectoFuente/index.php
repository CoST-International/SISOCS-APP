<?php
/* @var $this ProgramaFuenteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Programa Fuentes',
);

$this->menu=array(
	array('label'=>'Crear ProgramaFuente', 'url'=>array('create')),
	array('label'=>'Administrar ProgramaFuente', 'url'=>array('admin')),
);
?>

<h1>Programa Fuentes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
