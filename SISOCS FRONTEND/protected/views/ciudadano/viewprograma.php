<?php
/* @var $this ProyectoController */
/* @var $model Proyecto */

$this->breadcrumbs=array(
	'Ciudadano'=>array('index'),
	$model->programa,
);
?>

<h1>Ver programa #<?php echo $model->programa; ?></h1>

<?php 
$model->idFuncionario=Yii::app()->db->createCommand()
                              ->select('nombre')
                              ->from('cs_funcionarios')
                              ->where('idFuncionario ='.$model->idFuncionario)
                              ->queryScalar();
$model->entes=Yii::app()->db->createCommand()
                              ->select('descripcion')
                              ->from('cs_entes')
                              ->where("idente ='".$model->entes."'")
                              ->queryScalar();
$model->idRol=Yii::app()->db->createCommand()
                              ->select('rol')
                              ->from('cs_rol')
                              ->where("idrol ='".$model->idRol."'")
                              ->queryScalar();
$model->idSector=Yii::app()->db->createCommand()
                              ->select('sector')
                              ->from('cs_sector')
                              ->where("idsector ='".$model->idSector."'")
                              ->queryScalar();
$model->idSubSector=Yii::app()->db->createCommand()
                              ->select('subsector')
                              ->from('cs_subsector')
                              ->where("idSubSector ='".$model->idSubSector."'")
                              ->queryScalar();
$model->idProposito=Yii::app()->db->createCommand()
                              ->select('proposito')
                              ->from('cs_proposito')
                              ->where("idproposito ='".$model->idProposito."'")
                              ->queryScalar();
$this->widget('zii.widgets.CDetailView', array(
      'data'=>$model,
      'attributes'=>array(
            'idPrograma',
            'programa',
            'BIP',
            'nombreprograma',
            'entes',
            'idFuncionario',
            'idRol',
            'idSector',
            'idSubSector',
            'descripcion',
            'costoesti',
            'fechaapro',
             array('label'=>'cartaconvenio',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->cartaconvenio), Yii::app()->baseUrl . '/images/'.$model->cartaconvenio)
                   ),
              array('label'=>'otro1',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->otro1), Yii::app()->baseUrl . '/images/'.$model->otro1)
                   ),
             array('label'=>'planope',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->planope), Yii::app()->baseUrl . '/images/'.$model->planope)
                   ),
             array('label'=>'presupuesto',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->presupuesto), Yii::app()->baseUrl . '/images/'.$model->presupuesto)
                   ),
            array('label'=>'perfildelprogra',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->perfildelprogra), Yii::app()->baseUrl . '/images/'.$model->perfildelprogra)
                   ),
              array('label'=>'otro2',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->otro2), Yii::app()->baseUrl . '/images/'.$model->otro2)
                   ),
      
            'fechacreacion',
            'estado',
            'idProposito',
      ),
)); ?>