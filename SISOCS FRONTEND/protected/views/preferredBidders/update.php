<?php
/* @var $this PreferredBiddersController */
/* @var $model PreferredBidders */

$this->breadcrumbs=array(
	'Preferred Bidders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar PreferredBidders', 'url'=>array('index')),
	array('label'=>'Crear PreferredBidders', 'url'=>array('create')),
	array('label'=>'View PreferredBidders', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar PreferredBidders', 'url'=>array('admin')),
);
?>

<h1>Actualizar PreferredBidders <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>