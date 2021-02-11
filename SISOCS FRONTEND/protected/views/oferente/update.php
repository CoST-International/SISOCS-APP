<?php
/* @var $this OferenteController */
/* @var $model Oferente */

$this->breadcrumbs=array(
	//'Oferentes'=>array('index'),
	//$model->idOferente=>array('view','id'=>$model->idOferente),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Oferente', 'url'=>array('index')),
	array('label'=>'Crear Oferente', 'url'=>array('create')),
	//array('label'=>'Ver Oferente', 'url'=>array('view', 'id'=>$model->idOferente)),
	array('label'=>'Administrar Oferente', 'url'=>array('admin')),
);
?>

<h1>Actualizar Oferente <?php echo $model->idOferente; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
