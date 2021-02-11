<?php
                                    $lat_inicio = 1;
                                    $lon_inicio = 1;

                                    // coordenadas por defecto

                                    $lat_inicio = 14.060521;
                                    $lon_inicio = -87.164521;
                                    $lat_fin    = 14.011226;
                                    $lon_fin    = -87.010884;

                                    if ($IdInicioEjecucion != null) {
                                        $UbicacionPuntos = Yii::app()->db->createCommand('SELECT * FROM cs_proyecto WHERE     idProyecto='. $IdProyecto)->queryRow();

                                        $lat_inicio=$UbicacionPuntos['lat1'];
                                        $lon_inicio=$UbicacionPuntos['lon1'];
                                        $lat_fin=$UbicacionPuntos['lat2'];
                                        $lon_fin=$UbicacionPuntos['lon2'];
                                    }

                                    ?>
    <iframe width="100%" height="550" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
    <?php 
    if ((($lat_inicio>0 || $lat_inicio <0) && ($lon_inicio>0||$lon_inicio<0))
        && (($lat_fin>0||$lat_fin<0) && ($lon_fin>0||$lon_fin<0))) 
        { echo 'src="https://maps.google.com/maps?f=d&source=sd&saddr=' . $lat_inicio . ',' . $lon_inicio . '&daddr=' . $lat_fin
                        . ',' . $lon_fin . '&hl=es&sll=14.853494,-87.022642&ie=UTF8&output=embed">'; } elseif ((($lat_inicio>0 || $lat_inicio
                        <0) && ($lon_inicio>0||$lon_inicio
                            <0)) && $lat_fin==0 && $lon_fin==0) { echo 'src="https://maps.google.com/maps?f=d&source=sd&saddr=' . $lat_inicio . ',' .
                                $lon_inicio . '&daddr=' . $lat_inicio . ',' . $lon_inicio .
                                '&hl=es&sll=14.853494,-87.022642&ie=UTF8&output=embed">'; } ?>
    </iframe>
