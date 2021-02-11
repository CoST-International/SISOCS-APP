<?php
/* @var $this ContratosController */
/* @var $model Contratos */

$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	$model->idContratos=>array('view','id'=>$model->idContratos),
	'Actualizar',
);
if($model->estado!='BORRADOR' && $model->estado!='REVISIÓN' || !Yii::app()->user->isGuest) 
{
$this->menu=array(
	array('label'=>'Listar Modificaciones', 'url'=>array('index')),
	array('label'=>'Crear Modificación', 'url'=>array('create')),
	array('label'=>'Ver Modificación', 'url'=>array('view', 'id'=>$model->idContratos)),
	array('label'=>'Gestionar Modificaciones', 'url'=>array('admin')),
);
?>
<h1>Actualizar Gestión de Contrato </h1>
<h1><?php echo $model->idContratacion0["titulocontrato"]; ?></h1>


<?php $this->renderPartial('_form', array('model'=>$model));
}
else
{
	$this->redirect(array('index'));
}?>