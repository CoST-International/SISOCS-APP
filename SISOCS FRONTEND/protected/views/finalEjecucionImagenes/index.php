<?php
/* @var $this FinalEjecucionImagenesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Final Ejecucion Imagenes',
);

$this->menu=array(
	array('label'=>'Crear FinalEjecucionImagenes', 'url'=>array('create')),
	array('label'=>'Gestionar FinalEjecucionImagenes', 'url'=>array('admin')),
);
?>

<h1>Final Ejecucion Imagenes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
