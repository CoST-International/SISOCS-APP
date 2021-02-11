<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'Espacio de Trabajo',
);  
?>
<h1><i>Mis Pendientes</i></h1><hr>

<?php
    
    
    if(Yii::app()->user->getName() == 'admin') echo Yii::app()->user->ui->userManagementAdminLink;
    // Determinando el rol mas alto que tenga el usuario
    $userRol ='';
    $criterio = '';
	
    if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Programa')) $userRol = 'Programas';
    if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Proyecto')) $userRol = 'Proyectos';
    if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Adquisicione')) $userRol = 'Adquisiciones';
	if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Avances')) $userRol = 'Avances';
    
    echo "$userRol<hr>";
    
    //------------------------------------- PROYECTOS
    if (Yii::app()->user->isInRole(Yii::app()->user->id, 'IngresoDatos')) {
        echo '<h3>Proyectos</h3>';
        if (Yii::app()->user->isInRole(Yii::app()->user->id, 'IngresoDatos')) {
            //$criterio = "estado='BORRADOR' AND usuario_creacion = " & (string)Yii::app()->user->id;
            $criterio = "estado='BORRADOR'";
        } elseif(Yii::app()->user->isInRole(Yii::app()->user->id, 'Autor')) {
            $criterio = "estado='REVISIÓN'";
        }
        
        //echo $criterio.'<hr/>';
        $records = Proyecto::model()->findAll();
        /*
        $this->widget('zii.widgets.grid.CGridView', array(
                'dataProvider' => $records,
                'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
                'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                'htmlOptions' => array('class' => 'grid-view rounded'),
                'columns' => array(
        				array('header' => 'idProyecto',
        					  'name'   => 'idProyecto'),
        				array('header' => 'Código',
        					  'name'   => 'codigo'),
        				array('header' => 'Nombre del Proyecto',
        				      'name'   => 'nombre_proyecto'),
        				array(
                                'htmlOptions'=>array(
        							'width'=>'120',
        							'style'=>'text-align:right',
        						 ),
        						'header' => 'Acciones',
                                'class' => 'CButtonColumn',
        						'template' => '{view}{update}',
        						'buttons' => array(
        										   'view' => array( 
        														'label' => '<span class="btn btn-primary" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></span>',  
        														'options'=>array('title'=>'Ver'),
        														'imageUrl' => false,
        														),
        											'update' => array( 
        														'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>',  
        														'options'=>array('title'=>'Editar'),
        														'imageUrl' => false,
        														),
        										   ),
                        ),
                ),
        ));
*/
        $this->widget('application.extensions.tablesorter.Sorter', array(
            'data'=>$records,
            'columns'=>array(
            'idProyecto',
            'codigo',
            'nombre_proyecto',
            'estado',
         )
        ));
    
    }
	
	
	    
    




    if ($userRol =='Programas')
        {
/*		echo '<h3>Programas</h3>';
		$records= Programa::model()->findAll('estado=\'BORRADOR\' OR estado=\'REVISIÓN\'');
        $this->widget('application.extensions.tablesorter.Sorter', array(
            'data'=>$records,
            'columns'=>array(
            'idPrograma',
            'programa',
            'BIP',
            'nombreprograma',
            'estado',
         )
        ));
 */          
            /* $criterio = 'estado=\'BORRADOR\' OR estado=\'REVISIÓN\'';
            $dp_Programa=new CActiveDataProvider('Programa',array(
                                'criteria'=>array(
                                    'condition'=>$criterio,
                                    'order'=>'estado ASC',									    
                                ),
                                'countCriteria'=>array(
                                    'condition'=>$criterio,
                                ),
                                'pagination'=>array(
                                    'pageSize'=>20,
                                ),)); */
            
           /*  $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'programa-grid',
                'dataProvider'=>$dp_Programa,
                'columns'=>array(
                    'idPrograma',
                    'programa',
                    'BIP',
                    'nombreprograma',
                    'estado',
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{update} {view}',
                        'buttons'=>array (
                            'update'=> array(
                                'imageUrl'=>'',
                                'url'=>'Yii::app()->createUrl("programa/update", array("id"=>$data->idPrograma))',
                                'options'=>array( 'class'=>'icon-edit' ),
                            ),
                            'view'=>array(
                                'imageUrl'=>'',
                                'url'=>'Yii::app()->createUrl("programa/view", array("id"=>$data->idPrograma))',
                                'options'=>array( 'class'=>'icon-search' ),
                            ),
                        ),
                    ),
                ),
            )); */ 
        };
    
    //------------------------------------- PROYECTOS
    if (($userRol == 'Programas') || ($userRol == 'Proyectos'))
        {
            echo '<h3>Proyectos</h3>';
            if ($userRol == 'Programas') 
               { $criterio = "estado='REVISIÓN'"; }
            else
               { $criterio = "estado='BORRADOR'"; };
			   
		$records= Proyecto::model()->findAll($criterio);
        
        $this->widget('application.extensions.tablesorter.Sorter', array(
            'data'=>$records,
            'columns'=>array(
            'idProyecto',
            //'idPrograma0.nombreprograma',
            'idPrograma',
            'codigo',
            'nombre_proyecto',
            'estado',
         )
        ));   
        

        }
    
    //------------------------------------- CALIFICACION
    if (($userRol == 'Programas') || ($userRol == 'Adquisiciones'))
        {
            echo '<h3>Calificacion</h3>';
            if ($userRol == 'Programas') 
               { $criterio = "estado='REVISIÓN'"; }
            else
               { $criterio = "estado='BORRADOR'"; };
			   
			$records= Calificacion::model()->findAll($criterio);  
			  $this->widget('application.extensions.tablesorter.Sorter', array(
            'data'=>$records,
            'columns'=>array(
           'idCalificacion',
                //'idProyecto0.nombreproyecto',
                'idProyecto',
                'numproceso',
                'nomprocesoproyecto',
                'idmetodo0.adquisicion',
                'estado',
			)
			));  
			
        
  
        }

    //------------------------------------- ADJUDICACION
    if (($userRol == 'Programas') || ($userRol == 'Adquisiciones'))
        {
            echo '<h3>Adjudicacion</h3>';
            if ($userRol == 'Programas') 
               { $criterio = "estado='REVISIÓN'"; }
            else
               { $criterio = "estado='BORRADOR'"; };
        
			$records= Adjudicacion::model()->findAll($criterio);
			  $this->widget('application.extensions.tablesorter.Sorter', array(
            'data'=>$records,
            'columns'=>array(
            'idAdjudicacion',
                'idCalificacion',
                'numproceso',
                'nomprocesoproyecto',
                'nconsulnac',
                'nconsulinter',
			)
			));  

            
        }    
    
    //------------------------------------- CONTRATACION
    if (($userRol == 'Programas') || ($userRol == 'Adquisiciones'))
        {
            echo '<h3>Contratacion</h3>';
		        
		if ($userRol == 'Programas') 
               { $criterio = "estado='REVISIÓN'"; }
            else
               { $criterio = "estado='BORRADOR'"; };
        
			 $records= Contratacion::model()->findAll($criterio);
        
       $this->widget('application.extensions.tablesorter.Sorter', array(
    'data' => $records,
    'columns' => array(
        'idContratacion',
        array('header' => 'Nombre Programa',
            'value' => 'titulocontrato'),
        'precio',
        'fechainicio',
        'fechafinal', // Relation value given in model
    ),
    
      'filters'=>array( // it was optional
            'filter-false',
            'filter-select',
            'filter-false',
            'filter-false',
            'filter-false',
        ),
));
		
         
            
        }
        
    //------------------------------------- CONTRATOS
    if (($userRol == 'Programas') || ($userRol == 'Adquisiciones'))
        {
            echo '<h3>Gestion de Contratos</h3>';
            if ($userRol == 'Programas') 
               { $criterio = "estado='REVISIÓN'"; }
            else
               { $criterio = "estado='BORRADOR'"; };
        
			$records= Contratos::model()->findAll($criterio);
        
        $this->widget('application.extensions.tablesorter.Sorter', array(
            'data'=>$records,
            'columns'=>array(
            'idContratos',
                'idContratacion',
                'estatuscontrato',
                'nmodifica',
                'fecha',
                'tipomodifica',
                'estado',
         )
        ));
		
          
                
        }
		
		//INICIO DE EJECUCION
		if (($userRol == 'Programas') || ($userRol == 'Avances'))
        {
            //echo '<h3>Implementación</h3>';
            if ($userRol == 'Programas') 
               { $criterio = "estado_sol='REVISIÓN'"; }
            else
               { $criterio = "estado_sol='BORRADOR'"; };
        
			//$records= InicioEjecucion::model()->findAll($criterio);
            
            //print_r($records);
            
            /*
            $this->widget('application.extensions.tablesorter.Sorter', array(
                'data'=>$records,
                'columns'=>array(
                'codigo',
                //'idContratacion',
                'fecha_venc_01',
                ),
            ));*/
             
        }
		
		
		
		if (($userRol == 'Programas') || ($userRol == 'Avances'))
        {
            echo '<h3>Avances</h3>';
            if ($userRol == 'Programas') 
               { $criterio = "estado_sol='REVISIÓN'"; }
            else
               { $criterio = "estado_sol='BORRADOR'"; };
        
			$records= Avances::model()->findAll($criterio);
			
			$this->widget('application.extensions.tablesorter.Sorter', array(
                'data'=>$records,
                'columns'=>array(
                'codigo',
                'codigo_inicio_ejecucion',
                'porcent_programado',
                'porcent_real',
                'finan_programado',
                'finan_real',
                ),
		));

		
            
        }
	
?>
