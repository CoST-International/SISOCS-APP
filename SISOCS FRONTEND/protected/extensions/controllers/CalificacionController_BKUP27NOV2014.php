<?php

class CalificacionController extends Controller
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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','ViewDetempresa','ViewDetoferentes','ViewDetfirmas','DeleteGet','GeneratePdf','GenerateExcel'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','profile'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','profile'),
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
        public function actionViewDetempresa()
	{
            $mf= CalificacionEmpresa::model()->findAll('idcalificacion=:ca',array(':ca'=>$_GET['id']));
            //$mf=(count($mf)>0)?$mf:$mf->attributeLabels();
            $list=CHtml::listData($mf,'idcalificacion','idcalificacion');
            $f=new CalificacionEmpresa;
            $a=$f->attributeLabels();
		echo '
            <div class="view">
                    <table>
                    <tr>
                        <th>'.$a['idcalificacion'].'</th>
                        <th>'.$a['idempresa'].'</th>
                        <th></th>
                    </tr>';
                //numero de columnas o celdas
                $cd=(count($list)>0)?count($list):0;                
                    if ($cd>0) {
                            foreach ($mf as $v) {
                               echo '<tr>';
                               echo '<td>'.$v->idcalificacion.'</td>';
                               echo '<td>'.  $this->obtenerNombre($v->idempresa).'</td>';
                             // echo '<td>'.CHtml::link('Eliminar','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'));
                             echo '<td>'.CHtml::link('Eliminar',array('calificacion/DeleteGet',array('cal'=>$v->idcalificacion,'id'=>$v->idempresa,'tabla'=>'cs_calificacion_empresa')),array('class'=>'del'));//, 'confirm' => 'Esta seguro de quitar el registro?
                                     echo '</tr>';
                               }   
                    }

                       echo '
                    </table>
              </div>        
            ';
	}
        public function actionViewDetoferentes()
	{
            $mf= CalificacionOferente::model()->findAll('idcalificacion=:ca',array(':ca'=>$_GET['id']));
            //$mf=(count($mf)>0)?$mf:$mf->attributeLabels();
            $list=CHtml::listData($mf,'idcalificacion','idcalificacion');
            $f=new CalificacionOferente;
            $a=$f->attributeLabels();
		echo '
            <div class="view">
                    <table>
                    <tr>
                        <th>'.$a['idcalificacion'].'</th>
                        <th>'.$a['idoferente'].'</th>
                        <th></th>
                    </tr>';
                //numero de columnas o celdas
                $cd=(count($list)>0)?count($list):0;                
                    if ($cd>0) {
                            foreach ($mf as $v) {
                               echo '<tr>';
                               echo '<td>'.$v->idcalificacion.'</td>';
                               echo '<td>'.  $this->obtenerNombre($v->idoferente).'</td>';
                             // echo '<td>'.CHtml::link('Eliminar','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'));
                             echo '<td>'.CHtml::link('Eliminar',array('calificacion/DeleteGet',array('cal'=>$v->idcalificacion,'id'=>$v->idoferente,'tabla'=>'cs_calificacion_oferente')),array('class'=>'del'));//, 'confirm' => 'Esta seguro de quitar el registro?
                                     echo '</tr>';
                               }   
                    }

                       echo '
                    </table>
              </div>        
            ';
	}
        public function actionViewDetfirmas()
	{
            $mf= CalificacionFirma::model()->findAll('idcalificacion=:ca',array(':ca'=>$_GET['id']));
            //$mf=(count($mf)>0)?$mf:$mf->attributeLabels();
            $list=CHtml::listData($mf,'idcalificacion','idcalificacion');
            $f=new CalificacionFirma;
            $a=$f->attributeLabels();
		echo '
            <div class="view">
                    <table>
                    <tr>
                        <th>'.$a['idcalificacion'].'</th>
                        <th>'.$a['idfirma'].'</th>
                        <th></th>
                    </tr>';
                //numero de columnas o celdas
                $cd=(count($list)>0)?count($list):0;                
                    if ($cd>0) {
                            foreach ($mf as $v) {
                               echo '<tr>';
                               echo '<td>'.$v->idcalificacion.'</td>';
                               echo '<td>'.  $this->obtenerNombre($v->idfirma).'</td>';
                             // echo '<td>'.CHtml::link('Eliminar','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'));
                           echo '<td>'.CHtml::link('Eliminar',array('calificacion/DeleteGet',array('cal'=>$v->idcalificacion,'id'=>$v->idfirma,'tabla'=>'cs_calificacion_firma')),array('class'=>'del'));//, 'confirm' => 'Esta seguro de quitar el registro?
                                     echo '</tr>';
                               }   
                    }

                       echo '
                    </table>
              </div>        
            ';
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Calificacion;
                
                $this->performAjaxValidation($model);
                
                if(isset($_POST['Calificacion']))  {
                    
                    $model->attributes=$_POST['Calificacion'];
                    
                    if ($model->save()) {
                        
                        $id=$model->idCalificacion;
                        
                        $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 3, $id);
                        
                        $image1=CUploadedFile::getInstance($model,'image1');
                        $image2=CUploadedFile::getInstance($model,'image2');
                        $image3=CUploadedFile::getInstance($model,'image3');
                        $image4=CUploadedFile::getInstance($model,'image4');
                        $image5=CUploadedFile::getInstance($model,'image5');
                        $image6=CUploadedFile::getInstance($model,'image6');
                        $image7=CUploadedFile::getInstance($model,'image7');
                        $image8=CUploadedFile::getInstance($model,'image8');
                        $image9=CUploadedFile::getInstance($model,'image9');

                        if (strlen($image1)>0){
                           if ($image1->saveAs($dir.'/'.$image1->getName())) {
                               $model->invitainter=  Yii::app()->Controller->getURL($dir.'/'.$image1->getName());
                           }
                        }
                        if (strlen($image2)>0){
                           if ($image2->saveAs($dir.'/'.$image2->getName())) {
                               $model->basespreca=  Yii::app()->Controller->getURL($dir.'/'.$image2->getName());
                           }
                        }
                        if (strlen($image3)>0){
                           if ($image3->saveAs($dir.'/'.$image3->getName())) {
                               $model->resolucion=  Yii::app()->Controller->getURL($dir.'/'.$image3->getName());
                           }
                        }
                        if (strlen($image4)>0){
                           if ($image4->saveAs($dir.'/'.$image4->getName())) {
                               $model->nombreante=  Yii::app()->Controller->getURL($dir.'/'.$image4->getName());
                           }
                        }
                        if (strlen($image5)>0){
                           if ($image5->saveAs($dir.'/'.$image5->getName())) {
                               $model->convocainvi=  Yii::app()->Controller->getURL($dir.'/'.$image5->getName());
                           }
                        }
                        if (strlen($image6)>0){
                           if ($image6->saveAs($dir.'/'.$image6->getName())) {
                               $model->tdr=  Yii::app()->Controller->getURL($dir.'/'.$image6->getName());
                           }
                        }
                        if (strlen($image7)>0){
                           if ($image7->saveAs($dir.'/'.$image7->getName())) {
                               $model->aclaraciones=  Yii::app()->Controller->getURL($dir.'/'.$image7->getName());
                           }
                        }
                        if (strlen($image8)>0){
                           if ($image8->saveAs($dir.'/'.$image8->getName())) {
                               $model->actarecpcion=  Yii::app()->Controller->getURL($dir.'/'.$image8->getName());
                           }
                        }
                        if (strlen($image9)>0){
                           if ($image9->saveAs($dir.'/'.$image9->getName())) {
                               $model->otro2=  Yii::app()->Controller->getURL($dir.'/'.$image9->getName());
                           }
                        }
                        
                        $this->mandarCorreo(3, $model->idCalificacion);
                        $this->redirect(array('update','id'=>$model->idCalificacion));//view
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

		if(isset($_POST['Calificacion']))  {
                    
                    $model->attributes=$_POST['Calificacion'];
                    
                    if ($model->save()) {
                        
                        $id=$model->idCalificacion;
                        
                        $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 3, $id);
                        
                        $image1=CUploadedFile::getInstance($model,'image1');
                        $image2=CUploadedFile::getInstance($model,'image2');
                        $image3=CUploadedFile::getInstance($model,'image3');
                        $image4=CUploadedFile::getInstance($model,'image4');
                        $image5=CUploadedFile::getInstance($model,'image5');
                        $image6=CUploadedFile::getInstance($model,'image6');
                        $image7=CUploadedFile::getInstance($model,'image7');
                        $image8=CUploadedFile::getInstance($model,'image8');
                        $image9=CUploadedFile::getInstance($model,'image9');

                        if (strlen($image1)>0){
                           if ($image1->saveAs($dir.'/'.$image1->getName())) {
                               $model->invitainter=  Yii::app()->Controller->getURL($dir.'/'.$image1->getName());
                           }
                        }
                        if (strlen($image2)>0){
                           if ($image2->saveAs($dir.'/'.$image2->getName())) {
                               $model->basespreca=  Yii::app()->Controller->getURL($dir.'/'.$image2->getName());
                           }
                        }
                        if (strlen($image3)>0){
                           if ($image3->saveAs($dir.'/'.$image3->getName())) {
                               $model->resolucion=  Yii::app()->Controller->getURL($dir.'/'.$image3->getName());
                           }
                        }
                        if (strlen($image4)>0){
                           if ($image4->saveAs($dir.'/'.$image4->getName())) {
                               $model->nombreante=  Yii::app()->Controller->getURL($dir.'/'.$image4->getName());
                           }
                        }
                        if (strlen($image5)>0){
                           if ($image5->saveAs($dir.'/'.$image5->getName())) {
                               $model->convocainvi=  Yii::app()->Controller->getURL($dir.'/'.$image5->getName());
                           }
                        }
                        if (strlen($image6)>0){
                           if ($image6->saveAs($dir.'/'.$image6->getName())) {
                               $model->tdr=  Yii::app()->Controller->getURL($dir.'/'.$image6->getName());
                           }
                        }
                        if (strlen($image7)>0){
                           if ($image7->saveAs($dir.'/'.$image7->getName())) {
                               $model->aclaraciones=  Yii::app()->Controller->getURL($dir.'/'.$image7->getName());
                           }
                        }
                        if (strlen($image8)>0){
                           if ($image8->saveAs($dir.'/'.$image8->getName())) {
                               $model->actarecpcion=  Yii::app()->Controller->getURL($dir.'/'.$image8->getName());
                           }
                        }
                        if (strlen($image9)>0){
                           if ($image9->saveAs($dir.'/'.$image9->getName())) {
                               $model->otro2=  Yii::app()->Controller->getURL($dir.'/'.$image9->getName());
                           }
                        }
                        
                        $model->save();
                        $this->mandarCorreo(3, $model->idCalificacion);
                        $this->redirect(array('view','id'=>$model->idCalificacion));//view
                    }
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
        
        public function actionDeleteGet()
	{  //$data=Municipio::model()->findAll('depto=:dep',array(':dep'=>$_POST['id']));
            try {
				
                 //$d= ProgramaFuente::model()->findAll('idcalificacion=:p and '..'=:f',array(':p'=>$_GET[0]['idPrograma'],':f'=>$_GET[0]['idFuente']));
                 $command=Yii::app()->db->createCommand();
                 $t=$_GET[0]['tabla'];
                 $c="";
                 switch ($t){
                 case "cs_calificacion_empresa":
                        $c="idempresa";
                     break;
                 case "cs_calificacion_firma":
                        $c="idfirma";
                     break;
                 case "cs_calificacion_oferente":
                        $c="idoferente";
                     break;
                 }
                 $cond='idcalificacion=:c and '.$c.'=:id';
                 $pro=$command->delete($t,$cond,array(':c'=>$_GET[0]['cal'],':id'=>$_GET[0]['id']));
                 $this->actionUpdate($_GET[0]['cal']);
            } catch (Exception $ex) {
               //$model->addError(null, $ex->getMessage());
            }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex2()
	{
		$dataProvider=new CActiveDataProvider('Calificacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Calificacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
    }

    public function actionAdmin()
    {
        $records=  Calificacion::model()->findAll();
        $this->render('admin',array(
            'records'=>$records,
        ));
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Calificacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Calificacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Calificacion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='calificacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        private function obtenerNombre($x)
        {
            $dat=Empresa::model()->findByPk($x);
            $r= (count($dat)>0?$dat['attributes']['nombre_empresa']:"");
            return $r;
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
				 
                 $model = Calificacion::model()->findAll();    
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
                
                 $model = Calificacion::model()->findAll();

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
