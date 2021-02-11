<style type='text/css'>
img #img{
	width:300px;
	height:400px;
	}
</style>
<?php if($uploaded):?>
<p>La imagen se subió correctamente. Check <?php echo $dir?>.</p>
<?php endif ?>
<?php echo CHtml::beginForm('','post',array 
   ('enctype'=>'multipart/form-data'))?>
<?php echo "<br/>".CHtml::image($dir."\\".$nombre,400,array('id'=>"img")); ?>
   <?php echo CHtml::error($model, 'file')?>
   <?php echo CHtml::activeFileField($model, 'file')?>
   <?php echo CHtml::submitButton('Subir')?>
<?php echo CHtml::endForm()?>

