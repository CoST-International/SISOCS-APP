<div class="animated fadeIn">
    <?php
                                    if (!empty($avances)) {
                                        $avances2=$avances;
                                        $total_x = count(Yii::app()->db->createCommand()
                                                                          ->select('*')
                                                                          ->from('v_avance_ft')
                                                                          ->where('idContratacion=:id', array(':id' => $contratacion[0]['idContratacion']))
                                                                          ->queryAll());
                                        $row     = 0;
                                        $total_x = count($avances);
                                    }

                                    if (!empty($avances)) {
                                        ?>
                                        <div class="code-boxInverse">
        <table class="table table-bordered table-hover" width="100%">
            <thead>
                <tr style="background:#29a4dd;color:#fff">
                    <th>% Fí­sico progra.</th>
                    <th>% Fí­sico real</th>
                    <th>Finan. progra.</th>
                    <th>Finan. real</th>
                    <th>Fecha de avance</th>
                    <th>Descripción de problemas</th>
                    <th>Descripción de temas</th>
                    <th style="width:50px">Imágenes</th>
                </tr>
            </thead>
            <?php
                                        $td_style = false;
                                        while ($row < $total_x) {
                                            if ($avances[$row]['estado'] == 'PUBLICADO') {
                                                ?>
                <tr>
                    <td>
                        <?php echo (!empty($avances[$row]['porcentaje_programado'])) ? number_format($avances[$row]['porcentaje_programado'], 2) : 'No ha divulgado esta información'; ?>
                    </td>
                    <td>
                        <?php echo (!empty($avances[$row]['porcentaje_real'])) ? number_format($avances[$row]['porcentaje_real'], 2) : 'No ha divulgado esta información'; ?>
                    </td>
                    <td>
                        <?php echo (!empty($avances[$row]['financiero_programado'])) ? number_format($avances[$row]['financiero_programado'], 2) : 'No ha divulgado esta información'; ?>
                    </td>
                    <td>
                        <?php echo (!empty($avances[$row]['financiero_real'])) ? number_format($avances[$row]['financiero_real'], 2) : 'No ha divulgado esta información'; ?>
                    </td>
                    <td>
                        <p align="left">
                            <?php echo date('d/m/Y', strtotime($avances[$row]['fecha_avance'])); ?>
                        </p>
                    </td>
                    <td>
                        <?php echo $avances[$row]['problemas']; ?>
                    </td>
                    <td>
                        <?php echo $avances[$row]['temas_relevantes']; ?>
                    </td>
                    <td>
                        <!--    **************************************************************************     LAS IMAGENES **********************************************************     -->
                        <?php
                                                $cod = $avances[$row]['idAvances'];
                                                $avance_imagenes2 = Yii::app()->db->createCommand()
                                                                                      ->select('*')
                                                                                      ->from('v_imagenes_poravance')
                                                                                      ->where('idAvances=:id', array(':id' => $cod))
                                                                                      ->queryAll();
                                                $cantidad_img2    = count($avance_imagenes2);
                                                if ($cantidad_img2 > 0) {
                                                    echo CHtml::Button('Ver imagenes', array('id'=>'enviar','onclick'=>'verImagenes('.$cod.');','class'=>'btn btn-primary'));
                                                } else {
                                                    echo "No hay imagenes disponibles";
                                                } ?>
                    </td>
                </tr>
                <?php
                                            } //fin de validar avances publicados
                                            $td_style = !$td_style;
                                            $row++;
                                        } ?>
        </table>
                                    </div>
        <div class="code-boxInverse">
            <h4> Documentos de avances</h4>
            <?php
                                        $generidData = AdvanceDocuments::model()->findAll(array(
                                            'condition' => 'idAvance=:id',
                                            'params' => array(
                                                ':id' => $avances2[0]['idAvances']
                                            )
                                        )); ?>

                <hr>
                <table class="display hover row-border" id="AdvanceDocumentsTable" cellspacing="0" style="width:100%;">
                    <thead>
                        <tr style="background:#29a4dd;color:#fff">
                            
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Documentos</th>
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
        <?php
                                    } 
                                    ?>
</div>