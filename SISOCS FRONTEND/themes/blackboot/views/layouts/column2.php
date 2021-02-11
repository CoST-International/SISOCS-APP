<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
    <div class="two_layout">
        <div class="row" style="margin:0 auto">

            <div class="col-sm-3 col-lg-3 col-md-3 col-xs-3 sidebar-offcanvas" id="sidebar" style="padding-left:0px;padding-right:0px;padding-top:0px;">
            <h3 style="font-size:1.8em;width:100%;color:#fff;text-align:center;min-height:50px;padding:20px;background:#29a4dd">
            <span class="collapse in hidden-xs-down">Navegación</span>
                <i class="fa fa-bars" aria-hidden="true" id="navTogleIcon"></i>
            </h3>
            
       
            <div style="padding:20px">
            <?php
            
             foreach ($this->menu as &$valor) {
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
                 $valor['label'] = $icon.$valor['label'].'</span>';
                 $valor['itemOptions'] = array('class'=>'nav-item','id'=>'borderDown');
                 
                 $valor['encodeLabel'] = false;
             }


            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'',
            ));
            $this->widget('zii.widgets.CMenu', array(
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'nav nav-stacked','id' => 'menu'),
            ));
            $this->endWidget();
        ?>
        </div>
            </div>
            <!-- sidebar span3 -->

            <div class="col-sm-9 col-lg-9 col-md-9 col-xs-9" id="main" style="padding-top:10px;margin-left: 20px;">
                <div>
                    <?php echo $content; ?>
                </div>
                <!-- content -->
            </div>

        </div>
    </div>
</div>
<?php $this->endContent(); ?>

<script type="text/javascript">
	$(document).ready(function(){
        $('.content_header').insertBefore('.two_layout');

      
        $('#navTogleIcon').click(function() {
          

         });

    });
</script>