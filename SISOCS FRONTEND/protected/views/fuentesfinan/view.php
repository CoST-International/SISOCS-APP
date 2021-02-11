<?php
/* @var $this FuentesfinanController */
/* @var $model Fuentesfinan */

$this->breadcrumbs=array(
	//'Fuentesfinans'=>array('index'),
	$model->idfuente,
);

$this->menu=array(
	//array('label'=>'Listar Fuentes de Financiamiento', 'url'=>array('index')),
	array('label'=>'Crear Fuentes de Financiamiento', 'url'=>array('create')),
	array('label'=>'Actualizar Fuentes de Financiamiento', 'url'=>array('update', 'id'=>$model->idfuente)),
//	array('label'=>'Eliminar Fuentes de Financiamiento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idfuente),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Administrar Fuentes de Financiamiento', 'url'=>array('admin')),
);
?>

<h1>Ver Fuente de Financiamiento #<?php echo $model->idfuente; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fuente',
		'idfuente',
	),
)); ?>
