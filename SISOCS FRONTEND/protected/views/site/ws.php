<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'Espacio de Trabajo',
);  
?>


	<div class="row-fluid">
		<div class="two_layout">
			<div class="row" style="margin:0 auto">

				<div class="col-sm-3 col-lg-3 col-md-3 col-xs-3 sidebar-offcanvas" id="sidebar" style="padding-left:0px;padding-right:0px;padding-top:0px;">
					<h3 style="font-size:1.8em;width:100%;color:#fff;text-align:center;min-height:50px;padding:20px;background:#29a4dd">
						<span class="collapse in hidden-xs-down">Navegación</span>
						<i class="fa fa-bars" aria-hidden="true" id="navTogleIcon"></i>
					</h3>


					<div style="padding:20px">
						<ul class="nav nav-stacked" id="menu">
							<?php 
                    if (Yii::app()->user->getName() == 'admin') {
					//	echo Yii::app()->user->ui->userManagementAdminLink;
						echo "<li class='nav-item' id='borderDown'><a href=".Yii::app()->baseUrl."/index.php?r=cruge/ui/usermanagementadmin><i class='fa fa-list' id='iconSideBar'></i> <span class='collapse in hidden-xs-down'>Panel de Control</span></a></li>";
                    }
					

			?>
						</ul>
					</div>
				</div>
				<!-- sidebar span3 -->

				<div class="col-sm-9 col-lg-9 col-md-9 col-xs-9" id="main" style="padding-top:10px;margin-left: 20px;">

					<div class="content_header">
						<h1 style="font-size:2em;color:#141414">Mis Pendientes</h1>
						<hr class="lineOne">
					</div>
					<table width="100%">
						<thead>
							<tr>
								<td>
									<h1>
										<i></i>
									</h1>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<?php
							
											if (isset($proyecto)) {
												echo '<b>Planificacion de proyectos</b>';
												$this->widget('zii.widgets.grid.CGridView', array(
														'id'=>'grid',
														'dataProvider' => $proyecto,
														'filter' => null,
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
																array('header' => 'Estado',
																	  'name'   => 'estado'),
																array('header' => 'Fecha',
																	  'name' => 'fecha_creacion',
																	  'value' => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_creacion))'),
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
																										'url'=>'Yii::app()->createUrl("proyecto/view", array("id"=>$data->idProyecto))',
																										),
																							'update' => array( 
																										'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
																										'options'=>array('title'=>'Editar'),
																										'imageUrl' => false,
																										'url'=>'Yii::app()->createUrl("proyecto/update", array("id"=>$data->idProyecto))',
																										),
																						   ),
																),
														),
												)); 
											}
												
											echo '<br>';
										
											if (isset($calificacion)) {
												echo '<b>Etapa de calificación</b>';
												$this->widget('zii.widgets.grid.CGridView', array(
														'id'=>'calificacion-grid',
														'dataProvider' => $calificacion,
														'filter' => null,
														'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
														'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
														'summaryText' => 'Mostrando {start} - {end} de {count} registros',
														'htmlOptions' => array('class' => 'grid-view rounded'),
														'columns' => array(
																array('header' => 'idCalificacion',
																	  'name'   => 'idCalificacion'),
																array('header' => 'No. Proceso',
																	  'name'   => 'numproceso'),
																array('header' => 'Nombre del Proceso',
																	  'name'   => 'nomprocesoproyecto'),
																array('header' => 'Estado',
																	  'name'   => 'estado'),
																array('header' => 'Fecha',
																	  'name' => 'fecha_creacion',
																	  'value' => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_creacion))'),
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
																										'url'=>'Yii::app()->createUrl("calificacion/view", array("id"=>$data->idCalificacion))',
																										),
																							'update' => array( 
																										'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
																										'options'=>array('title'=>'Editar'),
																										'imageUrl' => false,
																										'url'=>'Yii::app()->createUrl("calificacion/update", array("id"=>$data->idCalificacion))',
																										),
																						   ),
																),
														),
												));
											}
										
											echo '<br>';
											
											if (isset($adjudicacion)) {
												echo '<b>Etapa de Adjudicación</b>';
												$this->widget('zii.widgets.grid.CGridView', array(
														'id'=>'adjudicacion-grid',
														'dataProvider' => $adjudicacion,
														'filter' => null,
														'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
														'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
														'summaryText' => 'Mostrando {start} - {end} de {count} registros',
														'htmlOptions' => array('class' => 'grid-view rounded'),
														'columns' => array(
																array('header' => 'idAdjudicacion',
																	  'name'   => 'idAdjudicacion'),
																array('header' => 'No. Proceso',
																	  'name'   => 'numproceso'),
																array('header' => 'Nombre del Proceso',
																	  'name'   => 'nomprocesoproyecto'),
																array('header' => 'Nacionales',
																	  'name'   => 'nconsulnac'),
																array('header' => 'Intenacionales',
																	  'name'   => 'nconsulinter'),
																array('header' => 'Fecha',
																	  'name' => 'fecha_creacion',
																	  'value' => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_creacion))'),
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
																										'url'=>'Yii::app()->createUrl("adjudicacion/view", array("id"=>$data->idAdjudicacion))',
																										),
																							'update' => array( 
																										'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
																										'options'=>array('title'=>'Editar'),
																										'imageUrl' => false,
																										'url'=>'Yii::app()->createUrl("adjudicacion/update", array("id"=>$data->idAdjudicacion))',
																										),
																						   ),
																),
														),
												));
											}
																		
											echo '<br>';
											
											if (isset($contratacion)) {
												echo '<b>Etapa de Contratación</b>';
												$this->widget('zii.widgets.grid.CGridView', array(
														'id'=>'contratacion-grid',
														'dataProvider' => $contratacion,
														'filter' => null,
														'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
														'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
														'summaryText' => 'Mostrando {start} - {end} de {count} registros',
														'htmlOptions' => array('class' => 'grid-view rounded'),
														'columns' => array(
																array('header' => 'idContratacion',
																	  'name'   => 'idContratacion'),
																array('header' => 'Titulo del contrato',
																	  'name'   => 'titulocontrato'),
																array('header' => 'Precio en LPS',
																	  'name'   => 'precio'),
																array('header' => 'Fecha de inicio',
																	  'name' => 'fechainicio',
																	  'value' => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fechainicio))'),
																array('header' => 'Fecha final',
																	  'name' => 'fechafinal',
																	  'value' => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fechafinal))'),
																array('header' => 'Fecha',
																	  'name' => 'fecha_creacion',
																	  'value' => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_creacion))'),
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
																										'url'=>'Yii::app()->createUrl("contratacion/view", array("id"=>$data->idContratacion))',
																										),
																							'update' => array( 
																										'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
																										'options'=>array('title'=>'Editar'),
																										'imageUrl' => false,
																										'url'=>'Yii::app()->createUrl("contratacion/update", array("id"=>$data->idContratacion))',
																										),
																						   ),
																),
														),
												));
											}
											
											echo '<br>';
											
											if (isset($inicio_ejecucion)) {
												echo '<b>Inicio de la Ejecución</b>';
												$this->widget('zii.widgets.grid.CGridView', array(
														'id'=>'inicioEjecucion-grid',
														'dataProvider' => $inicio_ejecucion,
														'filter' => null,
														'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
														'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
														'summaryText' => 'Mostrando {start} - {end} de {count} registros',
														'htmlOptions' => array('class' => 'grid-view rounded'),
														'columns' => array(
																array('header' => 'idInicioEjecucion',
																	  'name'   => 'idInicioEjecucion'),
																array('header' => 'Titulo del contrato',
																	  'name'   => 'idContratacion0.titulocontrato'),
																array('header' => 'Responsable Oferente',
																	  'name'   => 'idContacto0.Nombres'),
																array('header' => 'Fecha orden de inicio',
																	  'name' => 'fecha_inicio',
																	  'value' => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_inicio))'),
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
																										'url'=>'Yii::app()->createUrl("inicioEjecucion/view", array("id"=>$data->idInicioEjecucion))',
																										),
																							'update' => array( 
																										'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
																										'options'=>array('title'=>'Editar'),
																										'imageUrl' => false,
																										'url'=>'Yii::app()->createUrl("inicioEjecucion/update", array("id"=>$data->idInicioEjecucion))',
																										),
																						   ),
																),
														),
												));
											}
										
											echo '<br>';
											
											if (isset($gestion_contratos)) {
												echo '<b>Gestión de los contratos</b>';
												$this->widget('zii.widgets.grid.CGridView', array(
														'id'=>'GestionContratos-grid',
														'dataProvider' => $gestion_contratos,
														'filter' => null,
														'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
														'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
														'summaryText' => 'Mostrando {start} - {end} de {count} registros',
														'htmlOptions' => array('class' => 'grid-view rounded'),
														'columns' => array(
																array('header' => 'idContratos',
																	  'name'   => 'idContratos'),
																array('header' => 'Titulo del contrato',
																	  'name'   => 'idContratacion0.titulocontrato'),
																array('header' => '# Modificación',
																	  'name'   => 'nmodifica'),
																array('header' => 'Tipo Modificación',
																	  'name'   => 'tipomodifica'),
																array('header' => 'Fecha',
																	  'name' => 'fecha',
																	  'value' => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha))'),
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
																										'url'=>'Yii::app()->createUrl("Contratos/view", array("id"=>$data->idContratos))',
																										),
																							'update' => array( 
																										'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
																										'options'=>array('title'=>'Editar'),
																										'imageUrl' => false,
																										'url'=>'Yii::app()->createUrl("Contratos/update", array("id"=>$data->idContratos))',
																										),
																						   ),
																),
														),
												));
											}
											
												  
											
									
										
											echo '<br>';
											
											if (isset($avances)) {
												echo '<b>Gestión de los avances</b>';
												$this->widget('zii.widgets.grid.CGridView', array(
														'id'=>'Avances-grid',
														'dataProvider' => $avances,
														'filter' => null,
														'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
														'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
														'summaryText' => 'Mostrando {start} - {end} de {count} registros',
														'htmlOptions' => array('class' => 'grid-view rounded'),
														'columns' => array(
																array('header' => 'idAvances',
																	  'name'   => 'idAvances'),
																array('header' => 'Av. Financiero Programado',
																	  'name'   => 'finan_programado'),
																array('header' => 'Av. Financiero Real',
																	  'name'   => 'finan_real'),
																array('header' => 'Fecha del avance',
																	  'name' => 'fecha_avance',
																	  'value' => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_avance))'),
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
																										'url'=>'Yii::app()->createUrl("Avances/view", array("id"=>$data->idAvances))',
																										),
																							'update' => array( 
																										'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
																										'options'=>array('title'=>'Editar'),
																										'imageUrl' => false,
																										'url'=>'Yii::app()->createUrl("Avances/update", array("id"=>$data->idAvances))',
																										),
																						   ),
																),
														),
												));
											}
										
										?>
								</td>
							</tr>
						</tbody>
					</table>
					<!-- content -->
				</div>

			</div>
		</div>
	</div>

	<script type="text/javascript">
	
	</script>