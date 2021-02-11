<?php
/* @var $this FinalEjecucionImagenesController */
/* @var $model FinalEjecucionImagenes */

$this->breadcrumbs=array(
	'Final Ejecucion Imagenes'=>array('index'),
	$model->idImagen,
);

$this->menu=array(
	array('label'=>'Listar FinalEjecucionImagenes', 'url'=>array('index')),
	array('label'=>'Crear FinalEjecucionImagenes', 'url'=>array('create')),
	array('label'=>'Actualizar FinalEjecucionImagenes', 'url'=>array('update', 'id'=>$model->idImagen)),
	array('label'=>'Eliminar FinalEjecucionImagenes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idImagen),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar FinalEjecucionImagenes', 'url'=>array('admin')),
);
?>

<h1>View FinalEjecucionImagenes #<?php echo $model->idImagen; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idImagen',
		'idFinalizacion',
		'nombre_imagen',
		'nombre_fisico',
		'ubicacion_imagen',
		'estado',
		'usuario_creacion',
		'fecha_creacion',
	),
)); ?>
