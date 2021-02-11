<?php
/* @var $this InicioEjecucionController */
/* @var $data InicioEjecucion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idInicioEjecucion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idInicioEjecucion), array('view', 'id'=>$data->idInicioEjecucion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContratacion')); ?>:</b>
	<?php echo '( '.CHtml::encode($data->idContratacion).' ) '.$data->idContratacion0->ncontrato; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contratacion0.titulocontrato')); ?>:</b>
        <?php echo '( '.CHtml::encode($data->idContratacion).' ) '.$data->idContratacion0->titulocontrato; ?>
       <br />

</div>
