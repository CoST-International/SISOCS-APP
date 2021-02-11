<?php

class InicioEjecucionController extends Controller
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
            return array('accessControl',array('CrugeAccessControlFilter'),);
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
				'actions'=>array('index','view','GeneratePdf','GenerateExcel'),
				'users'=>array('*'),
			),
             array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update','admin', 'ViewDetDesembolsos2', 'DeleteDesembolso'),
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

	
    public function actionViewDetDesembolsos2($id, $event)
	{
        /*
        $modelDesembolsosMontos=new DesembolsosMontos('search');
        $modelDesembolsosMontos->cod_contrato = 30;
        $this->renderpartial('_filas',array('model'=>$modelDesembolsosMontos, 'evento'=>$event));
        */
        
        $mf= DesembolsosMontos::model()->findAll(array('order'=>'desembolso', 'condition'=>'cod_contrato=:x', 'params'=>array(':x'=>$id))); //findAll('cod_contrato=:pf',array(':pf'=>$id));
        $this->renderpartial('_filas',array('datos'=>$mf, 'evento'=>$event));           
        
	}
    
    public function actionViewDetDesembolsos($id, $event)
	{
        $mf= DesembolsosMontos::model()->findAll('cod_contrato=:pf',array(':pf'=>$id));
        $this->renderpartial('_filas',array('datos'=>$mf, 'evento'=>$event));           
	}
    
    public function actionDeleteDesembolso($codigo, $cod_contrato)
	{  
            try {
                 $command=Yii::app()->db->createCommand();
                 $pro=$command->delete('cs_desembolsos_montos','codigo=:p and cod_contrato=:f',array(':p'=>$codigo,':f'=>$cod_contrato));
                 $this->actionUpdate($codigo);
            } catch (Exception $ex) {
               //$model->addError(null, $ex->getMessage());
               Yii::app()->user->setFlash('Error',$ex->getMessage());
            }

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
		$model=new InicioEjecucion;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		
		if(isset($_POST['InicioEjecucion']))
		{
			//print_r($_POST['InicioEjecucion']); echo '<HR>';
            $model->attributes=$_POST['InicioEjecucion'];
			$EstdoAvance=$model->estado_sol;
            $model->fecha_registro = date('Y-m-d');
            $model->user_registro=Yii::app()->user->id;
            $result = $model->save();
            //echo $result; echo '<hr>';
            if($result){
                //print_r($model);
                $this->mandarCorreo(7, $model->codigo);
                $this->redirect(array('view','id'=>$model->codigo));
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
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		
		if(isset($_POST['InicioEjecucion']))
		{
			$model->attributes=$_POST['InicioEjecucion'];
            if($model->save()){
                 $this->mandarCorreo(7, $model->codigo);
                 $this->redirect(array('view','id'=>$model->codigo));}	
		}
		
        $this->render('update',array(
			'model'=>$model,
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('InicioEjecucion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
        $model = new InicioEjecucion('search');
        $model->unsetAttributes();  // clear any default values
		if(isset($_GET['InicioEjecucion']))
			$model->attributes=$_GET['InicioEjecucion'];

		$records=  InicioEjecucion::model()->findAll();
		
        $this->render('admin',array(
			'model'=>$model, 'records'=>$records
		));
        
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return InicioEjecucion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=InicioEjecucion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param InicioEjecucion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='inicio-ejecucion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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
				 
                 $model = InicioEjecucion::model()->findAll();    
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
                
                 $model = InicioEjecucion::model()->findAll();

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
