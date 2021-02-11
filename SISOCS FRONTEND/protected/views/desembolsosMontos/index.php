<?php
/* @var $this DesembolsosMontosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Desembolsos Montoses',
);

$this->menu=array(
	array('label'=>'Crear DesembolsosMontos', 'url'=>array('create')),
	array('label'=>'Gestionar DesembolsosMontos', 'url'=>array('admin')),
);
?>

<h1>Desembolsos Montoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
