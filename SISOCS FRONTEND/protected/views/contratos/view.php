<?php
/* @var $this ContratosController */
/* @var $model Contratos */
$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	$model->idContratos,
);
if($model->estado!='BORRADOR' && $model->estado!='REVISIÓN' || !Yii::app()->user->isGuest) 
{
$this->menu=array(
	array('label'=>'Listar Modificaciones', 'url'=>array('index')),
	array('label'=>'Crear Modificación', 'url'=>array('create')),
	array('label'=>'Actualizar Modificación', 'url'=>array('update', 'id'=>$model->idContratos)),
	array('label'=>'Eliminar Modificación', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idContratos),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Modificaciones', 'url'=>array('admin')),
);
?>

<h1>Ver Gestión de Contrato #<?php echo $model->idContratos; ?></h1>

<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idContratos',
		'idContratacion0.ncontrato',
		'idContratacion0.titulocontrato',
		'nmodifica',
		'fecha',
		'tipomodifica',
		'justimodcontrato',
		array('label'=>'Precio Actual', 'value'=>number_format($model->precioactual,2,'.',',')),
		'fechatercontra',
		'alcanceactucontrato',
		array('label'=>'Adendas a los Contratos Debidamente Suscritas',
              'type'=>'raw',
              'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->adendas)), Yii::app()->Controller->getNameFromEnlace($model->adendas),array('target'=>'_blank')),$model->adendas)
        ),
        array('label'=>'Programa Actualizado de Trabajo',
              'type'=>'raw',
              'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->prograactu)), Yii::app()->Controller->getNameFromEnlace($model->prograactu),array('target'=>'_blank')),$model->prograactu)
        ),
		array('label'=>'Otro',
              'type'=>'raw',
              'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->otro)), Yii::app()->Controller->getNameFromEnlace($model->otro),array('target'=>'_blank')),$model->otro)
        ),
		'estado',
         array('label'=>$model->getAttributeLabel('usuario_creacion'),
            'type' => 'raw',
            'value'=>$model->Usuario($model->usuario_creacion)
        ),
        //'usuario_creacion',
        //'usuario_creacion',
	'fecha_creacion',
        array('label'=>$model->getAttributeLabel('usuario_publicacion'),
            'type' => 'raw',
            'value'=>$model->Usuario($model->usuario_publicacion)
        ),
	'fecha_publicacion',
	),
));

}
else {
	$this->redirect(array('index'));
}

?>
