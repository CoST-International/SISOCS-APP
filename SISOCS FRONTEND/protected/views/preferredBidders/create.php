<?php
/* @var $this PreferredBiddersController */
/* @var $model PreferredBidders */

$this->breadcrumbs=array(
	'Preferred Bidders'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar PreferredBidders', 'url'=>array('index')),
	array('label'=>'Gestionar PreferredBidders', 'url'=>array('admin')),
);
?>

<h1>Crear PreferredBidders</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>