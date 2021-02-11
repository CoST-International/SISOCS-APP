<?php

class ProyectoController extends Controller
{
    public $np=array();
    /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
//		return array(
//			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
//		);
            return array('accessControl',array('CrugeAccessControlFilter'));
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(   'index','view','Ajaxubicacion','ViewDetFuente','ViewDetBeneficiario',
                                    'DeleteGet','DatosBeneficiario','AjaxDatosprograma',
                                    'DatosBeneficiarioDepto','DeleteFuenteGet',
									'GeneratePdf','GenerateExcel','listaEntes'),
				'users'=>array('*'),
			),
			  array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update','admin'),
                'users' => array('@'),
				//'expression'=>'Yii::app()->user->checkAccess("Programas")',
				//'roles'=>array('Programas','Proyectos'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete'),
                'users' => array('admin'),
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionViewDetFuente($id, $event)
	{
            $mf= ProyectoFuente::model()->findAll('idProyecto=:pf',array(':pf'=>$id));
            $this->renderpartial('_filasfuente',array('datos'=>$mf, 'evento'=>$event));
	}
    
    public function actionViewDetBeneficiario($id, $event)
	{
        
        $sql = 'Select * from vProyecto_Beneficiario Where idproyecto = '.$id;
        $command=Yii::app()->db->createCommand($sql);
        $mf=$command->queryAll();
        $this->renderpartial('_filasbeneficiarios',array('datos'=>$mf, 'evento'=>$event));
        
	}
	
	public function actionViewDetMunicipio($id, $event)
	{
        
        $sql = 'Select * from vProyecto_Beneficiario Where idproyecto = '.$id;
        $command=Yii::app()->db->createCommand($sql);
        $mf=$command->queryAll();
        $this->renderpartial('_filasbeneficiarios',array('datos'=>$mf, 'evento'=>$event));
        
	}
	
	public function getEnlaceVacio($url,$href){
        
        if(strlen($href)>10){
            $enlace=$url;
        }
        else{
            $enlace="No Aplica";
        }
 
        return $enlace;
    }
        
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
    /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Proyecto;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                
                if(isset($_POST['Proyecto']))  {
                    
                    $model->attributes=$_POST['Proyecto'];
                    
                    if ($model->save()) {
                        
                        $id=$model->idProyecto;
                        
                        $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 2, $id);
                        
                        /* if ($model->validate(array('image1'))) {
                            $image1 = CUploadedFile::getInstance($model, 'image1');
                        } else { $image1 = ''; }
                        if ($model->validate(array('image2'))) {
                            $image2 = CUploadedFile::getInstance($model, 'image2');
                        } else { $image2 = ''; }
                        if ($model->validate(array('image3'))) {
                            $image3 = CUploadedFile::getInstance($model, 'image3');
                        } else { $image3 = ''; }
                        if ($model->validate(array('image4'))) {
                            $image4 = CUploadedFile::getInstance($model, 'image4');
                        } else { $image4 = ''; }
                        if ($model->validate(array('image5'))) {
                            $image5 = CUploadedFile::getInstance($model, 'image5');
                        } else { $image5 = ''; }
                        if ($model->validate(array('image6'))) {
                            $image6 = CUploadedFile::getInstance($model, 'image6');
                        } else { $image6 = ''; }
                        if ($model->validate(array('image7'))) {
                            $image7 = CUploadedFile::getInstance($model, 'image7');
                        } else { $image7 = ''; }
                        if ($model->validate(array('image8'))) {
                            $image8 = CUploadedFile::getInstance($model, 'image8');
                        } else { $image8 = ''; }
                        if ($model->validate(array('image9'))) {
                            $image9 = CUploadedFile::getInstance($model, 'image9');
                        } else { $image9 = ''; }
                        if ($model->validate(array('image10'))) {
                            $image10 = CUploadedFile::getInstance($model, 'image10');
                        } else { $image10 = ''; }
                        if ($model->validate(array('image11'))) {
                            $image11 = CUploadedFile::getInstance($model, 'image11');
                        } else { $image11 = ''; }
                        if ($model->validate(array('image12'))) {
                            $image12 = CUploadedFile::getInstance($model, 'image12');
                        } else { $image12 = ''; } */
                
                        $image1=CUploadedFile::getInstance($model,'image1');
                        $image2=CUploadedFile::getInstance($model,'image2');
                        $image3=CUploadedFile::getInstance($model,'image3');
                        $image4=CUploadedFile::getInstance($model,'image4');
                        $image5=CUploadedFile::getInstance($model,'image5');
                        $image6=CUploadedFile::getInstance($model,'image6');
                        $image7=CUploadedFile::getInstance($model,'image7');
                        $image8=CUploadedFile::getInstance($model,'image8');
                        $image9=CUploadedFile::getInstance($model,'image9');
                        $image10=CUploadedFile::getInstance($model,'image10');
                        $image11=CUploadedFile::getInstance($model,'image11');
                        $image12=CUploadedFile::getInstance($model,'image12');

                        if (strlen($image1)>0){
                           if ($image1->saveAs($dir.'/'.$image1->getName())) {
                               $model->especiplano=  Yii::app()->Controller->getURL($dir.'/'.$image1->getName());
                           }
                        }
                        if (strlen($image2)>0){
                           if ($image2->saveAs($dir.'/'.$image2->getName())) {
                               $model->presuprogra=  Yii::app()->Controller->getURL($dir.'/'.$image2->getName());
                           }
                        }
                        if (strlen($image3)>0){
                           if ($image3->saveAs($dir.'/'.$image3->getName())) {
                               $model->estudiofact=  Yii::app()->Controller->getURL($dir.'/'.$image3->getName());
                           }
                        }
                        if (strlen($image4)>0){
                           if ($image4->saveAs($dir.'/'.$image4->getName())) {
                               $model->estudioimpact=  Yii::app()->Controller->getURL($dir.'/'.$image4->getName());
                           }
                        }
                        if (strlen($image5)>0){
                           if ($image5->saveAs($dir.'/'.$image5->getName())) {
                               $model->licambi=  Yii::app()->Controller->getURL($dir.'/'.$image5->getName());
                           }
                        }
                        if (strlen($image6)>0){
                           if ($image6->saveAs($dir.'/'.$image6->getName())) {
                               $model->estuimpactierra=  Yii::app()->Controller->getURL($dir.'/'.$image6->getName());
                           }
                        }
                        if (strlen($image7)>0){
                           if ($image7->saveAs($dir.'/'.$image7->getName())) {
                               $model->planreasea=  Yii::app()->Controller->getURL($dir.'/'.$image7->getName());
                           }
                        }
                        if (strlen($image8)>0){
                           if ($image8->saveAs($dir.'/'.$image8->getName())) {
                               $model->plananual=  Yii::app()->Controller->getURL($dir.'/'.$image8->getName());
                           }
                        }
                        if (strlen($image9)>0){
                           if ($image9->saveAs($dir.'/'.$image9->getName())) {
                               $model->acuerdofinan=  Yii::app()->Controller->getURL($dir.'/'.$image9->getName());
                           }
                        }
                        if (strlen($image10)>0){
                           if ($image10->saveAs($dir.'/'.$image10->getName())) {
                               $model->otro=  Yii::app()->Controller->getURL($dir.'/'.$image10->getName());
                           }
                        }
                        if (strlen($image11)>0){
                           if ($image11->saveAs($dir.'/'.$image11->getName())) {
                               $model->notaprioridad=  Yii::app()->Controller->getURL($dir.'/'.$image11->getName());
                           }
                        }
                        if (strlen($image12)>0){
                           if ($image12->saveAs($dir.'/'.$image12->getName())) {
                               $model->constanciabanco=  Yii::app()->Controller->getURL($dir.'/'.$image12->getName());
                           }
                        }

                        $model->save();
                        $this->mandarCorreo(2, $model->idProyecto);
                        $this->redirect(array('update','id'=>$model->idProyecto));//view
                    }     
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            $model=$this->loadModel($id);

            $this->performAjaxValidation($model);

            if(isset($_POST['Proyecto']))  {
                
                $model->attributes=$_POST['Proyecto'];
                
                if ($model->save()) {

                    $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 2, $id);

                    /* if ($model->validate(array('image1'))) {
                        $image1 = CUploadedFile::getInstance($model, 'image1');
                    } else { $image1 = ''; }
                    if ($model->validate(array('image2'))) {
                        $image2 = CUploadedFile::getInstance($model, 'image2');
                    } else { $image2 = ''; }
                    if ($model->validate(array('image3'))) {
                        $image3 = CUploadedFile::getInstance($model, 'image3');
                    } else { $image3 = ''; }
                    if ($model->validate(array('image4'))) {
                        $image4 = CUploadedFile::getInstance($model, 'image4');
                    } else { $image4 = ''; }
                    if ($model->validate(array('image5'))) {
                        $image5 = CUploadedFile::getInstance($model, 'image5');
                    } else { $image5 = ''; }
                    if ($model->validate(array('image6'))) {
                        $image6 = CUploadedFile::getInstance($model, 'image6');
                    } else { $image6 = ''; }
                    if ($model->validate(array('image7'))) {
                        $image7 = CUploadedFile::getInstance($model, 'image7');
                    } else { $image7 = ''; }
                    if ($model->validate(array('image8'))) {
                        $image8 = CUploadedFile::getInstance($model, 'image8');
                    } else { $image8 = ''; }
                    if ($model->validate(array('image9'))) {
                        $image9 = CUploadedFile::getInstance($model, 'image9');
                    } else { $image9 = ''; }
                    if ($model->validate(array('image10'))) {
                        $image10 = CUploadedFile::getInstance($model, 'image10');
                    } else { $image10 = ''; }
                    if ($model->validate(array('image11'))) {
                        $image11 = CUploadedFile::getInstance($model, 'image11');
                    } else { $image11 = ''; }
                    if ($model->validate(array('image12'))) {
                        $image12 = CUploadedFile::getInstance($model, 'image12');
                    } else { $image12 = ''; } */
                
                    $image1=CUploadedFile::getInstance($model,'image1');
                    $image2=CUploadedFile::getInstance($model,'image2');
                    $image3=CUploadedFile::getInstance($model,'image3');
                    $image4=CUploadedFile::getInstance($model,'image4');
                    $image5=CUploadedFile::getInstance($model,'image5');
                    $image6=CUploadedFile::getInstance($model,'image6');
                    $image7=CUploadedFile::getInstance($model,'image7');
                    $image8=CUploadedFile::getInstance($model,'image8');
                    $image9=CUploadedFile::getInstance($model,'image9');
                    $image10=CUploadedFile::getInstance($model,'image10');
                    $image11=CUploadedFile::getInstance($model,'image11');
                    $image12=CUploadedFile::getInstance($model,'image12'); 

                    if (strlen($image1)>0){
                       if ($image1->saveAs($dir.'/'.$image1->getName())) {
                           $model->especiplano=  Yii::app()->Controller->getURL($dir.'/'.$image1->getName());
                       }
                    }
                    if (strlen($image2)>0){
                       if ($image2->saveAs($dir.'/'.$image2->getName())) {
                           $model->presuprogra=  Yii::app()->Controller->getURL($dir.'/'.$image2->getName());
                       }
                    }
                    if (strlen($image3)>0){
                       if ($image3->saveAs($dir.'/'.$image3->getName())) {
                           $model->estudiofact=  Yii::app()->Controller->getURL($dir.'/'.$image3->getName());
                       }
                    }
                    if (strlen($image4)>0){
                       if ($image4->saveAs($dir.'/'.$image4->getName())) {
                           $model->estudioimpact=  Yii::app()->Controller->getURL($dir.'/'.$image4->getName());
                       }
                    }
                    if (strlen($image5)>0){
                       if ($image5->saveAs($dir.'/'.$image5->getName())) {
                           $model->licambi=  Yii::app()->Controller->getURL($dir.'/'.$image5->getName());
                       }
                    }
                    if (strlen($image6)>0){
                       if ($image6->saveAs($dir.'/'.$image6->getName())) {
                           $model->estuimpactierra=  Yii::app()->Controller->getURL($dir.'/'.$image6->getName());
                       }
                    }
                    if (strlen($image7)>0){
                       if ($image7->saveAs($dir.'/'.$image7->getName())) {
                           $model->planreasea=  Yii::app()->Controller->getURL($dir.'/'.$image7->getName());
                       }
                    }
                    if (strlen($image8)>0){
                       if ($image8->saveAs($dir.'/'.$image8->getName())) {
                           $model->plananual=  Yii::app()->Controller->getURL($dir.'/'.$image8->getName());
                       }
                    }
                    if (strlen($image9)>0){
                       if ($image9->saveAs($dir.'/'.$image9->getName())) {
                           $model->acuerdofinan=  Yii::app()->Controller->getURL($dir.'/'.$image9->getName());
                       }
                    }
                    if (strlen($image10)>0){
                       if ($image10->saveAs($dir.'/'.$image10->getName())) {
                           $model->otro=  Yii::app()->Controller->getURL($dir.'/'.$image10->getName());
                       }
                    }
                    if (strlen($image11)>0){
                       if ($image11->saveAs($dir.'/'.$image11->getName())) {
                           $model->notaprioridad=  Yii::app()->Controller->getURL($dir.'/'.$image11->getName());
                       }
                    }
                    if (strlen($image12)>0){
                       if ($image12->saveAs($dir.'/'.$image12->getName())) {
                           $model->constanciabanco=  Yii::app()->Controller->getURL($dir.'/'.$image12->getName());
                       }
                    }

                    $model->save();
                    
                    $this->mandarCorreo(2, $model->idProyecto);
                    $this->redirect(array('view','id'=>$model->idProyecto));
                }
            }
            
            $this->render('update',array(
                    'model'=>$model,
            ));
	}
        
    protected function obtenerSector($p) {
            $s= Programa::model()->findByPk($p);
            return $s->sector;
    }
    
    public function nombreImagen($c,$i) {
        return "1_".$c.$i;
    }


    /**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
    
    public function actionDeleteGet(array $par)
	{  //$data=Municipio::model()->findAll('depto=:dep',array(':dep'=>$_POST['id']));
            try {
                 //$d= ProgramaFuente::model()->findAll('idPrograma=:p and idFuente=:f',array(':p'=>$_GET[0]['idPrograma'],':f'=>$_GET[0]['idFuente']));
                 $command=Yii::app()->db->createCommand();
                 $pro=$command->delete('cs_proyecto_municipio','idProyecto=:p and idMunicipio=:m and idDepartamento=:d',array(':p'=>$_GET[0]['pro'],':m'=>$_GET[0]['mun'],':d'=>$_GET[0]['dep']));
                $this->actionUpdate($_GET[0]['pro']);
            } catch (Exception $ex) {
               $model->addError(null, $ex->getMessage());
            }
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		  
		  if (Yii::app()->user->getName()=='admin') {
			  $dataProvider=new CActiveDataProvider('Proyecto');
		  }
		  else {
			  $dataProvider=new CActiveDataProvider('Proyecto', array(
                    'criteria'=>array(
                    'condition'=>'estado != "PUBLICADO"',
                    ),    
                ));
		  };
		  /*
		  if (!Yii::app()->user->isGuest) {
                $dataProvider=new CActiveDataProvider('Proyecto', array(
                    'criteria'=>array(
                    'condition'=>'estado !="PUBLICADO"',
                    ),    
                ));
            }
            else {
                $dataProvider=new CActiveDataProvider('Proyecto', array(
                    'criteria'=>array(
                    'condition'=>'estado ="PUBLICADO"',
                    ),    
                ));
           }      
			*/
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
    	$model=new Proyecto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proyecto']))
			$model->attributes=$_GET['Proyecto'];
		
		$records=  Proyecto::model()->findAll();
        $this->render('admin',array(
                    'model'=>$model,'records'=>$records
                ));
		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Proyecto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Proyecto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Proyecto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='proyecto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionAjaxDatosprograma()
	{
              // var_dump($_POST) ;
              if(isset($_POST['id']))
		{
                 $data=Programa::model()->findByPk($_POST['id']);
                 $this->np=array('nombre'=>$data->nombreprograma,
                     'sector'=>$data->sector);             
		}
                $this->renderPartial('resultado',array('datos'=>$this->np)) ;
                 Yii::app()->end();
             
	}
       public function actionAjaxubicacion()
	{
              // var_dump($_POST) ;
              if(isset($_POST['id']))
		{
                 $data=Ubicacionvial::model()->findByPk($_POST['id']);
                 $x=$data->attributes;             
     		}
                //echo CJavaScript::jsonEncode($data);
                 //echo CJSON::encode($data);
               $this->renderPartial('resultadojson',array('datos'=>$x), false, true) ;
               // echo json_encode(array('reg'=>  $this->np['region'],'tra'=> $this->np['tramo']));
               //  Yii::app()->end();
             
	}
        
    public function actionAjaxMunicipios()
	{
              if(isset($_POST['id']))
		{
                  $data=Municipio::model()->findAll('depto=:dep',array(':dep'=>$_POST['id']));
                  $data=CHtml::listData($data,'municipio','municipio');          		
               }
                $this->renderPartial('resultadomuni',array('datos'=>$data)) ;  
	}
        
      public function actionDatosBeneficiario()
        {
            $b=Beneficiario::model()->findByPk($_POST['id']);
            $d=$b['attributes']['depto'];
            $m=$b['attributes']['muni'];
            $dp=  Departamento::model()->findByPk($d);
            $mun=  Municipio::model()->find('depto=:d and id=:m',array(':d'=>$d,':m'=>$m));;
            echo '<p>'.$dp['attributes']['departamento'].'</p>';
            echo '<p>'.$mun['attributes']['municipio'].'</p>';
        }
          public function actionDatosBeneficiarioDepto()
        {
            $mun=Beneficiario::model()->listaBeneficiariosDep($_POST['id']);
            $this->renderPartial('resultadobeneficiario',array('datos'=>$mun), false, true) ;
        }
         public function actionDeleteFuenteGet()
	{  //$data=Municipio::model()->findAll('depto=:dep',array(':dep'=>$_POST['id']));
            try {
                 //$d= ProgramaFuente::model()->findAll('idPrograma=:p and idFuente=:f',array(':p'=>$_GET[0]['idPrograma'],':f'=>$_GET[0]['idFuente']));
                 $command=Yii::app()->db->createCommand();
                 $pro=$command->delete('cs_proyecto_fuente','idProyecto=:p and idFuente=:f',array(':p'=>$_GET[0]['idProyecto'],':f'=>$_GET[0]['idFuente']));
                 $this->actionUpdate($_GET[0]['idProyecto']);
            } catch (Exception $ex) {
               $model->addError(null, $ex->getMessage());
            }

	}
         public function nombreFuente($p) {
            $dt=Fuentesfinan::model()->findByPk($p);
            return $dt->fuente;
        }
        
          public function nombreMoneda($m) {
            $dt=  Monedas::model()->findByPk($m);
            return $dt->moneda;
        }
        public function abreviaturaFuente($p) {
           $criteria = new CDbCriteria;
            $criteria->select='Max(monto) as monto,idFuente';
            $criteria->condition='idPrograma=:searchTxt';
            $criteria->params=array(':searchTxt'=>$p);
            $criteria->order ='monto DESC';
            $pfuent = ProgramaFuente::model()->find($criteria);
            $dt=Fuentesfinan::model()->findByPk(array($pfuent['attributes']['idFuente']));
            return $dt['attributes']['abreviatura'];
        }
		          //Funciones para la impresion 
          public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
              
             if(isset($session['Empleado_records']))
               {
                $model=$session['Empleado_records'];
               }   
               else
				 
                 $model = Proyecto::model()->findAll();    
				 //$model = Programa::model()->find('programa'=$model->programa');  
				   
		Yii::app()->request->sendFile(date('YmdHis').'.xls',
			$this->renderPartial('excelReport', array(
				'model'=>$model
			), true) 
		);
	} 
        public function actionGeneratePdf() 
	{
           $session=new CHttpSession; 
           $session->open();
		//Yii::import('application.modules.admin.extensions.giiplus.bootstrap.*');
		//require_once('tcpdf/tcpdf.php');
		//require_once('tcpdf/config/lang/eng.php');
                
                 $model = Proyecto::model()->findAll();

		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		$pdf = Yii::createComponent('application.extensions.MPDF56.mpdf');
		$pdf= new mPDF();
        $pdf->WriteHTML($html);
         $nom="Programia_".date("d-m-Y").".pdf";
        $url=Yii::app()->baseUrl . '/'.$nom;
         //$url=Yii::app()->basePath."/images/".$nom;
        $pdf->Output($nom,"F");              
        echo '<a href='.$url.'>Descargar Reporte </a>';
                Yii::app()->end();
	}
        
       
}
