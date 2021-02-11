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
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
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
				'actions'=>array('index','view','Ajaxubicacion','ViewDet',
                                    'DeleteGet','DatosBeneficiario','AjaxDatosprograma'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
      public function actionViewDet()
	{
            $mf= ProyectoBeneficiario::model()->findAll('idproyecto=:en',array(':en'=>$_GET['idproyecto']));
            //$mf=(count($mf)>0)?$mf:$mf->attributeLabels();
            $list=CHtml::listData($mf,'idproyecto','idproyecto');
            $f=new ProyectoBeneficiario;
            $a=$f->attributeLabels();
		echo '
            <div class="view">
                    <table>
                    <tr>
                        <th>'.$a['idbeneficiario'].'</th>
                        <th>Departamento</th>
                        <th>Municipio</th>
                        <th></th>
                    </tr>';
                //numero de columnas o celdas
                $cd=(count($list)>0)?count($list):0;                
                    if ($cd>0) {
                            foreach ($mf as $v) {
                              //$bene=ProyectoBeneficiario::model()->find('idproyecto=:pro and idbeneficiario=:idb',array(':pro'=>$v->idproyecto,':idb'=>$v->idbeneficiario));
                                $b=Beneficiario::model()->findByPk($v->idbeneficiario);
                                $d=$b['attributes']['depto'];
                                $m=$b['attributes']['muni'];
                                $dp=  Departamento::model()->findByPk($d);
                                $mun=  Municipio::model()->find('depto=:d and id=:m',array(':d'=>$d,':m'=>$m));;
                               echo '<tr>';
                               echo '<td>'.$v->idbeneficiario.'</td>';
                               echo '<td>'.$dp['attributes']['departamento'].'</td>';
                               echo '<td>'.$mun['attributes']['municipio'].'</td>';
                               //echo '<td>'.$v->idMoneda.'</td>';
                              echo '<td>'.CHtml::link('Eliminar',array('proyecto/DeleteGet',array('pro'=>$v->idproyecto,'ben'=>$v->idbeneficiario)),array('class'=>'del'));//, 'confirm' => 'Esta seguro de quitar el registro?
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
		$model=new Proyecto;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);
                    $dir = Yii::getPathOfAlias('webroot.images');          
                     $uploaded = false;
		if(isset($_POST['Proyecto']))
		{
                    
			$model->attributes=$_POST['Proyecto'];
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
                           $uploaded =$image1->saveAs($dir.'/'.$image1->getName());
                            $model->especiplano=$image1->getName();
                            $uploaded=true; 
                        }
                        if (strlen($image2)>0){
                           $uploaded =$image2->saveAs($dir.'/'.$image2->getName());
                            $model->presuprogra=$image2->getName();
                            $uploaded=true; 
                        }
                        if (strlen($image3)>0){
                           $uploaded =$image3->saveAs($dir.'/'.$image3->getName());
                            $model->estudiofact=$image3->getName();
                            $uploaded=true; 
                        }
                        if (strlen($image4)>0){
                           $uploaded =$image4->saveAs($dir.'/'.$image4->getName());
                            $model->estudioimpact=$image4->getName();
                            $uploaded=true; 
                        }if (strlen($image5)>0){
                           $uploaded =$image5->saveAs($dir.'/'.$image5->getName());
                            $model->licambi=$image5->getName();
                            $uploaded=true; 
                        }if (strlen($image6)>0){
                           $uploaded =$image6->saveAs($dir.'/'.$image6->getName());
                            $model->estuimpactierra=$image6->getName();
                            $uploaded=true; 
                        }
                        if (strlen($image7)>0){
                           $uploaded =$image7->saveAs($dir.'/'.$image7->getName());
                            $model->planreasea=$image7->getName();
                            $uploaded=true; 
                        }if (strlen($image8)>0){
                           $uploaded =$image8->saveAs($dir.'/'.$image8->getName());
                            $model->plananual=$image8->getName();
                            $uploaded=true; 
                        }if (strlen($image9)>0){
                           $uploaded =$image9->saveAs($dir.'/'.$image9->getName());
                            $model->acuerdofinan=$image9->getName();
                            $uploaded=true; 
                        }if (strlen($image10)>0){
                           $uploaded =$image10->saveAs($dir.'/'.$image10->getName());
                            $model->otro=$image10->getName();
                            $uploaded=true; 
                        }if (strlen($image11)>0){
                           $uploaded =$image11->saveAs($dir.'/'.$image11->getName());
                            $model->notaprioridad=$image11->getName();
                            $uploaded=true; 
                        }
                        if (strlen($image12)>0){
                           $uploaded =$image12->saveAs($dir.'/'.$image12->getName());
                            $model->constanciabanco=$image12->getName();
                            $uploaded=true; 
                        }
                        try {
                            $model->codigo="PMR-".rand(0, 1000);//."-".  $this->obtenerSector($model->idPrograma);
                            if($model->save())
				$this->redirect(array('update','id'=>$model->idProyecto));//view
                        } catch (Exception $ex) {
                             $model->addError(null, $ex->getMessage());
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

		if(isset($_POST['Proyecto']))
		{
			$model->attributes=$_POST['Proyecto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idProyecto));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        protected function obtenerSector($p) {
                $s= Programa::model()->findByPk($p);
                return $s->sector;
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
                 //$d= ProgramaFuente::model()->findAll('idPrograma=:p and idFuente=:f',array(':p'=>$_GET[0]['idPrograma'],':f'=>$_GET[0]['idFuente']));
                 $command=Yii::app()->db->createCommand();
                 $pro=$command->delete('cs_proyecto_beneficiario','idproyecto=:p and idbeneficiario=:b',array(':p'=>$_GET[0]['pro'],':b'=>$_GET[0]['ben']));
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
		  if (!Yii::app()->user->isGuest) {
             //$dataProvider=new CActiveDataProvider('Programa');
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

		$this->render('admin',array(
			'model'=>$model,
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
}
