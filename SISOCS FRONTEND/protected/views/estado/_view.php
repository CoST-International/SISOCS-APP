<?php
/* @var $this EstadoController */
/* @var $data Estado */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->estado), array('view', 'id'=>$data->estado)); ?>
	<br />


</div>