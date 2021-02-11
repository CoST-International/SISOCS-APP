<div class="informes">
    <div class="row">
			<h1 class="section-title wow fadeIn animated" data-wow-delay=".2s">
				Informes Gerenciales
			</h1>
			<p class="section-subcontent"></p>
			<hr>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="coolBox">
					<h5>
						<strong style="font-size:.8em">Proyectos:</strong>
						<label style="float:right;font-size:.8em">
                            <?php echo count(Proyecto::Model()->findAll()); ?>
						</label>
					</h5>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="coolBox" style="float:right">
					<h5>
						<strong style="font-size:.8em">Contratos:</strong>
						<label style="float:right;font-size:.8em">USD.
                            <?php 
                                $sum = Yii::app()->db->createCommand()->select('sum(precioLPS)')->from('cs_contratacion')->queryScalar();
                                echo number_format(($sum/1000000), 2). "M";
                            ?>
						</label>
					</h5>
				</div>
			</div>

        </div>
        
    <div class="row">
        <div class="col-md-6 col-xs-12 col-sm-12" id="chartBox">
            <?php
                    $fa = date("d/m/Y");
                    echo $fa;
                    $eje = count(Contratacion::Model()->findAll("fechafinal >'" . $fa . "'")); ///count(Contratacion::Model()->findAll())*100;
                    $fin = Count(Contratacion::Model()->findAll("fechafinal <'" . $fa . "'")); ///count(Contratacion::Model()->findAll())*100;
                    $this->Widget('ext.highcharts.HighchartsWidget', array(
                        'options' => array(
                            'gradient' => array(
                                'enabled' => true
                            ) ,
                            'credits' => array(
                                'enabled' => false
                            ) ,
                            'exporting' => array(
                                'enabled' => false
                            ) ,
                            'chart' => array(
                                'plotBackgroundColor' => null,
                                'backgroundColor' => 'transparent',
                                'plotBorderWidth' => null,
                                'plotShadow' => false,
                               
                            ) ,
                            'legend' => array(
                                'enabled' => false,
                            ) ,
                            'title' => array(
                                'text' => 'Proyectos a Nivel Nacional'
                            ) ,
                            'plotOptions' => array(
                                'pie' => array(
                                    'allowPointSelect' => true,
                                    'cursor' => 'pointer',
                                    'dataLabels' => array(
                                        'enabled' => true,
                                        'color' => '#000000',
                                        'connectorColor' => '#000000',
                                        'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    ) ,
                                )
                            ) ,
                            'series' => array(
                                array(
                                    'type' => 'pie',
                                    'name' => '# de Proyectos',
                                    'data' => array(
                                        array(
                                            'En ejecucion',
                                            $eje
                                        ) ,
                                        array(
                                            'Finalizados',
                                            $fin
                                        ) ,
                                    ) ,
                                )
                            ) ,
                        )
                    ));
            ?>
        </div>    
        <div class="col-md-6 col-xs-12 col-sm-12" id="chartBox" style="background:#f3f3f3">
            <br>

            <?php
                    /*$bcie = count(ProyectoFuente::Model()->findAll("idFuente ='0000000001'"));
                    $bid = Count(ProyectoFuente::Model()->findAll("idFuente ='0000000002'"));
                    $bm = count(ProyectoFuente::Model()->findAll("idFuente ='0000000003'"));
                    $fn = Count(ProyectoFuente::Model()->findAll("idFuente ='0000000004'"));
                    $this->Widget('ext.highcharts.HighchartsWidget', array(
                        'options' => array(
                            'gradient' => array(
                                'enabled' => true
                            ) ,
                            'credits' => array(
                                'enabled' => false
                            ) ,
                            'exporting' => array(
                                'enabled' => false
                            ) ,
                            'chart' => array(
                                'plotBackgroundColor' => null,
                                'backgroundColor' => 'transparent',
                                'plotBorderWidth' => null,
                                'plotShadow' => false,

                            ) ,
                            'legend' => array(
                                'enabled' => false,
                            ) ,
                            'title' => array(
                                'text' => 'Proyectos Según su Fuente de Financiamiento'
                            ) ,
                            'plotOptions' => array(
                                'pie' => array(
                                    'allowPointSelect' => true,
                                    'cursor' => 'pointer',
                                    'dataLabels' => array(
                                        'enabled' => true,
                                        'color' => '#000000',
                                        'connectorColor' => '#000000',
                                        'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    ) ,
                                )
                            ) ,
                            'series' => array(
                                array(
                                    'type' => 'pie',
                                    'name' => '# de Proyectos',
                                    'data' => array(
                                        array(
                                            'BCIE',
                                            $bcie
                                        ) ,
                                        array(
                                            'BID',
                                            $bid
                                        ) ,
                                        array(
                                            'Banco Mundial',
                                            $bm
                                        ) ,
                                        array(
                                            'Fondos Nacionales',
                                            $fn
                                        )
                                    ) ,
                                )
                            ) ,
                        )
                    ));*/
            ?>

            <?php
                $sql = "SELECT DISTINCT b.id,b.legalName FROM cs_proyecto_fuente a join cs_parties b ON a.idFuente = b.id WHERE estado = 'PUBLICADO'";
                $command=Yii::app()->db->createCommand($sql);
                $projects=$command->queryAll();
                $finalArray = array();
                foreach ($projects as $project) {
                    $finalArray[] = array(
                        $project["legalName"],
                        count(ProyectoFuente::Model()->findAll("idFuente ='".$project["id"]."'"))
                    );
                }
              
                $this->Widget('ext.highcharts.HighchartsWidget', array(
                    'options' => array(
                        'gradient' => array(
                            'enabled' => true
                        ) ,
                        'credits' => array(
                            'enabled' => false
                        ) ,
                        'exporting' => array(
                            'enabled' => false
                        ) ,
                        'chart' => array(
                            'plotBackgroundColor' => null,
                            'backgroundColor' => 'transparent',
                            'plotBorderWidth' => null,
                            'plotShadow' => false,
                            
                        ) ,
                        'legend' => array(
                            'enabled' => false,
                        ) ,
                        'title' => array(
                            'text' => 'Proyectos Según su Fuente de Financiamiento'
                        ) ,
                        'plotOptions' => array(
                            'pie' => array(
                                'allowPointSelect' => true,
                                'cursor' => 'pointer',
                                'dataLabels' => array(
                                    'enabled' => true,
                                    'color' => '#000000',
                                    'connectorColor' => '#000000',
                                    'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                                ) ,
                            )
                        ) ,
                        'series' => array(
                            array(
                                'type' => 'pie',
                                'name' => '# de Proyectos',
                                'data' => $finalArray
                            )
                        ) ,
                    )
                ));
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-12 col-sm-12" id="chartBox">
            <br>          
                <?php
                    /*
                       $con = count(Proyecto::Model()->findAll("Proposito ='1'"));
                       $ape = count(Proyecto::Model()->findAll("Proposito ='2'"));
                       $pav = count(Proyecto::Model()->findAll("Proposito ='3'"));
                       $reh = count(Proyecto::Model()->findAll("Proposito ='2'"));
                       $mvp = count(Proyecto::Model()->findAll("Proposito ='4'"));
                       $mvr = count(Proyecto::Model()->findAll("Proposito ='5'"));
                       $sup = count(Proyecto::Model()->findAll("Proposito ='6'"));
                        $this->Widget('ext.highcharts.HighchartsWidget', array(
                            'options' => array(
                                'gradient' => array(
                                    'enabled' => true
                                ) ,
                                'credits' => array(
                                    'enabled' => false
                                ) ,
                                'exporting' => array(
                                    'enabled' => false
                                ) ,
                                'chart' => array(
                                    'plotBackgroundColor' => null,
                                    'backgroundColor' => 'transparent',
                                    'plotBorderWidth' => null,
                                    'plotShadow' => false,

                                ) ,
                                'legend' => array(
                                    'enabled' => false,
                                ) ,
                                'title' => array(
                                    'text' => 'Obras por Sector'
                                ) ,
                                'plotOptions' => array(
                                    'pie' => array(
                                        'allowPointSelect' => true,
                                        'cursor' => 'pointer',
                                        'dataLabels' => array(
                                            'enabled' => true,
                                            'color' => '#000000',
                                            'connectorColor' => '#000000',
                                            'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                                        ) ,
                                    )
                                ) ,
                                'series' => array(
                                    array(
                                        'type' => 'pie',
                                        'name' => '# de Obras',
                                        'data' => array(
                                            array(
                                                'Construcción',
                                                $con
                                            ) ,
                                            array(
                                                'Rehabilitación',
                                                $reh
                                            ) ,
                                            array(
                                                'Pavimentación',
                                                $pav
                                            ) ,
                                            array(
                                                'Mantenimiento Rutinario',
                                                $mvr
                                            ) ,
                                            array(
                                                'Mantenimiento Periódico',
                                                $mvp
                                            ) ,
                                            array(
                                                'Supervisión',
                                                $sup
                                            ) ,
                                        )
                                    ) ,
                                )
                            )
                        ));
                        */
                ?>
                <?php
                    $sql = "SELECT DISTINCT b.idSector, sector FROM cs_proyecto a JOIN cs_sector b ON a.idSector = b.idSector WHERE a.estado = 'PUBLICADO'";
                    $command=Yii::app()->db->createCommand($sql);
                    $projects=$command->queryAll();
                    $finalArray = array();
                    foreach ($projects as $project) {
                        $finalArray[] = array(
                            $project["sector"],
                            count(Proyecto::Model()->findAll("idSector ='".$project["idSector"]."'"))
                        );
                    }
                  
                    $this->Widget('ext.highcharts.HighchartsWidget', array(
                        'options' => array(
                            'gradient' => array(
                                'enabled' => true
                            ) ,
                            'credits' => array(
                                'enabled' => false
                            ) ,
                            'exporting' => array(
                                'enabled' => false
                            ) ,
                            'chart' => array(
                                'plotBackgroundColor' => null,
                                'backgroundColor' => 'transparent',
                                'plotBorderWidth' => null,
                                'plotShadow' => false,
                                
                            ) ,
                            'legend' => array(
                                'enabled' => false,
                            ) ,
                            'title' => array(
                                'text' => 'Obra por Sector'
                            ) ,
                            'plotOptions' => array(
                                'pie' => array(
                                    'allowPointSelect' => true,
                                    'cursor' => 'pointer',
                                    'dataLabels' => array(
                                        'enabled' => true,
                                        'color' => '#000000',
                                        'connectorColor' => '#000000',
                                        'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    ) ,
                                )
                            ) ,
                            'series' => array(
                                array(
                                    'type' => 'pie',
                                    'name' => '# de Proyectos',
                                    'data' => $finalArray
                                )
                            ) ,
                        )
                    ));
                ?>
                </div>
            </div>
</div>
