<?php

class AvancesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        //return array(
//			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
//		);
        return array('accessControl', array('CrugeAccessControlFilter'));
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'admin2'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($cod_inicio_ejecucion) {
        $_SESSION['CoInSe'] = $cod_inicio_ejecucion;
        $direcc = $_SESSION['CoInSe'];
        $model = new Avances;
        $model2 = new DocAdjuntados;
        $model3 = new ImgAdjuntadas;
        //$model2->up_dated = date('Y-m-d');
        //$path = Yii::app()->getBasePath. '\sisocs\images\doc_subidos';
        $path = Yii::getPathOfAlias('webroot.images.doc_subidos');



        //$path2 = Yii::app()->getBasePath . '\sisocs\images\img_subidas';
        $path2 = YiiBase::getPathOfAlias('webroot.images.img_subidas.' . $direcc);



        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);
        $this->performAjaxValidation(array($model, $model2, $model3));

        if (isset($_POST['Avances'])) {
            //$EstdoAvance=$model->estado_sol;
            $estado_sol = '';
            $criteria = new CDbCriteria;
            $criteria->select = 'estado_sol';
            $criteria->condition = 'idContratacion=:idCod';
            $criteria->params = array(':idCod' => $cod_inicio_ejecucion);
            $documento = InicioEjecucion::model()->find($criteria);
            $estado_sol = $documento->estado_sol;

            $model->attributes = $_POST['Avances'];
            $EstdoAvance = $model->estado_sol;

            if ($estado_sol != "PUBLICADO" and $model->estado_sol == "PUBLICADO") {

                $var = "El inicio de Ejecucion no esta en estado: PUBLICADO, No se puede crear";
                echo "<script>alert('$var')</script>";
            } else {

                if ($model->save()) {
                    if ($EstdoAvance == "NECESITAN REVISION") {
                        Yii::app()->Controller->enviarCorreo(8, $model->codigo);
                    };
                    $this->redirect(array('avances/update', 'id' => $model->codigo));
                }
            }
        }

        if (isset($_POST['DocAdjuntados'])) {


            $model2->attributes = $_POST['DocAdjuntados'];
            if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc1'])) {
                $model2->nombre_doc1 = $_POST['DocAdjuntados']['nombre_doc1'];
                //$model2->ubicacion_doc =$_FILES['DocAdjuntados']['name']['nombre_doc'];
                //if ($model2->validate(array('nombre_doc'))) {
                $model2->nombre_doc1 = CUploadedFile::getInstance($model2, 'nombre_doc1');
                //} else {
                //$model2->nombre_doc = '3';
                //}
                //$model2->nombre_doc->saveAs($path . '/' . time() . '_' . str_replace(' ', '_', strtolower($model2->nombre_doc)));
                $model2->nombre_doc1->saveAs($path . '/' . time() . '_' . $model2->nombre_doc1);


                //$model2->ubicacion_doc=$path . '\\' . time() . '_' .$model2->nombre_doc;//->getName();
                //$model2->doc_type = $model2->ubicacion_doc->getType();
                //$model2->doc_size = $model2->ubicacion_doc->getSize();
            }

            if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc2'])) {
                $model2->nombre_doc2 = $_POST['DocAdjuntados']['nombre_doc2'];
                $model2->nombre_doc2 = CUploadedFile::getInstance($model2, 'nombre_doc2');
                $model2->nombre_doc2->saveAs($path . '/' . time() . '_' . $model2->nombre_doc2);
            }

            if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc3'])) {
                $model2->nombre_doc3 = $_POST['DocAdjuntados']['nombre_doc3'];
                $model2->nombre_doc3 = CUploadedFile::getInstance($model2, 'nombre_doc3');
                $model2->nombre_doc3->saveAs($path . '/' . time() . '_' . $model2->nombre_doc3);
            }

            if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc4'])) {
                $model2->nombre_doc4 = $_POST['DocAdjuntados']['nombre_doc4'];
                $model2->nombre_doc4 = CUploadedFile::getInstance($model2, 'nombre_doc4');
                $model2->nombre_doc4->saveAs($path . '/' . time() . '_' . $model2->nombre_doc4);
            }

            if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc5'])) {
                $model2->nombre_doc5 = $_POST['DocAdjuntados']['nombre_doc5'];
                $model2->nombre_doc5 = CUploadedFile::getInstance($model2, 'nombre_doc5');
                $model2->nombre_doc5->saveAs($path . '/' . time() . '_' . $model2->nombre_doc5);
            }

            if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc6'])) {
                $model2->nombre_doc6 = $_POST['DocAdjuntados']['nombre_doc6'];
                $model2->nombre_doc6 = CUploadedFile::getInstance($model2, 'nombre_doc6');
                $model2->nombre_doc6->saveAs($path . '/' . time() . '_' . $model2->nombre_doc6);
            }

            if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc7'])) {
                $model2->nombre_doc7 = $_POST['DocAdjuntados']['nombre_doc7'];
                $model2->nombre_doc7 = CUploadedFile::getInstance($model2, 'nombre_doc7');
                $model2->nombre_doc7->saveAs($path . '/' . time() . '_' . $model2->nombre_doc7);
            }

            if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc8'])) {
                $model2->nombre_doc8 = $_POST['DocAdjuntados']['nombre_doc8'];
                $model2->nombre_doc8 = CUploadedFile::getInstance($model2, 'nombre_doc8');
                $model2->nombre_doc8->saveAs($path . '/' . time() . '_' . $model2->nombre_doc8);
            }


            $model2->ubicacion_doc = $path . '\\';

            $model2->cod_contrato = $cod_inicio_ejecucion;
            $model2->nombre_doc1 = $model2->nombre_doc1;
            $model2->nombre_doc2 = $model2->nombre_doc2;
            $model2->nombre_doc3 = $model2->nombre_doc3;
            $model2->nombre_doc4 = $model2->nombre_doc4;
            $model2->nombre_doc5 = $model2->nombre_doc5;
            $model2->nombre_doc6 = $model2->nombre_doc6;
            $model2->nombre_doc7 = $model2->nombre_doc7;
            $model2->nombre_doc8 = $model2->nombre_doc8;
            $model2->nombre_fisico1 = time() . '_' . $model2->nombre_doc1;
            $model2->nombre_fisico2 = time() . '_' . $model2->nombre_doc2;
            $model2->nombre_fisico3 = time() . '_' . $model2->nombre_doc3;
            $model2->nombre_fisico4 = time() . '_' . $model2->nombre_doc4;
            $model2->nombre_fisico5 = time() . '_' . $model2->nombre_doc5;
            $model2->nombre_fisico6 = time() . '_' . $model2->nombre_doc6;
            $model2->nombre_fisico7 = time() . '_' . $model2->nombre_doc7;
            $model2->nombre_fisico8 = time() . '_' . $model2->nombre_doc8;


            if ($model2->save()) {
                //$this->redirect(array('view', 'id' => $model2->id));
            }
        }

        if (isset($_POST['ImgAdjuntadas'])) {
            //$path2 = YiiBase::getPathOfAlias('webroot.images.img_subidas.'.$cod_inicio_ejecucion);
            //$path2 = YiiBase::getPathOfAlias('webroot.images');
            $model3->attributes = $_POST['ImgAdjuntadas'];
            if (@!empty($_FILES['ImgAdjuntadas']['name']['nombre_img'])) {
                $model3->nombre_img = $_POST['ImgAdjuntadas']['nombre_img'];

                $model3->nombre_img = CUploadedFile::getInstance($model3, 'nombre_img');

                $model3->nombre_img->saveAs($path2 . '/' . time() . '_' . $model3->nombre_img);
                //$model3->nombre_img->saveAs($path2 );

                $model3->ubicacion_img = $path2 . '/' . time() . '_' . $model3->nombre_img; //->getName();
            }
            $model3->cod_contrato = $cod_inicio_ejecucion;
            //$model3->nombre_img = $model3->nombre_img;  //time() . '_' . str_replace(' ', '_', strtolower($model3->nombre_img));
            $model3->nombre_img->saveAs($path2 . '/' . time() . '_' . $model3->nombre_img);
            $model3->nombre_fisico = time() . '_' . $model3->nombre_img;
            if ($model3->save()) {
                //$this->redirect(array('view', 'id' => $model3->id));
            }
        }
        
        if (Yii::app()->request->isAjaxRequest) { // check the condition  
            echo CJSON::encode(array(
                'status' => 'failure',
                'div' => $this->renderPartial('_form', array('model' => $model, 'model2' => $model2, 'model3' => $model3, 'cod_inicio_ejecucion' => $cod_inicio_ejecucion,), true)));
            exit;
            $this->refreash();
        } else {
            $this->render('create', array(// return the form  
                'model' => $model, 'model2' => $model2, 'model3' => $model3, 'cod_inicio_ejecucion' => $cod_inicio_ejecucion,
            ));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        
        $model = $this->loadModel($id);
        $model2 = new Avances;
        $model3 = new ImgAdjuntadas;
        $this->performAjaxValidation($model);

		$id = $model->codigo;
                
        if (isset($_POST['Avances'])) {
            $model->attributes = $_POST['Avances'];

            if ($model->save()) {
                $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 8, $id);

                $image1 = CUploadedFile::getInstance($model, 'nombre_doc1');
                $image2 = CUploadedFile::getInstance($model, 'nombre_doc2');
                $image3 = CUploadedFile::getInstance($model, 'nombre_doc3');
                $image4 = CUploadedFile::getInstance($model, 'nombre_doc4');
                $image5 = CUploadedFile::getInstance($model, 'nombre_doc5');
                $image6 = CUploadedFile::getInstance($model, 'nombre_doc6');
                $image7 = CUploadedFile::getInstance($model, 'nombre_doc7');
                $image8 = CUploadedFile::getInstance($model, 'nombre_doc8');


                if (strlen($image1) > 0) {
                    if ($image1->saveAs($dir . '/' . $image1->getName())) {
                        $model->adj_garantias = Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
                    }
                }
                if (strlen($image2) > 0) {
                    if ($image2->saveAs($dir . '/' . $image2->getName())) {
                        $model->adj_avances = Yii::app()->Controller->getURL($dir . '/' . $image2->getName());
                    }
                }
                if (strlen($image3) > 0) {
                    if ($image3->saveAs($dir . '/' . $image3->getName())) {
                        $model->adj_supervicion = Yii::app()->Controller->getURL($dir . '/' . $image3->getName());
                    }
                }
                if (strlen($image4) > 0) {
                    if ($image4->saveAs($dir . '/' . $image4->getName())) {
                        $model->adj_evaluacion = Yii::app()->Controller->getURL($dir . '/' . $image4->getName());
                    }
                }
                if (strlen($image5) > 0) {
                    if ($image5->saveAs($dir . '/' . $image5->getName())) {
                        $model->adj_tecnica = Yii::app()->Controller->getURL($dir . '/' . $image5->getName());
                    }
                }
                if (strlen($image6) > 0) {
                    if ($image6->saveAs($dir . '/' . $image6->getName())) {
                        $model->adj_financiero = Yii::app()->Controller->getURL($dir . '/' . $image6->getName());
                    }
                }
                if (strlen($image7) > 0) {
                    if ($image7->saveAs($dir . '/' . $image7->getName())) {
                        $model->adj_recepcion = Yii::app()->Controller->getURL($dir . '/' . $image7->getName());
                    }
                }
                if (strlen($image8) > 0) {
                    if ($image8->saveAs($dir . '/' . $image8->getName())) {
                        $model->adj_disconformidad = Yii::app()->Controller->getURL($dir . '/' . $image8->getName());
                    }
                }
            }//fin del if($model->save())
            $model->save();
            //$this->mandarCorreo(8, $model->codigo);
        }
		
		if(isset($_POST['ImgAdjuntadas']))
		{
				$dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 8, $id);
				
				$model3->attributes = $_POST['ImgAdjuntadas'];
				$image1 = CUploadedFile::getInstance($model3, 'nombre_img');
				$model3->cod_contrato=$model->idContratacion;
				$model3->cod_avance=$model->codigo;
				
				//echo "<script> alert($dir); </script>";
				
                if (strlen($image1) > 0) {
                    if ($image1->saveAs($dir . '/' . $image1->getName())) {
                        $model3->nombre_img = Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
						$model3->nombre_fisico = $image1->getName();
						$model3->ubicacion_img=$dir;
						
					}
                }
				
				$model3->save();
				
		}

        //*****************************************************************************
        /*
        if(isset($_POST['ImgAdjuntadas']))
		{
				$dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 8, $id);
				
				$model3->attributes = $_POST['ImgAdjuntadas'];
				$model3->cod_contrato=$model->idContratacion;
				$model3->cod_avance=$model->codigo;
                
                $tempFile = $_FILES['Filedata']['tmp_name']['nombre_img'];
                $fileName = $_FILES['ImgAdjuntadas']['name']['nombre_img'];
                $fileSize = $_FILES['Filedata']['size']['nombre_img'];
                
                if (strlen($fileName) > 0) {
                    $ret = move_uploaded_file("", "./" . Yii::app()->Controller->smart_resize_image($tempFile , 400 , 400 , false , $dir . '/' . $fileName , true , false ,100 ));
                    
                    if ($ret) {
                        $model3->nombre_img = Yii::app()->Controller->getURL($dir . '/' . $fileName);
						$model3->nombre_fisico = $fileName;
						$model3->ubicacion_img=$dir;
					}
                }
				
				$model3->save();
		}
        */
        //*****************************************************************************

        $this->render('update', array(
            'model' => $model,
            'model2' => $model2,
            'model3' => $model3,
            'cod_inicio_ejecucion' => $model->codigo_inicio_ejecucion
        ));
    }

    /*
     * public function actionUpdate($id) {

      $model = $this->loadModel($id);
      $_SESSION['CoAv'] = $id;
      $model2 = new DocAdjuntados;
      $model3 = new ImgAdjuntadas;

      // Uncomment the following line if AJAX validation is needed
      //$this->performAjaxValidation($model);



      if (isset($_POST['Avances'])) {

      $criteria = new CDbCriteria;
      $criteria->select = 'estado_sol';
      $criteria->condition = 'idContratacion=:idCod';
      $criteria->params = array(':idCod' => $model->codigo_inicio_ejecucion);
      $documento = InicioEjecucion::model()->find($criteria);
      $estado_sol = $documento->estado_sol;

      $model->attributes = $_POST['Avances'];
      $EstdoAvance = $model->estado_sol;

      if ($estado_sol != "PUBLICADO" and $model->estado_sol == "PUBLICADO") {
      $var = "El inicio de Ejecucion no esta en estado: PUBLICADO, No se puede actualizar";
      echo "<script>alert('$var')</script>";
      } else {
      if ($model->save()) {
      if ($EstdoAvance == "NECESITAN REVISION") {
      Yii::app()->Controller->enviarCorreo(8, $id);
      };
      $this->redirect(array('view', 'id' => $model->codigo));
      };
      }
      }

      if (isset($_POST['DocAdjuntados'])) {
      $path = Yii::getPathOfAlias('webroot.images.doc_subidos');

      $model2->attributes = $_POST['DocAdjuntados'];

      if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc1'])) {
      $model2->nombre_doc1 = $_POST['DocAdjuntados']['nombre_doc1'];
      $model2->nombre_doc1 = CUploadedFile::getInstance($model2, 'nombre_doc1');
      }
      if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc2'])) {
      $model2->nombre_doc2 = $_POST['DocAdjuntados']['nombre_doc2'];
      $model2->nombre_doc2 = CUploadedFile::getInstance($model2, 'nombre_doc2');
      }
      if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc3'])) {
      $model2->nombre_doc3 = $_POST['DocAdjuntados']['nombre_doc3'];
      $model2->nombre_doc3 = CUploadedFile::getInstance($model2, 'nombre_doc3');
      }
      if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc4'])) {
      $model2->nombre_doc4 = $_POST['DocAdjuntados']['nombre_doc4'];
      $model2->nombre_doc4 = CUploadedFile::getInstance($model2, 'nombre_doc4');
      }
      if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc5'])) {
      $model2->nombre_doc5 = $_POST['DocAdjuntados']['nombre_doc5'];
      $model2->nombre_doc5 = CUploadedFile::getInstance($model2, 'nombre_doc5');
      }
      if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc6'])) {
      $model2->nombre_doc6 = $_POST['DocAdjuntados']['nombre_doc6'];
      $model2->nombre_doc6 = CUploadedFile::getInstance($model2, 'nombre_doc6');
      }
      if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc7'])) {
      $model2->nombre_doc7 = $_POST['DocAdjuntados']['nombre_doc7'];
      $model2->nombre_doc7 = CUploadedFile::getInstance($model2, 'nombre_doc7');
      }
      if (@!empty($_FILES['DocAdjuntados']['name']['nombre_doc8'])) {
      $model2->nombre_doc8 = $_POST['DocAdjuntados']['nombre_doc8'];
      $model2->nombre_doc8 = CUploadedFile::getInstance($model2, 'nombre_doc8');
      }


      //$model2->ubicacion_doc='0';

      if ($model2->nombre_doc1 != '') {
      $model2->nombre_fisico1 = time() . '_' . $model2->nombre_doc1;
      };
      if ($model2->nombre_doc2 != '') {
      $model2->nombre_fisico2 = time() . '_' . $model2->nombre_doc2;
      };
      if ($model2->nombre_doc3 != '') {
      $model2->nombre_fisico3 = time() . '_' . $model2->nombre_doc3;
      };
      if ($model2->nombre_doc4 != '') {
      $model2->nombre_fisico4 = time() . '_' . $model2->nombre_doc4;
      };
      if ($model2->nombre_doc5 != '') {
      $model2->nombre_fisico5 = time() . '_' . $model2->nombre_doc5;
      };
      if ($model2->nombre_doc6 != '') {
      $model2->nombre_fisico6 = time() . '_' . $model2->nombre_doc6;
      };
      if ($model2->nombre_doc7 != '') {
      $model2->nombre_fisico7 = time() . '_' . $model2->nombre_doc7;
      };
      if ($model2->nombre_doc8 != '') {
      $model2->nombre_fisico8 = time() . '_' . $model2->nombre_doc8;
      };

      if ($model2->nombre_doc1 != '' OR $model2->nombre_doc2 != '' OR $model2->nombre_doc3 != '' OR $model2->nombre_doc4 != '' OR $model2->nombre_doc5 != '' OR $model2->nombre_doc6 != '' OR $model2->nombre_doc7 != '' OR $model2->nombre_doc8 != '') {

      $doc_exis = '0';

      $documento2 = DocAdjuntados::model()->find(array(
      'select' => 'codigo',
      'condition' => 'cod_avance=:id',
      'params' => array(':id' => $id),
      ));


      if ($documento2 === null) {
      $doc_exis = '0';
      } else {
      $doc_exis = $documento2->codigo;
      }


      if ($doc_exis == '0') {

      //$model2->ubicacion_doc=Yii::getPathOfAlias('webroot'). '/images/doc_subidos/' ;

      if ($model2->save()) {

      if ($model2->nombre_doc1 != '') {
      time() . '_' . $model2->nombre_doc1->saveAs($path . '/' . time() . '_' . $model2->nombre_doc1);
      };
      if ($model2->nombre_doc2 != '') {
      time() . '_' . $model2->nombre_doc2->saveAs($path . '/' . time() . '_' . $model2->nombre_doc2);
      };
      if ($model2->nombre_doc3 != '') {
      time() . '_' . $model2->nombre_doc3->saveAs($path . '/' . time() . '_' . $model2->nombre_doc3);
      };
      if ($model2->nombre_doc4 != '') {
      time() . '_' . $model2->nombre_doc4->saveAs($path . '/' . time() . '_' . $model2->nombre_doc4);
      };
      if ($model2->nombre_doc5 != '') {
      time() . '_' . $model2->nombre_doc5->saveAs($path . '/' . time() . '_' . $model2->nombre_doc5);
      };
      if ($model2->nombre_doc6 != '') {
      time() . '_' . $model2->nombre_doc6->saveAs($path . '/' . time() . '_' . $model2->nombre_doc6);
      };
      if ($model2->nombre_doc7 != '') {
      time() . '_' . $model2->nombre_doc7->saveAs($path . '/' . time() . '_' . $model2->nombre_doc7);
      };
      if ($model2->nombre_doc8 != '') {
      time() . '_' . $model2->nombre_doc8->saveAs($path . '/' . time() . '_' . $model2->nombre_doc8);
      };
      };
      } else {
      $documento2 = DocAdjuntados::model()->findByPk($doc_exis);

      if ($model2->nombre_doc1 != '') {
      $documento2->nombre_doc1 = $model2->nombre_doc1;
      $documento2->nombre_fisico1 = time() . '_' . $model2->nombre_doc1;
      time() . '_' . $model2->nombre_doc1->saveAs($path . '/' . time() . '_' . $model2->nombre_doc1);
      };
      if ($model2->nombre_doc2 != '') {
      $documento2->nombre_doc2 = $model2->nombre_doc2;
      $documento2->nombre_fisico2 = time() . '_' . $model2->nombre_doc2;
      time() . '_' . $model2->nombre_doc2->saveAs($path . '/' . time() . '_' . $model2->nombre_doc2);
      };
      if ($model2->nombre_doc3 != '') {
      $documento2->nombre_doc3 = $model2->nombre_doc3;
      $documento2->nombre_fisico3 = time() . '_' . $model2->nombre_doc3;
      time() . '_' . $model2->nombre_doc3->saveAs($path . '/' . time() . '_' . $model2->nombre_doc3);
      };
      if ($model2->nombre_doc4 != '') {
      $documento2->nombre_doc4 = $model2->nombre_doc4;
      $documento2->nombre_fisico4 = time() . '_' . $model2->nombre_doc4;
      time() . '_' . $model2->nombre_doc4->saveAs($path . '/' . time() . '_' . $model2->nombre_doc4);
      };
      if ($model2->nombre_doc5 != '') {
      $documento2->nombre_doc5 = $model2->nombre_doc5;
      $documento2->nombre_fisico5 = time() . '_' . $model2->nombre_doc5;
      time() . '_' . $model2->nombre_doc5->saveAs($path . '/' . time() . '_' . $model2->nombre_doc5);
      };
      if ($model2->nombre_doc6 != '') {
      $documento2->nombre_doc6 = $model2->nombre_doc6;
      $documento2->nombre_fisico6 = time() . '_' . $model2->nombre_doc6;
      time() . '_' . $model2->nombre_doc6->saveAs($path . '/' . time() . '_' . $model2->nombre_doc6);
      };
      if ($model2->nombre_doc7 != '') {
      $documento2->nombre_doc7 = $model2->nombre_doc7;
      $documento2->nombre_fisico7 = time() . '_' . $model2->nombre_doc7;
      time() . '_' . $model2->nombre_doc7->saveAs($path . '/' . time() . '_' . $model2->nombre_doc7);
      };
      if ($model2->nombre_doc8 != '') {
      $documento2->nombre_doc8 = $model2->nombre_doc8;
      $documento2->nombre_fisico8 = time() . '_' . $model2->nombre_doc8;
      time() . '_' . $model2->nombre_doc8->saveAs($path . '/' . time() . '_' . $model2->nombre_doc8);
      };
      $documento2->save();
      }
      }
      }


      if (isset($_POST['ImgAdjuntadas'])) {
      $idInicioEjecucion = $model->codigo_inicio_ejecucion;
      $idAvances = $model->codigo;
      $ruta_de_guardado = YiiBase::getPathOfAlias("sisocs3/images/img_subidas");

      $model3->attributes = $_POST['ImgAdjuntadas'];
      $fecha = date('Ymd');

      if (@!empty($_FILES['ImgAdjuntadas']['name']['nombre_img'])) {
      $model3->nombre_img = $_POST['ImgAdjuntadas']['nombre_img'];
      $model3->nombre_img = CUploadedFile::getInstance($model3, 'nombre_img');
      //$model3->ubicacion_img="$idInicioEjecucion/$idAvances/{$fecha}_{$model3->nombre_img}";
      $model3->ubicacion_img = "$idInicioEjecucion/$idAvances/{$fecha}_{$model3->nombre_img}";
      }
      $model3->nombre_fisico = "{$fecha}_{$model3->nombre_img}";
      if ($model3->save()) {
      $model3->nombre_img->saveAs("$ruta_de_guardado/{$model3->nombre_fisico}");
      }
      /* print_r($_POST); echo '<BR>'; print_r($_FILES);
      }

      $this->render('update', array(
      'model' => $model,
      'model2' => $model2,
      'model3' => $model3, 'cod_inicio_ejecucion' => $model->codigo_inicio_ejecucion,
      ));
      }
     */

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
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Avances');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
		$records=Avances::model()->findAll();
        $model = new Avances('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Avances']))
            $model->attributes = $_GET['Avances'];

        $this->render('admin', array(
            'model' => $model,'records'=>$records,
        ));
    }

    public function actionAdmin2($id) {
		$records=Avances::model()->findAll();
        $model = new Avances();
        $model->unsetAttributes();
        $model->codigo_inicio_ejecucion = $id;
        if (isset($_GET['Avances'])) {
            $model->attributes = $_GET['Avances'];
        }

        $this->render('admin', array('model' => $model,'records'=>$records));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Avances the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Avances::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    public function loadModel2($id) {
        $model2 = DocAdjuntados::model2()->findByPk($id);
        if ($model2 === null)
            throw new CHttpException(404, 'The requested page does not exist2.');
        return $model2;
    }

    //public function loadModel3($id)
    //{
    //	$model3=ImgAdjuntados::model()->findByPk($id);
    //	if($model3===null)
    //		throw new CHttpException(404,'The requested page does not exist3.');
    //	return $model3;
    //}

    /**
     * Performs the AJAX validation.
     * @param Avances $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'avances-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
