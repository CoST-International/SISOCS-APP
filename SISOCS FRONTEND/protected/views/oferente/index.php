<?php
/* @var $this OferenteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Oferentes',
);

$this->menu=array(
	array('label'=>'Crear Oferente', 'url'=>array('create')),
	array('label'=>'Administrar Oferente', 'url'=>array('admin')),
);
?>

<h1>Oferente</h1>

<?php 
$this->widget('application.extensions.tablesorter.Sorter', array(
    'data'=>$records,
    'columns'=>array(
       'idOferente',
		'nombre_Oferente',
    )
));


 ?>
