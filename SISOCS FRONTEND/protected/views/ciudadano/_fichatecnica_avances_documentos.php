
<?php
   if(!empty($data)){

      $resultX=  Yii::app()->db->createCommand()
                                           ->select('*')
                                           ->from('v_doc_avancesporid')
                                           ->where('cod_avance=:id',array(':id'=>$data))										   
                                           ->queryAll();
   
   

 $this->widget('zii.widgets.CDetailView', array(
            'data'=>$resultX,
            'attributes'=>array(
                array ('label'=>'Documento de garantía que puede ser i) Fianza o Garantía bancaria, emitida por una institución financiera autorizada; ii) Bonos del Estado y; iii) Cheques Certificados',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[0]['adj_garantias'])), $resultX[0]['adj_garantias'])
                       ),
                array ('label'=>'Informes de avance de implementación que presentan los contratistas',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[0]['adj_avances'])), $resultX[0]['adj_avances'])
                       ),
                array ('label'=>'Informes de supervisión de la construcción',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[0]['adj_supervicion'])), $resultX[0]['adj_supervicion'])
                       ),
                array ('label'=>'Informes de evaluación de proyecto (continuos y al finalizar)',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[0]['adj_evaluacion'])), $resultX[0]['adj_evaluacion'])
                       ),
                array ('label'=>'Informes de auditoría técnica',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[0]['adj_tecnica'])), $resultX[0]['adj_tecnica'])
                       ),
                array ('label'=>'Informes de auditoría financiera',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[0]['adj_financiero'])), $resultX[0]['adj_financiero'])
                       ),
                array ('label'=>'Acta de recepción definitiva',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[0]['adj_recepcion'])), $resultX[0]['adj_recepcion'])
                       ),
                array ('label'=>'Informe de disconformidad, cuando corresponda',
                       'type'=>'raw',
                       'value'=>CHtml::link(CHtml::encode($this->getNameFromURL($resultX[0]['adj_disconformidad'])), $resultX[0]['adj_disconformidad'])
                       ),
                
            ),
        ));

}

echo $data;

 ?>
                <!--</br>-->
	<!--?php  else  echo "Este avance no tiene imagenes disponibles.";  ? -->