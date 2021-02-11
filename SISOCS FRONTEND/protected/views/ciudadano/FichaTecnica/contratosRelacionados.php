<div class="list-group">
    <?php
    $sql = "SELECT DISTINCT `vCiudadano`.`idProyecto`,
                    `vCiudadano`.`idCalificacion`,
                    `vCiudadano`.`idAdjudicacion`,
                    `vCiudadano`.`idContratacion`,
                    `vCiudadano`.`idInicioEjecucion`,
                    `vCiudadano`.`calificacion_numero`,
                    `vCiudadano`.`calificacion_nombre`,
                    `vCiudadano`.`calificacion_metodo`,
                    `vCiudadano`.`contratacion_oferente`,
                    `vCiudadano`.`contratacion_alcances`,
                    `vCiudadano`.`contratacion_precioLPS`,
                    `vCiudadano`.`contratacion_precioUSD`,
                    `vCiudadano`.`contratacion_fecha_inicio`,
                    `vCiudadano`.`contratacion_fecha_final`,
                    `vCiudadano`.`contratacion_duracion`
                FROM `vCiudadano`
                WHERE idProyecto =".$proyecto[0]["idProyecto"];

    $adquisicion = Yii::app()->db->createCommand($sql)->queryAll();
    ?>
    <?php for ($i=0;$i<count($adquisicion);$i++) {
                        ?>
    <?php
    if ($adquisicion[$i]['calificacion_numero']  == ''){
        continue;
    }
        $control="";
                        $idFicha="";
                        if ($adquisicion[$i]['idProyecto']!=null) {
                            $control="Proyecto";
                            $idFicha=$adquisicion[$i]['idProyecto'];
                            if ($adquisicion[$i]['idCalificacion']!=null) {
                                $control="Calificacion";
                                $idFicha=$adquisicion[$i]['idCalificacion'];
                                if ($adquisicion[$i]['idAdjudicacion']!=null) {
                                    $control="Adjudicacion";
                                    $idFicha=$adquisicion[$i]['idAdjudicacion'];
                                    if ($adquisicion[$i]['idContratacion']!=null) {
                                        $control="Contratacion";
                                        $idFicha=$adquisicion[$i]['idContratacion'];
                                        $noMostrar = $_GET['id'];
                                    }
                                }
                            }
                        } ?>
        <?php
            if ($CPrincipal>0) {
                if($idFicha!=$noMostrar){
                    if ($idFicha==$CPrincipal) {
                        echo CHtml::link($adquisicion[$i]['calificacion_nombre'], array('FichaTecnica', 'control'=>$control, 'id'=>$idFicha), array('class'=>'list-group-item'));
                    }
                    else {
                        echo CHtml::link($adquisicion[$i]['calificacion_nombre'], array('FichaTecnica_Relacionada', 'control'=>$control, 'id'=>$idFicha), array('class'=>'list-group-item'));
                    }

                }
            }
            else {
                echo '';
            }
        ?>


        <?php
                    } ?>
</div>
