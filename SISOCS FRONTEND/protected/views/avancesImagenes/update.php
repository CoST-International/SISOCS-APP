<?php
/* @var $this AvancesImagenesController */
/* @var $model AvancesImagenes */

$this->breadcrumbs=array(
	'Avances Imagenes'=>array('index'),
	$model->idImagen=>array('view','id'=>$model->idImagen),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar AvancesImagenes', 'url'=>array('index')),
	array('label'=>'Crear AvancesImagenes', 'url'=>array('create')),
	array('label'=>'View AvancesImagenes', 'url'=>array('view', 'id'=>$model->idImagen)),
	array('label'=>'Gestionar AvancesImagenes', 'url'=>array('admin')),
);
?>

<h1>Actualizar AvancesImagenes <?php echo $model->idImagen; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>