<div class="">
	<ul class="list-group">
		<?php 
		if(count($relatedProcess)==0) {
			echo "";
			return;
		};
		for ($i=0;$i<count($relatedProcess);$i++) {
							?>
		<?php
		if ($relatedProcess[$i]['calificacion_numero']  == ''){
			continue;
		}
			$control="";
							$idFicha="";
							if ($relatedProcess[$i]['idProyecto']!=null) {
								$control="Proyecto";
								$idFicha=$relatedProcess[$i]['idProyecto'];
								if ($relatedProcess[$i]['idCalificacion']!=null) {
									$control="Calificacion";
									$idFicha=$relatedProcess[$i]['idCalificacion'];
									if ($relatedProcess[$i]['idAdjudicacion']!=null) {
										$control="Adjudicacion";
										$idFicha=$relatedProcess[$i]['idAdjudicacion'];
										if ($relatedProcess[$i]['idContratacion']!=null) {
											$control="Contratacion";
											$idFicha=$relatedProcess[$i]['idContratacion'];
										}
									}
								}
							} ?>
							<li class="list-group-item">
							 <?php 
							 //$relatedProcess[$i]['proyecto_nombre'].' '.$relatedProcess[$i]['calificacion_numero']
								$url = CController::createUrl('FichaTecnica', array('control'=>$control, 'id'=>$idFicha));
								echo '<a href='.$url.'>'.$relatedProcess[$i]['proyecto_nombre'].' - <b> Contrato : '.$relatedProcess[$i]['calificacion_numero'].'</b></a>'
							 ?>
							</li>
			<?php
						} ?>
	</ul>
</div>