<?php
/* @var $this OferenteController */
/* @var $model Oferente */

$this->breadcrumbs=array(
	//'Oferentes'=>array('index'),
	$model->idOferente,
);

$this->menu=array(
	//array('label'=>'Listar Oferente', 'url'=>array('index')),
	array('label'=>'Crear Oferente', 'url'=>array('create')),
	//array('label'=>'Actualizar Oferente', 'url'=>array('update', 'id'=>$model->idOferente)),
	//array('label'=>'Borrar Oferente', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idOferente),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Administrar Oferente', 'url'=>array('admin')),
);
?>

<h1>Ver Oferente #<?php echo $model->idOferente; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idOferente',
		'nombre_oferente',
	),
)); ?>
