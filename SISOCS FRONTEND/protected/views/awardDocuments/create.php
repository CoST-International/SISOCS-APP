<?php
/* @var $this AwardDocumentsController */
/* @var $model AwardDocuments */

$this->breadcrumbs=array(
	'Award Documents'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar AwardDocuments', 'url'=>array('index')),
	array('label'=>'Gestionar AwardDocuments', 'url'=>array('admin')),
);
?>

<h1>Crear AwardDocuments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>