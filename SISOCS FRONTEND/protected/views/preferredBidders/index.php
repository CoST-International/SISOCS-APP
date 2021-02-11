<?php
/* @var $this PreferredBiddersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Preferred Bidders',
);

$this->menu=array(
	array('label'=>'Crear PreferredBidders', 'url'=>array('create')),
	array('label'=>'Gestionar PreferredBidders', 'url'=>array('admin')),
);
?>

<h1>Preferred Bidders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
