<?php

class ContratosController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
//		return array(
//			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
//		);
        return array('accessControl', array('CrugeAccessControlFilter'),);
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'GeneratePdf', 'GenerateExcel'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin','create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array( 'delete'),
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Contratos;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);



        if (isset($_POST['Contratos'])) {
            $model->attributes = $_POST['Contratos'];
            if ($model->save()) {
                $id = $model->idContratos;
                $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 6, $id);

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
                    if ($image1->saveAs($dir . '/' . $image1->getName())) {
                        $model->adendas = Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
                    }
                }
                if (strlen($image2) > 0) {
                    if ($image2->saveAs($dir . '/' . $image2->getName())) {
                        $model->prograactu = Yii::app()->Controller->getURL($dir . '/' . $image2->getName());
                    }
                }
                if (strlen($image3) > 0) {

                    if ($image3->saveAs($dir . '/' . $image3->getName())) {
                        $model->otro = Yii::app()->Controller->getURL($dir . '/' . $image3->getName());
                    }
                }
                if (strlen($image4) > 0) {


                    if ($image4->saveAs($dir . '/' . $image4->getName())) {
                        $model->prograini = Yii::app()->Controller->getURL($dir . '/' . $image4->getName());
                    }
                }
                $model->save();
            }

            $this->mandarCorreo(6, $model->idContratos);
            $this->redirect(array('view', 'id' => $model->idContratos));
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
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);


        if (isset($_POST['Contratos'])) {
            $model->attributes = $_POST['Contratos'];
            if ($model->save()) {
                $id = $model->idContratos;
                $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 6, $id);

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
                    if ($image1->saveAs($dir . '/' . $image1->getName())) {
                        $model->adendas = Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
                    }
                }
                if (strlen($image2) > 0) {
                    if ($image2->saveAs($dir . '/' . $image2->getName())) {
                        $model->prograactu = Yii::app()->Controller->getURL($dir . '/' . $image2->getName());
                    }
                }
                if (strlen($image3) > 0) {

                    if ($image3->saveAs($dir . '/' . $image3->getName())) {
                        $model->otro = Yii::app()->Controller->getURL($dir . '/' . $image3->getName());
                    }
                }
                if (strlen($image4) > 0) {


                    if ($image4->saveAs($dir . '/' . $image4->getName())) {
                        $model->prograini = Yii::app()->Controller->getURL($dir . '/' . $image4->getName());
                    }
                }
                $model->save();
            }
            $this->mandarCorreo(6, $model->idContratos);
            $this->redirect(array('view', 'id' => $model->idContratos));
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
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex2() {

        if (!Yii::app()->user->isGuest) {
            //$dataProvider=new CActiveDataProvider('Contratos');
            $dataProvider = new CActiveDataProvider('Contratos', array(
                        'criteria' => array(
                            'condition' => 'estado !="PUBLICADO"',
                        ),
                    ));
        } else {
            $dataProvider = new CActiveDataProvider('Contratos', array(
                        'criteria' => array(
                            'condition' => 'estado ="PUBLICADO"',
                        ),
                    ));
        }
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
         $dataProvider=new CActiveDataProvider('Contratos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
    }

    public function actionAdmin() {
        
        $model = new Contratos('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Contratos']))
            $model->attributes = $_GET['Contratos'];
        
        $records=  Contratos::model()->findAll();
        
        $this->render('admin', array(
            'model' => $model, 'records'=>$records
        ));
        
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Contratos the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Contratos::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Contratos $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contratos-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    //Funciones para la impresion 
    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Empleado_records'])) {
            $model = $session['Empleado_records'];
        }
        else
            $model = Contratos::model()->findAll();
        //$model = Programa::model()->find('programa'=$model->programa');  

        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }

    public function actionGeneratePdf() {
        $session = new CHttpSession;
        $session->open();
        //Yii::import('application.modules.admin.extensions.giiplus.bootstrap.*');
        //require_once('tcpdf/tcpdf.php');
        //require_once('tcpdf/config/lang/eng.php');

        $model = Contratos::model()->findAll();

        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        $pdf = Yii::createComponent('application.extensions.MPDF56.mpdf');
        $pdf = new mPDF();
        $pdf->WriteHTML($html);
        $nom = "Programia_" . date("d-m-Y") . ".pdf";
        $url = Yii::app()->baseUrl . '/' . $nom;
        //$url=Yii::app()->basePath."/images/".$nom;
        $pdf->Output($nom, "F");
        echo '<a href=' . $url . '>Descargar Reporte </a>';
        Yii::app()->end();
    }

}