<?php
/* @var $this MetodoAdjudicacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Metodo Adjudicacions',
);

$this->menu=array(
	array('label'=>'Crear MetodoAdjudicacion', 'url'=>array('create')),
	array('label'=>'Gestionar MetodoAdjudicacion', 'url'=>array('admin')),
);
?>

<h1>Metodo Adjudicacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
