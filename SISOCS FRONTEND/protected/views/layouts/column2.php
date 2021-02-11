<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19" style="width:70%;">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last" >
	<div id="sidebar">
	<?php
    
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operaciones',
		));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
				   
			'htmlOptions'=>array('class'=>'Operaciones'),
				));
		$this->endWidget();
		
if (Yii::app()->user->isSuperAdmin) { /*
          $this->beginWidget('zii.widgets.CPortlet', array(
               'title'=>'Planificación del Programa',
          ));
          $this->widget('zii.widgets.CMenu', array(
               'items'=>array(
                    array('label'=>'Entidad de Adquisición', 'url'=>array('/entes')),
                    array('label'=>'Funcionarios', 'url'=>array('/funcionarios')),
                    array('label'=>'Rol', 'url'=>array('/rol')), 
                    array('label'=>'Sector', 'url'=>array('/sector')),                    
                    array('label'=>'Sub-Sector', 'url'=>array('/subsector')),
                    array('label'=>'Fuentes de Financiamiento', 'url'=>array('/fuentesfinan')),
                  ),
               'htmlOptions'=>array('class'=>'operations'),
          ));
          $this->endWidget(); */
          $this->beginWidget('zii.widgets.CPortlet', array(
               'title'=>'Planificación del Proyecto',
          ));
          $this->widget('zii.widgets.CMenu', array(
               'items'=>array(
                    array('label'=>'Clase', 'url'=>array('/clase')),
                    array('label'=>'Funcionarios', 'url'=>array('/funcionarios')),
                    array('label'=>'Ubicación Vial', 'url'=>array('/ubicacionvial')),
                    array('label'=>'Región', 'url'=>array('/region')), 
                    array('label'=>'Departamentos', 'url'=>array('/departamento')),                   
                    array('label'=>'Tramo', 'url'=>array('/tramo')),
                    array('label'=>'Ruta', 'url'=>array('/ruta')),
                    array('label'=>'Tipo de Red', 'url'=>array('/tipored')),
                    array('label'=>'Propósito', 'url'=>array('/proposito')),
                    array('label'=>'Municipio', 'url'=>array('/municipio')),
                    array('label'=>'Fuentes de Financiamiento', 'url'=>array('/fuentesfinan')),
                  ),
               'htmlOptions'=>array('class'=>'operations'),
          ));
          $this->endWidget();
          $this->beginWidget('zii.widgets.CPortlet', array(
               'title'=>'Invitación y Calificación',
          ));
          $this->widget('zii.widgets.CMenu', array(
               'items'=>array(
                    array('label'=>'Funcionarios', 'url'=>array('/funcionarios')),
                    array('label'=>'Tipo de contrato', 'url'=>array('/tipocontrato')),
                    array('label'=>'Entidad de Adquisición', 'url'=>array('/entes')),
                    array('label'=>'Método de Adquisición', 'url'=>array('/tipoadquisicion')),                   
                    array('label'=>'Oferentes/Empresas', 'url'=>array('/empresa')),
                  ),
               'htmlOptions'=>array('class'=>'operations'),
          ));
          $this->endWidget();
          $this->beginWidget('zii.widgets.CPortlet', array(
               'title'=>'Evaluación de las Ofertas/Adjudicación',
          ));
          $this->widget('zii.widgets.CMenu', array(
               'items'=>array(
                    array('label'=>'Estatus del proceso', 'url'=>array('/estadoproceso')),
                    array('label'=>'Entidad de Adquisición', 'url'=>array('/entes')),
                    array('label'=>'Oferentes/Empresas', 'url'=>array('/empresa')),
                  ),
               'htmlOptions'=>array('class'=>'operations'),
          ));
          $this->endWidget();
          $this->beginWidget('zii.widgets.CPortlet', array(
               'title'=>'Implementación',
          ));
          $this->widget('zii.widgets.CMenu', array(
               'items'=>array(
                    array('label'=>'Datos de Contacto', 'url'=>array('/contactos')),
                    array('label'=>'Tipo de Garantía', 'url'=>array('/garantias')),
                  ),
               'htmlOptions'=>array('class'=>'operations'),
          ));
          $this->endWidget();
          $this->beginWidget('zii.widgets.CPortlet', array(
               'title'=>'Avances de Ejecución',
          ));
          $this->widget('zii.widgets.CMenu', array(
               'items'=>array(
                    array('label'=>'Actividades en Avances', 'url'=>array('/actAvances/admin')),
                    array('label'=>'Actividades', 'url'=>array('/catgTipoActividades/admin')),
					array('label'=>'Sub-Actividades', 'url'=>array('/catgSubActividades/admin')),
					array('label'=>'Unidad', 'url'=>array('/catgUnidades/admin')),
                  ),
               'htmlOptions'=>array('class'=>'operations'),
          ));
          $this->endWidget();
          $this->beginWidget('zii.widgets.CPortlet', array(
               'title'=>'Generales',
          ));
          $this->widget('zii.widgets.CMenu', array(
               'items'=>array(
                    array('label'=>'Estados', 'url'=>array('/estado')),
                    array('label'=>'Tipos de Moneda', 'url'=>array('/monedas')),
                    array('label'=>'Ver gráficos', 'url'=>array('/graficos')),
                    array('label'=>'Ver Mapa', 'url'=>array('/address')),
                    
                  ),
               'htmlOptions'=>array('class'=>'operations'),
          ));
          $this->endWidget();
    }
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
