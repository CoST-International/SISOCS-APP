<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0; width:100%;column-span:1;table-layout: fixed;border:none}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;width:33.3%}
.tg .tg-qp8u{color:#ffffff;text-align:center}
.tg .tg-header{font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;font-size:36px;border:0px}
.tg .tg-encabezados{font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;font-size:23px;}
.tg .tg-spacer{width:20%}

#map_canvas {
        width: 100%;
        height: 500px;
      }
	  
.slideshow { margin: auto;width:auto; height:auto; }
.slideshow img { width: 100%; height: 100%; padding: 2px; }

.tab_cont {border-color:#000;margin:0px;padding:0px;border-style:dashed;border:none;text-align:center;height:10%;font-family:Calibri, sans-serif;width:100% !important}
.tab_cont tr th{background:#000;border-width:1px;border-top:thin;border-left:thin;border-right:thin;font-size:15px;font-weight:bold;margin:0px;padding:0px;white-space:nowrap;padding:2px !important;}
.tab_cont th{color:#FFF;font-size:15px;}
.tab_cont tr td{border-width:0px;background:#FFCC33;font-size:12px;vertical-align:central;margin:0px;padding:0px !important;}
#styled_td {border-width:0px;background:#FFF;margin:2px;padding:0px !important;}


</style>

   <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/css/themes/jquery-1.11.1.min.js' ?>"></script>

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
		<th colspan="4">Lista de Proyectoz</th>
		</tr>
		<tr>
		<th>Código</th>
		<th>Nombre del Proyecto</th>	
		<th>Ficha</th>
		</tr>

<?php foreach($Proyectos as $data){?>
	<tr>
		<td><?php echo $data->idProyecto; ?></td>
		<td><?php echo $data->nombre_proyecto;?></td>		
		<td><?php echo CHtml::link(CHtml::Button('Detalle'), array('fichatecnicapro', 'idpro'=>$data->idProyecto)); ?></td>	
	</tr>
<?php }?>
	</table>
	<?php }else{ 
		echo "No hay registros de poyecto que cumplan con el criterio de busqueda.";}?>