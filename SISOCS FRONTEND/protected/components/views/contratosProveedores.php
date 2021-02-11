<?php $contador = 0; $otroContador = 0; ?>
<div class="container">
<div class="row">
	<!-- <div class="container"> -->
		<div class="col-md-12 bg-blue">
			<div class="col-md-4 text-center cell"><strong>Contratos obtenidos por proveedor</strong></div>
			<div class="col-md-4 text-center cell"><strong>Método de adquisición</strong></div>
			<div class="col-md-4 text-center cell"><strong>Cantidad de procesos</strong></div>
		</div>
		<div class="col-md-12 border-round">
			<div class="row-fluid accordion-group">
				<?php foreach ($headers as $header): ?>
					<?php $contador++ ?>
					<?php $style = $contador % 2 == 0 ? "bg-gray" : "bg-white" ?>
					<div>
						<div class="accordion-heading col-md-4 text-center <?php echo $style ?> height-40"><?php echo $header['contratos'] ?></div>
						<div class="accordion-heading col-md-4 text-center <?php echo $style ?> height-40"><?php echo $header['proveedores'] ?></div>
						<div class="accordion-heading col-md-3 text-center <?php echo $style ?> height-40"><?php echo number_format($header['suma'], 2, '.', ',') ?></div>
						<!-- <div class="col-md-1">
							<button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
						</div> -->
						<div class="col-md-1 accordion-heading <?php echo $style ?> height-40">
							<a href="#<?php echo $contador ?>" data-parent="#accordion" data-toggle="collapse" class="moreInfo"><i class="fa fa-plus-square" onclick="javascript:void(0)"></i>
							</a>
						</div>
					</div>
					<?php $nContratos = 1 ?>
					<?php 
						$contratos = Yii::app()->db->createCommand(
							'SELECT DISTINCT cs_oferente.idOferente id, 
								cs_oferente.nombre_oferente nombre 
							 FROM cs_contratacion contratacion
                  			 JOIN cs_oferente ON cs_oferente.idOferente = contratacion.idOferente
                  			 WHERE contratacion.idOferente IN 
                  			 	(SELECT idOferente 
                  			 	 FROM cs_contratacion 
                  			 	 GROUP BY idOferente 
                  			 	 HAVING count(idOferente) = :nContrato)'
                  		)->prepare(array(
							":nContrato" => $nContratos++
						))->queryAll();
					?>
					<div id="<?php echo $contador ?>" class="row-fluid collapse" data-toggle="false">
						<div class="col-md-6"><strong>Código proveedor</strong></div>	
						<div class="col-md-6"><strong>Nombre proveedor</strong></div>	
						<!-- <div class="col-md-4"><strong>Proceso</strong></div>	 -->
						<!-- <div class="col-md-6"><strong>Descripción</strong></div> -->
						<div class="col-md-12 h-divider"></div>
						<?php foreach($contratos as $contrato): ?>
							<?php $otroContador++ ?>
							<?php $style = $otroContador % 2 == 0 ? "bg-gray" : "bg-white" ?>
							<div class="col-lg-12 <?php echo $style ?>">
								<div class="col-md-6"><?php echo $contrato['id'] ?></div>	
								<div class="col-md-6"><?php echo $contrato['nombre'] ?></div>
								<?php 
								$otrosContratos=Yii::app()->db->createCommand(
									'SELECT cali.nomprocesoproyecto nombre, cali.idProyecto idProyecto FROM cs_contratacion contratacion
                    				 JOIN cs_adjudicacion adju
                    				 ON
                    				 adju.idAdjudicacion= contratacion.idAdjudicacion
                    				 JOIN cs_calificacion cali
                    				 ON
                    				 cali.idCalificacion= adju.idCalificacion
                    				 WHERE contratacion.idOferente='.$contrato['id'])
								->queryAll();
							?>
							<?php foreach($otrosContratos as $otros): ?>
								<div class="col-md-12">
									<b>Código del proceso: </b>
									<i><a href="index.php?r=ciudadano/PreFichaTecnica&id='<?php echo $otros['idProyecto']."'" ?>" target="_blank"><?php echo $otros['idProyecto'] ?></a></i><br/>
									<b>Nombre del proceso: </b>
									<i><?php echo $otros['nombre'] ?></i>
								</div>
							<?php endforeach; ?>
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