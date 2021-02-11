<?php
/* @var $this AvancesImagenesController */
/* @var $model AvancesImagenes */

$this->breadcrumbs=array(
	'Avances Imagenes'=>array('index'),
	$model->idImagen,
);

$this->menu=array(
	array('label'=>'Listar AvancesImagenes', 'url'=>array('index')),
	array('label'=>'Crear AvancesImagenes', 'url'=>array('create')),
	array('label'=>'Actualizar AvancesImagenes', 'url'=>array('update', 'id'=>$model->idImagen)),
	array('label'=>'Eliminar AvancesImagenes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idImagen),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar AvancesImagenes', 'url'=>array('admin')),
);
?>

<h1>View AvancesImagenes #<?php echo $model->idImagen; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idImagen',
		'idAvances',
		'nombre_imagen',
		'nombre_fisico',
		'ubicacion_imagen',
		'estado',
		'usuario_creacion',
		'fecha_creacion',
		'usuario_publicacion',
		'fecha_publicacion',
	),
)); ?>
