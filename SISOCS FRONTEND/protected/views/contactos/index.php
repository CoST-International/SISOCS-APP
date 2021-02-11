<?php
/* @var $this ContactosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contactoses',
);

$this->menu=array(
	array('label'=>'Crear Contactos', 'url'=>array('create')),
	array('label'=>'Gestionar Contactos', 'url'=>array('admin')),
);
?>

<h1>Contactoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
