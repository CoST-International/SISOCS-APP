<?php

class AdjudicacionController extends Controller
{
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
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','Search','Proceso','GeneratePdf','GenerateExcel'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','create','update','profile'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete','profile'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $model = new Adjudicacion;
        
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        
        if (isset($_POST['Adjudicacion'])) {
        
            $model->attributes = $_POST['Adjudicacion'];
            
            if ($model->save()) {
                
                $id = $model->idAdjudicacion;
                $dir = Yii::app()->controller->getPath('webroot.adjuntos', 4, $id);
                
                /* if ($model->validate(array('image1'))) {
                    echo 'image1';
                    $image1 = CUploadedFile::getInstance($model, 'image1');
                } else { $image1 = ''; }
                if ($model->validate(array('image2'))) {
                    echo 'image2'; $image2 = CUploadedFile::getInstance($model, 'image2');
                } else { $image2 = ''; }
                if ($model->validate(array('image3'))) {
                    echo 'image3'; $image3 = CUploadedFile::getInstance($model, 'image3');
                } else { $image3 = ''; }
                if ($model->validate(array('image4'))) {
                    echo 'image4'; $image4 = CUploadedFile::getInstance($model, 'image4');
                } else { $image4 = ''; }  */
                        
                $image1 = CUploadedFile::getInstance($model, 'image1');
                $image2 = CUploadedFile::getInstance($model, 'image2');
                $image3 = CUploadedFile::getInstance($model, 'image3');
                $image4 = CUploadedFile::getInstance($model, 'image4');
                
                if (strlen($image1) > 0) {
                    $uploaded = $image1->saveAs($dir . '/' . $image1->getName());
                    $model->actaaper = Yii::app()->Controller->getURL($dir.'/'.$image1->getName());
                    $uploaded = true;
                }
                if (strlen($image2) > 0) {
                    $uploaded = $image2->saveAs($dir . '/' . $image2->getName());
                    $model->informeacta = Yii::app()->Controller->getURL($dir.'/'.$image2->getName());
                    $uploaded = true;
                }
                if (strlen($image3) > 0) {
                    $uploaded = $image3->saveAs($dir . '/' . $image3->getName());
                    $model->resoladju = Yii::app()->Controller->getURL($dir.'/'.$image3->getName());
                    $uploaded = true;
                }
                if (strlen($image4) > 0) {
                    $uploaded = $image4->saveAs($dir . '/' . $image4->getName());
                    $model->otro = Yii::app()->Controller->getURL($dir.'/'.$image4->getName());
                    $uploaded = true;
                }
                if ($model->save(false)) {
                    $this->mandarCorreo(4, $model->idAdjudicacion);
                    $this->redirect(array('view', 'id' => $model->idAdjudicacion));
                }
                
                $model->save();
                $this->mandarCorreo(4, $model->idAdjudicacion);
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{	
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);
        
        if (isset($_POST['Adjudicacion'])) {
            
            $model->attributes = $_POST['Adjudicacion'];
            
            $dir = Yii::app()->controller->getPath('webroot.adjuntos',4,$id);
            $enlace = Yii::app()->controller->getURL($dir);
            
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
            } else { $image4 = ''; } */
                    
            $image1 = CUploadedFile::getInstance($model, 'image1');
            $image2 = CUploadedFile::getInstance($model, 'image2');
            $image3 = CUploadedFile::getInstance($model, 'image3');
            $image4 = CUploadedFile::getInstance($model, 'image4'); 
            
            if (strlen($image1) > 0) {
                if($image1->saveAs($dir . '/' . $image1->getName())) {
                    $model->actaaper = $enlace . '/' . $image1->getName();
                }
            }
            if (strlen($image2) > 0) {
                if($image2->saveAs($dir . '/' . $image2->getName())) {
                    $model->informeacta = $enlace . '/' . $image2->getName();
                }
            }
            if (strlen($image3) > 0) {
                if($image3->saveAs($dir . '/' . $image3->getName())) {
                    $model->resoladju = $enlace . '/' . $image3->getName();
                }
            }
            if (strlen($image4) > 0) {
                if($image4->saveAs($dir . '/' . $image4->getName())) {
                    $model->otro = $enlace . '/' . $image4->getName();
                }
            }
            
            if ($model->save()) {
                $this->mandarCorreo(4, $model->idAdjudicacion);
                $this->redirect(array('view', 'id' => $model->idAdjudicacion));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
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

	/**
	 * Lists all models.
	 */
	public function actionIndex2()
	{
		
                  if (!Yii::app()->user->isGuest) {
             //$dataProvider=new CActiveDataProvider('Adjudicacion');
                $dataProvider=new CActiveDataProvider('Adjudicacion', array(
                    'criteria'=>array(
                    'condition'=>'estado !="PUBLICADO"',
                    ),    
                ));
            }
            else {
                $dataProvider=new CActiveDataProvider('Adjudicacion', array(
                    'criteria'=>array(
                    'condition'=>'estado ="PUBLICADO"',
                    ),    
                ));
           }    
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
     $dataProvider=new CActiveDataProvider('Adjudicacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new Adjudicacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Adjudicacion']))
			$model->attributes=$_GET['Adjudicacion'];
		
		$records=  Adjudicacion::model()->findAll();
		
		$this->render('admin',array(
			'model'=>$model, 'records'=>$records
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Adjudicacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Adjudicacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Adjudicacion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='adjudicacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSearch()
    {
       /* $model = $this->loadModel($_POST['idAdjudicacion']);
        $items = array(
            'ncontrato'=>date('Y-m')."/".$model->idAdjudicacion,
        );
        echo CJSON::encode($items);*/
		
		 $model = $this->loadModel($_POST['idAdjudicacion']);
        
        $resultX=  Yii::app()->db->createCommand()
                                           ->select('*')
                                           ->from('v_idmetodo_poridadjudicacion')
                                           ->where('idAdjudicacion=:id',array(':id'=>$_POST['idAdjudicacion']))										   
                                           ->queryRow();
        
         $IdMetodoAdquisicion = $resultX['idmetodo'];
        
        
        $items = array(
            'ncontrato' => date('Y-m') . "/" . $model->idAdjudicacion,
            'idmetodo'=> $IdMetodoAdquisicion,
        );
        echo CJSON::encode($items);
		
    }

    public function actionProceso()
    {
       	$model = Calificacion::Model()->findBySQL("Select * FROM cs_calificacion WHERE numproceso ='".$_POST['numproceso']."'");
       	$model = Calificacion::Model()->findByPk($_POST['idCalificacion']);
       	$item = array(
       	    'numproceso'=>$model->numproceso,
       	    'nompro'=>$model->nomprocesoproyecto,
       	    'nummet'=>$model->idmetodo,
       	);
       echo CJSON::encode($item);
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
				 
                 $model = Adjudicacion::model()->findAll();    
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
                
                 $model = Adjudicacion::model()->findAll();

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