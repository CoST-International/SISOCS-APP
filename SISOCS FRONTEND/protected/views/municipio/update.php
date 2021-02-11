<?php
/* @var $this MunicipioController */
/* @var $model Municipio */

$this->breadcrumbs=array(
	//'Municipios'=>array('index'),
	//array('view','id'=>$model->primaryKey),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Municipio', 'url'=>array('index')),
	array('label'=>'Crear Municipio', 'url'=>array('create')),
	//array('label'=>'Ver Municipio', 'url'=>array('view', 'idMunicipio'=>$model->idMunicipio,'idDepartamento'=>$model->idDepartamento)),
	array('label'=>'Administrar Municipio', 'url'=>array('admin')),
);
?>

<h1>Actualizar Municipio <?php echo $model->idMunicipio; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
