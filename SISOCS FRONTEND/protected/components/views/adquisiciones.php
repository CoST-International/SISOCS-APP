<?php $contador = 0; $otroContador = 0; ?>
<div class="container">
<div class="row">
	<!-- <div class="container"> -->
		<div class="col-md-12 bg-blue">
			<div class="col-md-4 text-center cell"><strong>Tipo de servicio contratado</strong></div>
			<div class="col-md-4 text-center cell"><strong>Método de adquisición</strong></div>
			<div class="col-md-4 text-center cell"><strong>Cantidad de contratos</strong></div>
		</div>
		<div class="col-md-12 border-round">
			<div class="row-fluid accordion-group">
				<?php foreach ($headers as $header): ?>
					<?php $contador++ ?>
					<?php $style = $contador % 2 == 0 ? "bg-gray" : "bg-white" ?>
					<div>
						<div class="accordion-heading col-md-4 text-center <?php echo $style ?> height-40"><?php echo $header['contrato'] ?></div>
						<div class="accordion-heading col-md-4 text-center <?php echo $style ?> height-40"><?php echo $header['adquisicion'] ?></div>
						<div class="accordion-heading col-md-3 text-center <?php echo $style ?> height-40"><?php echo $header['contrato_cuantos'] ?></div>
						<!-- <div class="col-md-1">
							<button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
						</div> -->
						<div class="col-md-1 accordion-heading <?php echo $style ?> height-40">
							<a href="#<?php echo $contador ?>" data-parent="#accordion" data-toggle="collapse" class="moreInfo"><i class="fa fa-plus-square" onclick="javascript:void(0)"></i>
							</a>
						</div>
					</div>
					<?php
                        $contratos = Yii::app()->db->createCommand(
    '
										SELECT
						                cs_calificacion.idProyecto,
						              	cs_calificacion.idCalificacion,
						                cs_calificacion.numproceso,
						                cs_calificacion.nomprocesoproyecto
						              	/*cs_tipocontrato.contrato,
						              	cs_metodo.adquisicion,
						              	cs_calificacion.idMetodo,
						              	cs_calificacion.idTipoContrato*/
						                FROM cs_calificacion INNER JOIN cs_metodo ON
						                	cs_calificacion.idMetodo = cs_metodo.idMetodo INNER JOIN cs_tipocontrato ON
						                	cs_calificacion.idTipoContrato = cs_tipocontrato.idTipoContrato
						                WHERE cs_calificacion.estado = "PUBLICADO" AND
						                	  cs_calificacion.idMetodo = :idMetodo AND
						                	  cs_calificacion.idTipoContrato = :idTipoContrato'
                                     )->prepare(array(
										":idMetodo"=>$header['idMetodo'],
										":idTipoContrato"=>$header['idTipoContrato']
									))->queryAll();
                    ?>
					<div id="<?php echo $contador ?>" class="row-fluid collapse" data-toggle="false">
						<div class="col-md-1"><strong>Proyecto</strong></div>
						<div class="col-md-1"><strong>Calificación</strong></div>
						<div class="col-md-4"><strong>Proceso</strong></div>
						<div class="col-md-6"><strong>Descripción</strong></div>
						<div class="col-md-12 h-divider"></div>
						<?php foreach ($contratos as $contrato): ?>
							<?php $otroContador++ ?>
							<?php $style = $otroContador % 2 == 0 ? "bg-gray" : "bg-white" ?>
							<div class="col-lg-12">
								<div class="col-md-1 <?php #echo $style?>"><?php echo $contrato['idProyecto'] ?></div>
								<div class="col-md-1 <?php #echo $style?>"><?php echo $contrato['idCalificacion'] ?></div>
								<div class="col-md-4 <?php #echo $style?>"><?php echo $contrato['numproceso'] ?></div>
								<div class="col-md-6 <?php #echo $style?>"><?php echo $contrato['nomprocesoproyecto'] ?></div>
							</div>
						<?php endforeach; ?>
						<div class="col-md-12 h-divider"></div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<!-- </div> -->
</div>
</div>
<!-- Here's come the magic -->
<script>
	$('.moreInfo').click(function(){
		$(this).find('i').toggleClass('fa-plus-square fa-minus-square')
	});

</script>
