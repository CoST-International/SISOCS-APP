<?php
/* @var $this MetodoAdjudicacionController */
/* @var $model MetodoAdjudicacion */

$this->breadcrumbs=array(
	//'Metodo Adjudicacions'=>array('index'),
	//$model->idMetodoAdjudicacion=>array('view','id'=>$model->idMetodoAdjudicacion),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar MetodoAdjudicacion', 'url'=>array('index')),
	array('label'=>'Crear MetodoAdjudicacion', 'url'=>array('create')),
	//array('label'=>'View MetodoAdjudicacion', 'url'=>array('view', 'id'=>$model->idMetodoAdjudicacion)),
	array('label'=>'Gestionar MetodoAdjudicacion', 'url'=>array('admin')),
);
?>

<h1>Actualziar MetodoAdjudicacion <?php echo $model->idMetodoAdjudicacion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
