<?php
/* @var $this MunicipioController */
/* @var $model Municipio */

$this->breadcrumbs=array(
	//'Municipios'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Municipio', 'url'=>array('index')),
	array('label'=>'Administrar Municipio', 'url'=>array('admin')),
);
?>

<h1>Crear Municipio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
