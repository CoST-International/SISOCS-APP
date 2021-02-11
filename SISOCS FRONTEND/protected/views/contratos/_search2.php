<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
		'class' => 'form-search',
	),
)); ?>

<?php 

        $connection=Yii::app()->db;
        $sql2='SELECT DISTINCT idContratacion, nombre_contrato
              FROM vids
              WHERE 1
              ORDER BY nombre_contrato';
        
        $command=$connection->createCommand($sql2);
        $rows2=$command->queryAll();

        echo CHtml::dropDownList('Contratos[idContratacion]', $model, CHtml::listData($rows2, 'idContratacion', 'nombre_contrato'), array('class' => 'selectbox', 'style'=>'width: 600px')); 
        
?>
<?php $this->endWidget(); ?>