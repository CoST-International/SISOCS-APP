<?php
/* @var $this FuncionariosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Funcionarios',
);

$this->menu=array(
	array('label'=>'Crear Funcionarios', 'url'=>array('create')),
	array('label'=>'Gestionar Funcionarios', 'url'=>array('admin')),
);
?>

<h1>Funcionarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
