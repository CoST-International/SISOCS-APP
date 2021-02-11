<?php
/* @var $this CalificacionOferenteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Calificacion Oferentes',
);

$this->menu=array(
	array('label'=>'Crear CalificacionOferente', 'url'=>array('create')),
	array('label'=>'Gestionar CalificacionOferente', 'url'=>array('admin')),
);
?>

<h1>Calificaci&oacute;n Oferentes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
