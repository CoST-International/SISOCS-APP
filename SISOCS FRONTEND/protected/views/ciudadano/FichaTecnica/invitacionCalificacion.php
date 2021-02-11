<div class="animated fadeIn">
    <?php if (!empty($calificacion)) {
    ?>

    <form class="form-horizontal" role="form" style="padding-top:10px">
        <div class="row">

            <div class="col-md-12 col-xs-12 col-sm-12">
                <label for="name" class="control-label col-sm-4" style="font-weight:bold">Nombre del proceso:</label>
                <div class="col-sm-8" style="text-align:justify">
                    <p>
                        <?php echo (!empty($calificacion[0]['nomprocesoproyecto'])) ? $calificacion[0]['nomprocesoproyecto'] : 'No ha divulgado esta información'; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12">
                <label for="name" class="control-label col-sm-4" style="font-weight:bold">Tipo de contrato:</label>
                <div class="col-sm-8" style="text-align:justify">
                    <p>
                        <?php $TipoContrato  = Yii::app()->db->createCommand('SELECT contrato FROM cs_tipocontrato WHERE idTipoContrato ='.$calificacion[0]['idTipoContrato'])->queryAll(); ?>
                        <?php echo (!empty($TipoContrato[0]['contrato'])) ? $TipoContrato[0]['contrato'] : 'No ha divulgado esta información'; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12">
                <label for="name" class="control-label col-sm-4" style="font-weight:bold">Método de adquisiciones:</label>
                <div class="col-sm-8" style="text-align:justify">
                    <p>
                        <?php $MetodoAdquisicion   = (is_numeric($calificacion[0]['idMetodo']))?Yii::app()->db->createCommand('SELECT adquisicion FROM `cs_metodo` WHERE idMetodo ='.$calificacion[0]['idMetodo'])->queryAll():null; ?>
                        <?php echo (!empty($MetodoAdquisicion[0]['adquisicion'])) ? $MetodoAdquisicion[0]['adquisicion'] : 'No ha divulgado esta información'; ?>
                    </p>
                </div>
            </div>
        </div>





<?php
/*
$mCalificacion  = Yii::app()->db->createCommand('SELECT * FROM cs_calificacion WHERE idCalificacion ='.$calificacion[0]['idCalificacion'])->queryAll();

$mCalificacion = '';

if (!empty($calificacion[0]['idCalificacion'])) {
	$mCalificacion = Calificacion::model()->findByPk($calificacion[0]['idCalificacion']);
	if (!empty($mCalificacion)) {
				//=========================   Contract =======================
				//echo '<div class="row form-group" style="padding: 10px" >';
				if (!empty($mCalificacion->contract_startDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'contract_startDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->contract_startDate)) . '</div></p>'; 
					echo '</div>';
				}
				if (!empty($mCalificacion->contract_endDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'contract_endDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->contract_endDate)) . '</div></p>'; 
					echo '</div>';
				}
				echo '</div>';
				echo '<div class="row form-group" style="padding: 10px" >';
				if (!empty($mCalificacion->contract_maxExtentDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'contract_maxExtentDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->contract_maxExtentDate)) . '</div></p>'; 
					echo '</div>';
				}
				if (!empty($mCalificacion->contract_durationInDays)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'contract_durationInDays'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . $mCalificacion->contract_durationInDays . '</div></p>'; 
					echo '</div>';
				}
				echo '</div>';
				//======================  Award  ==================================
				echo '<div class="row form-group" style="padding: 10px" >';
				if (!empty($mCalificacion->award_startDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'award_startDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->award_startDate)) . '</div></p>'; 
					echo '</div>';
				}
				if (!empty($mCalificacion->award_endDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'award_endDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->award_endDate)) . '</div></p>'; 
					echo '</div>';
				}
				echo '</div>';
				echo '<div class="row form-group" style="padding: 10px" >';
				if (!empty($mCalificacion->award_maxExtentDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'award_maxExtentDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->award_maxExtentDate)) . '</div></p>'; 
					echo '</div>';
				}
				if (!empty($mCalificacion->award_durationInDays)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'award_durationInDays'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . $mCalificacion->award_durationInDays . '</div></p>'; 
					echo '</div>';
				}
				echo '</div>';
				//=====================  Enquiry ===================================
				echo '<div class="row form-group" style="padding: 10px" >';
				if (!empty($mCalificacion->enquiry_startDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'enquiry_startDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->enquiry_startDate)) . '</div></p>'; 
					echo '</div>';
				}
				if (!empty($mCalificacion->enquiry_endDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'enquiry_endDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->enquiry_endDate)) . '</div></p>'; 
					echo '</div>';
				}
				echo '</div>';
				echo '<div class="row form-group" style="padding: 10px" >';
				if (!empty($mCalificacion->enquiry_maxExtentDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'enquiry_maxExtentDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->enquiry_maxExtentDate)) . '</div></p>'; 
					echo '</div>';
				}
				if (!empty($mCalificacion->enquiry_durationInDays)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'enquiry_durationInDays'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . $mCalificacion->enquiry_durationInDays . '</div></p>'; 
					echo '</div>';
				}
				echo '</div>';
				//=====================  Tender ===================================
				echo '<div class="row form-group" style="padding: 10px" >';
				if (!empty($mCalificacion->tender_startDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'tender_startDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->tender_startDate)) . '</div></p>'; 
					echo '</div>';
				}
				if (!empty($mCalificacion->tender_endDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'tender_endDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->tender_endDate)) . '</div></p>'; 
					echo '</div>';
				}
				echo '</div>';
				echo '<div class="row form-group" style="padding: 10px" >';
				if (!empty($mCalificacion->tender_maxExtentDate)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'tender_maxExtentDate'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . date("d-m-Y", strtotime($mCalificacion->tender_maxExtentDate)) . '</div></p>'; 
					echo '</div>';
				}
				if (!empty($mCalificacion->tender_durationInDays)) { 
					echo '<div class="col-md-12 col-xs-12 col-sm-12">';
						echo '<label for="name" class="control-label col-sm-4" style="font-weight:bold">' . CHtml::activeLabel($mCalificacion, 'tender_durationInDays'). ': </label>';
						echo '<div class="col-sm-8" style="text-align:justify"><p>' . $mCalificacion->tender_durationInDays . '</div></p>'; 
					echo '</div>';
				}
				//echo '</div>';
	}
}
*/
?>










    </form>


    <div class="code-boxInverse">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="background:#f5f5f5" class="collapsed">
                            <h5>Empresas interesadas (<?php echo (!empty($adjudicacion[0]['nparticipantes'])) ? $adjudicacion[0]['nparticipantes'] : ''/*$nparticipate[0]['n']*/ ?>)</h5>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                    <div class="panel-body" style="background: #fff;padding: 0px;">
                        <?php $nombresOferentes= Yii::app()->db->createCommand('SELECT cs_parties.legalName ln FROM cs_parties WHERE cs_parties.id in (SELECT idOferente FROM cs_calificacion_oferente WHERE idCalificacion='.$calificacion[0]['idCalificacion'].')')->queryAll(); ?>
                        <ul class="list-group">
                            <?php
                $conteo=1;
            foreach ($nombresOferentes as $nombresoferentes) {
                echo  '<li class="list-group-item">'.$conteo++.'. '.$nombresoferentes['ln'].'</li>';
            } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($calificacion[0]['idTipoContrato'] === 'Diseí±o' || $calificacion[0]['idTipoContrato'] === 'Supervision' || $calificacion[0]['idTipoContrato'] === 'Diseí±o y Supervision') {
        ?>
    <div class="code-boxInverse">
        <h5>Diseí±o y supervisión</h5>
        <hr>
        <table class="table table-bordered table-hover" width="100%">
            <tr>
                <th>Firmas</th>
            </tr>
            <?php
            $row      = 0;
        $total_x  = count($calificacion_firma);
        $td_style = false;
        while ($row < $total_x) {
            ?>
                <tr>
                    <?php if ($td_style == false) {
                ?>
                    <td>
                        <?php echo $calificacion_firma[$row]['nombre_firma']; ?>
                    </td>
                    <?php
                        $td_style = true;
            } else {
                ?>
                        <td>
                            <?php echo $calificacion_firma[$row]['nombre_firma']; ?>
                        </td>
                        <?php
                            $td_style = false;
            } ?>
                </tr>
                <?php
                $row++;
        } ?>
        </table>
    </div>
    <?php
    } elseif ($calificacion[0]['idTipoContrato'] === 'Mantenimiento' || $calificacion[0]['idTipoContrato'] === 'Construcción') {
        ?>
        <div class="code-boxInverse">
            <h5>Construcción</h5>
            <hr>
            <table class="table table-bordered table-hover" width="100%">
                <tr>
                    <th>Oferentes</th>
                </tr>
                <?php
                $row      = 0;
        $total_x  = count($calificacion_oferente);
        $td_style = false;
        while ($row < $total_x) {
            ?>
                    <tr>
                        <?php
                        if ($td_style == false) {
                            ?>
                            <td>
                                <?php echo $calificacion_oferente[$row]['nombre_oferente']; ?>
                            </td>
                            <?php
                            $td_style = true;
                        } else {
                            ?>
                                <td>
                                    <?php echo $calificacion_oferente[$row]['nombre_oferente']; ?>
                                </td>
                                <?php
                                $td_style = false;
                        } ?>
                    </tr>
                    <?php
                    $row++;
        } ?>
            </table>
        </div>
        <?php
    } ?>



            <div class="code-boxInverse">
                <h5> Documentos de la licitación </h5>
                <?php
                                            $generidData = TenderDocuments::model()->findAll(array(
                                                'condition' => 'idCalificacion=:id',
                                                'params' => array(
                                                    ':id' => $calificacion[0]['idCalificacion']
                                                )
                                            )); ?>

                    <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                    <table class="display hover row-border" id="CalificacionDocumentsTable" cellspacing="0" style="width:100%;">
                        <thead>
                            <tr style="background:#29a4dd;color:#fff">
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Documento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                                    $total_x=count($generidData);
    $row=0;
    while ($row< $total_x) {
        ?>
                                <tr>
                                    <td>
                                        <span>
                                            <?php echo $generidData[$row] ['title']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php echo $generidData[$row] ['description']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <a href="<?php echo $generidData[$row] ['url']; ?>" target="_blank">Descargar / Ver</a>
                                        </span>
                                    </td>
                                </tr>

                                <?php
                                                    $row++;
    } ?>
                        </tbody>
                    </table>
            </div>
            <div class="code-boxInverse">
                <h5>Detalles de contacto de la entidad de adquisición</h5>
                <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                <label for="name" class="control-label col-sm-2" style="font-weight:bold">Nombre:</label>
                <div class="col-sm-4" style="text-align:justify">
                    <p>
                        <?php echo (!empty($calificacion[0]['funcionario_nombre'])) ? $calificacion[0]['funcionario_nombre'] : 'No ha divulgado esta información'; ?>
                    </p>
                </div>

                <label for="name" class="control-label col-sm-2" style="font-weight:bold">Puesto:</label>
                <div class="col-sm-4" style="text-align:justify">
                    <p>
                        <?php echo (!empty($calificacion[0]['funcionario_puesto'])) ? $calificacion[0]['funcionario_puesto'] : 'No ha divulgado esta información'; ?>
                    </p>
                </div>
                <label for="name" class="control-label col-sm-2" style="font-weight:bold">Correo:</label>
                <div class="col-sm-4" style="text-align:justify">
                    <p>
                        <?php echo (!empty($calificacion[0]['funcionario_correo'])) ? $calificacion[0]['funcionario_correo'] : 'No ha divulgado esta información'; ?>
                    </p>
                </div>
                <label for="name" class="control-label col-sm-2" style="font-weight:bold">Teléfono:</label>
                <div class="col-sm-4" style="text-align:justify">
                    <p>
                        <?php echo (!empty($calificacion[0]['funcionario_telefono'])) ? $calificacion[0]['funcionario_telefono'] : 'No ha divulgado esta información'; ?>
                    </p>
                </div>
                <label for="name" class="control-label col-sm-2" style="font-weight:bold">Entidad de adquisición:</label>
                <div class="col-sm-4" style="text-align:justify">
                    <p>
                        <?php $entidadCalificacion=Yii::app()->db->createCommand("SELECT descripcion FROM cs_entes WHERE idEnte=(SELECT idEnte FROM cs_calificacion WHERE idCalificacion=".$calificacion[0]['idCalificacion'].") ")->queryScalar();
                echo(!empty($entidadCalificacion) ? $entidadCalificacion : 'No ha divulgado esta información y que'); ?>
                    </p>
                </div>
            </div>
            <table class="general">
                <tr>
                    <td style="text-align:center">
                        <?php /*echo CHtml::Button('Ver información de respaldo', array(
                                                'onclick' => '$("#respCalificacion").dialog("open"); return false;'
                                            ));*/
                                                ?>
                    </td>
                </tr>
            </table>
            <?php
} else {
                                                    echo "<p>No ha divulgado esta información </p>";
                                                }
                                    ?>
</div>
