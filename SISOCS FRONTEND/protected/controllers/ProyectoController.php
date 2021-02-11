<?php
class ProyectoController extends Controller {
    public $np = array();
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
    public function filters() {

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
    public function accessRules() {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'index',
                    'view',
                    'Ajaxubicacion',
                    'ViewDetFuente',
                    'DeleteGet',
                    'DatosBeneficiario',
                    'AjaxDatosprograma',
                    'DatosBeneficiarioDepto',
                    'DeleteFuenteGet',
                    'GeneratePdf',
                    'GenerateExcel',
                    'Selectdos',
                    'SelecTipoAud',
                    'Selectunidad'
                ),
                'users' => array(
                    '*'
                )
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'create3',
                    'update',
                    'admin',
                    'delete',
                    'ViewDetMunicipio',
                    'ViewDetFuentesFinanciamiento',
                    'ViewDetBudgetBreakdown',
                    'ViewDetPrequalification',
                    'ViewDetPrequalification',
                    'ViewBeneficiaries',
                    'ViewMilestone',
                    'ViewDocuments',
                    'ViewForecast',
					'ViewForecastObservations'

                    // 'CargarSubSector',

                ),
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
                ),
                'users' => array(
                    'admin'
                )
            ),
            array(
                'deny', // deny all users
                'users' => array(
                    '*'
                )
            )
        );
    }

    public function actionViewDetFuente($id, $event) {
        $mf = ProyectoFuente::model()->findAll('idProyecto=:pf', array(
            ':pf' => $id
        ));
        $this->renderpartial('_filasfuente', array(
            'datos' => $mf,
            'evento' => $event
        ));
    }

    public function actionViewDetMunicipio($id, $event) {
        $sql     = 'Select * from vproyecto_beneficiario Where idproyecto = :id';
        $command = Yii::app()->db->createCommand($sql)->prepare(array(":id" =>$id));
        $mf      = $command->queryAll();
        $this->renderpartial('_filasbeneficiarios', array(
            'datos' => $mf,
            'evento' => $event
        ));

    }

    public function getEnlaceVacio($url, $href) {
        if (strlen($href) > 10) {
            $enlace = $url;
        } else {
            $enlace = "No Aplica";
        }

        return $enlace;
    }

    /**
     * Displays a particular model.
     *
     * @param integer $id
     *            the ID of the model to be displayed
     */
    public function actionView($id) {

        $criteria            = new CDbCriteria;
        $criteria->condition = "idProyecto = $id";

        $model = Proyecto::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'La página solicitada no existe o no tiene los permisos para verla.');

        $this->render('view', array(
            'model' => $model
        ));

    }

    public function actionViewDocuments($id, $event)
    {

        $md = new PlanningDocuments();
        $md->unsetAttributes();
        $md->idProyecto = $id;
        $mf = PlanningDocuments::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idProyecto=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasDocuments', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Proyecto();

        // Uncomment the following line if AJAX validation is needed

        $this->performAjaxValidation($model);
		if (!$model->fechaaprob) {
			$model->fechaaprob=null;
		}
        if (isset($_POST['Proyecto'])) {
            $model->attributes = $_POST['Proyecto'];
			$model->Proposito= Yii::app()->request->getPost('Proyecto')['Proposito'];
			$model->descambiental= Yii::app()->request->getPost('Proyecto')['descambiental'];
			$model->descreasentamiento= Yii::app()->request->getPost('Proyecto')['descreasentamiento'];

			if (!$model->fechaaprob) {
				$model->fechaaprob=null;
			}
            if ($model->save()) {
                try {
                    Yii::app()->Controller->saveMongo($model->idProyecto);
                } catch (Exception $e) {

                }

                $id  = $model->idProyecto;
				if ($model->estado=="BORRADOR") {
					$model->usuario_creacion = Yii::app()->user->id;
	                //$model->estado           = 'BORRADOR';
				}
				elseif($model->estado=="PUBLICADO"){
					$model->usuario_publicacion = Yii::app()->user->id;

				}
				else{
					$model->usuario_creacion = Yii::app()->user->id;
				}
				//$id=Yii::app()->db->createCommand("SELECT MAX(idProyecto) FROM cs_proyecto")->queryScalar();
				$model->usuario_creacion = Yii::app()->user->id;
				if ($model->estado=="PUBLICADO") {
					$model->usuario_publicacion = Yii::app()->user->id;
					$model->fecha_publicacion=date("Y-m-d H:i:s");
				}
				elseif($model->estado=="REVISIÓN"){
					$this->mandarCorreo(1,$id);
				}

                $model->save();

                $this->redirect(array(
                    'update',
                    'id' => $model->idProyecto
                ));
            }
        }
        $this->render('create', array(
            'model' => $model
        ));

    }

    public function actionCreate3($idCreate) {
        $model = new Proyecto();
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
		if (!$model->fechaaprob) {
			$model->fechaaprob=null;
		}
        if (isset($_POST['Proyecto'])) {
            $model->attributes = $_POST['Proyecto'];
            if ($model->save()) {
                $id  = $model->idProyecto;
                $model->usuario_creacion = Yii::app()->user->id;
				if ($model->estado=="PUBLICADO") {
					$model->usuario_publicacion = Yii::app()->user->id;
					$model->fecha_publicacion=date("Y-m-d H:i:s");
				}
				elseif($model->estado=="REVISIÓN"){
					$this->mandarCorreo(1,$model->idProyecto);
				}
                $model->save();
                $this->redirect(array(
                    'update',
                    'id' => $model->idProyecto
                )); // view
            }
        }
        $this->render('create', array(
            'model' => $model,
            'idCreate' => $idCreate
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *            the ID of the model to be updated
     * @param integer $eje
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $this->performAjaxValidation($model);
        $modelBudgetBreakdown= new BudgetBreakdown();
        $modelPrequalification= new Prequalification();
        $modelFuentesfinan= new Fuentesfinan();
		if (!$model->fechaaprob) {
			$model->fechaaprob=null;
		}
        if (isset($_POST['Proyecto'])) {


            $model->attributes = $_POST['Proyecto'];
			$model->Proposito= Yii::app()->request->getPost('Proyecto')['Proposito'];
			$model->descambiental= Yii::app()->request->getPost('Proyecto')['descambiental'];
			$model->descreasentamiento= Yii::app()->request->getPost('Proyecto')['descreasentamiento'];
			if (!$model->fechaaprob) {
				$model->fechaaprob=null;
			}
            if ($model->save()) {
                try {
                    Yii::app()->Controller->saveMongo($model->idProyecto);
                } catch (Exception $e) {
                     //print_r($e);
                     //echo '<hr>';
                     //Yii::log('se ve algo?', 'info', 'system.web.CController');
                     //exit();
                }


                if ($model->estado == "PUBLICADO") {
                    $model->usuario_publicacion = Yii::app()->user->id;
                    $model->fecha_publicacion   = date("Y-m-d H:i:s");
                    Yii::app()->db->createCommand()->update('cs_proyecto_municipio', array(
                        'estado' => $model->estado,
                        'fecha_publicacion' => $model->fecha_publicacion,
                        'usuario_publicacion' => $model->usuario_publicacion
                    ), 'idProyecto=:id', array(
                        ':id' => $model->idProyecto
                    ));
                    Yii::app()->db->createCommand()->update('cs_proyecto_fuente', array(
                        'estado' => $model->estado,
                        'fecha_publicacion' => $model->fecha_publicacion,
                        'usuario_publicacion' => $model->usuario_publicacion
                    ), 'idProyecto=:id', array(
                        ':id' => $model->idProyecto
                    ));

                    //Yii::app()->controller->sendSubscribeMail(1);

                } else {
                    $model->usuario_publicacion = null;
					$model->fecha_publicacion= null;
                    Yii::app()->db->createCommand()->update('cs_proyecto_municipio', array(
                        'estado' => $model->estado,
                        'fecha_creacion' => $model->fecha_creacion,
                        'usuario_creacion' => $model->usuario_creacion
                    ), 'idProyecto=:id', array(
                        ':id' => $model->idProyecto
                    ));
                    Yii::app()->db->createCommand()->update('cs_proyecto_fuente', array(
                        'estado' => $model->estado,
                        'fecha_creacion' => $model->fecha_creacion,
                        'usuario_creacion' => $model->usuario_creacion
                    ), 'idProyecto=:id', array(
                        ':id' => $model->idProyecto
                    ));
                }
				if ($model->estado=="PUBLICADO") {
					$model->usuario_publicacion = Yii::app()->user->id;
					$model->fecha_publicacion=date("Y-m-d H:i:s");
				}
				elseif($model->estado=="REVISIÓN"){
					$this->mandarCorreo(1,$model->idProyecto);
				}
                $model->save();
				//Yii::app()->controller->mc();

                $this->redirect(array(
                    'view',
                    'id' => $model->idProyecto
                ));
            }




        }

        $post=Yii::app()->request->getParam('eje');
        $iDP=Yii::app()->request->getParam('idProyecto');
        /*---------------- Guardar y Modificar BudgetBreakdown ----------------*/
        /*if (isset($_POST['BudgetBreakdown'])) {
            $modelBudgetBreakdown->unsetAttributes();
            $modelBudgetBreakdown->attributes = $_POST['BudgetBreakdown'];
            $modelBudgetBreakdown->idProyecto=$iDP;
            $budgetBreakdownValues=Yii::app()->db->createCommand("
              SELECT description, sourceParty_name, amount, currency, startDate, endDate FROM cs_budgetBreakdown WHERE idProyecto =".$id)->queryRow();
            if (empty($budgetBreakdownValues)) {
              if ($modelBudgetBreakdown->save()) {
                $this->redirect(array(
                    'create'
                ));
              }
            }
            else {
              $sql="UPDATE cs_budgetBreakdown set `idProyecto`=:idProyecto, `description`=:descripcion, `sourceParty_id`=:partyId, `amount`=:amount, `currency`=:currency, `startDate`=:startDate, `endDate`=:endDate WHERE idProyecto=:idProyecto;";

              $parameters = array(":idProyecto"=>$iDP,
                                  ":descripcion"=>$modelBudgetBreakdown->description,
                                  ":partyId"=>$modelBudgetBreakdown->sourceParty_id,
                                  ":amount"=>$modelBudgetBreakdown->amount,
                                  ":currency"=>$modelBudgetBreakdown->currency,
                                  ":startDate"=>$modelBudgetBreakdown->startDate,
                                  ":endDate"=>$modelBudgetBreakdown->endDate);

              if (Yii::app()->db->createCommand($sql)->execute($parameters)) {
                $this->redirect(array(
                    'create'
                ));
              }
            }

          }*/
        /*---------------------------------------------------------------------*/

        /*---------------- Guardar y Modificar Prequalification ----------------*/
        if (isset($_POST['Prequalification'])) {
            $modelPrequalification->unsetAttributes();
            $modelPrequalification->attributes = $_POST['Prequalification'];
            $modelPrequalification->idProyecto=$iDP;
            $modelPrequalification->eligibilityCriteria=1;
            $PrequalificationValues=Yii::app()->db->createCommand("
              SELECT `id`, `idProyecto`, `startDate`, `endDate`, `durationInDays`, `enquiryPeriod_startDate`, `enquiryPeriod_endDate`, `qualificationPeriod_startDate`, `qualificationPeriod_endDate`, `eligibilityCriteria` FROM `cs_prequalification` WHERE idProyecto = :id")->prepare(array(":id"=>$id))->queryRow();
            if (empty($PrequalificationValues)) {

              if ($modelPrequalification->save()) {
                $this->redirect(array(
                    'create'
                ));
              }
            }
            else {
              $sql="UPDATE cs_prequalification set `idProyecto`=:idProyecto, `startDate`=:startDate, `endDate`=:endDate , `durationInDays`=:durationInDays,
                   `enquiryPeriod_startDate`=:enquiryPeriod_startDate, `enquiryPeriod_endDate`=:enquiryPeriod_endDate,
                   `qualificationPeriod_startDate`=:qualificationPeriod_startDate, `qualificationPeriod_endDate`=:qualificationPeriod_endDate,
                   `eligibilityCriteria`=:eligibilityCriteria  WHERE idProyecto=:idProyecto;";

              $parameters = array(":idProyecto"=>$iDP,
                                  ":startDate"=>$modelPrequalification->startDate,
                                  ":endDate"=>$modelPrequalification->endDate,
                                  ":durationInDays"=>$modelPrequalification->durationInDays,
                                  ":enquiryPeriod_startDate"=>$modelPrequalification->enquiryPeriod_startDate,
                                  ":enquiryPeriod_endDate"=>$modelPrequalification->enquiryPeriod_endDate,
                                  ":qualificationPeriod_startDate"=>$modelPrequalification->qualificationPeriod_startDate,
                                  ":qualificationPeriod_endDate"=>$modelPrequalification->qualificationPeriod_endDate,
                                  ":eligibilityCriteria"=>$modelPrequalification->eligibilityCriteria
                                  );

              if (Yii::app()->db->createCommand($sql)->execute($parameters)) {
                $this->redirect(array(
                    'create'
                ));
              }
            }

          }
        /*---------------------------------------------------------------------*/




        $this->render('update', array(
            'model' => $model,
            'modelBudgetBreakdown'=>$modelBudgetBreakdown,
            'modelPrequalification'=>$modelPrequalification,
            'modelFuentesFinan'=>$modelFuentesfinan,
        ));

    }

    protected function obtenerSector($p) {

        // $s = Programa::model()->findByPk($p);

        return $s->sector;
    }

    public function nombreImagen($c, $i) {
        return "1_" . $c . $i;
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id
     *            the ID of the model to be deleted
     */
    public function actionDelete($id) {
        try {
			Yii::app()->controller->GuardarEliminado("cs_proyecto","idProyecto=".$id);
            $this->loadModel($id)->delete();
            try {
                Yii::app()->Controller->saveMongo($model->idProyecto);
            } catch (Exception $e) {

            }
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
                    'admin'
                ));

        }
        catch (CDbException $e) {
            if ($e->getCode() === 23000) {
                Yii::app()->user->setFlash('error', '<b>' . $e->getCode() . ':<font color="red">No se puede eliminar el registro seleccionado, existen otros elementos de informacion relacionados con este registro.<br>Asegurese de eliminar todo elemento de informacion relacionado con este registro antes de proceder a eliminarlo.</font></b>');
                $this->render('view', array(
                    'model' => $this->loadModel($id)
                ));
            } else {
                throw $e;
            }

        }
    }

    public function actionDeleteGet() {
        try {
            $command = Yii::app()->db->createCommand();
            $pro     = $command->delete('cs_proyecto_municipio', 'idProyecto=:p and idMunicipio=:m and idDepartamento=:d', array(
                ':p' => $_GET[0]['pro'],
                ':m' => $_GET[0]['mun'],
                ':d' => $_GET[0]['dep']
            ));
            $this->actionUpdate($_GET[0]['pro']);
        }

        catch (Exception $ex) {
            $model->addError(null, $ex->getMessage());
        }
    }



    /**
     * Manages all models.
     */
    public function actionAdmin() {
		$criteria = new CDbCriteria;

        if (!Yii::app()->user->isSuperAdmin) {
            $criteria->addSearchCondition('t.usuario_creacion', Yii::app()->user->id, true, 'AND');
            $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criteria->addSearchCondition('t.estado', 'REVISIÓN', true, 'OR');
            }

        }
        $model = new Proyecto('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Proyecto']))
            $model->attributes = $_GET['Proyecto'];
        $records = Proyecto::model()->findAll($criteria);
        $this->render('admin', array(
            'model' => $model,
            'records' => $records
        ));
    }

    /**
     * Lists all models. 162,161 ie
     */
    public function actionIndex() {
        $model = new Proyecto('published');
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['Proyecto']))
            $model->attributes = $_GET['Proyecto'];
        $this->render('index', array(
            'model' => $model
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer $id
     *            the ID of the model to be loaded
     * @return Proyecto the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $criteria = new CDbCriteria;
        if (Yii::app()->user->isSuperAdmin) {
            $criteria->condition = "idProyecto = $id";
        } elseif (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
            $criteria->condition = "idProyecto = $id AND (estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÓN')";
        } else {
            $criteria->condition = "idProyecto = $id AND (estado = 'BORRADOR')";
        }

        $model = Proyecto::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'La página solicitada no existe o no tiene los privilegios para verla.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param Proyecto $model
     *            the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'proyecto-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAjaxMunicipios() {
        if (isset($_POST['id'])) {
            $data = Municipio::model()->findAll('depto=:dep', array(
                ':dep' => $_POST['id']
            ));
            $data = CHtml::listData($data, 'municipio', 'municipio');
        }

        $this->renderPartial('resultadomuni', array(
            'datos' => $data
        ));
    }

    public function actionDatosBeneficiario() {
        $b   = Beneficiario::model()->findByPk($_POST['id']);
        $d   = $b['attributes']['depto'];
        $m   = $b['attributes']['muni'];
        $dp  = Departamento::model()->findByPk($d);
        $mun = Municipio::model()->find('depto=:d and id=:m', array(
            ':d' => $d,
            ':m' => $m
        ));
        ;
        echo '<p>' . $dp['attributes']['departamento'] . '</p>';
        echo '<p>' . $mun['attributes']['municipio'] . '</p>';
    }

    public function actionDatosBeneficiarioDepto() {
        $mun = Beneficiario::model()->listaBeneficiariosDep($_POST['id']);
        $this->renderPartial('resultadobeneficiario', array(
            'datos' => $mun
        ), false, true);
    }

    public function actionDeleteFuenteGet() { // $data=Municipio::model()->findAll('depto=:dep',array(':dep'=>$_POST['id']));
        try {

            // $d= ProgramaFuente::model()->findAll('idPrograma=:p and idFuente=:f',array(':p'=>$_GET[0]['idPrograma'],':f'=>$_GET[0]['idFuente']));

            $command = Yii::app()->db->createCommand();
            $pro     = $command->delete('cs_proyecto_fuente', 'idProyecto=:p and idFuente=:f', array(
                ':p' => $_GET[0]['idProyecto'],
                ':f' => $_GET[0]['idFuente']
            ));
            $this->actionUpdate($_GET[0]['idProyecto']);
        }

        catch (Exception $ex) {
            $model->addError(null, $ex->getMessage());
        }
    }

    public function nombreFuente($p) {

        // $dt = Fuentesfinan::model()->findByPk($p);

        return Fuentesfinan::model()->find("idfuente = $p")->fuente;

        // return $dt->fuente;

    }

    public function actionCargarSubSector($id) {
        /*
        $dat=Subsector::model()->findAll('idSector=:secid', array(':secid'=>$id));
        $list=CHtml::listData($dat,'idSubSector','subsector');
        echo "<option value=''>--Seleccione un valor--</option>";
        foreach($list as $idSub=>$nombreSubSector)
        echo CHtml::tag('option', array('value'=>$idSub),CHtml::encode($nombreSubSector),true);
        */
    }

    public function nombreMoneda($m) {
        return Monedas::model()->find("idMoneda = $m")->moneda;
    }

    public function abreviaturaFuente($p) {
        $criteria            = new CDbCriteria();
        $criteria->select    = 'Max(monto) as monto,idFuente';
        $criteria->condition = 'idPrograma=:searchTxt';
        $criteria->params    = array(
            ':searchTxt' => $p
        );
        $criteria->order     = 'monto DESC';
        $pfuent              = ProgramaFuente::model()->find($criteria);
        $dt                  = Fuentesfinan::model()->findByPk(array(
            $pfuent['attributes']['idFuente']
        ));
        return $dt['attributes']['abreviatura'];
    }


    public function actionSelectdos() {
        $id_uno = $_POST['Proyecto']['idSector'];
        $lista  = Subsector::model()->findAll('idSector = :id_uno', array(
            ':id_uno' => $id_uno
        ));
        $lista  = CHtml::listData($lista, 'idSubSector', 'subsector');
        foreach ($lista as $valor => $descripcion) {

            // echo CHtml::tag('opcion',array('value'=>$valor),CHtml::encode($descripcion),true);
            // echo CHtml::tag('opcion',array('value'=>$valor),CHtml::encode($descripcion),TRUE);

            echo CHtml::tag('option', array(
                'value' => $valor
            ), CHtml::encode($descripcion), true);
        }
    }

    public function actionSelectunidad() {
        $id_uno = $_POST['Proyecto']['idEnte'];
        $lista  = EntesUnidad::model()->findAll(array(
            'order' => 'nombre asc'
        ), 'idEnte = :id_uno', array(
            ':id_uno' => $id_uno
        ));
        $lista  = CHtml::listData($lista, 'idUnidad', 'nombre');
        foreach ($lista as $valor => $descripcion) {

            // echo CHtml::tag('opcion',array('value'=>$valor),CHtml::encode($descripcion),true);
            // echo CHtml::tag('opcion',array('value'=>$valor),CHtml::encode($descripcion),TRUE);

            echo CHtml::tag('option', array(
                'value' => $valor
            ), CHtml::encode($descripcion), true);
        }
    }

    public function actionViewDetFuentesFinanciamiento($id, $event)
    {

        $md = new ProyectoFuente();
        $modelProyecto= new Proyecto();
        $md->unsetAttributes();
        $md->idProyecto = $id;
        $mf = ProyectoFuente::model()->findAll(array(
            'condition' => 'idProyecto=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasfuente', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md,
            'modelProyecto'=>$modelProyecto,
            'iDP'=>$id
        ),false,true);
    }

    public function actionViewDetBudgetBreakdown($id, $event)
    {


        $md = new BudgetBreakdown();
        $modelProyecto= new Proyecto();
        $md->unsetAttributes();
        $md->idProyecto = $id;
        $mf = BudgetBreakdown::model()->findAll(array(
            'condition' => 'idProyecto=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasbudgetbreakdown', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md,
            'modelProyecto'=>$modelProyecto,
            'iDP'=>$id
        ),false,true);
    }

    public function actionViewDetPrequalification($id, $event)
    {


        $md = new PreQualification();
        $modelProyecto= new Proyecto();
        $md->unsetAttributes();
        $md->idProyecto = $id;
        $mf = PreQualification::model()->findAll(array(
            'condition' => 'idProyecto=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasprequalification', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md,
            'modelProyecto'=>$modelProyecto,
            'iDP'=>$id
        ),false,true);
    }
    public function actionViewBeneficiaries($id, $event)
    {


        $md = new ProyectoMunicipio();
        $modelProyecto= new Proyecto();
        $md->unsetAttributes();
        $md->idProyecto = $id;
        $mf = ProyectoMunicipio::model()->findAll(array(
            'condition' => 'idProyecto=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasbeneficiaries', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md,
            'modelProyecto'=>$modelProyecto,
            'iDP'=>$id
        ),false,true);
    }
    public function actionViewMilestone($id, $event)
    {


        $md = new PlanningMilestone();
        $modelProyecto= new Proyecto();
        $md->unsetAttributes();
        $md->idProyecto = $id;
        $mf = PlanningMilestone::model()->findAll(array(
            'condition' => 'idProyecto=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasmilestone', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md,
            'modelProyecto'=>$modelProyecto,
            'iDP'=>$id
        ),false,true);
    }

    public function actionViewForecast($id, $event)
    {


        $md = new Forecast();
        $modelProyecto= new Proyecto();
        $md->unsetAttributes();
        $md->idProyecto = $id;
        $mf = Forecast::model()->findAll(array(
            'condition' => 'idProyecto=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderPartial('_filasforecast', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md,
            'modelProyecto'=>$modelProyecto,
            'iDP'=>$id
        ),false,true);
    }

	public function actionViewForecastObservations($idForecast)
    {


        $md = new ForecastObservations();

        $md->unsetAttributes();
        $md->forecast_id = $idForecast;
        $mf = ForecastObservations::model()->findAll(array(
            'condition' => 'forecast_id=:id',
            'params' => array(
                ':id' => $idForecast
            )
        ));
        $this->renderPartial('_filasForecastObservations', array(
            'datos' => $mf,
            'model' => $md,
            'idForecast'=>$idForecast
        ),false,true);
    }



}
