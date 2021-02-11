<?php
/* @var $this FuentesfinanController */
/* @var $model Fuentesfinan */

$this->breadcrumbs=array(
	//'Fuentesfinans'=>array('index'),
	//$model->idfuente=>array('view','id'=>$model->idfuente),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Fuentes de Financiamiento', 'url'=>array('index')),
	array('label'=>'Crear Fuentes de Financiamiento', 'url'=>array('create')),
	//array('label'=>'Ver Fuentes de Financiamiento', 'url'=>array('view', 'id'=>$model->idfuente)),
	array('label'=>'Administrar Fuentes de Financiamiento', 'url'=>array('admin')),
);
?>

<h1>Actualizar Fuente de Financiamiento <?php echo $model->idfuente; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
