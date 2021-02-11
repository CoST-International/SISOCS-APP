<?php
/* @var $this AvancesImagenesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Avances Imagenes',
);

$this->menu=array(
	array('label'=>'Crear AvancesImagenes', 'url'=>array('create')),
	array('label'=>'Gestionar AvancesImagenes', 'url'=>array('admin')),
);
?>

<h1>Avances Imagenes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
