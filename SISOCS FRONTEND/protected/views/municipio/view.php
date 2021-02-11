<?php
/* @var $this MunicipioController */
/* @var $model Municipio */

$this->breadcrumbs=array(
	//'Municipios'=>array('index'),
	$model->primaryKey,
);


$this->menu=array(
	//array('label'=>'Listar Municipio', 'url'=>array('index')),
	array('label'=>'Crear Municipio', 'url'=>array('create')),
	//array('label'=>'Actualizar Municipio', 'url'=>array('update', 'idMunicipio'=>$model->idMunicipio,'idDepartamento'=>$model->idDepartamento)),
	//array('label'=>'Borrar Municipio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','idMunicipio'=>$model->idMunicipio,'idDepartamento'=>$model->idDepartamento),'confirm'=>'�Est&aacute seguro/a de borrar este item?')),
	array('label'=>'Administrar Municipio', 'url'=>array('admin')),
);

//var_dump($model);
?>

<h1>Ver Municipio #<?php echo $model->idMunicipio; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes' => array(
		'FK_idDepartamento.departamento',
		'idMunicipio',
		'municipio'
	)
)); ?>
