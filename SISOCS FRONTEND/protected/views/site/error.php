<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<body>

	<div class="alert alert-danger">
  <strong>Error!</strong> Solicitud no Encontrada o Invalida!
</div>



     <h2><?php echo nl2br(CHtml::encode($data['message'])); ?></h2>
     <p>
        Mientras el servidor manejaba su solicitud se encontró con un Error o La solicitud realizada<br>
				No cumple con los requisitos mínimos para ser procesada
     </p>

     <p>
       Si cree que este Error es por parte del sistema, por favor contacte al administrador<?php echo $data['admin']; ?>.
     </p>
     <p>
        Muchas Gracias.
				<?php echo CHtml::encode($message); ?>
     </p>

</body>

<div class="error">

</div>
