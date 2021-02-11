<?php

class ProgramaController extends Controller
{
             public $programafuente="";
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
//			//array(array('CrugeAccessControlFilter')),
//		);
            return array('accessControl',array('CrugeAccessControlFilter'),);
            // return array(array('CrugeAccessControlFilter'));
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
	
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'ListaSubsector', 'ListaFuncionario',
                    'ViewDet', 'DeleteGet', 'ViewDetpropositos', 'DeleteGetproposito', 'ListaEstados',
                    'GeneratePdf', 'GenerateExcel'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update','admin', 'delete'), //agregue delete
                'users' => array('@')
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
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
	
	public function getEnlaceVacio($url,$href){
        
        if(strlen($href)>10){
            $enlace=$url;
        }
        else{
            $enlace="No Aplica";
        }
 
        return $enlace;
    }
    
      
    public function actionViewDet($id, $event)
	{
        $mf= ProgramaFuente::model()->findAll('idPrograma=:pf',array(':pf'=>$id));
        $this->renderpartial('_filas',array('datos'=>$mf, 'evento'=>$event));           
	}
        
    public function actionViewDetpropositos($id, $event)
	{
            $mp= ProgramaProposito::model()->findAll('idprograma=:en',array(':en'=>$id));
            $this->renderpartial('_filasproposito',array('datos'=>$mp,'evento'=>$event));
	}
        
       public function actionListaEstados()
        {
            $dat= Estado::model()->findAll();
            $list = CHtml::listData($dat,'estado', 'estado');
            return $list ;
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
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $model=new Programa;

        $this->performAjaxValidation($model);
            
        if(isset($_POST['Programa'])) {
    
            $model->attributes=$_POST['Programa'];
            
            if ($model->save()) {
                
                $id=$model->idPrograma;

                $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 1, $id);
                
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
                } else { $image6 = ''; } */
                
                $image1=CUploadedFile::getInstance($model,'image1');
                $image2=CUploadedFile::getInstance($model,'image2');
                $image3=CUploadedFile::getInstance($model,'image3');
                $image4=CUploadedFile::getInstance($model,'image4');
                $image5=CUploadedFile::getInstance($model,'image5');
                $image6=CUploadedFile::getInstance($model,'image6');

                if (strlen($image1)>0){
                   if ($image1->saveAs($dir.'/'.$image1->getName())) {
                       $model->cartaconvenio=  Yii::app()->Controller->getURL($dir.'/'.$image1->getName());
                   }
                }
                if (strlen($image2)>0){
                   if ($image2->saveAs($dir.'/'.$image2->getName())) {
                       $model->otro1=  Yii::app()->Controller->getURL($dir.'/'.$image2->getName());
                   }
                }
                if (strlen($image3)>0){
                   if ($image3->saveAs($dir.'/'.$image3->getName())) {
                       $model->planope=  Yii::app()->Controller->getURL($dir.'/'.$image3->getName());
                   }
                }
                if (strlen($image4)>0){
                   if ($image4->saveAs($dir.'/'.$image4->getName())) {
                       $model->presupuesto=  Yii::app()->Controller->getURL($dir.'/'.$image4->getName());
                   }
                }
                if (strlen($image5)>0){
                   if ($image5->saveAs($dir.'/'.$image5->getName())) {
                       $model->perfildelprogra=  Yii::app()->Controller->getURL($dir.'/'.$image5->getName());
                   }
                }
                if (strlen($image6)>0){
                   if ($image6->saveAs($dir.'/'.$image6->getName())) {
                       $model->otro2=  Yii::app()->Controller->getURL($dir.'/'.$image6->getName());
                   }
                }
                
                $model->save();
                $this->mandarCorreo(1, $model->idPrograma);
                $this->redirect(array('update','id'=>$model->idPrograma));		
            }
        }
        
        $this->render('create',array(
        'model'=>$model,'programafuente'=> $this->programafuente));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $modelFuente = ProgramaFuente::model()->findAll("idPrograma = $id");
        $modelProposito = ProgramaProposito::model()->findAll("idPrograma = $id");
        
		$this->performAjaxValidation($model);
                
        if(isset($_POST['Programa'])) {

            $model->attributes=$_POST['Programa'];

            if ($model->save()) {

                $id=$model->idPrograma;

                $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 1, $id);
                
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
                } else { $image6 = ''; } */
                
                $image1=CUploadedFile::getInstance($model,'image1');
                $image2=CUploadedFile::getInstance($model,'image2');
                $image3=CUploadedFile::getInstance($model,'image3');
                $image4=CUploadedFile::getInstance($model,'image4');
                $image5=CUploadedFile::getInstance($model,'image5');
                $image6=CUploadedFile::getInstance($model,'image6');
                
                if (strlen($image1)>0){
                   if ($image1->saveAs($dir.'/'.$image1->getName())) {
                       $model->cartaconvenio=  Yii::app()->Controller->getURL($dir.'/'.$image1->getName());
                   }
                }
                if (strlen($image2)>0){
                   if ($image2->saveAs($dir.'/'.$image2->getName())) {
                       $model->otro1=  Yii::app()->Controller->getURL($dir.'/'.$image2->getName());
                   }
                }
                if (strlen($image3)>0){
                   if ($image3->saveAs($dir.'/'.$image3->getName())) {
                       $model->planope=  Yii::app()->Controller->getURL($dir.'/'.$image3->getName());
                   }
                }
                if (strlen($image4)>0){
                   if ($image4->saveAs($dir.'/'.$image4->getName())) {
                       $model->presupuesto=  Yii::app()->Controller->getURL($dir.'/'.$image4->getName());
                   }
                }
                if (strlen($image5)>0){
                   if ($image5->saveAs($dir.'/'.$image5->getName())) {
                       $model->perfildelprogra=  Yii::app()->Controller->getURL($dir.'/'.$image5->getName());
                   }
                }
                if (strlen($image6)>0){
                   if ($image6->saveAs($dir.'/'.$image6->getName())) {
                       $model->otro2=  Yii::app()->Controller->getURL($dir.'/'.$image6->getName());
                   }
                }
                
                $model->save();
                $this->mandarCorreo(1, $model->idPrograma);
                $this->redirect(array('view','id'=>$model->idPrograma));		
            }
        };
        

        $this->render('update', array(
            'model'=>$model, 'Fuente'=>$modelFuente, 'Proposito'=>$modelProposito,
        ));
	}
        
//        protected function afterSave(){
//            parent::afterSave();
//            $this->mandarCorreo(1, $model->idPrograma);
//            //$profile->errors();
//            return  parent::afterSave();;
//        }
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $r=Programa::model()->findByPk($id);
            //$list = CHtml::listData($r,'idPrograma', 'estado');
            if ($r['attributes']['estado']!="PUBLICADO") {
                $this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                    }else {
                     //echo  Yii::app()->user->setFlash('error','No se pueden elimnar Programas Publicados, consulte al Webmaster.');
                    //$model->addError(null,"No se pueden elimnar Programas Publicados, consulte al Webmaster.");    
                    $this->redirect( $_POST['returnUrl']);
                }
		
	}
        
        public function actionDeleteGet()
	{  //$data=Municipio::model()->findAll('depto=:dep',array(':dep'=>$_POST['id']));
            try {
                 //$d= ProgramaFuente::model()->findAll('idPrograma=:p and idFuente=:f',array(':p'=>$_GET[0]['idPrograma'],':f'=>$_GET[0]['idFuente']));
                 $command=Yii::app()->db->createCommand();
                 $pro=$command->delete('cs_programa_fuente','idPrograma=:p and idFuente=:f',array(':p'=>$_GET[0]['idPrograma'],':f'=>$_GET[0]['idFuente']));
                 $this->actionUpdate($_GET[0]['idPrograma']);
            } catch (Exception $ex) {
               $model->addError(null, $ex->getMessage());
            }

	}
            
    public function actionDeleteGetproposito()
	{  //$data=Municipio::model()->findAll('depto=:dep',array(':dep'=>$_POST['id']));
            try {
                 //$d= ProgramaFuente::model()->findAll('idPrograma=:p and idFuente=:f',array(':p'=>$_GET[0]['idPrograma'],':f'=>$_GET[0]['idFuente']));
                 $command=Yii::app()->db->createCommand();
                 $pro=$command->delete('cs_programa_proposito','idprograma=:p and idproposito=:f',array(':p'=>$_GET[0]['idprograma'],':f'=>$_GET[0]['idproposito']));
                            
                 $this->actionUpdate($_GET[0]['idprograma']);
            } catch (Exception $ex) {
               $model->addError(null, $ex->getMessage());
            }

	}
	/**
	 * Lists all models.
	 */
	public function actionIndex2()
	{  
             if (!Yii::app()->user->isGuest) {
             //$dataProvider=new CActiveDataProvider('Programa');
                $dataProvider=new CActiveDataProvider('Programa', array(
                    'criteria'=>array(
                    'condition'=>'estado !="PUBLICADO"',
                    ),    
                ));
            }
            else {
                $dataProvider=new CActiveDataProvider('Programa', array(
                    'criteria'=>array(
                    'condition'=>'estado ="PUBLICADO"',
                    ),    
                ));
           }    
		$this->render('index',array(
			'dataProvider'=>$dataProvider
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
    {
       $dataProvider=new CActiveDataProvider('Programa');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));

                
        //$records = Programa::model()->findAll();
        //$this->render('admin',array(
            //'records'=>$records,
        //))
    }

    public function actionAdmin()
    {
        $model=new Programa('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Programa']))
            $model->attributes=$_GET['Programa'];

        $records = Programa::model()->findAll();
        
        $this->render('admin',array(
            'model'=>$model, 
            'records'=>$records)
        );
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Programa the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Programa::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Programa $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='programa-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
         protected function crearCodigo($cod,$fuente,$sector) {
            return $cod."-".$fuente."-".$sector;
        }
         protected function tieneFuente($cod) {
          $dat= ProgramaFuente::model()->findAll('idPrograma=:pro',array(':pro'=>$cod));
          return count($dat);
        }
        public function actionListaSubsector()
        {
            $dat= Subsector::model()->findAll('idsector=:sec',array(':sec'=>$_POST['id']));
            $list =CHtml::listData($dat,'idSubSector','subsector');
            $this->renderpartial('resultadosubcod',array('datos'=>$list,));
        }
        public function actionListaFuncionario()
        {
            $dat= Funcionarios::model()->findAll('idEnte=:en',array(':en'=>$_POST['id']));
            $list =CHtml::listData($dat,'idfuncionario','nombre');
            $this->renderpartial('resultadocod',array('datos'=>$list,));
           // Yii::app()->end();
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
				 
                 $model = Programa::model()->findAll();    
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
                
                 $model = Programa::model()->findAll();

		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		$pdf = Yii::createComponent('application.extensions.MPDF56.mpdf');
		$pdf= new mPDF();
        $pdf->WriteHTML($html);
         $nom="Programa_".date("d-m-Y").".pdf";
        $url=Yii::app()->baseUrl . '/'.$nom;
         //$url=Yii::app()->basePath."/images/".$nom;
        $pdf->Output($nom,"F");              
        echo '<a href='.$url.'>Descargar Reporte </a>';
                Yii::app()->end();
	}
        
       
}
