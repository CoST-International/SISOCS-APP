<?php 
	/**
	* Widget que obtiene los contratos de un proveedor
	* y los muestra en un acordeón.
	*/
	class AdquisicionesWidget extends CWidget
	{
		public function init()
		{
			#Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
			
            $file=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'bootstrap.widget.min.css';
            $cssFile = Yii::app()->getAssetManager()->publish($file);
            Yii::app()->clientScript->registerCssFile($cssFile);

            $file=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'style.widget.css';
            $cssFile = Yii::app()->getAssetManager()->publish($file);
            Yii::app()->clientScript->registerCssFile($cssFile);

            #$file=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'bootstrap.min.js';
            #$jsFile = Yii::app()->getAssetManager()->publish($file);
            #Yii::app()->clientScript->registerScriptFile($jsFile);

            Yii::app()->clientScript->registerScriptFile('https://use.fontawesome.com/20e0080cb0.js');

	        parent::init();
		}

		public function run()
		{
			$sql = "SELECT
	                	cs_tipocontrato.contrato,
	                	cs_metodo.adquisicion,
	                    cs_calificacion.idMetodo,
	                    cs_calificacion.idTipoContrato,
	                	COUNT(cs_metodo.adquisicion) AS 'contrato_cuantos'
                	FROM cs_calificacion INNER JOIN cs_metodo ON
                	     cs_calificacion.idMetodo = cs_metodo.idMetodo 
                	     INNER JOIN cs_tipocontrato ON 
                	     cs_calificacion.idTipoContrato = cs_tipocontrato.idTipoContrato
                	WHERE cs_calificacion.estado = 'PUBLICADO'
                	GROUP BY cs_calificacion.idTipoContrato,
                			 cs_calificacion.idMetodo";
			$headers = Yii::app()->db->createCommand($sql)->queryAll();
			$this->render('adquisiciones',array('headers'=>$headers));
		}
	}
 ?>