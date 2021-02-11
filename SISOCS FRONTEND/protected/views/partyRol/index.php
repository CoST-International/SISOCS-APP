<?php
/* @var $this PartyRolController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Party Rols',
);

$this->menu=array(
	array('label'=>'Crear PartyRol', 'url'=>array('create')),
	array('label'=>'Gestionar PartyRol', 'url'=>array('admin')),
);
?>

<h1>Party Rols</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
