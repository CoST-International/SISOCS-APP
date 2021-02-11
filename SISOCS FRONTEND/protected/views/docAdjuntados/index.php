<?php
/* @var $this DocAdjuntadosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Doc Adjuntadoses',
);

$this->menu=array(
	array('label'=>'Crear DocAdjuntados', 'url'=>array('create')),
	array('label'=>'Gestionar DocAdjuntados', 'url'=>array('admin')),
);
?>

<h1>Doc Adjuntadoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
