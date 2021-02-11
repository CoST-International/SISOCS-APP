

<h1>Ver Planificacion #<?php echo $model->idProyecto; ?></h1>

<?php 
$model->idDepto=Yii::app()->db->createCommand()
                              ->select('departamento')
                              ->from('cs_departamento')
                              ->where('codigoDepto ='.$model->idDepto)
                              ->queryScalar();
$model->idRegion=Yii::app()->db->createCommand()
                              ->select('region')
                              ->from('cs_region')
                              ->where("idregion ='".$model->idRegion."'")
                              ->queryScalar();
$model->idTramo=Yii::app()->db->createCommand()
                              ->select('tramo')
                              ->from('cs_tramo')
                              ->where("idtramo ='".$model->idTramo."'")
                              ->queryScalar();
$model->idRuta=Yii::app()->db->createCommand()
                              ->select('tramo')
                              ->from('cs_ruta')
                              ->where("idruta ='".$model->idRuta."'")
                              ->queryScalar();
$model->idTipoRed=Yii::app()->db->createCommand()
                              ->select('descripción_tipo')
                              ->from('cs_tipored')
                              ->where("Idtipored ='".$model->idTipoRed."'")
                              ->queryScalar();
$model->idProposito=Yii::app()->db->createCommand()
                              ->select('proposito')
                              ->from('cs_proposito')
                              ->where("idproposito ='".$model->idProposito."'")
                              ->queryScalar();
$model->idFuncionario=Yii::app()->db->createCommand()
                              ->select('nombre')
                              ->from('cs_funcionarios')
                              ->where('idFuncionario ='.$model->idFuncionario)
                              ->queryScalar();
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'idProyecto',
            'idPrograma',
            'codigo',
            'nombre_proyecto',
            //'idUbicacion',
            'idRegion',
            'idDepto',
            'idTramo',
            'idRuta',
            'idTipoRed',
            'idProposito',
            'descrip',
            'presupuesto',
		//'especiplano',
               array('label'=>'Especificaciones y planos de la obra',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->especiplano), Yii::app()->baseUrl . '/images/'.$model->especiplano)
                   ),
            array('label'=>'Presupuesto y programa multianual del proyecto',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->presuprogra), Yii::app()->baseUrl . '/images/'.$model->presuprogra)
                   ),
            array('label'=>'Estudio de Factibilidad',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->estudiofact), Yii::app()->baseUrl . '/images/'.$model->estudiofact)
                   ),
            array('label'=>'Estudio de Impacto Ambiental',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->estudioimpact), Yii::app()->baseUrl . '/images/'.$model->estudioimpact)
                   ),
             array('label'=>'Licencia Ambiental y Contrato de Medidas de Mitigación',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->licambi), Yii::app()->baseUrl . '/images/'.$model->licambi)
                   ),
            array('label'=>'Estudio de Impacto en Tierras y Reasentamiento',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->estuimpactierra), Yii::app()->baseUrl . '/images/'.$model->estuimpactierra)
                   ),
            array('label'=>'Plan de Reasentamiento y Compensación',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->planreasea), Yii::app()->baseUrl . '/images/'.$model->planreasea)
                   ),
              array('label'=>'Plan Anual de Compras y Contrataciones (PACC) de SOPTRAVI o del Fondo VIAL',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->plananual), Yii::app()->baseUrl . '/images/'.$model->plananual)
                   ),
            array('label'=>'Acuerdo de Financiamiento',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->acuerdofinan), Yii::app()->baseUrl . '/images/'.$model->acuerdofinan)
                   ),
             array('label'=>'Otro',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->otro), Yii::app()->baseUrl . '/images/'.$model->otro)
                   ),
		'fechacreacion',
            'estado',
            'idFuncionario',
            'fechaaprob',
            'idfuente',
            'codsefin',
            'notaprioridad',
            'constanciabanco',
	),
)); ?>
