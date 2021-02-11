<?php
/*
	aqui: $this->beginContent('//layouts/main'); indica que este layout se amolda 
	al layout que se haya definido para todo el sistema, y dentro de el colocara
	su propio layout para amoldar a un CPortlet.
	
	esto es para asegurar que el sistema disponga de un portlet, 
	esto es casi lo mismo que haber puesto en UiController::layout = '//layouts/column2'
	a diferencia que aqui se indica el uso de un archivo CSS para estilos predefinidos
	
	Yii::app()->layout asegura que estemos insertando este contenido en el layout que
	se ha definido para el sistema principal.
*/
?>
	<?php 
	$this->beginContent('//layouts/'.Yii::app()->layout); 
?>

	<?php	
	if(Yii::app()->user->isSuperAdmin)
		echo Yii::app()->user->ui->superAdminNote();
?>


		<div class="row-fluid">
			<div class="two_layout">

				<div class="row" style="margin:0 auto">

					<div class="col-sm-3 col-lg-3 col-md-3 col-xs-3 sidebar-offcanvas" id="sidebar" style="padding-left:0px;padding-right:0px;padding-top:0px;">
						<h3 style="font-size:1.8em;width:100%;color:#fff;text-align:center;min-height:50px;padding:20px;background:#29a4dd">
							<span class="collapse in hidden-xs-down">Navegación</span>
							<i class="fa fa-bars" aria-hidden="true" id="navTogleIcon"></i>
						</h3>
						<div style="padding:20px;">

							<?php 
							if(Yii::app()->user->checkAccess('admin')) {
								$menu=Yii::app()->user->ui->adminItems;
									foreach ($menu as &$valor) {
										$icon='<i class="fa fa-plus-eye"></i> <span class="collapse in hidden-xs-down">';
										
										if (strpos($valor['label'], 'Crear')!== false ||strpos($valor['label'], 'Create')!== false) {
											$icon='<i class="fa fa-plus-circle" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
										} else if (strpos($valor['label'], 'Editar')!== false) {
											$icon='<i class="fa fa-pencil-square-o" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
										} else if (strpos($valor['label'], 'Lista')!== false) {
											$icon='<i class="fa fa-list" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
										} else if (strpos($valor['label'], 'Gestion')!== false||strpos($valor['label'], 'Manage')!== false) {
											$icon='<i class="fa fa-list" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
										}else if (strpos($valor['label'], 'Eliminar')!== false) {
										   $icon='<i class="fa fa-trash-o" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									   }else if (strpos($valor['label'], 'Actualizar')!== false) {
										   $icon='<i class="fa fa-edit" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									   }else if (strpos($valor['label'], 'Ver')!== false) {
										   $icon='<i class="fa fa-eye" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									   }
									   else if (strpos($valor['label'], 'Regresar')!== false) {
										   $icon='<i class="fa fa-backward" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									   }
									   else if (strpos($valor['label'], 'Administrar')!== false) {
										   $icon='<i class="fa fa-toggle-left" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									   }
									   else if (strpos($valor['label'], 'Administrador')!== false) {
										$icon='<i class="fa fa-users" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									}  else if (strpos($valor['label'], 'Campo')!== false) {
										$icon='<i class="fa fa-file" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									}else if (strpos($valor['label'], 'Asigna')!== false) {
										$icon='<i class="fa fa-book" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									}else if (strpos($valor['label'], 'Roles')!== false) {
										$icon='<i class="fa fa-bookmark" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									}else if (strpos($valor['label'], 'Tareas')!== false) {
										$icon='<i class="fa fa-tasks" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									}else if (strpos($valor['label'], 'Operacion')!== false) {
										$icon='<i class="fa fa-chain" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									}else if (strpos($valor['label'], 'Variables')!== false) {
										$icon='<i class="fa fa-cogs" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									}else if (strpos($valor['label'], 'Sesiones')!== false) {
										$icon='<i class="fa fa-check" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									}else if (strpos($valor['label'], 'Sistema')!== false) {
										$icon='<i class="fa fa-eye" id="iconSideBar"></i> <span class="collapse in hidden-xs-down">';
									}
										$valor['label'] = $icon.$valor['label'].'</span>';
										$valor['itemOptions'] = array('class'=>'nav-item','id'=>'borderDown');
										
										$valor['encodeLabel'] = false;
									}
								
										$this->beginWidget('zii.widgets.CPortlet', array(
											'title'=>ucfirst(CrugeTranslator::t("")),
										));
										$this->widget('zii.widgets.CMenu', array(
											'items'=>$menu,
											'htmlOptions'=>array('class'=>'operations'),
										));
										$this->endWidget();
								 } 	?>

						</div>
					</div>
					<!-- sidebar span3 -->

					<div class="col-sm-9 col-lg-9 col-md-9 col-xs-9" id="main" style="padding-top:10px;margin-left: 20px;">

						<div class="content_header" style="text-align:left">
							<h1 style="font-size:2em;color:#141414">Administración de Usuarios</h1>
							<hr class="lineOne">
						</div>
						<?php echo $content; ?>
						<!-- content -->
					</div>

				</div>
			</div>
		</div>
		<?php $this->endContent(); ?>

		<script type="text/javascript">
			$(document).ready(function () {
				$('.form h1').hide();


			});

		</script>