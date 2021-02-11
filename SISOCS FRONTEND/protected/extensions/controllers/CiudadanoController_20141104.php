<?php

class CiudadanoController extends Controller
{
    // public function accessRules()
    // {
        // return array(
            // array('allow',  // allow all users to perform 'index' and 'view' actions
                // 'actions'=>array('BProyecto','update'),
                // 'users'=>array('@'),
            // ),
            // array('allow',  // allow all users to perform 'index' and 'view' actions
                // 'actions'=>array('actionviewproyecto','update'),
                // 'users'=>array('@'),
            // ),
            // array('allow',  // allow all users to perform 'index' and 'view' actions
                // 'actions'=>array('BPrograma','update','fichatecnicapro','fichatecnicaprg','fichatecnicacon','Informecumplimiento','BCumplimiento'),
                // 'users'=>array('@'),
            // ),
            // array('allow',  // allow all users to perform 'index' and 'view' actions
                // 'actions'=>array('actionviewprograma','update'),
                // 'users'=>array('@'),
            // ),
            // array('allow',  // allow all users to perform 'index' and 'view' actions
                // 'actions'=>array('actionviewcontrato','update'),
                // 'users'=>array('@'),
            // ),
            // array('allow',  // allow all users to perform 'index' and 'view' actions
                // 'actions'=>array('actionComayagua','update'),
                // 'users'=>array('@'),
            // ),
            // array('allow',  // allow all users to perform 'index' and 'view' actions
                // 'actions'=>array('actionfichatecnica','update'),
                // 'users'=>array('@'),
            // ),
        // );
    // }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionBProyecto()
    {    
        $criterio=$_POST['criterio'];
        
        // *********************** Lista de contratos
        $sql=    "Select DISTINCT
                  vCiudadano.idPrograma,
                  vCiudadano.idProyecto,
                  vCiudadano.idCalificacion,
                  vCiudadano.idAdjudicacion,
                  vCiudadano.idContratacion,
                  vCiudadano.contratacion_nombre,
                  vCiudadano.contratacion_numero,
                  vCiudadano.contratacion_alcances,
                  vCiudadano.contratacion_precio,
                  vCiudadano.contratacion_inicio,
                  vCiudadano.contratacion_final,
                  vCiudadano.contratacion_duracion,
                  vCiudadano.contratacion_estado 
                From
                  vCiudadano
                Where
                  (vCiudadano.idContratacion is not null) And
                  (
                      (vCiudadano.programa_codigo Like '%$criterio%') Or
                      (vCiudadano.programa_nombre Like '%$criterio%') Or
                      (vCiudadano.programa_descripcion Like '%$criterio%') Or
                      (vCiudadano.BIP Like '%$criterio%') Or
                      (vCiudadano.programa_proposito Like '%$criterio%') Or
                      (vCiudadano.programa_funcionario Like '%$criterio%') Or
                      (vCiudadano.proyecto_codigo Like '%$criterio%') Or
                      (vCiudadano.proyecto_nombre Like '%$criterio%') Or
                      (vCiudadano.proyecto_descripcion Like '%$criterio%') Or
                      (vCiudadano.proyecto_depto Like '%$criterio%') Or
                      (vCiudadano.proyecto_muni Like '%$criterio%') Or
                      (vCiudadano.proyecto_funcionario Like '%$criterio%') Or
                      (vCiudadano.proyecto_ubicacion Like '%$criterio%') Or
                      (vCiudadano.calificacion_codigo Like '%$criterio%') Or
                      (vCiudadano.calificacion_nombre Like '%$criterio%') Or
                      (vCiudadano.calificacion_funcionario Like '%$criterio%') Or
                      (vCiudadano.adjudicacion_codigo Like '%$criterio%') Or
                      (vCiudadano.adjudicacion_nombre Like '%$criterio%') Or
                      (vCiudadano.contratacion_nombre Like '%$criterio%') Or
                      (vCiudadano.contratacion_numero Like '%$criterio%') Or
                      (vCiudadano.contratacion_alcances Like '%$criterio%')
                  )
                ";
        
        $command=Yii::app()->db->createCommand($sql);
        $contrato=$command->queryAll();
        $this->renderPartial('Listacontrato', array('Contratos'=>$contrato));
        
        // *********************** Lista de Adjudicaciones
        $sql=    "Select DISTINCT
                  vCiudadano.idPrograma,
                  vCiudadano.idProyecto,
                  vCiudadano.idCalificacion,
                  vCiudadano.idAdjudicacion,
                  vCiudadano.idContratacion,
                  vCiudadano.adjudicacion_codigo,
                  vCiudadano.adjudicacion_nombre,
                  vCiudadano.adjudicacion_nacionales,
                  vCiudadano.adjudicacion_internacionales,
                  vCiudadano.adjudicacion_proceso,
                  vCiudadano.adjudicacion_estado
                From
                  vCiudadano
                Where
                  (vCiudadano.idAdjudicacion IS NOT NULL And vCiudadano.idContratacion IS NULL) And
                  (
                      (vCiudadano.programa_codigo Like '%$criterio%') Or
                      (vCiudadano.programa_nombre Like '%$criterio%') Or
                      (vCiudadano.programa_descripcion Like '%$criterio%') Or
                      (vCiudadano.BIP Like '%$criterio%') Or
                      (vCiudadano.programa_proposito Like '%$criterio%') Or
                      (vCiudadano.programa_funcionario Like '%$criterio%') Or
                      (vCiudadano.proyecto_codigo Like '%$criterio%') Or
                      (vCiudadano.proyecto_nombre Like '%$criterio%') Or
                      (vCiudadano.proyecto_descripcion Like '%$criterio%') Or
                      (vCiudadano.proyecto_depto Like '%$criterio%') Or
                      (vCiudadano.proyecto_muni Like '%$criterio%') Or
                      (vCiudadano.proyecto_funcionario Like '%$criterio%') Or
                      (vCiudadano.proyecto_ubicacion Like '%$criterio%') Or
                      (vCiudadano.calificacion_codigo Like '%$criterio%') Or
                      (vCiudadano.calificacion_nombre Like '%$criterio%') Or
                      (vCiudadano.calificacion_funcionario Like '%$criterio%') Or
                      (vCiudadano.adjudicacion_codigo Like '%$criterio%') Or
                      (vCiudadano.adjudicacion_nombre Like '%$criterio%') Or
                      (vCiudadano.contratacion_nombre Like '%$criterio%') Or
                      (vCiudadano.contratacion_numero Like '%$criterio%') Or
                      (vCiudadano.contratacion_alcances Like '%$criterio%')
                   )
                "; 
        
        $command=Yii::app()->db->createCommand($sql);
        $adjudicacion=$command->queryAll();
        $this->renderPartial('Listaadjudicacion', array('Adjudicacion'=>$adjudicacion));
        
        // *********************** Lista de Calificaciones
        $sql=    "Select DISTINCT
                  vCiudadano.idPrograma,
                  vCiudadano.idProyecto,
                  vCiudadano.idCalificacion,
                  vCiudadano.calificacion_codigo,
                  vCiudadano.calificacion_nombre,
                  vCiudadano.calificacion_estatus,
                  vCiudadano.calificacion_evaluacion,
                  vCiudadano.calificacion_estado,
                  vCiudadano.calificacion_funcionario
                From
                  vCiudadano
                Where
                  (vCiudadano.idCalificacion is not null And vCiudadano.idAdjudicacion is null) And
                  (
                      (vCiudadano.programa_codigo Like '%$criterio%') Or
                      (vCiudadano.programa_nombre Like '%$criterio%') Or
                      (vCiudadano.programa_descripcion Like '%$criterio%') Or
                      (vCiudadano.BIP Like '%$criterio%') Or
                      (vCiudadano.programa_proposito Like '%$criterio%') Or
                      (vCiudadano.programa_funcionario Like '%$criterio%') Or
                      (vCiudadano.proyecto_codigo Like '%$criterio%') Or
                      (vCiudadano.proyecto_nombre Like '%$criterio%') Or
                      (vCiudadano.proyecto_descripcion Like '%$criterio%') Or
                      (vCiudadano.proyecto_depto Like '%$criterio%') Or
                      (vCiudadano.proyecto_muni Like '%$criterio%') Or
                      (vCiudadano.proyecto_funcionario Like '%$criterio%') Or
                      (vCiudadano.proyecto_ubicacion Like '%$criterio%') Or
                      (vCiudadano.calificacion_codigo Like '%$criterio%') Or
                      (vCiudadano.calificacion_nombre Like '%$criterio%') Or
                      (vCiudadano.calificacion_funcionario Like '%$criterio%') Or
                      (vCiudadano.adjudicacion_codigo Like '%$criterio%') Or
                      (vCiudadano.adjudicacion_nombre Like '%$criterio%') Or
                      (vCiudadano.contratacion_nombre Like '%$criterio%') Or
                      (vCiudadano.contratacion_numero Like '%$criterio%') Or
                      (vCiudadano.contratacion_alcances Like '%$criterio%')
                   )
                ";
        
        $command=Yii::app()->db->createCommand($sql);
        $calificacion=$command->queryAll();
        $this->renderPartial('Listacalificacion', array('Calificacion'=>$calificacion));
        
        // *********************** Lista de Proyectos
        $sql=    "Select DISTINCT
                  vCiudadano.idPrograma,
                  vCiudadano.idProyecto,
                  vCiudadano.proyecto_codigo,
                  vCiudadano.proyecto_nombre,
                  vCiudadano.proyecto_descripcion,
                  vCiudadano.proyecto_presupuesto,
                  vCiudadano.proyecto_estado,
                  vCiudadano.proyecto_funcionario,
                  vCiudadano.proyecto_ubicacion 
                From
                  vCiudadano
                Where
                  (vCiudadano.idProyecto is not null And vCiudadano.idCalificacion is null) And
                   (
                      (vCiudadano.programa_codigo Like '%$criterio%') Or
                      (vCiudadano.programa_nombre Like '%$criterio%') Or
                      (vCiudadano.programa_descripcion Like '%$criterio%') Or
                      (vCiudadano.BIP Like '%$criterio%') Or
                      (vCiudadano.programa_proposito Like '%$criterio%') Or
                      (vCiudadano.programa_funcionario Like '%$criterio%') Or
                      (vCiudadano.proyecto_codigo Like '%$criterio%') Or
                      (vCiudadano.proyecto_nombre Like '%$criterio%') Or
                      (vCiudadano.proyecto_descripcion Like '%$criterio%') Or
                      (vCiudadano.proyecto_depto Like '%$criterio%') Or
                      (vCiudadano.proyecto_muni Like '%$criterio%') Or
                      (vCiudadano.proyecto_funcionario Like '%$criterio%') Or
                      (vCiudadano.proyecto_ubicacion Like '%$criterio%') Or
                      (vCiudadano.calificacion_codigo Like '%$criterio%') Or
                      (vCiudadano.calificacion_nombre Like '%$criterio%') Or
                      (vCiudadano.calificacion_funcionario Like '%$criterio%') Or
                      (vCiudadano.adjudicacion_codigo Like '%$criterio%') Or
                      (vCiudadano.adjudicacion_nombre Like '%$criterio%') Or
                      (vCiudadano.contratacion_nombre Like '%$criterio%') Or
                      (vCiudadano.contratacion_numero Like '%$criterio%') Or
                      (vCiudadano.contratacion_alcances Like '%$criterio%')
                    )
                ";
        
        $command=Yii::app()->db->createCommand($sql);
        $proyecto=$command->queryAll();
        $this->renderPartial('Listaproyecto', array('Proyecto'=>$proyecto));
        
        
        // *********************** Lista de Programa
        $sql=    "Select DISTINCT
                  vCiudadano.idPrograma,
                  vCiudadano.programa_codigo,
                  vCiudadano.programa_nombre,
                  vCiudadano.programa_descripcion,
                  vCiudadano.programa_costo,
                  vCiudadano.programa_fecha,
                  vCiudadano.BIP,
                  vCiudadano.programa_estado,
                  vCiudadano.programa_funcionario  
                From
                  vCiudadano
                Where
                  (vCiudadano.idPrograma is not null And vCiudadano.idProyecto is null) And
                  (
                      (vCiudadano.programa_codigo Like '%$criterio%') Or
                      (vCiudadano.programa_nombre Like '%$criterio%') Or
                      (vCiudadano.programa_descripcion Like '%$criterio%') Or
                      (vCiudadano.BIP Like '%$criterio%') Or
                      (vCiudadano.programa_proposito Like '%$criterio%') Or
                      (vCiudadano.programa_funcionario Like '%$criterio%') Or
                      (vCiudadano.proyecto_codigo Like '%$criterio%') Or
                      (vCiudadano.proyecto_nombre Like '%$criterio%') Or
                      (vCiudadano.proyecto_descripcion Like '%$criterio%') Or
                      (vCiudadano.proyecto_depto Like '%$criterio%') Or
                      (vCiudadano.proyecto_muni Like '%$criterio%') Or
                      (vCiudadano.proyecto_funcionario Like '%$criterio%') Or
                      (vCiudadano.proyecto_ubicacion Like '%$criterio%') Or
                      (vCiudadano.calificacion_codigo Like '%$criterio%') Or
                      (vCiudadano.calificacion_nombre Like '%$criterio%') Or
                      (vCiudadano.calificacion_funcionario Like '%$criterio%') Or
                      (vCiudadano.adjudicacion_codigo Like '%$criterio%') Or
                      (vCiudadano.adjudicacion_nombre Like '%$criterio%') Or
                      (vCiudadano.contratacion_nombre Like '%$criterio%') Or
                      (vCiudadano.contratacion_numero Like '%$criterio%') Or
                      (vCiudadano.contratacion_alcances Like '%$criterio%')
                   )
                ";
        
        $command=Yii::app()->db->createCommand($sql);
        $programa=$command->queryAll();
        $this->renderPartial('Listaprograma', array('Programas'=>$programa));
        
    }
    
    public function actionBMapa()
    {    
        $criterio=$_POST['id'];
        
		// *********************** Lista de contratos
        $sql=    "Select DISTINCT
                  vCiudadano.idPrograma,
                  vCiudadano.idProyecto,
                  vCiudadano.idCalificacion,
                  vCiudadano.idAdjudicacion,
                  vCiudadano.idContratacion,
                  vCiudadano.contratacion_nombre,
                  vCiudadano.contratacion_numero,
                  vCiudadano.contratacion_alcances,
                  vCiudadano.contratacion_precio,
                  vCiudadano.contratacion_inicio,
                  vCiudadano.contratacion_final,
                  vCiudadano.contratacion_duracion,
                  vCiudadano.contratacion_estado 
                From
                  vCiudadano
                Where
                  (vCiudadano.idContratacion is not null) And
                  (
                      (vCiudadano.proyecto_codigo_depto = '$criterio')
                  )
                ";
        
        $command=Yii::app()->db->createCommand($sql);
        $contrato=$command->queryAll();
        $this->renderPartial('Listacontrato', array('Contratos'=>$contrato));
        
        // *********************** Lista de Adjudicaciones
        $sql=    "Select DISTINCT
                  vCiudadano.idPrograma,
                  vCiudadano.idProyecto,
                  vCiudadano.idCalificacion,
                  vCiudadano.idAdjudicacion,
                  vCiudadano.idContratacion,
                  vCiudadano.adjudicacion_codigo,
                  vCiudadano.adjudicacion_nombre,
                  vCiudadano.adjudicacion_nacionales,
                  vCiudadano.adjudicacion_internacionales,
                  vCiudadano.adjudicacion_proceso,
                  vCiudadano.adjudicacion_estado
                From
                  vCiudadano
                Where
                  (vCiudadano.idAdjudicacion IS NOT NULL And vCiudadano.idContratacion IS NULL) And
                  (
                      (vCiudadano.proyecto_codigo_depto = '$criterio')
                   )
                "; 
        
        $command=Yii::app()->db->createCommand($sql);
        $adjudicacion=$command->queryAll();
        $this->renderPartial('Listaadjudicacion', array('Adjudicacion'=>$adjudicacion));
        
        // *********************** Lista de Calificaciones
        $sql=    "Select DISTINCT
                  vCiudadano.idPrograma,
                  vCiudadano.idProyecto,
                  vCiudadano.idCalificacion,
                  vCiudadano.calificacion_codigo,
                  vCiudadano.calificacion_nombre,
                  vCiudadano.calificacion_estatus,
                  vCiudadano.calificacion_evaluacion,
                  vCiudadano.calificacion_estado,
                  vCiudadano.calificacion_funcionario
                From
                  vCiudadano
                Where
                  (vCiudadano.idCalificacion is not null And vCiudadano.idAdjudicacion is null) And
                  (
                      (vCiudadano.proyecto_codigo_depto = '$criterio')
                  )
                ";
        
        $command=Yii::app()->db->createCommand($sql);
        $calificacion=$command->queryAll();
        $this->renderPartial('Listacalificacion', array('Calificacion'=>$calificacion));
        
        // *********************** Lista de Proyectos
        $sql=    "Select DISTINCT
                  vCiudadano.idPrograma,
                  vCiudadano.idProyecto,
                  vCiudadano.proyecto_codigo,
                  vCiudadano.proyecto_nombre,
                  vCiudadano.proyecto_descripcion,
                  vCiudadano.proyecto_presupuesto,
                  vCiudadano.proyecto_estado,
                  vCiudadano.proyecto_funcionario,
                  vCiudadano.proyecto_ubicacion 
                From
                  vCiudadano
                Where
                  (vCiudadano.idProyecto is not null And vCiudadano.idCalificacion is null) And
                  (
                      (vCiudadano.proyecto_codigo_depto = '$criterio')
                  )
                ";
        
        $command=Yii::app()->db->createCommand($sql);
        $proyecto=$command->queryAll();
        $this->renderPartial('Listaproyecto', array('Proyecto'=>$proyecto));
        
        
        // *********************** Lista de Programa
        $sql=    "Select DISTINCT
                  vCiudadano.idPrograma,
                  vCiudadano.programa_codigo,
                  vCiudadano.programa_nombre,
                  vCiudadano.programa_descripcion,
                  vCiudadano.programa_costo,
                  vCiudadano.programa_fecha,
                  vCiudadano.BIP,
                  vCiudadano.programa_estado,
                  vCiudadano.programa_funcionario  
                From
                  vCiudadano
                Where
                  (vCiudadano.idPrograma is not null And vCiudadano.idProyecto is null) And
                  (
                      (vCiudadano.proyecto_codigo_depto = '$criterio')
                  )
                ";
        
        $command=Yii::app()->db->createCommand($sql);
        $programa=$command->queryAll();
        $this->renderPartial('Listaprograma', array('Programas'=>$programa));
        
    }

    public function actionFichaTecnica($control, $id)
    {

        switch ($control)
        {
            case 'Programa':
                $sql = "Select Distinct
                          vCiudadano.idPrograma
                        From
                          vCiudadano
                        Where 
                          vCiudadano.idPrograma = $id
                        ";
                break;
            case 'Proyecto':
                $sql = "Select Distinct
                          vCiudadano.idPrograma,
                          vCiudadano.idProyecto
                        From
                          vCiudadano
                        Where 
                          vCiudadano.idProyecto = $id
                        ";
                break;
            case 'Calificacion':
                $sql = "Select Distinct
                          vCiudadano.idPrograma,
                          vCiudadano.idProyecto,
                          vCiudadano.idCalificacion
                        From
                          vCiudadano
                        Where 
                          vCiudadano.idCalificacion = $id
                        ";
                break;
            case 'Adjudicacion':
                $sql = "Select Distinct
                          vCiudadano.idPrograma,
                          vCiudadano.idProyecto,
                          vCiudadano.idCalificacion,
                          vCiudadano.idAdjudicacion
                        From
                          vCiudadano
                        Where 
                          vCiudadano.idAdjudicacion = $id
                        ";
                break;
            case 'Contratacion':
                $sql = "Select Distinct
                          vCiudadano.idPrograma,
                          vCiudadano.idProyecto,
                          vCiudadano.idCalificacion,
                          vCiudadano.idAdjudicacion,
                          vCiudadano.idContratacion,
                          vCiudadano.idEjecucion
                        From
                          vCiudadano
                        Where 
                          vCiudadano.idContratacion = $id
                        ";
                break;
        };
        
        $command=Yii::app()->db->createCommand($sql);
        $ids=$command->queryAll();
        
        switch ($control) 
        {
            case 'Programa':
                $programa=Yii::app()->db->createCommand('SELECT * FROM vPrograma WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();
                $programa_fuentes=Yii::app()->db->createCommand('SELECT * FROM vPrograma_Fuentes WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();
                $programa_proposito=Yii::app()->db->createCommand('SELECT * FROM vPrograma_Proposito WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();

                $proyecto=Array();
                $proyecto_beneficiario=Array();
                $proyecto_fuente=Array();

                $calificacion=Array();
                $calificacion_empresa=Array();
                $calificacion_firma=Array();
                $calificacion_oferente=Array();

                $adjudicacion=Array();

                $contratacion=Array();
                $contratos_gestion=Array();
                $ejecucion=Array();
                $avances=Array();
                break;
            case 'Proyecto':
                $programa=Yii::app()->db->createCommand('SELECT * FROM vPrograma WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();
                $programa_fuentes=Yii::app()->db->createCommand('SELECT * FROM vPrograma_Fuentes WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();
                $programa_proposito=Yii::app()->db->createCommand('SELECT * FROM vPrograma_Proposito WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();

                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vProyecto_Beneficiario WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vProyecto_Fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();

                $calificacion=Array();
                $calificacion_empresa=Array();
                $calificacion_firma=Array();
                $calificacion_oferente=Array();

                $adjudicacion=Array();

                $contratacion=Array();
                $contratos_gestion=Array();
                $ejecucion=Array();
                $avances=Array();
                break;
            case 'Calificacion':
                $programa=Yii::app()->db->createCommand('SELECT * FROM vPrograma WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();
                $programa_fuentes=Yii::app()->db->createCommand('SELECT * FROM vPrograma_Fuentes WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();
                $programa_proposito=Yii::app()->db->createCommand('SELECT * FROM vPrograma_Proposito WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();

                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vProyecto_Beneficiario WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vProyecto_Fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();

                $calificacion=Yii::app()->db->createCommand('SELECT * FROM vCalificacion WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_empresa=Yii::app()->db->createCommand('SELECT * FROM vCalificacion_Empresa WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_firma=Yii::app()->db->createCommand('SELECT * FROM vCalificacion_Firma WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_oferente=Yii::app()->db->createCommand('SELECT * FROM vCalificacion_Oferente WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();

                $adjudicacion=Array();

                $contratacion=Array();
                $contratos_gestion=Array();
                $ejecucion=Array();
                $avances=Array();
                break;
            case 'Adjudicacion':
                $programa=Yii::app()->db->createCommand('SELECT * FROM vPrograma WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();
                $programa_fuentes=Yii::app()->db->createCommand('SELECT * FROM vPrograma_Fuentes WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();
                $programa_proposito=Yii::app()->db->createCommand('SELECT * FROM vPrograma_Proposito WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();

                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vProyecto_Beneficiario WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vProyecto_Fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();

                $calificacion=Yii::app()->db->createCommand('SELECT * FROM vCalificacion WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_empresa=Yii::app()->db->createCommand('SELECT * FROM vCalificacion_Empresa WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_firma=Yii::app()->db->createCommand('SELECT * FROM vCalificacion_Firma WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_oferente=Yii::app()->db->createCommand('SELECT * FROM vCalificacion_Oferente WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();

                $adjudicacion=Yii::app()->db->createCommand('SELECT * FROM vAdjudicacion WHERE idAdjudicacion='.$ids[0]['idAdjudicacion'])->queryAll();

                $contratacion=Array();
                $contratos_gestion=Array();
                $ejecucion=Array();
                $avances=Array();
                break;
            case 'Contratacion':
                $programa=Yii::app()->db->createCommand('SELECT * FROM vPrograma WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();
                $programa_fuentes=Yii::app()->db->createCommand('SELECT * FROM vPrograma_Fuentes WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();
                $programa_proposito=Yii::app()->db->createCommand('SELECT * FROM vPrograma_Proposito WHERE idPrograma='.$ids[0]['idPrograma'])->queryAll();

                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vProyecto_Beneficiario WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vProyecto_Fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();

                $calificacion=Yii::app()->db->createCommand('SELECT * FROM vCalificacion WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_empresa=Yii::app()->db->createCommand('SELECT * FROM vCalificacion_Empresa WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_firma=Yii::app()->db->createCommand('SELECT * FROM vCalificacion_Firma WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_oferente=Yii::app()->db->createCommand('SELECT * FROM vCalificacion_Oferente WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();

                $adjudicacion=Yii::app()->db->createCommand('SELECT * FROM vAdjudicacion WHERE idAdjudicacion='.$ids[0]['idAdjudicacion'])->queryAll();

                $contratacion=Yii::app()->db->createCommand('SELECT * FROM vContratacion WHERE idContratacion='.$ids[0]['idContratacion'])->queryAll();
                $contratos_gestion=Yii::app()->db->createCommand('SELECT * FROM vContratos_Gestion WHERE idContratacion='.$ids[0]['idContratacion'])->queryAll();
                $ejecucion=Yii::app()->db->createCommand('SELECT * FROM vEjecucion WHERE idContratacion='.$ids[0]['idContratacion'])->queryAll();
                $avances=Yii::app()->db->createCommand('SELECT * FROM vAvances WHERE idContratacion='.$ids[0]['idContratacion'])->queryAll();
                break;
        };
        
		$this->render('fichatecnica',array(
                'programa'=>$programa,
                'programa_fuentes'=>$programa_fuentes,
                'programa_proposito'=>$programa_proposito,

                'proyecto'=>$proyecto,
                'proyecto_beneficiario'=>$proyecto_beneficiario,
                'proyecto_fuente'=>$proyecto_fuente,

                'calificacion'=>$calificacion,
                'calificacion_empresa'=>$calificacion_empresa,
                'calificacion_firma'=>$calificacion_firma,
                'calificacion_oferente'=>$calificacion_oferente,

                'adjudicacion'=>$adjudicacion,

                'contratacion'=>$contratacion,
                'contratos_gestion'=>$contratos_gestion,
                'ejecucion'=>$ejecucion,
                'avances'=>$avances,
            ));
    }
    
    public function getNameFromURL($url)
    {
        $retval = 'N/A';
        
        if (strlen($url) > 0) {
            if (!(strrpos($url, '/')==false)) {
                $retval = substr($url, strrpos($url, '/') + 1);
            }
        };

        return $retval;
    }
    
    // Marcador
    
    public function actionInformes()
	{
		$this->setPageTitle("Informes Gerenciales");
		$this->render('Informes');
	}

	public function actionInformetecproyecto()
	{
		$this->setPageTitle("Informe Técnico de Proyecto");
		$this->render('Informetecproyecto');
	}

	public function actionInformetecprograma()
	{
		$this->setPageTitle("Informe Técnico de Programa");
		$this->render('Informetecprograma');
	}

	public function actionInformeingsistema()
	{
		$this->setPageTitle("Informe de Ingresos al Sistema");
		$this->render('Informeingsistema');
	}

	public function actionInformecumplimiento()
	{
		$this->setPageTitle("Informe de Cumplimiento de Registro de la Información");
		$this->render('Informecumplimiento');
	}

	public function actiongaleriafotos($idcon)
	{
		$this->setPageTitle("Galeria de Fotos");
		//$images=ImgAdjuntadas::model()->findAll("cod_contrato =$idcon");
		 $images=ImgAdjuntadas::model()->findAll("cod_contrato ='".$idcon."'");
		$this->render('galeriafotos',array('images'=>$images,));
	}

	public function actionBCumplimiento()
	{
		$criterio=$_POST['criterio'];
		$tipo=$_POST['tipo'];
		$sql="Select * FROM ";
		if($tipo == "programa") $sql=$sql."cs_programa "; 
		if($tipo == "proyecto") $sql=$sql."cs_proyecto "; 
		if($tipo == "calificacion") $sql=$sql."cs_calificacion "; 
		if($tipo == "adjudicacion") $sql=$sql."cs_adjudicacion "; 
		if($tipo == "contratacion") $sql=$sql."cs_contratacion "; 
		if($tipo == "contrato") $sql=$sql."cs_contratos "; 
		if($tipo == "todos") $sql=$sql."cs_programa, cs_proyecto, cs_calificacion, cs_adjudicacion, cs_contratacion, cs_contratos ";
		if($criterio == "1") $sql=$sql." WHERE DATEDIFF(DATE_FORMAT(STR_TO_DATE(fechacreacion,'%d/%m/%Y'),'%Y/%m/%d'),DATE_FORMAT(STR_TO_DATE(fecharecibido,'%d/%m/%Y'),'%Y/%m/%d')) < 2 ";
		if($criterio == "2") $sql=$sql." WHERE DATEDIFF(DATE_FORMAT(STR_TO_DATE(fechacreacion,'%d/%m/%Y'),'%Y/%m/%d'),DATE_FORMAT(STR_TO_DATE(fecharecibido,'%d/%m/%Y'),'%Y/%m/%d')) between 2 AND 5 ";
		if($criterio == "3") $sql=$sql." WHERE DATEDIFF(DATE_FORMAT(STR_TO_DATE(fechacreacion,'%d/%m/%Y'),'%Y/%m/%d'),DATE_FORMAT(STR_TO_DATE(fecharecibido,'%d/%m/%Y'),'%Y/%m/%d')) between 5 AND 10 ";
		if($criterio == "4") $sql=$sql." WHERE DATEDIFF(DATE_FORMAT(STR_TO_DATE(fechacreacion,'%d/%m/%Y'),'%Y/%m/%d'),DATE_FORMAT(STR_TO_DATE(fecharecibido,'%d/%m/%Y'),'%Y/%m/%d')) > 10 ";
                if($tipo == "programa") 
                {
                    $programa= Programa::model()->findAllBySql($sql);
                    $this->renderPartial('Listaprograma_1', array('Programas'=>$programa));
                }
		if($tipo == "proyecto")  
                {
                    $proyecto=  Proyecto::model()->findAllBySql($sql);
                    $this->renderPartial('Listaproyecto_1', array('Proyectos'=>$proyecto));
                }
		if($tipo == "calificacion") 
                    {
                    $calificacion= Calificacion::model()->findAllBySql($sql);
                    $this->renderPartial('Listacalificacion', array('Calificacion'=>$calificacion));
                }
		if($tipo == "adjudicacion")  
                    {
                    $adjudicacion= Adjudicacion::model()->findAllBySql($sql);
                    $this->renderPartial('Listaadjudicacion', array('Adjudicacion'=>$adjudicacion));
                }
		if($tipo == "contratacion") 
                    {
                    $contratacion= Contratacion::model()->findAllBySql($sql);
                    $this->renderPartial('Listacontratacion', array('Contratacion'=>$contratacion));
                }
		if($tipo == "contrato") 
                    {
                    $contrato= Contratos::model()->findAllBySql($sql);
                    $this->renderPartial('Listacontrato_1', array('Contratos'=>$contrato));
                }
		//if($tipo == "todos") 
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
				 
                 $model = Programa::model()->findAll();    
				 //$model = Programa::model()->find('programa'=$model->programa');  
				   
		Yii::app()->request->sendFile(date('YmdHis').'.xls',
			$this->renderPartial('fichatecnicaexcel', array(
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
                
                 $model = Programa::model()->findAll();

		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		$pdf = Yii::createComponent('application.extensions.MPDF56.mpdf');
		$pdf= new mPDF();
        $pdf->WriteHTML($html);
         $nom="Programa_".date("d-m-Y").".pdf";
        $url=Yii::app()->baseUrl . '/'.$nom;
         //$url=Yii::app()->basePath."/images/".$nom;
        $pdf->Output($nom,"F");              
        echo '<a href='.$url.'>Descargar Reporte </a>';
                Yii::app()->end();
	}
}