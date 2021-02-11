<?php
class InicioEjecucionController extends Controller

{
    /**
     *
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     *      using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     *
     * @return array action filters
     */
    public function filters()
    {

        // return array(
        // 'accessControl', // perform access control for CRUD operations
        // 'postOnly + delete', // we only allow deletion via POST request
        // );

        return array(
            'accessControl',
            array(
                'CrugeAccessControlFilter'
            )
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'index',
                    'view',
                    'GeneratePdf',
                    'GenerateExcel'
                ) ,
                'users' => array(
                    '*'
                )
            ) ,
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update',
                    'admin',
                    'ViewDetDesembolsos',
                    'ViewDetGarantias',
                    'DeleteDesembolso',
                    'DeleteGarantias',
                    'ViewDocuments',
                    'ViewTariffs',
                    'ViewTransactions',
                    'ViewMilestone',
                    'ViewKpi',
                    'ViewKpiObs'
                ) ,
                'users' => array(
                    '@'
                )
            )

            // 'expression'=>'Yii::app()->user->checkAccess("Programas")',
            // 'roles'=>array('Programas','Proyectos'),

            ,
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(
                    'delete'
                ) ,
                'users' => array(
                    'admin'
                )
            ) ,
            array(
                'deny', // deny all users
                'users' => array(
                    '*'
                )
            )
        );
    }

    /*
    public function actionViewDetGarantias($id, $event)
    {
        $mg = new Garantias();
        $mg->unsetAttributes();
        $mg->idInicioEjecucion = $id;
        $mf = Garantias::model()->findAll(array(
            'condition' => 'idInicioEjecucion=:x',
            'params' => array(
                ':x' => $id
            )
        ));
        $this->renderpartial('_filasGarantias', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $mg
        ));
    }*/

    public function actionViewDetDesembolsos($id, $event)
    {

	$md = new DesembolsosMontos();
        $md->unsetAttributes();
        $md->idInicioEjecucion = $id;
        $mf = DesembolsosMontos::model()->findAll(array(
            'order' => 'desembolso',
            'condition' => 'idInicioEjecucion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderPartial('_filas', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    /*
    public function actionViewDetDesembolsos($id, $event)
    {
        $mf = DesembolsosMontos::model()->findAll('idInicioEjecucion=:pf', array(
            ':pf' => $id
        ));
        $this->renderpartial('_filas', array(
            'datos' => $mf,
            'evento' => $event
        ));
    }
    */
    /*
    public function actionDeleteGarantias()
    {
        try {

            // $d= ProgramaFuente::model()->findAll('idPrograma=:p and idFuente=:f',array(':p'=>$_GET[0]['idPrograma'],':f'=>$_GET[0]['idFuente']));

            $command = Yii::app()->db->createCommand();
            $pro = $command->delete('cs_garantias', 'idInicioEjecucion=:p and idGarantia=:f', array(
                ':p' => $_GET['cod_inicioEjecucion'],
                ':f' => $_GET['codigo']
            ));
            $this->actionUpdate($_GET['cod_inicioEjecucion']);
        }

        catch(Exception $ex) {
            $model->addError(null, $ex->getMessage());
        }
    }*/

    public function actionDeleteDesembolso($codigo, $cod_inicioEjecucion)
    {
        try {
            $command = Yii::app()->db->createCommand();
            $pro = $command->delete('cs_desembolsos_montos', 'idInicioEjecucion=:p and idDesembolso=:f', array(
                ':p' => $_GET['cod_inicioEjecucion'],
                ':f' => $_GET['codigo']
            ));
            $this->actionUpdate($_GET['cod_inicioEjecucion']);
        }

        catch(Exception $ex) {
            $model->addError(null, $ex->getMessage());
        }
    }

    /**
     * Displays a particular model.
     *
     * @param integer $id
     *        	the ID of the model to be displayed
     */
    public function actionView($id) {

        $criteria = new CDbCriteria;
        $criteria->condition = "idInicioEjecucion = $id";

        $model = InicioEjecucion::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'La página solicitada no existe o no tiene los permisos para verla.');


        $this->render('view', array(
            'model' => $model
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new InicioEjecucion();

        // Uncomment the following line if AJAX validation is needed

        $this->performAjaxValidation($model);
        if (isset($_POST['InicioEjecucion'])) {

            $model->attributes = $_POST['InicioEjecucion'];
			if (Yii::app()->request->getPost('InicioEjecucion')) {
				$POST_FECHAINICIO=Yii::app()->request->getPost('InicioEjecucion');
            	$fechaInicio = $POST_FECHAINICIO['fecha_inicio'];
				$model->fecha_inicio=$fechaInicio;
			}
			if (!$model->fecha_inicio) {
				$model->fecha_inicio=null;
			}
            if ($model->save()) {
                try {
                    $sql = "SELECT DISTINCT a.idProyecto FROM cs_inicio_ejecucion e JOIN cs_contratacion d ON e.idContratacion = d.idContratacion JOIN cs_adjudicacion c ON d.idAdjudicacion = c.idAdjudicacion JOIN cs_calificacion b ON c.idCalificacion = b.idCalificacion JOIN cs_proyecto a ON a.idProyecto = b.idProyecto  WHERE e.idInicioEjecucion  =".$model->idInicioEjecucion;
                    $command=Yii::app()->db->createCommand($sql);
                    $tempId=$command->queryAll();
                    Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
                } catch (Exception $e) {

                }
                $id = $model->idInicioEjecucion;
                $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 6, $id);
                $image1 = CUploadedFile::getInstance($model, 'image1');
                if (strlen($image1) > 0) {
                    if ($image1->saveAs($dir . '/' . $image1->getName())) {
                        $model->programainicial = Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
                    }
                }

                $model->usuario_creacion = Yii::app()->user->id;
                $model->fecha_creacion = date("Y-m-d H:i:s");
                if ($model->estado == "PUBLICADO") {
                    $model->usuario_publicacion = Yii::app()->user->id;
                    $model->fecha_publicacion = date("Y-m-d H:i:s");
                    // Actualiza el estado del desembolso
                    /*Yii::app()->createCommand()
                              ->update('DesembolsosMontos',
                                array('estado'=>$model->estado,
                                      'fecha_publicacion'=>$model->fecha_publicacion,
                                      'usuario_publicacion'=>$model->usuario_publicacion),
                                'idInicioEjecucion=:id', array('id'=>$model->idInicioEjecucion));
                } else {
                  // Actualiza el estado del desembolso
                  Yii::app()->createCommand()
                            ->update('DesembolsosMontos',
                              array('estado'=>$model->estado),
                              'idInicioEjecucion=:id', array('id'=>$model->idInicioEjecucion));
                    $model->usuario_publicacion = 0;*/
                }
				$model->usuario_creacion = Yii::app()->user->id;
				if ($model->estado=="PUBLICADO") {
					$model->usuario_publicacion = Yii::app()->user->id;
					$model->fecha_publicacion=date("Y-m-d H:i:s");
				}
				elseif($model->estado=="REVISIÓN"){
					$this->mandarCorreo(6,$model->idInicioEjecucion);
				}

                $model->save();

                $this->redirect(array(
                    'update',
                    'id' => $model->idInicioEjecucion
                ));
            }
        }

        $this->render('update', array(
            'model' => $model
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *        	the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed

        $this->performAjaxValidation($model);
        if (isset($_POST['InicioEjecucion'])) {
            $model->attributes = $_POST['InicioEjecucion'];
			if (Yii::app()->request->getPost('InicioEjecucion')) {
				$POST_FECHAINICIO=Yii::app()->request->getPost('InicioEjecucion');
            	$fechaInicio = $POST_FECHAINICIO['fecha_inicio'];
				$model->fecha_inicio=$fechaInicio;
			}
			if (!$model->fecha_inicio) {
				$model->fecha_inicio=null;
			}
            if ($model->save()) {
                try {
                    $sql = "SELECT DISTINCT a.idProyecto FROM cs_inicio_ejecucion e JOIN cs_contratacion d ON e.idContratacion = d.idContratacion JOIN cs_adjudicacion c ON d.idAdjudicacion = c.idAdjudicacion JOIN cs_calificacion b ON c.idCalificacion = b.idCalificacion JOIN cs_proyecto a ON a.idProyecto = b.idProyecto  WHERE e.idInicioEjecucion  =".$model->idInicioEjecucion;
                    $command=Yii::app()->db->createCommand($sql);
                    $tempId=$command->queryAll();
                    Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
                } catch (Exception $e) {

                }
                $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 6, $id);
                $image1 = CUploadedFile::getInstance($model, 'image1');
                if (strlen($image1) > 0) {
                    if ($image1->saveAs($dir . '/' . $image1->getName())) {
                        $model->programainicial = Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
                    }
                }

                if ($model->estado == "PUBLICADO") {
                    $model->usuario_publicacion = Yii::app()->user->id;
                    $model->fecha_publicacion = date("Y-m-d H:i:s");
                    // Actualiza el estado del desembolso
                    Yii::app()->db->createCommand()
                              ->update('cs_desembolsos_montos',
                                array('estado'=>$model->estado,
                                      'fecha_publicacion'=>$model->fecha_publicacion,
                                      'usuario_publicacion'=>$model->usuario_publicacion),
                                'idInicioEjecucion=:id', array('id'=>$model->idInicioEjecucion));
                }
                else {
                    // Actualiza el estado del desembolso
                    Yii::app()->db->createCommand()
                              ->update('cs_desembolsos_montos',
                                array('estado'=>$model->estado),
                                'idInicioEjecucion=:id', array('id'=>$model->idInicioEjecucion));
                    $model->usuario_publicacion = 0;
                }

				if ($model->estado=="PUBLICADO") {
					$model->usuario_publicacion = Yii::app()->user->id;
					$model->fecha_publicacion=date("Y-m-d H:i:s");
				}
				elseif($model->estado=="REVISIÓN"){
					$this->mandarCorreo(6,$model->idInicioEjecucion);
				}
                $model->save();

                //$this->mandarCorreo(6, $model->idInicioEjecucion);
                $this->redirect(array(
                    'view',
                    'id' => $model->idInicioEjecucion
                ));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id
     *        	the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $model->delete();
        try {
            $sql = "SELECT DISTINCT a.idProyecto FROM cs_inicio_ejecucion e JOIN cs_contratacion d ON e.idContratacion = d.idContratacion JOIN cs_adjudicacion c ON d.idAdjudicacion = c.idAdjudicacion JOIN cs_calificacion b ON c.idCalificacion = b.idCalificacion JOIN cs_proyecto a ON a.idProyecto = b.idProyecto  WHERE e.idInicioEjecucion  =".$model->idInicioEjecucion;
            $command=Yii::app()->db->createCommand($sql);
            $tempId=$command->queryAll();
            Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
        } catch (Exception $e) {

        }
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser

        if (!isset($_GET['ajax'])) $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
            'admin'
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new InicioEjecucion('published');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['InicioEjecucion']))
            $model->attributes = $_GET['InicioEjecucion'];
        $this->render('index', array(
            'model' => $model
        ));

    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new InicioEjecucion('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['InicioEjecucion'])) $model->attributes = $_GET['InicioEjecucion'];

        // $records=InicioEjecucion::model()->findAll();

        $this->render('admin', array(
            'model' => $model,

            // 'records' => $records

        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer $id
     *        	the ID of the model to be loaded
     * @return InicioEjecucion the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $criteria = new CDbCriteria;
        if (Yii::app()->user->isSuperAdmin) {
            $criteria->condition = "idInicioEjecucion = $id";
        }
        elseif (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
            $criteria->condition = "idInicioEjecucion = $id AND (estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÃ“N')";
        }
        else {
            $criteria->condition = "idInicioEjecucion = $id AND (estado = 'BORRADOR')";
        }

        /*
        if (!Yii::app()->user->isSuperAdmin) {
        $sql = $sql . " AND (estado = 'BORRADOR')";
        } elseif (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
        $sql = $sql . " AND (estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÃ“N')";
        }

        */
        $model = InicioEjecucion::model()->find($criteria);
        if ($model === null) throw new CHttpException(404, 'La página solicitada no existe o el registro ya esta publicado.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param InicioEjecucion $model
     *        	the model to be validated
     */
    protected
    function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'inicio-ejecucion-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    // Funciones para la impresion

    public function actionGenerateExcel()
    {
        $session = new CHttpSession();
        $session->open();
        if (isset($session['Empleado_records'])) {
            $model = $session['Empleado_records'];
        }
        else $model = InicioEjecucion::model()->findAll();

        // $model = Programa::model()->find('programa'=$model->programa');

        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
            'model' => $model
        ) , true));
    }

    public function nombreGarantias($g)
    {
        return TipoGarantias::model()->find("idTipoGarantia = $g")->nombre;
    }

    public function getEnlaceVacio($url, $href)
    {
        if (strlen($href) > 10) {
            $enlace = $url;
        }
        else {
            $enlace = "No Aplica";
        }

        return $enlace;
    }

    public function actionGeneratePdf()
    {
        $session = new CHttpSession();
        $session->open();

        // Yii::import('application.modules.admin.extensions.giiplus.bootstrap.*');
        // require_once('tcpdf/tcpdf.php');
        // require_once('tcpdf/config/lang/eng.php');

        $model = InicioEjecucion::model()->findAll();
        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
        ) , true);
        $pdf = Yii::createComponent('application.extensions.MPDF56.mpdf');
        $pdf = new mPDF();
        $pdf->WriteHTML($html);
        $nom = "Programia_" . date("d-m-Y") . ".pdf";
        $url = Yii::app()->baseUrl . '/' . $nom;

        // $url=Yii::app()->basePath."/images/".$nom;

        $pdf->Output($nom, "F");
        echo '<a href=' . $url . '>Descargar Reporte </a>';
        Yii::app()->end();
    }

    public function actionViewDocuments($id, $event)
    {

        $md = new ImplementationDocuments();
        $md->unsetAttributes();
        $md->idInicioEjecucion = $id;
        $mf = ImplementationDocuments::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idInicioEjecucion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderPartial('_filasDocumentos', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }

//++++

    public function actionViewMilestone($id, $event)
    {

        $md = new ImplementationMilestone();
        $md->unsetAttributes();
        $md->idInicioEjecucion = $id;
        $mf = ImplementationMilestone::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idInicioEjecucion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderPartial('_filasMilestone', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }

//+++++

    public function actionViewTariffs($id, $event)
    {

        $md = new Tariffs();
        $md->unsetAttributes();
        $md->idInicioEjecucion = $id;
        $mf = Tariffs::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idInicioEjecucion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderPartial('_filasTariffs', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }

    public function actionViewTransactions($id, $event)
    {

        $md = new Transactions();
        $md->unsetAttributes();
        $md->idInicioEjecucion = $id;
        $mf = Transactions::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idInicioEjecucion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderPartial('_filasTransactions', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }

    public function actionViewKpi($id, $event)
    {

        $md = new Kpi();
        $md->unsetAttributes();
        $md->idInicioEjecucion = $id;
        $mf = Kpi::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idInicioEjecucion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderPartial('_filasKpi', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }

    public function actionViewKpiObs($idKPI, $event)
    {

        $md = new KpiObservations();
        $md->unsetAttributes();
        $md->kpi_id = $idKPI;
        $mf = KpiObservations::model()->findAll(array(
            'order' => 'id',
            'condition' => 'kpi_id=:id',
            'params' => array(
                ':id' => $idKPI
            )
        ));
        $this->renderPartial('_filasKpiObs', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
}
