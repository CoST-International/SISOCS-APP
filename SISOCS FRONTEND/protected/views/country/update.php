<?php
/* @var $this CountryController */
/* @var $model Country */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->idCountry=>array('view','id'=>$model->idCountry),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Country', 'url'=>array('index')),
	array('label'=>'Crear Country', 'url'=>array('create')),
	array('label'=>'View Country', 'url'=>array('view', 'id'=>$model->idCountry)),
	array('label'=>'Gestionar Country', 'url'=>array('admin')),
);
?>

<h1>Actualizar Country <?php echo $model->idCountry; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>