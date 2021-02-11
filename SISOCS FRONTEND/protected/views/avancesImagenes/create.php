<?php
/* @var $this AvancesImagenesController */
/* @var $model AvancesImagenes */

$this->breadcrumbs=array(
	'Avances Imagenes'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar AvancesImagenes', 'url'=>array('index')),
	array('label'=>'Gestionar AvancesImagenes', 'url'=>array('admin')),
);
?>

<h1>Crear AvancesImagenes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>