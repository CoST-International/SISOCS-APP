<?php
/* @var $this CiudadanoController */

$this->breadcrumbs=array(
	'Ciudadano',
);
/*Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile("assets/bootstrap/js/bootstrap.min.js");
Yii::app()->clientScript->registerCssFile("assets/bootstrap/css/bootstrap.min.css");
Yii::app()->clientScript->registerCssFile("css/customDragon.css");*/

?>
<center>
    <table style="width: 100%">
<tr>
<td>
Proyectos Registrados: <br /> <input type="text" name="nobras" value="<?php echo count(Proyecto::Model()->findAll());?>" readonly="true">
</td>
<td>
<?php $sum=Yii::app()->db->createCommand()
                ->select('sum(precio)')
                ->from('cs_contratacion')
                ->queryScalar();?>
Montos Contratados: <br /> <input type="text" name="moncon" size="40" value="LPS. <?php echo number_format($sum,2,'.',',');?>" readonly="true">
</td>
</tr>
<tr>
    <td colspan="2"><div align="center">
<img src="images/choluteca_bridge.jpg" width="800" height="200"></div>
</td>
</tr>
<tr>
<td>
Haga clic en las secciones de la imagen <br />
para visualizar los proyectos localizados <br />
en los departamentos
</td>
<td>
Ingrese texto de búsqueda <br />
<form name="form1" method="POST">
<input type="text" id="criterio" name="criterio" size="30"/>
<input type="submit" name="yt0" value="Buscar" id="yt0" /> 
<?php 
/*
	echo CHtml::ajaxSubmitButton(
	'Buscar',
	array('Ciudadano/BProyecto'),
	array('update' =>'#proyectos')
	);
*/
?> 
</form>
</td>
</tr>
<tr>
<td>

<div>
<img src="images/MapaHND2.png" style="width: 610px; height: 400px" usemap="#map"/>
<map name="map">
<area shape="poly" coords="278,225,271,208,253,176,247,160,260,140,260,140,280,128,298,124,312,126,326,122,356,113,380,102,406,120,414,121,427,141,451,158,450,193,445,211,435,226,432,242,413,252,404,258,393,266,388,250,359,256,352,254,347,247,335,241,329,232,317,236,306,243,292,228,280,227,279,226" href="#" id="yt1" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '15'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="454,193,450,65,450,65,509,81,562,114,641,160,573,187,522,196,485,198,457,188" href="#" id="yt2" <?php //echo CHtml::ajaxLink('Buscar', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '09'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="450,154,449,61,449,61,429,70,404,74,355,56,353,67,325,75,304,85,308,102,326,118,380,100,414,122,453,156" href="#" id="yt3" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '02'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="374,290,377,274,390,268,386,251,358,259,336,243,309,242,276,230,257,250,253,271,246,286,239,300,233,301,227,312,238,323,256,308,272,303,289,298,314,301,335,277,347,264,374,290" href="#" id="yt4" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '07'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="271,307,279,348,247,375,220,378,201,356,208,341,200,302,219,307,240,321,268,304,269,304,272,305" href="#" id="yt5" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '06'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="200,350,210,336,199,307,178,298,169,289,167,319,168,342,180,348,198,352" href="#" id="yt6" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '17'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="224,308,244,284,253,255,271,228,257,187,242,167,225,178,212,202,203,224,205,239,203,251,188,267,182,294,195,305,202,294,226,306" href="#" id="yt7" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '08'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="248,166,260,142,260,142,293,126,320,120,299,104,234,117,200,115,181,107,166,95,153,137,187,159,219,175,228,158,249,163" href="#" id="yt8" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '18'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="311,110,311,110,304,85,255,88,212,78,187,81,173,74,165,92,184,111,199,111,231,116,247,109,273,106,286,104,307,105,310,104" href="#" id="yt9" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '01'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="253,58,253,58,282,41,340,24,370,18,369,4,326,9,269,20,256,32,240,54" href="#" id="yt10" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '11'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="203,213,222,186,204,170,186,165,172,169,142,195,155,222,179,238,175,248,167,258,177,270,191,257,206,209,218,189" href="#" id="yt11" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '03'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="168,287,183,286,184,266,172,266,164,254,176,245,172,236,159,232,142,244,122,259,119,273,137,272,143,284,161,280,177,293" href="#" id="yt12" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '12'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="171,70,160,95,150,138,169,161,145,190,140,165,135,150,136,134,123,117,104,107,116,93,128,99,143,81,158,74,171,70,172,70,168,75" href="#" id="yt13" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '05'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="144,185,139,170,134,153,130,129,107,108,68,133,75,159,75,171,84,173,95,185,107,202,130,208,143,191" href="#" id="yt14" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '16'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="122,272,141,247,154,229,140,204,122,211,110,210,97,224,98,237,107,249,92,280,96,288,121,273,133,251" href="#" id="yt15" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '10'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="92,273,106,250,91,223,106,209,82,171,75,187,68,204,70,212,50,233,43,246,62,261,90,274" href="#" id="yt16" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '13'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="65,211,63,198,76,175,67,137,30,156,18,175,24,196,42,197,53,218,62,212,63,212,65,211" href="#" id="yt17" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '04'),'update'=>'#proyectos')); ?> />
<area shape="poly" coords="43,247,60,219,49,211,35,200,26,200,19,211,2,222,33,234,44,241,44,242,45,242" href="#" id="yt18" <?php //echo CHtml::ajaxLink('', 'index.php?r=Ciudadano/BMapa',array('type' =>'POST','data' =>array( 'id' => '14'),'update'=>'#proyectos')); ?> />
</map>
</div>
</td>
</tr>
</table>
</center>
<div id='proyectos'></div>
<div id='programas'></div>

<script type="text/javascript">
/*<![CDATA[*/
jQuery(function($) {
jQuery('body').on('click','#yt0',function(){jQuery.ajax({'type':'POST','url':'/sisocs/index.php?r=Ciudadano/BProyecto','cache':false,'data':jQuery(this).parents("form").serialize(),'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt1',function(){jQuery.ajax({'type':'POST','data':{'id':'15'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt2',function(){jQuery.ajax({'type':'POST','data':{'id':'09'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt3',function(){jQuery.ajax({'type':'POST','data':{'id':'02'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt4',function(){jQuery.ajax({'type':'POST','data':{'id':'07'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt5',function(){jQuery.ajax({'type':'POST','data':{'id':'06'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt6',function(){jQuery.ajax({'type':'POST','data':{'id':'17'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt7',function(){jQuery.ajax({'type':'POST','data':{'id':'08'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt8',function(){jQuery.ajax({'type':'POST','data':{'id':'18'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt9',function(){jQuery.ajax({'type':'POST','data':{'id':'01'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt10',function(){jQuery.ajax({'type':'POST','data':{'id':'11'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt11',function(){jQuery.ajax({'type':'POST','data':{'id':'03'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt12',function(){jQuery.ajax({'type':'POST','data':{'id':'12'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt13',function(){jQuery.ajax({'type':'POST','data':{'id':'05'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt14',function(){jQuery.ajax({'type':'POST','data':{'id':'16'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt15',function(){jQuery.ajax({'type':'POST','data':{'id':'10'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt16',function(){jQuery.ajax({'type':'POST','data':{'id':'13'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt17',function(){jQuery.ajax({'type':'POST','data':{'id':'04'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
jQuery('body').on('click','#yt18',function(){jQuery.ajax({'type':'POST','data':{'id':'14'},'url':'index.php?r=Ciudadano/BMapa','cache':false,'success':function(html){jQuery("#proyectos").html(html)}});return false;});
  $("#nav li").hover(
    function () {
      if ($(this).hasClass("parent")) {
        $(this).addClass("over");
      }
    },
    function () {
      $(this).removeClass("over");
    }
  );

jQuery('#yii_bootstrap_collapse_0').collapse({'parent':false,'toggle':false});
});
/*]]>*/
</script>
