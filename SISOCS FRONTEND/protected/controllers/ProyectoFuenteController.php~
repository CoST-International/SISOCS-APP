<?php

class ProyectoFuenteController extends Controller
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
				'actions'=>array('index','view','Viewdet','Quitar'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','Create2','BatchUpdate','Addfuente'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 public function actionAddnew() {
                $model=new ProyectoFuente;
        // Ajax Validation enabled
        $this->performAjaxValidation($model);
        // Flag to know if we will render the form or try to add 
        // new jon.
                $flag=true;
        if(isset($_POST['ProyectoFuente']))
        {       $flag=false;
            $model->attributes=$_POST['ProyectoFuente'];
 
            if($model->save()) {
                //Return an <option> and select it
                            echo CHtml::tag('option',array (
                                'value'=>$model->jid,
                                'selected'=>true
                            ),CHtml::encode($model->jdescr),true);
                        }
                }
                if($flag) {
                    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                    $this->renderPartial('createDialog',array('model'=>$model,),false,true);
                }
        }
	public function actionCreate()
	{
        $model=new ProyectoFuente;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProyectoFuente']))
		{
			$model->attributes=$_POST['ProyectoFuente'];
			try
			{
				if($model->save())
				$this->redirect(array('view',$model));
			}
			catch (CDbException $ex)
		   {
			 $model->addError(null, $ex->getMessage());
		   }
			
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
	public function actionCreate2($id)
    {
        $model=new ProyectoFuente;
        $this->performAjaxValidation($model);
        
        if(isset($_POST['ProyectoFuente'])) {
            $model->attributes=$_POST['ProyectoFuente'];
            if($model->save()) {
                //$this->redirect(array('view','id'=>$model->id));
            } else {
                echo json_encode(array('error' => $model->getErrors().'|||'.var_dump($model)));
            }
        } else {
            $this->renderpartial('_formajax',array(
                'model'=>$model, 'idProyecto'=>$id
            ));
        }
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProyectoFuente']))
		{
			$model->attributes=$_POST['ProyectoFuente'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idProyecto));
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
        
        public function actionQuitar($id)
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
		$dataProvider=new CActiveDataProvider('ProyectoFuente');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProyectoFuente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProyectoFuente']))
			$model->attributes=$_GET['ProyectoFuente'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ProgramaFuente the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ProyectoFuente::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ProgramaFuente $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='proyecto-fuente-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionBatchUpdate()
          {
            $items=new ProyectoFuente();
            //$model->unsetAttributes(); 
            // retrieve items to be updated in a batch mode
            // assuming each item is of model class ’Item’
            $items=  ProyectoFuente::model()->findAll();
            if (isset($_POST['item']))
            {$valid=true;
                foreach($items as $i=>$item)
                {
                        if(isset($_POST['Item'][$i]))
                        $item->attributes=$_POST['Item'][$i];
                        $valid=$item->validate() && $valid;
                }
            if($valid){}
             }
            // displays the view to collect tabular input
            $this->render('batchupdate',array('items'=>$items));
             //$this->render('batchupdate',array('model'=>$items));
    }
        
        public function actionaddjax()
	{
		$model=new ProyectoFuente;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProyectoFuente']))
		{
			$model->attributes=$_POST['ProyectoFuente'];
			if($model->save())
				$this->redirect(array('view',$model));
		}

		$this->renderPartial('update',array(
			'model'=>$model,
		));
	}
        public function actionAddfuente()
        {
                $model = new ProgramaFuenteForm;
                $form = new CForm(' application.views.site.ProgramaFuenteForm', $model);
                if($form->submitted('login') && $form->validate())
                $this->redirect(array('site/index'));
                else
                $this->render('_filas', array('form'=>$form));
                }
                
        public function actionViewdet() {
            $mf=new ProyectoFuente;
            $a=$mf->attributeLabels();
            echo '
            <div class="view">
                    <table>
                    <tr>
                        <th>'.$a['idFuente'].'</th>
                        <th>'.$a['monto'].'</th>
                        <th>'.$a['tasa_cambio'].'</th>
                        <th>'.$a['idMoneda'].'</th>
                    </tr>';
                for ($c = 0;$c <2;$c++) {
                    echo '<tr>';
                    for ($f = 0;$f <5;$f++) {
                        echo '<td>columna'.$f.'-celda:'.$c.'</td>';
                            }
                          echo '</tr>';
                       }
                       echo '
                    </table>
              </div>        
            ';
                }
  }
