<?php
/* @var $this FinalEjecucionController */
/* @var $model FinalEjecucion */

$this->breadcrumbs=array(
	'Finalización de Contratos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Contratos no finalizados', 'url'=>array('GestionFinales/admin')),
	array('label'=>'Lista de finalizaciones (Publicadas)', 'url'=>array('GestionFinales/publicadas')),
	array('label'=>'Gestionar finalizaciones', 'url'=>array('admin')),
);
?>

<h1>Crear Finalización de ejecución</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'idInicioEjecucion'=>$id)); ?>
