<?php
/* @var $this AvancesController */
/* @var $model Avances */

$this->breadcrumbs=array(
	'Avances'=>array('index'),
	$model->codigo,
);

$this->menu=array(
	array('label'=>'Lista Avances', 'url'=>array('index')),
	//array('label'=>'Crear Avances', 'url'=>array('create')),
	array('label'=>'Actualizar Avances', 'url'=>array('update', 'id'=>$model->codigo)),
	array('label'=>'Eliminar Avances', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->codigo),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Administrar Avances', 'url'=>array('admin2','id'=>Yii::app()->getSession()->get('cod_inicioEjecucion'))),
);
?>

<h1>Ver Avances en la Ejecuci&oacute;n #<?php echo $model->codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'codigo',
		'codigo_inicio_ejecucion',
		'porcent_programado',
		'porcent_real',
		'finan_programado',
		'finan_real',
		//'fecha_registro',
		//'user_registro',
		'fecha_avance',
		'desc_problemas',
		'desc_temas',
		 array('label'=>'Documento de Garantia',
                   'type'=>'raw',
                   'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->adj_garantias)), Yii::app()->Controller->getNameFromEnlace($model->adj_garantias),array('target'=>'_blank')),$model->adj_garantias)
                   ),
		array('label'=>'Documento Avances',
                   'type'=>'raw',
                   'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->adj_avances),array('target'=>'_blank')), $model->adj_avances),$model->adj_avances)
                   ),
				   array('label'=>'Documento Supervición',
                   'type'=>'raw',
                   'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->adj_supervicion)), Yii::app()->Controller->getNameFromEnlace($model->adj_supervicion),array('target'=>'_blank')),$model->adj_supervicion)
                   ),
				   array('label'=>'Documento Evaluación',
                   'type'=>'raw',
                   'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->adj_evaluacion)), Yii::app()->Controller->getNameFromEnlace($model->adj_evaluacion),array('target'=>'_blank')),$model->adj_evaluacion)
                   ),
				   array('label'=>'Documento Auditoría Técnica',
                   'type'=>'raw',
                   'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->adj_tecnica)), Yii::app()->Controller->getNameFromEnlace($model->adj_tecnica),array('target'=>'_blank')),$model->adj_tecnica)
                   ),
				    array('label'=>'Documento  Auditoría Financiera',
                   'type'=>'raw',
                   'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->adj_financiero)), Yii::app()->Controller->getNameFromEnlace($model->adj_financiero),array('target'=>'_blank')),$model->adj_financiero)
                   ),
				   array('label'=>'Documento Recepción Definitiva',
                   'type'=>'raw',
                   'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->adj_recepcion)), Yii::app()->Controller->getNameFromEnlace($model->adj_recepcion),array('target'=>'_blank')),$model->adj_recepcion)
                   ),
				   array('label'=>'Documento Informe de disconformidad',
                   'type'=>'raw',
                   'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->adj_disconformidad)), Yii::app()->Controller->getNameFromEnlace($model->adj_disconformidad),array('target'=>'_blank')),$model->adj_disconformidad)
                   ),
				   
	),
)); ?>
