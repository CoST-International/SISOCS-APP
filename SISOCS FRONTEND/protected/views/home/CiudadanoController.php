<?php

class CiudadanoController extends Controller
{
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('BProyecto','update'),
				'users'=>array('@'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('actionviewproyecto','update'),
				'users'=>array('@'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('BPrograma','update','fichatecnicapro','fichatecnicaprg','fichatecnicacon','Informecumplimiento','BCumplimiento'),
				'users'=>array('@'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('actionviewprograma','update'),
				'users'=>array('@'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('actionviewcontrato','update'),
				'users'=>array('@'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('actionComayagua','update'),
				'users'=>array('@'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('actionfichatecnica','update'),
				'users'=>array('@'),
			),
		);
	}
	public function actionAdmin()
	{
		$model=new Programa('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Programa']))
			$model->attributes=$_GET['Programa'];

		$this->render('admin',array(
			'model'=>$model,
		));
		//$this->render('admin');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionBProyecto()
	{	
		
		$command=Yii::app()->db->createCommand("SELECT * FROM v_proyecto WHERE (nombre_proyecto LIKE '%".$_POST['criterio']."%'  OR descrip LIKE '%".$_POST['criterio']."%' OR nombreprograma LIKE '%".$_POST['criterio']."%' OR departamento LIKE '%".$_POST['criterio']."%'  OR region LIKE '%".$_POST['criterio']."%' ) AND estado = 'PUBLICADO'");
        $proyecto=$command->queryAll();
        $this->renderPartial('Listaproyecto', array('Proyectos'=>$proyecto));
		
		 $command=Yii::app()->db->createCommand("select cs_programa.idPrograma,cs_programa.programa,cs_programa.BIP,cs_programa.nombreprograma,cs_programa.entes,cs_programa.idFuncionario,cs_programa.idRol,
			cs_programa.idSector,cs_programa.idSubSector,cs_programa.descripcion as descripcion_p,cs_programa.costoesti,cs_programa.fechaapro,cs_programa.cartaconvenio,cs_programa.otro1,
			cs_programa.planope,cs_programa.presupuesto,cs_programa.perfildelprogra,cs_programa.otro2,cs_programa.fechacreacion,cs_programa.estado,cs_programa.idProposito,cs_programa.fecharecibido,cs_programa.moneda,
			cs_entes.descripcion as descripcion_e,cs_funcionarios.nombre,cs_funcionarios.puesto,cs_rol.rol,cs_sector.sector,cs_subsector.subsector,cs_proposito.proposito
			from cs_programa
			left outer join cs_entes on cs_programa.entes=cs_entes.idente
			left outer join cs_funcionarios on cs_programa.idFuncionario=cs_funcionarios.idfuncionario
			left outer join cs_rol on cs_programa.idRol=cs_rol.idrol
			left outer join cs_sector on cs_programa.idRol=cs_sector.idsector
			left outer join cs_subsector on cs_programa.idRol=cs_subsector.idsubsector
			left outer join cs_proposito on cs_programa.idRol=cs_proposito.idproposito WHERE (cs_programa.nombreprograma LIKE '%".$_POST['criterio']."%' OR cs_funcionarios.nombre LIKE '%".$_POST['criterio']."%' OR cs_funcionarios.puesto LIKE '%".$_POST['criterio']."%') AND cs_programa.estado = 'PUBLICADO' ");
        $programa=$command->queryAll();
		$this->renderPartial('Listaprograma', array('Programas'=>$programa));
		
		
		$command=Yii::app()->db->createCommand("select cs_contratacion.idContratacion, cs_contratacion.idAdjudicacion, cs_contratacion.idEntidad, cs_contratacion.idoferente,
												cs_contratacion.precio, cs_contratacion.alcances, cs_contratacion.fechainicio, cs_contratacion.fechafinal, cs_contratacion.duracioncontrato,
												cs_contratacion.documentocontra, cs_contratacion.regante, cs_contratacion.espeplanos, cs_contratacion.estado, cs_contratacion.otro,
												cs_contratacion.ncontrato, cs_contratacion.titulocontrato, cs_contratacion.fecharecibido, cs_contratacion.fechacreacion,
												cs_adjudicacion.nomprocesoproyecto,cs_entes.descripcion,cs_oferente.nombre_oferente
												from cs_contratacion
												left outer join cs_adjudicacion on cs_contratacion.idAdjudicacion=cs_adjudicacion.idadjudicacion
												left outer join cs_entes on cs_contratacion.idEntidad=cs_entes.idente
												left outer join cs_oferente on cs_contratacion.idOferente=cs_oferente.idoferentes
												WHERE (cs_contratacion.alcances LIKE '%".$_POST['criterio']."%' OR cs_contratacion.titulocontrato LIKE '%".$_POST['criterio']."%' OR cs_adjudicacion.nomprocesoproyecto LIKE '%".$_POST['criterio']."%')  AND cs_contratacion.estado = 'PUBLICADO'");
        $contrato=$command->queryAll();
        $this->renderPartial('Listacontrato', array('Contratos'=>$contrato));
		
		
		$command=Yii::app()->db->createCommand("SELECT cs_adjudicacion.idAdjudicacion, cs_adjudicacion.idCalificacion, cs_adjudicacion.numproceso, cs_adjudicacion.nomprocesoproyecto, cs_adjudicacion.nconsulnac,
												cs_adjudicacion.nconsulinter, cs_adjudicacion.costoesti, cs_adjudicacion.estadoproceso, cs_adjudicacion.actaaper, cs_adjudicacion.informeacta, cs_adjudicacion.resoladju, cs_adjudicacion.estado,
												cs_adjudicacion.otro, cs_adjudicacion.numfirmasnac, cs_adjudicacion.numfimasinter, cs_adjudicacion.numconsulcorta, cs_adjudicacion.fecharecibido, cs_adjudicacion.fechacreacion
												FROM cs_adjudicacion
												WHERE (cs_adjudicacion.numproceso LIKE '%".$_POST['criterio']."%' OR cs_adjudicacion.nomprocesoproyecto LIKE '%".$_POST['criterio']."%' )  AND cs_adjudicacion.estado = 'PUBLICADO'");
        $adjudicacion=$command->queryAll();
        $this->renderPartial('Listaadjudicacion', array('Adjudicacion'=>$adjudicacion));
		
		$command=Yii::app()->db->createCommand("SELECT cs_calificacion.idCalificacion, cs_calificacion.idProyecto, cs_calificacion.numproceso, cs_calificacion.nomprocesoproyecto, cs_calificacion.fechactualizacion,
			cs_calificacion.idFuncionario, cs_calificacion.estatusproceso, cs_calificacion.proceseval, cs_calificacion.invitainter, cs_calificacion.basespreca, cs_calificacion.resolucion, 
			cs_calificacion.nombreante, cs_calificacion.convocainvi, cs_calificacion.tdr, cs_calificacion.aclaraciones, cs_calificacion.actarecpcion, cs_calificacion.fechaingreso, cs_calificacion.tipocontrato, 
			cs_calificacion.estado, cs_calificacion.otro1, cs_calificacion.otro2, cs_calificacion.identidadadquisicion, cs_calificacion.idmetodo, cs_calificacion.fecharecibido, cs_proyecto.nombre_proyecto, cs_funcionarios.nombre,
			cs_tiposadquisicion.adquisicion
			FROM cs_calificacion
			LEFT OUTER JOIN cs_proyecto ON cs_calificacion.idProyecto = cs_proyecto.idProyecto
			LEFT OUTER JOIN cs_funcionarios ON cs_proyecto.idfuncionario = cs_funcionarios.idfuncionario
			LEFT OUTER JOIN cs_tiposadquisicion ON cs_calificacion.identidadadquisicion=cs_tiposadquisicion.idtipo
			WHERE (cs_calificacion.numproceso LIKE '%".$_POST['criterio']."%' OR cs_calificacion.nomprocesoproyecto LIKE '%".$_POST['criterio']."%' OR cs_funcionarios.nombre LIKE '%".$_POST['criterio']."%')  AND cs_calificacion.estado = 'PUBLICADO'");
        $calificacion=$command->queryAll();
        $this->renderPartial('Listacalificacion', array('Calificacion'=>$calificacion));
		
		/*
        $command=Yii::app()->db->createCommand("SELECT * FROM v_programa WHERE titulocontrato LIKE '%".$_POST['criterio']."%' AND estado = 'PUBLICADO' ");
        $contrato=$command->queryAll();
        $this->renderPartial('Listacontrato', array('Contratos'=>$contrato));
		print_r($programa);
		/*
		print_r($contrato);
        
        $depto=Yii::app()->db->createCommand()
				->select('iddepto')
                ->from('cs_departamento')
                ->where("departamento LIKE '%".strtolower($_POST['criterio'])."%'")
                ->queryScalar();
		$query="SELECT * FROM cs_proyecto WHERE (idProyecto LIKE '%".$_POST['criterio']."%' OR idPrograma LIKE '%".$_POST['criterio']."%' OR nombre_proyecto LIKE '%".$_POST['criterio']."%' OR idDepto LIKE '%".$depto."%') AND estado = 'PUBLICADO'";
		$proyecto=Proyecto::model()->findAllBySql($query);		
		$this->renderPartial('Listaproyecto', array('Proyectos'=>$proyecto));
		$query="SELECT * FROM cs_programa WHERE (idPrograma LIKE '%".$_POST['criterio']."%' OR programa LIKE '%".$_POST['criterio']."%' OR nombreprograma LIKE '%".$_POST['criterio']."%') AND estado = 'PUBLICADO'";
		$programa=Programa::model()->findAllBySql($query);		
		$this->renderPartial('Listaprograma', array('Programas'=>$programa));
		$idcontr=Yii::app()->db->createCommand()
                ->select('idContratacion')
                ->from('cs_contratos')
                ->where("alcanceactucontrato LIKE '%".$_POST['criterio']."%'")
                ->queryScalar();
		$query="SELECT * FROM cs_contratacion WHERE (idEntidad LIKE '%".$_POST['criterio']."%' OR idoferente LIKE '%".$_POST['criterio']."%' OR titulocontrato LIKE '%".$_POST['criterio']."%' OR idContratacion = '".$idcontr."') AND estado = 'PUBLICADO'";
		$contrato=Contratacion::model()->findAllBySql($query);		
		$this->renderPartial('Listacontrato', array('Contratos'=>$contrato));
        */
	}

	public function actionviewproyecto($id)
	{
		$this->render('viewproyecto',array(
			'model'=>$this->loadModelProy($id),
		));
	}

	public function loadModelProy($id)
	{           
		$model=Proyecto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
/*
	public function actionBPrograma()
	{		
		$query="SELECT * FROM cs_programa WHERE nombreprograma LIKE '%".$_POST['criterio']."%' OR funcinombre LIKE '%".$_POST['criterio']."%'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$programa=Programa::model()->findAllBySql($query);		
		$this->renderPartial('Listaprograma', array('Programas'=>$programa));
	}
*/
	public function actionviewprograma($id)
	{
		$this->render('viewprograma',array(
			'model'=>$this->loadModelProg($id),
		));
	}

	public function loadModelProg($id)
	{            
		$model=Programa::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionviewcontrato($id)
	{
		$this->render('viewcontrato',array(
			'model'=>$this->loadModelCon($id),
		));
	}

	public function loadModelCon($id)
	{            
		$model=Contratacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelCn($id)
	{            
		$model=Contratos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelObra($id)
	{
		$model=Obras::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelAvances($id)
	{
		$model=Avances::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelActividades($id)
	{
		$model=Actividades::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionComayagua()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%03%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("Comayagua");	
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionAtlantida()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%01%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);
		$this->setPageTitle("Atlántida");		
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionCortes()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%05%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("Cortés");	
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionislasdelabahia()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%11%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("Islas de la Bahía");	
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionlapaz()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%12%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("La Paz");	
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionvalle()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%17%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);
		$this->setPageTitle("Valle");		
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionCholuteca()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%06%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("Choluteca");
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionYoro()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%18%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);
		$this->setPageTitle("Yoro");	
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionelparaiso()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%07%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("El Paraíso");		
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionsantabarbara()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%16%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("Santa Bárbara");		
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionLempira()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%13%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);
		$this->setPageTitle("Lempira");			
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionfranciscomorazan()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%08%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("Francisco Morazán");		
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionOlancho()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%15%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("Olancho");		
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionColon()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%02%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("Colón");		
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionOcotepeque()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%14%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("Ocotepeque");		
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionCopan()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%04%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);
		$this->setPageTitle("Copán");			
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actionIntibuca()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%10%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);	
		$this->setPageTitle("Intibucá");	
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}
	public function actiongraciasadios()
	{		
		$query="SELECT * FROM cs_proyecto WHERE idDepto LIKE '%09%' AND estado = 'PUBLICADO'";
		//$query="SELECT * FROM cs_proyecto WHERE programa LIKE '%prog%' ";
		$proyecto=Proyecto::model()->findAllBySql($query);		
		$this->setPageTitle("Gracias a Dios");
		$this->render('Listaproyectos', array('Proyectos'=>$proyecto));
	}

	public function actionfichatecnicacon($idcon)
	{
		$contratacion=$this->loadModelCon($idcon);
		$contrato=Contratos::Model()->find("idContratacion = '".$idcon."'");
		$adjudicacion=Adjudicacion::Model()->find("idAdjudicacion = '".$contratacion->idAdjudicacion."'");
		$calificacion=Calificacion::Model()->find("idCalificacion = '".$adjudicacion->idCalificacion."'");
		$proyecto=Proyecto::Model()->find("idProyecto = '".$calificacion->idProyecto."'");
		$programa=Programa::Model()->find("idPrograma = '".$proyecto->idPrograma."'");
		$gestionc=Gestioncontratos::Model()->find("cod_contrato = '".$idcon."'");
		$inieje=InicioEjecucion::Model()->find("idContratacion = '".$idcon."'");
		$avance=Avances::Model()->find("codigo_inicio_ejecucion = '".$inieje->codigo."'");
		$actividades=ActAvances::Model()->findAll("cod_avances = '".$avance->codigo."'");
		$ejecutor=Contactos::Model()->find("codigo = '".$inieje->cod_contacto_02."'");
		$supervisor=Contactos::Model()->find("codigo = '".$inieje->cod_contacto_03."'");
		$responsable=Funcionarios::Model()->find("idfuncionario ='".$programa->idFuncionario."'");
		$proposito=Proposito::Model()->find("idproposito ='".$proyecto->idProposito."'");
		$depto=Departamento::Model()->find("codigoDepto = '".$proyecto->idDepto."'");
		$admon=Entes::Model()->find("idente ='".$contratacion->idEntidad."'");
		$desembolsos=DesembolsosMontos::Model()->find("cod_contrato ='".$contrato->idContratos."'");
		$this->setPageTitle("Ficha Técnica");
		$this->render('fichatecnica',array(
			'programa'=>$programa,
			'proyecto'=>$proyecto,
			'calificacion'=>$calificacion,
			'contrato'=>$contrato,
			'contratacion'=>$contratacion,
			'adjudicacion'=>$adjudicacion,
			'avances'=>$avance,
			'actividades'=>$actividades,
			'gestionc'=>$gestionc,
			'inieje'=>$inieje,
			'ejecutor'=>$ejecutor,
			'supervisor'=>$supervisor,
			'responsable'=>$responsable,
			'proposito'=>$proposito,
			'depto'=>$depto,
			'admon'=>$admon,
			'desembolsos'=>$desembolsos,
			));
	}

	public function actionfichatecnicaprg($idprg)
	{
		$programa=$this->loadModelProg($idprg);
		$proyecto=Proyecto::Model()->find("idPrograma ='".$programa->idPrograma."'");
		$calificacion=Calificacion::Model()->find("idProyecto ='".$proyecto->idProyecto."'");
		$adjudicacion=Adjudicacion::Model()->find("idCalificacion ='".$calificacion->idCalificacion."'");
		$contratacion=Contratacion::Model()->find("idAdjudicacion ='".$adjudicacion->idAdjudicacion."'");
		$contrato=Contratos::Model()->find("idContratacion ='".$contratacion->idContratacion."'");
		$gestionc=Gestioncontratos::Model()->find("cod_contrato = '".$contrato->idContratos."'");
		$inieje=InicioEjecucion::Model()->find("idContratacion = '".$contratacion->idContratacion."'");
		$avance=Avances::Model()->find("codigo_inicio_ejecucion = '".$inieje->codigo."'");
		$actividades=ActAvances::Model()->findAll("cod_avances = '".$avance->codigo."'");
		$ejecutor=Contactos::Model()->find("codigo = '".$inieje->cod_contacto_02."'");
		$supervisor=Contactos::Model()->find("codigo = '".$inieje->cod_contacto_03."'");
		$responsable=Funcionarios::Model()->find("idfuncionario ='".$programa->idFuncionario."'");
		$proposito=Proposito::Model()->find("idproposito ='".$proyecto->idProposito."'");
		$depto=Departamento::Model()->find("codigoDepto = '".$proyecto->idDepto."'");
		$desembolsos=DesembolsosMontos::Model()->find("cod_contrato ='".$contrato->idContratos."'");
		$admon=Entes::Model()->find("idente ='".$contratacion->idEntidad."'");
		$this->setPageTitle("Ficha Técnica");
		$this->render('fichatecnica',array(
			'programa'=>$programa,
			'proyecto'=>$proyecto,
			'calificacion'=>$calificacion,
			'contrato'=>$contrato,
			'contratacion'=>$contratacion,
			'adjudicacion'=>$adjudicacion,
			'avances'=>$avance,
			'actividades'=>$actividades,
			'gestionc'=>$gestionc,
			'inieje'=>$inieje,
			'ejecutor'=>$ejecutor,
			'supervisor'=>$supervisor,
			'responsable'=>$responsable,
			'proposito'=>$proposito,
			'depto'=>$depto,
			'admon'=>$admon,
			'desembolsos'=>$desembolsos,
			));
	}

	public function actionfichatecnicapro($idpro)
	{
		$proyecto=$this->loadModelProy($idpro);
		$programa=Programa::Model()->find("idPrograma ='".$proyecto->idPrograma."'");
		$calificacion=Calificacion::Model()->find("idProyecto ='".$proyecto->idProyecto."'");
		$adjudicacion=Adjudicacion::Model()->find("idCalificacion ='".$calificacion->idCalificacion."'");
		$contratacion=Contratacion::Model()->find("idAdjudicacion ='".$adjudicacion->idAdjudicacion."'");
		$contrato=Contratos::Model()->find("idContratacion ='".$contratacion->idContratacion."'");
		$gestionc=Gestioncontratos::Model()->find("cod_contrato = '".$contrato->idContratos."'");
		$inieje=InicioEjecucion::Model()->find("idContratacion = '".$contratacion->idContratacion."'");
		$avance=Avances::Model()->find("codigo_inicio_ejecucion = '".$inieje->codigo."'");
		$actividades=ActAvances::Model()->findAll("cod_avances = '".$avance->codigo."'");
		$ejecutor=Contactos::Model()->find("codigo = '".$inieje->cod_contacto_02."'");
		$supervisor=Contactos::Model()->find("codigo = '".$inieje->cod_contacto_03."'");
		$responsable=Funcionarios::Model()->find("idfuncionario ='".$programa->idFuncionario."'");
		$proposito=Proposito::Model()->find("idproposito ='".$proyecto->idProposito."'");
		$depto=Departamento::Model()->find("codigoDepto = '".$proyecto->idDepto."'");
		$desembolsos=DesembolsosMontos::Model()->find("cod_contrato ='".$contrato->idContratos."'");
		$admon=Entes::Model()->find("idente ='".$contratacion->idEntidad."'");
		$this->setPageTitle("Ficha Técnica");
		$this->render('fichatecnica',array(
			'programa'=>$programa,
			'proyecto'=>$proyecto,
			'calificacion'=>$calificacion,
			'contrato'=>$contrato,
			'contratacion'=>$contratacion,
			'adjudicacion'=>$adjudicacion,
			'avances'=>$avance,
			'actividades'=>$actividades,
			'gestionc'=>$gestionc,
			'inieje'=>$inieje,
			'ejecutor'=>$ejecutor,
			'supervisor'=>$supervisor,
			'responsable'=>$responsable,
			'proposito'=>$proposito,
			'depto'=>$depto,
			'admon'=>$admon,
			'desembolsos'=>$desembolsos,
			));
		
	}

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
}