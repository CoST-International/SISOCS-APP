<div class="informes">
    
        
           
                <div align="center">
                    Proyectos Registrados:
                    <br />
                    <input type="text" name="nobras" value="<?php echo count(Proyecto::Model()->findAll());?>" readonly="true">
                </div>
            
           
                <div align="center">
                    <?php $sum=Yii::app()->db->createCommand()
                ->select('sum(precio)')
                ->from('cs_contratacion')
                ->queryScalar();?> Montos Contratados:
                    <br />
                    <input type="text" name="moncon" size="40" value="LPS. <?php echo number_format($sum,2,'.',',');?>"
                        readonly="true">
                </div>
            
        
        
            
                <div align="center">
                    <img src="images/Puente_Rande.JPG" width="800" height="100">
                </div>
            
           
                <div align="center">
                    <?php 
                        //$contratacion->fechafinal=strtotime($contratacion->fechafinal);
                        //$fa=date("d/m/Y",strtotime($fa));
                        $fa=date("d/m/Y");
                        echo $fa;
                        $eje=count(Contratacion::Model()->findAll("fechafinal >'".$fa."'"));///count(Contratacion::Model()->findAll())*100;
                        $fin=Count(Contratacion::Model()->findAll("fechafinal <'".$fa."'"));///count(Contratacion::Model()->findAll())*100;
                        $this->Widget('ext.highcharts.HighchartsWidget', array(
                            'options' => array(
                                    'gradient' => array('enabled'=> true),
                                'credits' => array('enabled' => false),
                                'exporting' => array('enabled' => false),
                                'chart' => array(
                                'plotBackgroundColor' => null,
                                'backgroundColor' => 'transparent',
                                'plotBorderWidth' => null,
                                'plotShadow' => false,
                                'height' => 500,
                                'width' => 750,
                                ),
                                'legend' => array(
                                'enabled' => false,
                                ),
                                'title' => array(
                                'text' => 'Proyectos a Nivel Nacional'
                                ),
                                'plotOptions' => array(
                                'pie' => array(
                                    'allowPointSelect' => true,
                                    'cursor' => 'pointer',
                                    'dataLabels' => array(
                                    'enabled' => true,
                                    'color' => '#000000',
                                    'connectorColor' => '#000000',
                                    'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %',
                                    ),
                                )
                                ),
                                'series' => array(
                                array(
                                    'type' => 'pie',
                                    'name' => '# de Proyectos',
                                    'data' => array(array('En ejecucion', $eje), array('Finalizados', $fin),),
                                )
                                ),
                                )));
                        ?>
                </div>
            

           
                <div align="center">
                    <?php 
                        $bcie=count(ProyectoFuente::Model()->findAll("idFuente ='0000000001'"));
                        $bid=Count(ProyectoFuente::Model()->findAll("idFuente ='0000000002'"));
                        $bm=count(ProyectoFuente::Model()->findAll("idFuente ='0000000003'"));
                        $fn=Count(ProyectoFuente::Model()->findAll("idFuente ='0000000004'"));
                        $this->Widget('ext.highcharts.HighchartsWidget', array(
                            'options' => array(
                                    'gradient' => array('enabled'=> true),
                                'credits' => array('enabled' => false),
                                'exporting' => array('enabled' => false),
                                'chart' => array(
                                'plotBackgroundColor' => null,
                                'backgroundColor' => 'transparent',
                                'plotBorderWidth' => null,
                                'plotShadow' => false,
                                'height' => 500,
                                'width' => 750,
                                ),
                                'legend' => array(
                                'enabled' => false,
                                ),
                                'title' => array(
                                'text' => 'Proyectos Según su Fuente de Financiamiento'
                                ),
                                'plotOptions' => array(
                                'pie' => array(
                                    'allowPointSelect' => true,
                                    'cursor' => 'pointer',
                                    'dataLabels' => array(
                                    'enabled' => true,
                                    'color' => '#000000',
                                    'connectorColor' => '#000000',
                                    'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %',
                                    ),
                                )
                                ),
                                'series' => array(
                                array(
                                    'type' => 'pie',
                                    'name' => '# de Proyectos',
                                    'data' => array(array('Banco Centroamericano de Integración Económica', $bcie), 
                                        array('Banco Interamericano de Desarrollo ', $bid),
                                        array('Banco Mundial', $bm), 
                                        array('Fondos Nacionales', $fn)),
                                )
                                ),
                                )));
                        ?>
                </div>
            
        
        
           
                <div align="center">
                    <?php
                        $arm=count(Proyecto::Model()->findAll("idRegion ='0000000001'"));
                        $brp=count(Proyecto::Model()->findAll("idRegion ='0000000002'"));
                        $cen=count(Proyecto::Model()->findAll("idRegion ='0000000003'"));
                        $cnd=count(Proyecto::Model()->findAll("idRegion ='0000000004'"));
                        $ep=count(Proyecto::Model()->findAll("idRegion ='0000000005'"));
                        $gdf=count(Proyecto::Model()->findAll("idRegion ='0000000006'"));
                        $lm=count(Proyecto::Model()->findAll("idRegion ='0000000007'"));
                        $ndo=count(Proyecto::Model()->findAll("idRegion ='0000000008'"));
                        $occ=count(Proyecto::Model()->findAll("idRegion ='0000000009'"));
                        $rl=count(Proyecto::Model()->findAll("idRegion ='0000000010'"));
                        $sb=count(Proyecto::Model()->findAll("idRegion ='0000000011'"));
                        $vdc=count(Proyecto::Model()->findAll("idRegion ='0000000012'"));
                        $vdl=count(Proyecto::Model()->findAll("idRegion ='0000000013'"));

                        $this->Widget('ext.highcharts.HighchartsWidget', array(
                            'options' => array(
                                    'gradient' => array('enabled'=> true),
                                'credits' => array('enabled' => false),
                                'exporting' => array('enabled' => false),
                                'chart' => array(
                                'plotBackgroundColor' => null,
                                'backgroundColor' => 'transparent',
                                'plotBorderWidth' => null,
                                'plotShadow' => false,
                                'height' => 500,
                                'width' => 750,
                                ),
                                'legend' => array(
                                'enabled' => false,
                                ),
                                'title' => array(
                                'text' => 'Obras por Región'
                                ),
                                'plotOptions' => array(
                                'pie' => array(
                                    'allowPointSelect' => true,
                                    'cursor' => 'pointer',
                                    'dataLabels' => array(
                                    'enabled' => true,
                                    'color' => '#000000',
                                    'connectorColor' => '#000000',
                                    'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %',
                                    ),
                                )
                                ),
                                'series' => array(
                                array(
                                    'type' => 'pie',
                                    'name' => '# de Obras',
                                    'data' => array(array('Arrecife Mesoamericano', $arm), 
                                            array('Biósfera Río Plátano', $brp), 
                                            array('Centro', $cen), 
                                            array('Cordillera Nombre de Dios', $cnd),
                                            array('El Paraíso', $ep), 
                                            array('Golfo de Fonseca', $gdf), 
                                            array('La Mosquitia', $lm), 
                                            array('Norte de Olancho', $ndo),
                                            array('Occidente', $occ), 
                                            array('Río Lempa', $rl), 
                                            array('Santa Bárbara', $sb), 
                                            array('Valle de Comayagua', $vdc),
                                            array('Valle de Lean', $vdl),
                                )
                                ),
                                ))));
                        ?>
                </div>
            
           
                <div align="center">
                    <?php
                        $con=count(Proyecto::Model()->findAll("idProposito ='0000000001'"));
                        $ape=count(Proyecto::Model()->findAll("idProposito ='0000000002'"));
                        $pav=count(Proyecto::Model()->findAll("idProposito ='0000000003'"));
                        $reh=count(Proyecto::Model()->findAll("idProposito ='0000000002'"));
                        $mvp=count(Proyecto::Model()->findAll("idProposito ='0000000004'"));
                        $mvr=count(Proyecto::Model()->findAll("idProposito ='0000000005'"));
                        $sup=count(Proyecto::Model()->findAll("idProposito ='0000000006'"));

                        $this->Widget('ext.highcharts.HighchartsWidget', array(
                            'options' => array(
                                    'gradient' => array('enabled'=> true),
                                'credits' => array('enabled' => false),
                                'exporting' => array('enabled' => false),
                                'chart' => array(
                                'plotBackgroundColor' => null,
                                'backgroundColor' => 'transparent',
                                'plotBorderWidth' => null,
                                'plotShadow' => false,
                                'height' => 500,
                                'width' => 750,
                                ),
                                'legend' => array(
                                'enabled' => false,
                                ),
                                'title' => array(
                                'text' => 'Obras por Propósito'
                                ),
                                'plotOptions' => array(
                                'pie' => array(
                                    'allowPointSelect' => true,
                                    'cursor' => 'pointer',
                                    'dataLabels' => array(
                                    'enabled' => true,
                                    'color' => '#000000',
                                    'connectorColor' => '#000000',
                                    'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %',
                                    ),
                                )
                                ),
                                'series' => array(
                                array(
                                    'type' => 'pie',
                                    'name' => '# de Obras',
                                    'data' => array(array('Construcción', $con), 
                                            array('Rehabilitación', $reh), 
                                            array('Pavimentación', $pav), 
                                            array('Mantenimiento Rutinario', $mvr),
                                            array('Mantenimiento Períodico', $mvp),
                                            array('Supervision', $sup),
                                )
                                ),
                                ))));
                        ?>
                </div>
</div>