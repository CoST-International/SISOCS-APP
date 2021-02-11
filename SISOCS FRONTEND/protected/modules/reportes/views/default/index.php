<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);


Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile("assets/bootstrap/js/bootstrap.min.js");
Yii::app()->clientScript->registerCssFile("assets/bootstrap/css/bootstrap.min.css");

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'empleado-form',
	'enableAjaxValidation'=>false,
));
//echo CHtml::LabelField('Ingrese el valor a buscar');
//echo CHtml::TextField('txtfind');
echo  CHtml::dropDownList('busca','proposito',Proyecto::model()->listaDepartamentos(),array('prompt'=>'--Seleccione un valor--'));
//$this->widget('bootstrap.widgets.TbButton', array(
//  'buttonType' => 'ajaxLink',
//    'label'=>'Enviar',
//    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
//    'size'=>'small', // null, 'large', 'small' or 'mini'
//    'htmlOptions'=>array('width'=>600),
//));

echo CHtml::ajaxSubmitButton(
	'Buscar',
	array('/proyecto/PDeptos'),
	array('update' =>'#resultado',));

 $this->endWidget();
?>

<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    --Seleccione un Departaento-- <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
  <?php 
        foreach (Proyecto::model()->listaDepartamentos() as $v) {
        echo "<li><a href=\"#\">".$v."</a></li>";
        }
  ?>
  </ul>
</div>
<div id='resultado'>
<?php 
var_dump($data);
?>
</div>
<script type="text/javascript">
$().ready(function(){

  alert('hola mundo');
  $('#busca').addClass("dropdown-toggle");
  //$('#busca').addClass("open");
	
	});
</script>
