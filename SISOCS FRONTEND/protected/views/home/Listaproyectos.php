<?php
/* @var $this ProyectoController */
/* @var $model Proyecto */

$this->breadcrumbs=array(
	'Ciudadano'=>array('index'),
);
?>
<?php
/* @var $this ProyectoController */
/* @var $model Proyecto */

$this->breadcrumbs=array(
	'Ciudadano'=>array('index'),
);
?>
<?php if(!empty($Proyectos)){?>
	<table border="1">
		<tr>
		<th colspan="4">Lista de Proyectos</th>
		</tr>
		<tr>
		<th>Código del Proyecto</th>
		<th>Nombre del Proyecto</th>
		<th>Presupuesto</th>
		<th>Fecha de Creación</th>
		<th>Ficha</th>
		</tr>

<?php foreach($Proyectos as $data){?>
	<tr>
		<td><?php echo CHtml::link(CHtml::encode($data->idProyecto), array('viewproyecto', 'id'=>$data->idProyecto)); ?></td>
		<td><?php echo $data->nombre_proyecto;?></td>
		<td><?php echo $data->presupuesto;?></td>	
		<td><?php echo $data->fechacreacion;?></td>	
		<td><?php echo CHtml::link(CHtml::Button('Ver información detallada'), array('fichatecnicapro', 'idpro'=>$data->idProyecto)); ?></td>	
	</tr>
<?php }?>
	</table>
	<?php }else{ 
		echo "No hay registros de poyecto que cumplan con el criterio de busqueda.";}?>