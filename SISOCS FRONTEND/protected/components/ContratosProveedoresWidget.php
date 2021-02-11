<?php 
	/**
	* Widget que obtiene los contratos de un proveedor
	* y los muestra en un acordeón.
	*/
	class ContratosProveedoresWidget extends CWidget
	{
		public function init()
		{
			#Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js');
			
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
			$sql = "SELECT cuantos AS 'contratos', count(*) AS 'proveedores', 
			               sum(monto) AS 'suma'
                    	   FROM (SELECT idOferente, count(idOferente) AS cuantos, 
                    	   sum(`precioUSD`) AS monto
                    FROM cs_contratacion
                    WHERE cs_contratacion.estado = 'PUBLICADO'
                    GROUP BY idOferente
                    ) T
                    GROUP BY cuantos ";
			$headers = Yii::app()->db->createCommand($sql)->queryAll();
			$this->render('contratosProveedores',array('headers'=>$headers));
		}
	}
 ?>