<?php
/* @var $this SectorController */
/* @var $model Sector */

$this->breadcrumbs=array(
	//'Sectors'=>array('index'),
	//$model->idSector=>array('view','id'=>$model->idSector),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Sector', 'url'=>array('index')),
	array('label'=>'Crear Sector', 'url'=>array('create')),
	//array('label'=>'Ver Sector', 'url'=>array('view', 'id'=>$model->idSector)),
	array('label'=>'Gestionar Sector', 'url'=>array('admin')),
);
?>

<h1>Actualizar Sector <?php echo $model->idSector; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
