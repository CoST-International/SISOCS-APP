<?php
/* @var $this SubsectorController */
/* @var $model Subsector */

$this->breadcrumbs=array(
	//'Subsectors'=>array('index'),
	//$model->idSubSector=>array('view','id'=>$model->idSubSector),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Subsector', 'url'=>array('index')),
	array('label'=>'Crear Subsector', 'url'=>array('create')),
	//array('label'=>'Ver Subsector', 'url'=>array('view', 'id'=>$model->idSubSector)),
	array('label'=>'Gestionar Subsector', 'url'=>array('admin')),
);
?>

<h1>Actualizar Subsector <?php echo $model->idSubSector; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
