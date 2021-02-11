<?php
/* @var $this CiudadanoController */

$this->breadcrumbs=array( 
	'Ciudadano'=>array('index'),
);
?>

<?php


	$this->beginWidget('Galleria');
	$a=1;
	
	if($images!=null)
	{
		foreach ($images as $img) 
    {
			$ubic=substr($img->ubicacion_img,44);
			
			if($a==3)
			{
				$a=1;?>
			<!--<?php //echo "<script language='JavaScript'>alert('".$ubic."');</script>"; ?>	-->
        <td height="20" width="20">
		   <img src=" <?php echo $ubic ?> "  />
        </td>
        </tr>
        <tr>
        <?php //echo "<br/>";
			}
			else
			{
        //echo CHtml::image("protected/img_subidas/".$img->nombre_img,50);?>
        <td height="20" width="20">
		<!--<?php //echo "<script language='JavaScript'>alert('".$ubic."');</script>"; ?>-->
		
       <img src="<?php echo $ubic ?>"  /><br>
	   <?php //echo $img->ubicacion_img; ?>
        </td>
        <?php
				$a++;
			}
			
		}
	}
	else{
		echo "No hay imágenes";
  }
  $this->endWidget();
	?>