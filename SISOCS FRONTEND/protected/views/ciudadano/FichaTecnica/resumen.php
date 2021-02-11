<div class="hidden-xs-down hidden-sm-down" id="basic-info">
                    <div class="row animated fadeIn">
                        <div class="basic-info-box col-md-4">
                            <div class="inner">
                                <p>Sector</p>
                                <h6>
                                    <?php echo (!empty($proyecto[0]['proyecto_sector'])) ? $proyecto[0]['proyecto_sector'] : 'No ha divulgado esta información'; ?> </h6>
                            </div>
                        </div>
                        <div class="basic-info-box col-md-4">
                            <div class="inner">
                                <p>Ubicación</p>
                                <h6>
                                    <?php echo (!empty($proyecto[0]['departamento'])) ? $proyecto[0]['departamento'] : 'No ha divulgado esta información'; ?> </h6>
                            </div>
                        </div>
                        <div class="basic-info-box col-md-4">
                            <div class="inner">
                                <p>
                                    Valor estimado del proyecto
                                </p>
                                <h6>
                                    <?php echo (!empty($proyecto[0]['presupuesto'])) ? number_format($proyecto[0]['presupuesto']/1000000, 2)." M" : 'No ha divulgado esta información'; ?> (LPS)
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="row animated fadeIn">
                        <div class="basic-info-box col-md-4">
                            <div class="inner">
                                <p>Etapa</p>
                                <h6>
                                    <?php echo $control ?> </h6>
                            </div>
                        </div>
                        <div class="basic-info-box col-md-4">
                            <div class="inner">
                                <p>Entidad contratante</p>
                                <h6>
                                    <?php echo (!empty($proyecto[0]['entes_nombre'])) ? $proyecto[0]['entes_nombre'] : 'No ha divulgado esta información'; ?>
                                </h6>
                            </div>
                        </div>
                        <div class="basic-info-box col-md-4">
                            <div class="inner">
                                <p>
                                    Fecha de publicación
                                </p>
                                <h6>
                                    <?php 
                                    if (!empty($proyecto[0]['fecha_publicacion'])) {
                                        $date=date_create($proyecto[0]['fecha_publicacion']);
                                        echo date_format($date, 'd/m/Y');
                                    }
                                    else {
                                        echo 'No ha divulgado esta información';
                                    }
                                    ?>
                                </h6>
                            </div>
                        </div>

                    </div>
                </div>