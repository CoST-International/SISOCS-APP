<div class="informe_proyectos">

	<?php
	$ind = Yii::app()->db->createCommand("CALL sp_portal_indicadores();")->queryRow();
	$sum=Yii::app()->db->createCommand()
                ->select('sum(precioLPS)')
                ->from('cs_contratacion')
				->queryScalar();
?>
		<div class="row">
			<h1 class="section-title wow fadeIn animated" data-wow-delay=".2s">
				Proyectos
			</h1>
			<hr style="border-top: 2px solid #29a4dd;width:5%;">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="coolBox">
					<h5>
						<strong style="font-size:.8em">Proyectos:</strong>
						<label style="float:right;font-size:.8em">
							<?php echo $ind['proyectos'] ?>
						</label>
					</h5>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="coolBox" style="float:right">
					<h5>
						<strong style="font-size:.8em">Contratos:</strong>
						<label style="float:right;font-size:.8em">LPS.
							<?php echo number_format(($ind['contratado']/1000000),2). "M";?>
						</label>
					</h5>
				</div>
			</div>

		</div>
		<?php
		$Proyectos=Proyecto::model()->findAll();
		if(!empty($Proyectos)){?>
		<table class="display hover row-border" id="tabla_proyectos_informe" cellspacing="0" style="width:100%;">
			<thead>
				<tr style="background:#29a4dd;color:#fff">
					<th>#</th>
					<th>Nombre</th>
					<th>Presupuesto</th>
					<th>Fecha de Creación</th>

				</tr>
			</thead>
			<tbody>
				</tr>
				<?php $td_style = false;   foreach($Proyectos as $data){?>
				<tr>
					<?php if ($td_style == false){ ?>
					<td>
						<?php echo $data->idProyecto; ?>
					</td>

					<td>
						<?php echo CHtml::link($data->nombre_proyecto, array('PreFichaTecnica', 'id'=>$data->idProyecto),array('target'=>'_blank')); ?>
					</td>
					<td>
						<?php echo number_format($data->presupuesto,2,'.',',');?>
					</td>
					<td>
						<?php echo $data->fecha_creacion; //date_format($data->fecha_creacion, 'd/m/Y');?>
					</td>
					<?php $td_style = true; }
                                    else { ?>
					<td>
						<?php echo $data->idProyecto; ?>
					</td>
					<td>
						<?php echo CHtml::link($data->nombre_proyecto, array('PreFichaTecnica', 'id'=>$data->idProyecto),array('target'=>'_blank')); ?>
					</td>
					<td>
						<?php echo number_format($data->presupuesto,2,'.',',');?>
					</td>
					<td>
						<?php echo $data->fecha_creacion; //date_format($data->fecha_creacion, 'd/m/Y');?>
					</td>
					<?php $td_style = false;
               }?>
				</tr>
				<?php }?>
			</tbody>
		</table>
		<?php
		}?>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('#tabla_proyectos_informe').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
			"pagingType": "simple",
			"scrollX": "500",
			"processing": true,
			"info": true,
			"autoWidth": true,
			"responsive": true

		});
	});

</script>