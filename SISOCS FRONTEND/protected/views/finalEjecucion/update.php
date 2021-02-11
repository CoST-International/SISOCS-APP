<?php
/* @var $this FinalEjecucionController */
/* @var $model FinalEjecucion */

$this->breadcrumbs=array(
	'Finalización de Contratos'=>array('index'),
	$model->idFinalizacion=>array('view','id'=>$model->idFinalizacion),
	'Actualizar',
);

$this->menu=array(
        array('label'=>'Ver Finalización de contrato', 'url'=>array('view', 'id'=>$model->idFinalizacion)),
        array('label'=>'Listar Contratos no finalizados', 'url'=>array('GestionFinales/admin')),
        array('label'=>'Lista de finalizaciones (Publicadas)', 'url'=>array('GestionFinales/publicadas')),
	array('label'=>'Gestionar finalizaciones', 'url'=>array('admin')),
);
?>

<h1>Actualizar Finalización de contrato #<?php echo $model->idFinalizacion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'model3'=>$model3)); ?>
