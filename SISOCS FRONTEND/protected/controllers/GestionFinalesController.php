<?php
class GestionFinalesController extends Controller

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
    public

    function filters()
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
    public

    function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'index'
                ) ,
                'users' => array(
                    '*'
                )
            ) ,
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'admin', 'publicadas'
                ) ,
                'users' => array(
                    '@'
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

    /**
     * Manages all models.
     */
    public

    function actionAdmin()
    {
        $model = new GestionFinales('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['GestionFinales'])) $model->attributes = $_GET['GestionFinales'];
        $this->render('admin', array(
            'model' => $model
        ));
    }

    function actionPublicadas()
    {
        $model = new GestionFinales('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['GestionFinales'])) $model->attributes = $_GET['GestionFinales'];
        $this->render('publicadas', array(
            'model' => $model
        ));
    }

    public

    function actionIndex()
    {
        $this->redirect(array(
            'GestionFinales/admin'
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
    public

    function loadModel($id)
    {
        $model = InicioEjecucion::model()->findByPk($id);
        if ($model === null) throw new CHttpException(404, 'La página solicitada no existe.');
        return $model;
    }
}
