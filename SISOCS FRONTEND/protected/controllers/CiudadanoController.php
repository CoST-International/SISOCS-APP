
<?php

class CiudadanoController extends Controller
{
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('BProyecto', 'index', 'PreFichaTecnica', 'FichaTecnica', 'BMapa','exportarExcel','ViewImagenes', 'actionBProyectoPdf', 'BProyectoDocsPdf', 'BProyectoBudgetPdf', 'BProyectoBeneficiariosPdf', 'BProyectoFuentesPdf', 'BProyectoPrecalificacionPdf', 'BProyectoPronosticoPdf', 'BProyectoHitosPdf','BCalificacionPdf','BOferentesPdf', 'BCalificacionDocsPdf', 'BAdjudicacionPdf', 'BAdjudicacionDocsPdf', 'BContratacionPdf','BAdjudicacionOferentesPreferidosPdf', 'BContratacionFirmantesPdf', 'BContratacionOrganizacionPdf', 'BContratacionAccionistasPdf', 'BContratacionPrestamistaPdf', 'BContratacionGovGarantiaPdf', 'BContratacionRiskPdf', 'BContratacionRatioPdf','BContratacionIrrPdf', 'BContratacionShareCapitalPdf', 'BContratacionEnmiendaPdf', 'BContratacionDocsPdf','BContratosPdf', 'BContratoDocsPdf', 'BPlanDesembolsoPdf','BImplementacionContactoPdf', 'BHitosImplementacionPdf', 'BTarifasPdf', 'BTransaccionPdf, BMapaTC', 'BImplementacionDocPdf', 'FichaTecnica_Relacionada','GetMonto'),
                'users'=>array('@'),
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('actionviewproyecto','update'),
                'users'=>array('@'),
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('BPrograma','update','fichatecnicapro','fichatecnicaprg','fichatecnicacon','Informecumplimiento','BCumplimiento','exportarExcel'),
                'users'=>array('@'),
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('actionviewprograma','update','exportarExcel'),
                'users'=>array('@'),
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('actionviewcontrato','update','exportarExcel'),
                'users'=>array('@'),
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('actionComayagua','update','exportarExcel'),
                'users'=>array('@'),
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('actionfichatecnica','update', 'PreFichaTecnica','exportarExcel'),
                'users'=>array('@'),
            ),
        );
    }

    public function validarLatYlong($lat){
        $valor=false;
        if($lat[0]=='1'){
         $valor=true;
        }
        return $valor;
    }

	public function validarLatitud($lat){
        $valor=false;
        if($lat>10&&$lat<20){
            $valor=true;
        }
        return $valor;
    }

    public function validarLongitud($lon){
        $valor=false;

        if(abs($lon)>80&&abs($lon)<90){
            $valor=true;
        }
        return $valor;
    }

    //agregando el mapa de los proyectos

    public function actionmapaproyectos() {
        $this->render('mapaproyectos');
    }

    public function actionIndex()
    {
        $this->render('index');
    }

	 public function actionviewproyecto($id)
    {

        $this->render('viewproyecto',array('id'=>$id,'data'));
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

    public function actionGetMonto(){
        $sql = '';
        $prepare = array();
        if ($_POST['id'] == ''){
            $retVal =[
                "TOTAL" => number_format(0.00, 2),
                "TOTAL_USD"=>number_format(0.00, 2)
            ];
            echo json_encode($retVal);
            return;
        }else if ($_POST['id'] == 'TODO'){
            $sql = "SELECT SUM(precio) as TOTAL, sum(precioUSD) as TOTAL_USD  FROM (
                SELECT cs_contratacion.idContratacion,
                            fn_precio_actualizado(cs_contratacion.idcontratacion) AS precio,
                            fn_precio_actualizado_usd(cs_contratacion.idcontratacion) AS precioUSD
                        FROM   cs_contratacion
                            INNER JOIN cs_adjudicacion
                                    ON cs_contratacion.idadjudicacion =
                                        cs_adjudicacion.idadjudicacion
                            INNER JOIN cs_calificacion
                                    ON cs_adjudicacion.idcalificacion =
                                        cs_calificacion.idcalificacion
                                INNER JOIN cs_proyecto
                                        ON cs_calificacion.idProyecto = cs_proyecto.idProyecto
                        WHERE cs_contratacion.estado = 'PUBLICADO'
                        GROUP BY cs_calificacion.idproyecto,
                                cs_contratacion.idContratacion
                    ) T";

        }else if ($_POST['id'] == 'FIDEICOMISO'){
            $sql = "SELECT SUM(precio) as TOTAL, sum(precioUSD) as TOTAL_USD  FROM (
                SELECT cs_contratacion.idContratacion,
                            fn_precio_actualizado(cs_contratacion.idcontratacion) AS precio,
                            fn_precio_actualizado_usd(cs_contratacion.idcontratacion) AS precioUSD
                        FROM   cs_contratacion
                            INNER JOIN cs_adjudicacion
                                    ON cs_contratacion.idadjudicacion =
                                        cs_adjudicacion.idadjudicacion
                            INNER JOIN cs_calificacion
                                    ON cs_adjudicacion.idcalificacion =
                                        cs_calificacion.idcalificacion
                                INNER JOIN cs_proyecto
                                        ON cs_calificacion.idProyecto = cs_proyecto.idProyecto
                        WHERE cs_contratacion.estado = 'PUBLICADO' AND cs_calificacion.idTipoContrato = 9
                        GROUP BY cs_calificacion.idproyecto,
                                cs_contratacion.idContratacion
                    ) T";
        }else{
            $prepare = array(":id" => $_POST['id']);
            $sql = "SELECT SUM(precio) as TOTAL, sum(precioUSD) as TOTAL_USD  FROM (
                SELECT cs_contratacion.idContratacion,
                            fn_precio_actualizado(cs_contratacion.idcontratacion) AS precio,
                            fn_precio_actualizado_usd(cs_contratacion.idcontratacion) AS precioUSD
                        FROM   cs_contratacion
                            INNER JOIN cs_adjudicacion
                                    ON cs_contratacion.idadjudicacion =
                                        cs_adjudicacion.idadjudicacion
                            INNER JOIN cs_calificacion
                                    ON cs_adjudicacion.idcalificacion =
                                        cs_calificacion.idcalificacion
                                INNER JOIN cs_proyecto
                                        ON cs_calificacion.idProyecto = cs_proyecto.idProyecto
                        WHERE cs_contratacion.estado = 'PUBLICADO' AND cs_proyecto.idProyecto IN (:id)
                        GROUP BY cs_calificacion.idproyecto,
                                cs_contratacion.idContratacion
                    ) T";
        }
        $command=Yii::app()->db->createCommand($sql)->prepare($prepare);
        $retVal =[
            "TOTAL" => number_format(($command->queryAll()[0]["TOTAL"]/1000000), 2),
            "TOTAL_USD"=>number_format(($command->queryAll()[0]["TOTAL_USD"]/1000000), 2)
        ];
        echo json_encode($retVal);
    }

    public function actionBProyecto()
    {
        if (isset($_POST['criterio'])) {
                $criterio=str_replace(' ', '%', $_POST['criterio']);
        } else {
                $criterio='';
        }

        $this->PageTitle = "Busqueda $criterio";

        $sql = "SELECT DISTINCT `vCiudadano`.`idProyecto`,
                    `vCiudadano`.`proyecto_codigo`,
                    `vCiudadano`.`proyecto_nombre`,
                    `vCiudadano`.`proyecto_descripcion`,
                    `vCiudadano`.`proyecto_proposito`,
                    `vCiudadano`.`proyecto_ente`
                FROM `vCiudadano`
                WHERE
                    (`vCiudadano`.`proyecto_codigo` like :criterio) OR
                    (`vCiudadano`.`proyecto_nombre` like :criterio) OR
                    (`vCiudadano`.`proyecto_descripcion` like :criterio) OR
                    (`vCiudadano`.`proyecto_proposito` like :criterio) OR
                    (`vCiudadano`.`proyecto_departamento` like :criterio) OR
                    (`vCiudadano`.`proyecto_municipio` like :criterio) OR
                    (`vCiudadano`.`proyecto_beneficio` like :criterio) OR
                    (`vCiudadano`.`proyecto_fuente` like :criterio) OR
                    (`vCiudadano`.`proyecto_sector` like :criterio) OR
                    (`vCiudadano`.`proyecto_subsector` like :criterio) OR
                    (`vCiudadano`.`proyecto_ente` like :criterio) OR
                    (`vCiudadano`.`proyecto_funcionario_nombre` like :criterio) OR
                    (`vCiudadano`.`calificacion_oferente` like :criterio) OR
                    (`vCiudadano`.`contratacion_oferente` like :criterio) OR
                    (`vCiudadano`.`contratacion_alcances` like :criterio)";

        $command=Yii::app()->db->createCommand($sql)->prepare(array( ":criterio" => '%'.$criterio.'%' ));
        $proyecto=$command->queryAll(); 
        //$this->pageTitle = "B&$criterio@".Yii::$app->getRequest()->serverName;
        $this->renderPartial('Listaproyecto', array('Proyecto'=>$proyecto));
    }

    public function actionBProyectoPdf($criterio)
    {
        $sql = "SELECT DISTINCT *
                FROM `vProyecto`
                WHERE
                    (`vProyecto`.`idProyecto` = :criterio)";

        $command=Yii::app()->db->createCommand($sql)->prepare(array( ":criterio" => $criterio ));
        $proyecto=$command->queryRow();
        echo json_encode($proyecto);
    }

    public function actionBProyectoDocsPdf($criterio)
    {
        $sql = "SELECT *
                FROM `cs_planning_documents`
                WHERE
                    (`cs_planning_documents`.`idProyecto` = :criterio)";

        $command=Yii::app()->db->createCommand($sql)->prepare(array( ":criterio" => $criterio ));
        $proyecto=$command->queryAll();
        echo json_encode($proyecto);
    }

    public function actionBProyectoBudgetPdf($criterio)
    {
        $datos_BudgetBreakdown=Yii::app()->db->createCommand('SELECT * from cs_budgetBreakdown WHERE idProyecto= :criterio')->prepare(array(":criterio" => $criterio))->queryAll();
        echo json_encode($datos_BudgetBreakdown);
    }
    public function actionBProyectoBeneficiariosPdf($criterio)
    {
        $datos_Beneficiarios=Yii::app()->db->createCommand('SELECT d.departamento a, m.municipio b, pm.beneficio c FROM cs_proyecto_municipio pm JOIN cs_departamento d ON d.idDepartamento=pm.idDepartamento JOIN cs_municipio m ON m.idMunicipio=pm.idMunicipio AND m.idDepartamento=pm.idDepartamento WHERE pm.idProyecto = :criterio')->prepare(array(":criterio" => $criterio))->queryAll();
        echo json_encode($datos_Beneficiarios);
    }
    public function actionBProyectoFuentesPdf($criterio)
    {
        $datos_fuentesFinan=Yii::app()->db->createCommand('SELECT p.legalName a, pf.monto b, c.moneda c, pf.tasa_cambio d FROM cs_proyecto_fuente pf JOIN cs_parties p ON p.id=pf.idFuente JOIN cs_currency c ON c.idCurrency = pf.idMoneda WHERE pf.idProyecto = :criterio')->prepare(array(":criterio" => $criterio))->queryAll();
        echo json_encode($datos_fuentesFinan);
    }
    public function actionBProyectoPrecalificacionPdf($criterio)
    {
        $datos_Precalificacion=Yii::app()->db->createCommand('SELECT * FROM cs_prequalification WHERE idProyecto = :criterio')->prepare(array(":criterio" => $criterio))->queryAll();
        echo json_encode($datos_Precalificacion);
    }
    public function actionBProyectoPronosticoPdf($criterio)
    {
        $datos_Pronostico=Yii::app()->db->createCommand('SELECT * FROM cs_forecast f JOIN cs_forecast_observations fo ON fo.forecast_id = f.id WHERE f.idProyecto=  :criterio')->prepare(array(":criterio" => $criterio))->queryAll();
        echo json_encode($datos_Pronostico);
    }
    public function actionBProyectoHitosPdf($criterio)
    {
        $datos_PHitos=Yii::app()->db->createCommand('SELECT * FROM cs_planning_milestone WHERE idProyecto=  :criterio')->prepare(array(":criterio" => $criterio))->queryAll();
        echo json_encode($datos_PHitos);
    }

    public function actionBCalificacionPdf($criterio)
    {
        $datos_Calificacion=Yii::app()->db->createCommand('SELECT * FROM vCalificacion  WHERE idCalificacion=  :criterio')->prepare(array(":criterio" => $criterio))->queryAll();
        echo json_encode($datos_Calificacion);
    }

    public function actionBOferentesPdf($criterio)
    {
        $datos_Calificacion=Yii::app()->db->createCommand('SELECT p.legalName a FROM cs_parties p JOIN cs_calificacion_oferente co ON co.idOferente=p.id WHERE co.idCalificacion=  :criterio')->prepare(array(":criterio" => $criterio))->queryAll();
        echo json_encode($datos_Calificacion);
    }

    public function actionBCalificacionDocsPdf($criterio)
    {
        $sql = "SELECT *
                FROM `cs_tender_documents`
                WHERE
                    (`cs_tender_documents`.`idCalificacion` = :criterio)";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataCalificacion=$command->queryAll();
        echo json_encode($DataCalificacion);
    }

    public function actionBAdjudicacionPdf($criterio)
    {
        $sql = "SELECT a.*,ma.nombre from cs_adjudicacion a JOIN cs_metodo_adjudicacion ma ON ma.idMetodoAdjudicacion=a.idMetodoAdjudicacion WHERE a.idAdjudicacion= :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataAdjudicacion=$command->queryAll();
        echo json_encode($DataAdjudicacion);
    }

    public function actionBAdjudicacionOferentesPreferidosPdf($criterio)
    {
        $sql = "SELECT ps.legalName FROM `cs_contratacion` c JOIN cs_preferredBidders p ON p.idContratacion= c.idContratacion JOIN cs_parties ps ON ps.id=p.parties_id WHERE `c`.`idContratacion` = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataAdjudicacion=$command->queryAll();
        echo json_encode($DataAdjudicacion);
    }

    public function actionBAdjudicacionDocsPdf($criterio)
    {
        $sql = "SELECT *
                FROM `cs_award_documents`
                WHERE
                    (`cs_award_documents`.`idAdjudicacion` = :criterio)";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":critero" => $criterio));
        $DataAdjudicacion=$command->queryAll();
        echo json_encode($DataAdjudicacion);
    }

    public function actionBContratacionPdf($criterio)
    {
        $sql = "SELECT c.*,ps.legalName FROM `cs_contratacion` c JOIN cs_preferredBidders p ON p.idContratacion= c.idContratacion JOIN cs_parties ps ON ps.id=p.parties_id WHERE `c`.`idContratacion` = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }

    public function actionBContratacionFirmantesPdf($criterio)
    {
        $sql = "SELECT * FROM cs_contracts_signatories c WHERE `c`.`idContratacion` = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }
    public function actionBContratacionOrganizacionPdf($criterio)
    {
        $sql = "SELECT c.*, p.legalName FROM cs_contracts_organization_details c JOIN cs_parties p ON p.id=c.parties_id WHERE `c`.`idContratacion` = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }
    public function actionBContratacionAccionistasPdf($criterio)
    {
        $sql = "SELECT * FROM cs_shareholders WHERE `idContratacion` = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));;
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }
    public function actionBContratacionPrestamistaPdf($criterio)
    {
        $sql = "SELECT * FROM cs_lenders_suppliers WHERE `idContratacion` = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }

    public function actionBContratacionGovGarantiaPdf($criterio)
    {
        $sql = "SELECT * FROM cs_gov_support_guarantee WHERE `idContratacion` =".$criterio;

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }

    public function actionBContratacionRiskPdf($criterio)
    {
        $sql = "SELECT ra.*, p.legalName FROM cs_risk_allocation ra JOIN cs_parties p ON p.id=ra.allocation_party_id WHERE `ra`.`idContratacion` = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }
    public function actionBContratacionRatioPdf($criterio)
    {
        $sql = "SELECT * FROM cs_debt_equity_ratio ra  WHERE `ra`.`idContratacion` = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }

    public function actionBContratacionIrrPdf($criterio)
    {
        $sql = "SELECT * FROM cs_actual_irr ra  WHERE `ra`.`idContratacion` = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }

    public function actionBContratacionShareCapitalPdf($criterio)
    {
        $sql = "SELECT * FROM cs_share_capital ra  WHERE `ra`.`idContratacion` = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }

    public function actionBContratacionEnmiendaPdf($criterio)
    {
        $sql = "SELECT * FROM cs_amendment ra  WHERE `ra`.`idContratacion` = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }

    public function actionBContratacionDocsPdf($criterio)
    {
        $sql = "SELECT * FROM cs_contract_documents WHERE idContratacion = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataCD=$command->queryAll();
        echo json_encode($DataCD);
    }

    public function actionBContratosPdf($criterio)
    {
        $sql = "SELECT * FROM cs_contratos ra  WHERE `ra`.`idContratacion` = :criterio order by nmodifica ASC";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataContratacion=$command->queryAll();
        echo json_encode($DataContratacion);
    }

    public function actionBContratoDocsPdf($criterio)
    {
        $sql = "SELECT cd.* FROM cs_contratos_documents cd JOIN cs_contratos c ON c.idContratos = cd.idContrato WHERE c.idContratacion = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));;
        $DataCD=$command->queryAll();
        echo json_encode($DataCD);
    }

    public function actionBPlanDesembolsoPdf($criterio)
    {
        $sql = "SELECT * FROM cs_desembolsos_montos WHERE idInicioEjecucion = :criterio ORDER BY desembolso ASC";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataCD=$command->queryAll();
        echo json_encode($DataCD);
    }

    public function actionBImplementacionContactoPdf($criterio)
    {
        $sql = "SELECT c.*, ie.fecha_inicio FROM cs_contactos c JOIN cs_inicio_ejecucion ie ON c.idContacto = ie.idContacto WHERE ie.idInicioEjecucion = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataCD=$command->queryAll();
        echo json_encode($DataCD);
    }

    public function actionBHitosImplementacionPdf($criterio)
    {
        $sql = "SELECT * FROM cs_implementation_milestone WHERE idInicioEjecucion = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataCD=$command->queryAll();
        echo json_encode($DataCD);
    }

    public function actionBTarifasPdf($criterio)
    {
        $sql = "SELECT * FROM cs_tariffs WHERE idInicioEjecucion = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataCD=$command->queryAll();
        echo json_encode($DataCD);
    }

    public function actionBTransaccionPdf($criterio)
    {
        $sql = "SELECT * FROM cs_transactions WHERE idInicioEjecucion = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataCD=$command->queryAll();
        echo json_encode($DataCD);
    }

    public function actionBImplementacionDocPdf($criterio)
    {
        $sql = "SELECT * FROM cs_implementation_documents WHERE idInicioEjecucion = :criterio";

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":criterio" => $criterio));
        $DataCD=$command->queryAll();

        echo json_encode($DataCD);
    }
    public function actionBMapa()
    {
        $criterio=$_POST['id'];

		// *********************** Lista de Proyectos
        if ($criterio == 'TODOS'){
            $sql= " Select		DISTINCT		a.idProyecto,
            proyecto_codigo,
            proyecto_nombre,
            proyecto_sector,
            proyecto_presupuesto,
            proyecto_ente,
            GROUP_CONCAT(DISTINCT a.proyecto_iddepartamento) AS proyecto_iddepartamento,
            GROUP_CONCAT(DISTINCT ' ',a.proyecto_departamento) AS proyecto_departamentos,
            GROUP_CONCAT(DISTINCT ' ',a.proyecto_municipio) AS proyecto_municipios,
            a.idCalificacion,
            a.idAdjudicacion,
            a.idContratacion,
            a.idInicioEjecucion,

            (SELECT GROUP_CONCAT(distinct cstc.contrato SEPARATOR '; ')
             FROM cs_tipocontrato cstc
            WHERE cstc.idTipoContrato in (SELECT idTipoContrato FROM cs_calificacion cscal WHERE cscal.idProyecto = a.idProyecto)) AS tc
        From
          vCiudadano a
        LEFT JOIN cs_contratacion b ON a.idContratacion = b.idContratacion
        LEFT JOIN cs_calificacion c ON a.idCalificacion = c.idCalificacion
        LEFT JOIN cs_tipocontrato d ON c.idTipoContrato = d.idTipoContrato
        Where
          (b.primario = TRUE OR a.idContratacion IS NULL)
          GROUP BY
          idProyecto,
            proyecto_codigo,
            proyecto_nombre,
            proyecto_sector,
            proyecto_presupuesto,
            proyecto_ente,
            a.idCalificacion,
            a.idAdjudicacion,
            a.idContratacion,
            a.idInicioEjecucion,
            c.idTipoContrato
            ";
        }else if ($criterio == 'FIDEICOMISO'){
            $sql= "SELECT DISTINCT
			a.idProyecto,
            proyecto_codigo,
            proyecto_nombre,
            proyecto_sector,
            proyecto_presupuesto,
            proyecto_ente,
            GROUP_CONCAT(DISTINCT a.proyecto_iddepartamento) AS proyecto_iddepartamento,
            GROUP_CONCAT(DISTINCT ' ', a.proyecto_departamento) AS proyecto_departamentos,
            GROUP_CONCAT(DISTINCT ' ', a.proyecto_municipio) AS proyecto_municipios,
            a.idCalificacion,
            a.idAdjudicacion,
            a.idContratacion,
            a.idInicioEjecucion,
            c.idTipoContrato,
            d.contrato tc
        From
          vCiudadano a
        LEFT JOIN cs_contratacion b ON a.idContratacion = b.idContratacion
        LEFT JOIN cs_calificacion c ON a.idCalificacion = c.idCalificacion
        LEFT JOIN cs_tipocontrato d ON c.idTipoContrato = d.idTipoContrato
        Where
          ( c.idTipoContrato = 9 )
          GROUP BY
          idProyecto,
            proyecto_codigo,
            proyecto_nombre,
            proyecto_sector,
            proyecto_presupuesto,
            proyecto_ente,
            a.idCalificacion,
            a.idAdjudicacion,
            a.idContratacion,
            a.idInicioEjecucion";
        }else if(($criterio == 'TC')){
            $ids = explode(",",$criterio);
            $whereClause = "( 0 = 1";
            foreach ($ids as $filterId):
                $whereClause = $whereClause." OR proyecto_iddepartamento='".str_replace("'","",$filterId)+"'";
            endforeach;
            $whereClause = $whereClause." )";

            $sql= " Select		DISTINCT		idProyecto,
            proyecto_codigo,
            proyecto_nombre,
            proyecto_sector,
            proyecto_presupuesto,
            proyecto_ente,
            GROUP_CONCAT(DISTINCT a.proyecto_iddepartamento) AS proyecto_iddepartamento,
            a.idCalificacion,
            a.idAdjudicacion,
            a.idContratacion,
            a.idInicioEjecucion,
            c.idTipoContrato,
            d.contrato tc
        From
          vCiudadano a
        LEFT JOIN cs_contratacion b ON a.idContratacion = b.idContratacion
        LEFT JOIN cs_calificacion c ON a.idCalificacion = c.idCalificacion
        LEFT JOIN cs_tipocontrato d ON c.idTipoContrato = d.idTipoContrato
        Where
        ( (b.primario = TRUE OR a.idContratacion IS NULL) and ". $whereClause .")
          GROUP BY
          idProyecto,
            proyecto_codigo,
            proyecto_nombre,
            proyecto_sector,
            proyecto_presupuesto,
            proyecto_ente,
            a.idCalificacion,
            a.idAdjudicacion,
            a.idContratacion,
            a.idInicioEjecucion";
        }else{
            $ids = explode(",",$criterio);
            $whereClause = "( 0 = 1";
            foreach ($ids as $filterId):
                $whereClause = $whereClause." OR proyecto_iddepartamento='".str_replace("'","",$filterId)+"'";
            endforeach;
            $whereClause = $whereClause." )";

            $sql= " Select		DISTINCT		idProyecto,
            proyecto_codigo,
            proyecto_nombre,
            proyecto_sector,
            proyecto_presupuesto,
            proyecto_ente,
            GROUP_CONCAT(DISTINCT a.proyecto_iddepartamento) AS proyecto_iddepartamento,
            a.idCalificacion,
            a.idAdjudicacion,
            a.idContratacion,
            a.idInicioEjecucion,
            c.idTipoContrato,
            d.contrato tc
        From
          vCiudadano a
        LEFT JOIN cs_contratacion b ON a.idContratacion = b.idContratacion
        LEFT JOIN cs_calificacion c ON a.idCalificacion = c.idCalificacion
        LEFT JOIN cs_tipocontrato d ON c.idTipoContrato = d.idTipoContrato
        Where
        ( (b.primario = TRUE OR a.idContratacion IS NULL) and ". $whereClause .")
          GROUP BY
          idProyecto,
            proyecto_codigo,
            proyecto_nombre,
            proyecto_sector,
            proyecto_presupuesto,
            proyecto_ente,
            a.idCalificacion,
            a.idAdjudicacion,
            a.idContratacion,
            a.idInicioEjecucion";
        }

        $command=Yii::app()->db->createCommand($sql);
        $proyecto=$command->queryAll();

	//$this->pageTitle = "M&$criterio@".Yii::$app->getRequest()->serverName;
        $this->renderPartial('Listaproyecto', array('Proyecto'=>$proyecto));
//        Yii::app()->crugemailer->sendTest();
    }

    public function actionPreFichaTecnica($id) {
        $proyecto = array();
        $adquisicion = array();
        $relatedProcess = array();
        $fideicomisos = array();

        $sql = "SELECT DISTINCT`vCiudadano`.`idProyecto`,
                    `vCiudadano`.`proyecto_codigo`,
                    `vCiudadano`.`proyecto_nombre`,
                    `vCiudadano`.`proyecto_descripcion`,
                    `vCiudadano`.`proyecto_proposito`,
                    `vCiudadano`.`proyecto_fecha_aprobacion`,
                    `vCiudadano`.`proyecto_presupuesto`,
                    `vCiudadano`.`proyecto_sector`,
                    `vCiudadano`.`proyecto_subsector`,
                    `vCiudadano`.`proyecto_ente`
                FROM `vCiudadano`
                WHERE idProyecto = :id";

        $proyecto=Yii::app()->db->createCommand($sql)->prepare(array(":id" => $id))->queryAll();

        $sql = "SELECT DISTINCT `vCiudadano`.`idProyecto`,
                        `vCiudadano`.`idCalificacion`,
                        `vCiudadano`.`idAdjudicacion`,
                        `vCiudadano`.`idContratacion`,
                        `vCiudadano`.`idInicioEjecucion`,
                        `vCiudadano`.`calificacion_numero`,
                        `vCiudadano`.`calificacion_nombre`,
                        `vCiudadano`.`calificacion_metodo`,
                        `vCiudadano`.`contratacion_oferente`,
                        `vCiudadano`.`contratacion_alcances`,
                        `vCiudadano`.`contratacion_precioLPS`,
                        `vCiudadano`.`contratacion_precioUSD`,
                        `vCiudadano`.`contratacion_fecha_inicio`,
                        `vCiudadano`.`contratacion_fecha_final`,
                        `vCiudadano`.`contratacion_duracion`
                    FROM `vCiudadano`
                    WHERE idProyecto = :id";

        $adquisicion = Yii::app()->db->createCommand($sql)->prepare(array(":id" => $id))->queryAll();

        $sql = "SELECT DISTINCT DEST.idProyecto,DEST.proyecto_codigo,DEST.proyecto_nombre FROM cs_related_process RP
        JOIN vCiudadano DEST ON RP.idProyecto = DEST.idProyecto
        JOIN vCiudadano SRC ON SRC.idContratacion = RP.idContratacion
        LEFT JOIN cs_calificacion DEST_CALIFICACION ON DEST.idCalificacion = DEST_CALIFICACION.idCalificacion
        WHERE SRC.idProyecto = :id";
        $relatedProcess = Yii::app()->db->createCommand($sql)->prepare(array(":id" => $id))->queryAll();

        $sql="SELECT DISTINCT DEST.idProyecto,
                DEST.idCalificacion,
                DEST.idAdjudicacion,
                DEST.idContratacion,
                DEST.idInicioEjecucion,
                DEST.calificacion_numero,
                DEST.calificacion_nombre,
                DEST.calificacion_metodo,
                DEST.contratacion_oferente,
                DEST.contratacion_alcances,
                DEST.contratacion_precioLPS,
                DEST.contratacion_precioUSD,
                DEST.contratacion_fecha_inicio,
                DEST.contratacion_fecha_final,
                DEST.contratacion_duracion
        FROM cs_related_process RP
        JOIN vCiudadano DEST ON RP.idProyecto = DEST.idProyecto
        JOIN vCiudadano SRC ON SRC.idContratacion = RP.idContratacion
        LEFT JOIN cs_calificacion DEST_CALIFICACION ON DEST.idCalificacion = DEST_CALIFICACION.idCalificacion
        WHERE DEST_CALIFICACION.idTipoContrato = 9 AND SRC.idProyecto = :id";
        $fideicomisos = Yii::app()->db->createCommand($sql)->prepare(array(":id" => $id))->queryAll();

        //$this->pageTitle = "PID&$id@".Yii::$app->getRequest()->serverName;
        $this->render('prefichatecnica',array(
                        'proyecto'=>$proyecto,
                        'adquisicion'=>$adquisicion,
                        'relatedProcess'=>$relatedProcess,
                        'fideicomisos'=>$fideicomisos
                    ));
    }


    public function actionFichaTecnica($control, $id)
    {

        switch ($control)
        {
            case 'Proyecto':
                $sql = "Select Distinct
                          vCiudadano.idProyecto
                        From
                          vCiudadano
                        Where
                          vCiudadano.idProyecto = :id
                        ";
                break;
            case 'Calificacion':
                $sql = "Select Distinct

                          vCiudadano.idProyecto,
                          vCiudadano.idCalificacion
                        From
                          vCiudadano
                        Where
                          vCiudadano.idCalificacion = :id
                        ";
                break;
            case 'Adjudicacion':
                $sql = "Select Distinct

                          vCiudadano.idProyecto,
                          vCiudadano.idCalificacion,
                          vCiudadano.idAdjudicacion
                        From
                          vCiudadano
                        Where
                          vCiudadano.idAdjudicacion = :id
                        ";
                break;
            case 'Contratacion':
                $sql = "Select Distinct

                          vCiudadano.idProyecto,
                          vCiudadano.idCalificacion,
                          vCiudadano.idAdjudicacion,
                          vCiudadano.idContratacion,
                          vCiudadano.idInicioEjecucion
                        From
                          vCiudadano
                        Where
                          vCiudadano.idContratacion = :id
                        ";
                break;
        };

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":id" => $id));
        $ids=$command->queryAll();

        $relatedProcess= array();
        $sql = "SELECT DISTINCT DEST.idProyecto, DEST.idCalificacion,DEST.idAdjudicacion,DEST.idContratacion,DEST.calificacion_numero, DEST.idProyecto,DEST.proyecto_codigo,DEST.proyecto_nombre
		FROM cs_related_process RP
        JOIN vCiudadano DEST ON RP.idProyecto = DEST.idProyecto
        JOIN vCiudadano SRC ON SRC.idContratacion = RP.idContratacion
        LEFT JOIN cs_contratacion b ON DEST.idContratacion = b.idContratacion
        WHERE
          (b.primario = TRUE OR DEST.idContratacion IS NULL)
        AND (SRC.idProyecto = ".$ids[0]['idProyecto'].")
        UNION ALL
        SELECT DISTINCT SRC.idProyecto, SRC.idCalificacion,SRC.idAdjudicacion,SRC.idContratacion,SRC.calificacion_numero, SRC.idProyecto,SRC.proyecto_codigo,SRC.proyecto_nombre
		FROM cs_related_process RP
        JOIN vCiudadano DEST ON RP.idProyecto = DEST.idProyecto
        JOIN vCiudadano SRC ON SRC.idContratacion = RP.idContratacion
        LEFT JOIN cs_contratacion b ON SRC.idContratacion = b.idContratacion
        WHERE
          (b.primario = TRUE OR DEST.idContratacion IS NULL)
        AND (DEST.idProyecto = ".$ids[0]['idProyecto'].")";
        $relatedProcess = Yii::app()->db->createCommand($sql)->queryAll();
        $galeriaImagenes = array();
        if (array_key_exists('idInicioEjecucion', $ids[0]) && $ids[0]["idInicioEjecucion"] != null) {
            $sql = "SELECT A.* FROM cs_avances_imagenes A JOIN cs_avances B ON A.idAvances = B.idAvances WHERE B.idInicioEjecucion = ".$ids[0]['idInicioEjecucion'];
            $galeriaImagenes = Yii::app()->db->createCommand($sql)->queryAll();
        }

        switch ($control)
        {
            case 'Proyecto':
                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vproyecto_beneficiario WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vproyecto_fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();

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
                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vproyecto_beneficiario WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vproyecto_fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();



                $calificacion=Yii::app()->db->createCommand('SELECT * FROM vCalificacion WHERE idCalificacion='.$ids[0]['idCalificacion'].' LIMIT 1')->queryAll();
                $calificacion=Array();
                $calificacion_empresa=Array();
                $calificacion_firma=Array();
                $calificacion_oferente=Yii::app()->db->createCommand('SELECT * FROM vcalificacion_oferente WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();

                $adjudicacion=Array();

                $contratacion=Array();
                $contratos_gestion=Array();
                $ejecucion=Array();
                $avances=Array();
                break;

            case 'Adjudicacion':
                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vproyecto_beneficiario WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vproyecto_fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();

                $calificacion=Yii::app()->db->createCommand('SELECT * FROM vCalificacion WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_empresa=Array();
                $calificacion_firma=Array();
                $calificacion_oferente=Yii::app()->db->createCommand('SELECT * FROM vcalificacion_oferente WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();

                $adjudicacion=Yii::app()->db->createCommand('SELECT * FROM vAdjudicacion WHERE idAdjudicacion='.$ids[0]['idAdjudicacion'])->queryAll();

                $contratacion=Array();
                $contratos_gestion=Array();
                $ejecucion=Array();
                $avances=Array();
                break;

            case 'Contratacion':
                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vproyecto_municipio WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vproyecto_fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();

                $calificacion=Yii::app()->db->createCommand('SELECT * FROM vCalificacion WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_empresa=Array();
                $calificacion_firma=Array();
                $calificacion_oferente=Yii::app()->db->createCommand('SELECT * FROM vcalificacion_oferente WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();

                $adjudicacion=Yii::app()->db->createCommand('SELECT * FROM vAdjudicacion WHERE idAdjudicacion='.$ids[0]['idAdjudicacion'])->queryAll();

                $contratacion=Yii::app()->db->createCommand('SELECT * FROM vContratacion WHERE idContratacion='.$ids[0]['idContratacion'])->queryAll();
                $contratos_gestion=Yii::app()->db->createCommand('SELECT * FROM vContratos WHERE idContratacion='.$ids[0]['idContratacion'])->queryAll();
                $ejecucion=Yii::app()->db->createCommand('SELECT * FROM vEjecucion WHERE idContratacion='.$ids[0]['idContratacion'].' AND estado="PUBLICADO"')->queryAll();

                if ($ids[0]['idInicioEjecucion'] == null) {
                    $avances=Array();
                } else {
                    $avances=Yii::app()->db->createCommand('SELECT * FROM vAvances WHERE estado = "PUBLICADO" AND idInicioEjecucion='.$ids[0]['idInicioEjecucion']. ' ORDER BY fecha_avance ')->queryAll();
                }
                break;
        };
        //if (!empty($ejecucion)) {
          //  $finalizacion = Yii::app()->db->createCommand()->select('*')->from('cs_final_ejecucion')->where('idInicioEjecucion=:id', array(
            //    ':id' => $ejecucion[0]['idInicioEjecucion']
            //))->queryAll();
        //}
		//$this->pageTitle = 'FT&'.$ids[0]['idProyecto'].'@'.Yii::$app->getRequest()->serverName;
        $final_ejecucion=FinalEjecucion::model();
        $idProyectoR = $ids[0]['idProyecto'];
        $CPrincipal = Yii::app()->db->createCommand('SELECT DISTINCT(v.idContratacion) FROM vidpaths v JOIN cs_contratacion c ON c.idContratacion=v.idContratacion WHERE v.idProyecto='.$idProyectoR.' AND c.primario=1')->queryScalar();
        $NContratosRelacionados = Yii::app()->db->createCommand('SELECT count(DISTINCT(v.idContratacion)) FROM vidpaths v JOIN cs_contratacion c ON c.idContratacion=v.idContratacion WHERE v.idProyecto='.$idProyectoR)->queryScalar();
        if ($NContratosRelacionados==1) {
            $CPrincipal=0;
        }

		$this->render('fichatecnica',array(
                'galeriaImagenes'=>$galeriaImagenes,
                'CPrincipal'=>$CPrincipal,
                'control'=>$control,
                'ids'=>$ids,
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
                'final_ejecucion'=> $final_ejecucion,
                'relatedProcess'=>$relatedProcess
                //'finalizacion',$finalizacion

            ));
    }

    public function actionFichaTecnica_Relacionada($control, $id)
    {

        switch ($control)
        {
            case 'Proyecto':
                $sql = "Select Distinct
                          vCiudadano.idProyecto
                        From
                          vCiudadano
                        Where
                          vCiudadano.idProyecto = :id
                        ";
                break;
            case 'Calificacion':
                $sql = "Select Distinct

                          vCiudadano.idProyecto,
                          vCiudadano.idCalificacion
                        From
                          vCiudadano
                        Where
                          vCiudadano.idCalificacion = :id
                        ";
                break;
            case 'Adjudicacion':
                $sql = "Select Distinct

                          vCiudadano.idProyecto,
                          vCiudadano.idCalificacion,
                          vCiudadano.idAdjudicacion
                        From
                          vCiudadano
                        Where
                          vCiudadano.idAdjudicacion = :id
                        ";
                break;
            case 'Contratacion':
                $sql = "Select Distinct

                          vCiudadano.idProyecto,
                          vCiudadano.idCalificacion,
                          vCiudadano.idAdjudicacion,
                          vCiudadano.idContratacion,
                          vCiudadano.idInicioEjecucion
                        From
                          vCiudadano
                        Where
                          vCiudadano.idContratacion = :id
                        ";
                break;
        };

        $command=Yii::app()->db->createCommand($sql)->prepare(array(":id"=>$id));
        $ids=$command->queryAll();

        $relatedProcess= array();
        $sql = "SELECT DISTINCT DEST.idProyecto, DEST.idCalificacion,DEST.idAdjudicacion,DEST.idContratacion,DEST.calificacion_numero, DEST.idProyecto,DEST.proyecto_codigo,DEST.proyecto_nombre
		FROM cs_related_process RP
        JOIN vCiudadano DEST ON RP.idProyecto = DEST.idProyecto
        JOIN vCiudadano SRC ON SRC.idContratacion = RP.idContratacion
        WHERE (SRC.idProyecto = ".$ids[0]['idProyecto'].")
        UNION ALL
        SELECT DISTINCT SRC.idProyecto, SRC.idCalificacion,SRC.idAdjudicacion,SRC.idContratacion,SRC.calificacion_numero, SRC.idProyecto,SRC.proyecto_codigo,SRC.proyecto_nombre
		FROM cs_related_process RP
        JOIN vCiudadano DEST ON RP.idProyecto = DEST.idProyecto
        JOIN vCiudadano SRC ON SRC.idContratacion = RP.idContratacion
        WHERE (DEST.idProyecto = ".$ids[0]['idProyecto'].")";
        $relatedProcess = Yii::app()->db->createCommand($sql)->queryAll();
        $galeriaImagenes = array();
        if (array_key_exists('idInicioEjecucion', $ids[0]) && $ids[0]["idInicioEjecucion"] != null ) {
            $sql = "SELECT A.* FROM cs_avances_imagenes A JOIN cs_avances B ON A.idAvances = B.idAvances WHERE B.idInicioEjecucion = ".$ids[0]['idInicioEjecucion'];
            $galeriaImagenes = Yii::app()->db->createCommand($sql)->queryAll();
        }

        switch ($control)
        {
            case 'Proyecto':
                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vproyecto_beneficiario WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vproyecto_fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();

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
                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vproyecto_beneficiario WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vproyecto_fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();



                $calificacion=Yii::app()->db->createCommand('SELECT * FROM vCalificacion WHERE idCalificacion='.$ids[0]['idCalificacion'].' LIMIT 1')->queryAll();
                $calificacion=Array();
                $calificacion_empresa=Array();
                $calificacion_firma=Array();
                $calificacion_oferente=Yii::app()->db->createCommand('SELECT * FROM vcalificacion_oferente WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();

                $adjudicacion=Array();

                $contratacion=Array();
                $contratos_gestion=Array();
                $ejecucion=Array();
                $avances=Array();
                break;

            case 'Adjudicacion':
                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vproyecto_beneficiario WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vproyecto_fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();

                $calificacion=Yii::app()->db->createCommand('SELECT * FROM vCalificacion WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_empresa=Array();
                $calificacion_firma=Array();
                $calificacion_oferente=Yii::app()->db->createCommand('SELECT * FROM vcalificacion_oferente WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();

                $adjudicacion=Yii::app()->db->createCommand('SELECT * FROM vAdjudicacion WHERE idAdjudicacion='.$ids[0]['idAdjudicacion'])->queryAll();

                $contratacion=Array();
                $contratos_gestion=Array();
                $ejecucion=Array();
                $avances=Array();
                break;

            case 'Contratacion':
                $proyecto=Yii::app()->db->createCommand('SELECT * FROM vProyecto WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_beneficiario=Yii::app()->db->createCommand('SELECT * FROM vproyecto_municipio WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();
                $proyecto_fuente=Yii::app()->db->createCommand('SELECT * FROM vproyecto_fuente WHERE idProyecto='.$ids[0]['idProyecto'])->queryAll();

                $calificacion=Yii::app()->db->createCommand('SELECT * FROM vCalificacion WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();
                $calificacion_empresa=Array();
                $calificacion_firma=Array();
                $calificacion_oferente=Yii::app()->db->createCommand('SELECT * FROM vcalificacion_oferente WHERE idCalificacion='.$ids[0]['idCalificacion'])->queryAll();

                $adjudicacion=Yii::app()->db->createCommand('SELECT * FROM vAdjudicacion WHERE idAdjudicacion='.$ids[0]['idAdjudicacion'])->queryAll();

                $contratacion=Yii::app()->db->createCommand('SELECT * FROM vContratacion WHERE idContratacion='.$ids[0]['idContratacion'])->queryAll();
                $contratos_gestion=Yii::app()->db->createCommand('SELECT * FROM vContratos WHERE idContratacion='.$ids[0]['idContratacion'])->queryAll();
                $ejecucion=Yii::app()->db->createCommand('SELECT * FROM vEjecucion WHERE idContratacion='.$ids[0]['idContratacion'].' AND estado="PUBLICADO"')->queryAll();

                if ($ids[0]['idInicioEjecucion'] == null) {
                    $avances=Array();
                } else {
                    $avances=Yii::app()->db->createCommand('SELECT * FROM vAvances WHERE estado = "PUBLICADO" AND idInicioEjecucion='.$ids[0]['idInicioEjecucion']. ' ORDER BY fecha_avance ')->queryAll();
                }
                break;
        };
        //if (!empty($ejecucion)) {
          //  $finalizacion = Yii::app()->db->createCommand()->select('*')->from('cs_final_ejecucion')->where('idInicioEjecucion=:id', array(
            //    ':id' => $ejecucion[0]['idInicioEjecucion']
            //))->queryAll();
        //}
		//$this->pageTitle = 'FT&'.$ids[0]['idProyecto'].'@'.Yii::$app->getRequest()->serverName;
        $final_ejecucion=FinalEjecucion::model();
        $idProyectoR = $ids[0]['idProyecto'];
        $CPrincipal = Yii::app()->db->createCommand('SELECT DISTINCT(v.idContratacion) FROM vidpaths v JOIN cs_contratacion c ON c.idContratacion=v.idContratacion WHERE v.idProyecto='.$idProyectoR.' AND c.primario=1')->queryScalar();
        $NContratosRelacionados = Yii::app()->db->createCommand('SELECT count(DISTINCT(v.idContratacion)) FROM vidpaths v JOIN cs_contratacion c ON c.idContratacion=v.idContratacion WHERE v.idProyecto='.$idProyectoR)->queryScalar();
        if ($NContratosRelacionados==1) {
            $CPrincipal=0;
        }
		$this->render('fichatecnica_rel',array(
                'galeriaImagenes'=>$galeriaImagenes,
                'control'=>$control,
                'idProyecto'=>$idProyectoR,
                'CPrincipal'=>$CPrincipal,
                'ids'=>$ids,
                'proyecto'=>$proyecto,
                'idProyecto'=>$idProyectoR,
                'CPrincipal'=>$CPrincipal,
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
                'final_ejecucion'=> $final_ejecucion,
                'relatedProcess'=>$relatedProcess
                //'finalizacion',$finalizacion

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


    public function actionContrato_proveedor()
    {
      $this->setPageTitle("Estratificacion de proveedorer segun contratos obtenidos");
      $this->render('contrato_proveedor');
    }

    public function actionAdq()
    {
      $this->setPageTitle("Tipo de Contrato vs. Metodo de Adquisición");
      $this->render('adq');
    }

  public function actionAdq2()
    {
      $this->setPageTitle("Tipo de Contrato vs. Metodo de Adquisición2");
      $this->render('adq2');
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

    public function actionInformeingsistema()
    {
            $this->setPageTitle("Informe de Ingresos al Sistema");
            $this->render('Informeingsistema');
    }


    public function actionPc()
    {
            $this->setPageTitle("Descarga de informacion");
            $this->render('pc');
    }

    public function actiongaleriafotos($idcon)
	{
		$this->setPageTitle("Galeria de Fotos");
		 $images=ImgAdjuntadas::model()->findAll("cod_contrato ='".$idcon."'");
		$this->render('galeriafotos',array('images'=>$images,));
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

                 $model = vProyecto_Contrato::model()->findAll();
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


   public function actionCargarCarrousel($data)
    {
        $data = array();
        $data["myValue"] = $data;

        $this->render('fichatecnica', $data);
    }

    public function actionUpdateAjax($data)
    {

        $data = array();
        $data["myValue"] = $data;

        $this->renderPartial('_fichatecnica_avances_imagenes', $data, false, true);
    }

     public function actionUpdateAjax2($data)
    {

        $data = array();
        $data["myValue"] = $data;

        $this->renderPartial('_fichatecnica_avances_documentos', $data, false, true);
    }

    public function actionPcd()
    {
      $this->render('pcd');
    }

    public function actionCreateExcel(){
      $this->render('pcd');

    }



  /* Crate for: ELNB
   * Date Creation: 05/09/2017
   * Description: Accción para exportar ha excel datos de consulta SQL
   */
    public function actionExportarExcel($nombrefile)
    {


        //$sql='SELECT * FROM vProyecto_Contrato LIMIT 100';
        $sql='SELECT * FROM vProyecto_Contrato';
        $command = Yii::app()->db->createCommand($sql);
        $dataReader = $command->queryAll();


        spl_autoload_unregister(array('YiiBase','autoload'));
        require(Yii::app()->basePath.'/extensions/phpexcel/Classes/PHPExcel.php');
        spl_autoload_register(array('YiiBase', 'autoload'));


        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setAutoSize(true);
       //$objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setAutoSize(true);
       //$objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setAutoSize(true);
       //$objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setAutoSize(true);



        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('U1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('Y1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('Z1')->getFont()->setBold(true);


        $objPHPExcel->getActiveSheet()->getStyle('AA1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AB1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AC1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AD1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AE1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AF1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AG1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AH1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AI1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AJ1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AK1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AL1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AM1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AN1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AO1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AP1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('AQ1')->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('AR1')->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('AS1')->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('AT1')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('O1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('P1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('Q1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('R1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('S1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('T1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('U1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('V1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('W1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('X1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('Y1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('Z1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));

        $objPHPExcel->getActiveSheet()->getStyle('AA1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AB1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AC1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AD1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AE1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AF1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AG1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AH1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AI1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AJ1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AK1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AL1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AM1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AN1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AO1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AP1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        $objPHPExcel->getActiveSheet()->getStyle('AQ1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        //$objPHPExcel->getActiveSheet()->getStyle('AR1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        //$objPHPExcel->getActiveSheet()->getStyle('AS1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));
        //$objPHPExcel->getActiveSheet()->getStyle('AT1')->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER, 'rotation'=> 0,'wrap' => true));



        $countData=0;
        $countReg=0;
        $num_hoja=0;
        $groupReg=false;
        $cantCut=30000;
        $objPHPExcel->getActiveSheet()->setTitle('Hoja1');
        $objPHPExcel->setActiveSheetIndex($num_hoja);


        foreach( $dataReader as $row ){
            $countData=$countData+1;
            $countReg=$countReg+1;

            if ($countData>$cantCut){
                $groupReg=true;
                $cantCut=$cantCut+30000;


                $objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
                $objPHPExcel->addSheet($objWorksheet);
                $objWorksheet->setTitle('Hoja'.($num_hoja+2));
                $countReg=1;
            }

            if ($groupReg){
                $num_hoja=$num_hoja+1;
                $groupReg=false;
            }

            if ($countReg==1){
                $objPHPExcel->setActiveSheetIndex($num_hoja)
                    ->setCellValue('A'.$countReg, 'ID PROYECTO')
                    ->setCellValue('B'.$countReg, 'ID CALIFICACIÓN')
                    ->setCellValue('C'.$countReg, 'ID ADJUDICACIÓN')
                    ->setCellValue('D'.$countReg, 'ID CONTRATACIÓN')
                    ->setCellValue('E'.$countReg, 'PROYECTO CODIGO')
                    ->setCellValue('F'.$countReg, 'PROYECTO CODIGO BIP')
                    ->setCellValue('G'.$countReg, 'PROYECTO NOMBRE')
                    ->setCellValue('H'.$countReg, 'PROYECTO DESCRIPCIÓN')
                    ->setCellValue('I'.$countReg, 'PROYECTO PROPOSITO')
                    ->setCellValue('J'.$countReg, 'PROYECTO AMBIENTAL')
                    ->setCellValue('K'.$countReg, 'PROYECTO REASENTAMIENTO')
                    ->setCellValue('L'.$countReg, 'PROYECTO FECHA APROBACIÓN')
                    ->setCellValue('M'.$countReg, 'PROYECTO PRESUPUESTO')
                    ->setCellValue('N'.$countReg, 'PROYECTO BENEFICIO')
                    ->setCellValue('O'.$countReg, 'PROYECTO FUENTE')
                    ->setCellValue('P'.$countReg, 'PROYECTO SECTOR')
                    ->setCellValue('Q'.$countReg, 'PROYECTO SUBSECTOR')
                    ->setCellValue('R'.$countReg, 'PROYECTO ENTE')
                    ->setCellValue('S'.$countReg, 'PROYECTO FUNCIONARIO NOMBRE')
                    ->setCellValue('T'.$countReg, 'CALIFICACIÓN ENTE')
                    ->setCellValue('U'.$countReg, 'CALIFICACIÓN NÚMERO')
                    ->setCellValue('V'.$countReg, 'CALIFICACIÓN NOMBRE')
                    ->setCellValue('W'.$countReg, 'ADJUDICACIÓN METODO')
                    ->setCellValue('X'.$countReg, 'CALIFICACIÓN METODO')
                    ->setCellValue('Y'.$countReg, 'CALIFICACIÓN FUNCIONARIO NOMBRE')
                    ->setCellValue('Z'.$countReg, 'CALIFICACIÓN OFERENTE')
                    ->setCellValue('AA'.$countReg, 'ADJUDICACIÓN TIPO CONTRATO')
                    ->setCellValue('AB'.$countReg, 'CONTRATACIÓN OFERENTE')
                    ->setCellValue('AC'.$countReg, 'CONTRATACIÓN ALCANCE')
                    ->setCellValue('AD'.$countReg, 'CONTRATACIÓN PRECIO LPS')
                    ->setCellValue('AE'.$countReg, 'CONTRATACIÓN PRECIO USD')
                    ->setCellValue('AF'.$countReg, 'CONTRATACIÓN FECHA CONTRACTUAL INICIO')
                    ->setCellValue('AG'.$countReg, 'CONTRATACIÓN FECHA FINAL')
                    ->setCellValue('AH'.$countReg, 'CONTRATACIÓN DURACIÓN')
                    ->setCellValue('AI'.$countReg, 'CONTRATACIÓN FECHA TERMINACIÓN ACTUALIZADA')
                    ->setCellValue('AG'.$countReg, 'CONTRATACIÓN PRECIO ACTUALIZADO')
                    ->setCellValue('AK'.$countReg, 'CONTRATACIÓN ADENDAS')
                    ->setCellValue('AL'.$countReg, 'CONTRATACIÓN NÚMERO PARTICIPANTES')
                    ->setCellValue('AM'.$countReg, 'CONTRATACIÓN COSTO ESTIMADO')
                    ->setCellValue('AN'.$countReg, 'CONTRATACIÓN NÚMERO CONTRATO')
                    ->setCellValue('AO'.$countReg, 'CONTRATACIÓN TITULO CONTRATO')
                    ->setCellValue('AP'.$countReg, 'CONTRATACIÓN FECHA INICIO')
                    ->setCellValue('AQ'.$countReg, 'AVANCES');
                   // ->setCellValue('AR'.$countReg, '')
                   // ->setCellValue('AS'.$countReg, '')
                   // ->setCellValue('AT'.$countReg, '');

                $countReg=$countReg+1;
                $objPHPExcel->setActiveSheetIndex($num_hoja)
                    ->setCellValue('A'.$countReg, $row['idProyecto'])
                    ->setCellValue('B'.$countReg, $row['idCalificacion'])
                    ->setCellValue('C'.$countReg, $row['idAdjudicacion'])
                    ->setCellValue('D'.$countReg, $row['idContratacion'])
                    ->setCellValue('E'.$countReg, $row['proyecto_codigo'])
                    ->setCellValue('F'.$countReg, $row['proyecto_codigo_BIP'])
                    ->setCellValue('G'.$countReg, $row['proyecto_nombre'])
                    ->setCellValue('H'.$countReg, $row['proyecto_descripcion'])
                    ->setCellValue('I'.$countReg, $row['proyecto_proposito'])
                    ->setCellValue('J'.$countReg, $row['proyecto_ambiental'])
                    ->setCellValue('K'.$countReg, $row['proyecto_reasentamiento'])
                    ->setCellValue('L'.$countReg, $row['proyecto_fecha_aprobacion'])
                    ->setCellValue('M'.$countReg, $row['proyecto_presupuesto'])
                    ->setCellValue('N'.$countReg, $row['Proyecto_Beneficio'])
                    ->setCellValue('O'.$countReg, $row['Proyecto_Fuentes'])
                    ->setCellValue('P'.$countReg, $row['proyecto_sector'])
                    ->setCellValue('Q'.$countReg, $row['proyecto_subsector'])
                    ->setCellValue('R'.$countReg, $row['proyecto_ente'])
                    ->setCellValue('S'.$countReg, $row['proyecto_funcionario_nombre'])
                    ->setCellValue('T'.$countReg, $row['calificacion_ente'])
                    ->setCellValue('U'.$countReg, $row['calificacion_numero'])
                    ->setCellValue('V'.$countReg, $row['calificacion_nombre'])
                    ->setCellValue('W'.$countReg, $row['adjudicacion_metodo'])
                    ->setCellValue('X'.$countReg, $row['calificacion_metodo'])
                    ->setCellValue('Y'.$countReg, $row['calificacion_funcionario_nombre'])
                    ->setCellValue('Z'.$countReg, $row['calificacion_oferentes'])
                    ->setCellValue('AA'.$countReg, $row['adjudicacion_tipo_contrato'])
                    ->setCellValue('AB'.$countReg, $row['contratacion_oferente'])
                    ->setCellValue('AC'.$countReg, $row['contratacion_alcances'])
                    ->setCellValue('AD'.$countReg, $row['contratacion_precioLPS'])
                    ->setCellValue('AE'.$countReg, $row['contratacion_precioUSD'])
                    ->setCellValue('AF'.$countReg, $row['contratacion_fecha_contractual_inicio'])
                    ->setCellValue('AG'.$countReg, $row['contratacion_fecha_final'])
                    ->setCellValue('AH'.$countReg, $row['contratacion_duracion'])
                    ->setCellValue('AI'.$countReg, $row['contratacion_fecha_terminacion_actualizada'])
                    ->setCellValue('AJ'.$countReg, $row['contratacion_precio_actualizado'])
                    ->setCellValue('AK'.$countReg, $row['contratacion_adendas'])
                    ->setCellValue('AL'.$countReg, $row['contratacion_numero_participantes'])
                    ->setCellValue('AM'.$countReg, $row['contratacion_costo_estimado'])
                    ->setCellValue('AN'.$countReg, $row['contratacion_numero_contrato'])
                    ->setCellValue('AO'.$countReg, $row['contratacion_titulo_contrato'])
                    ->setCellValue('AP'.$countReg, $row['contratacion_fecha_inicio'])
                    ->setCellValue('AQ'.$countReg, $row['Avances']);
                    //->setCellValue('AR'.$countReg, $row[''])
                    //->setCellValue('AS'.$countReg, $row[''])
                    //->setCellValue('AT'.$countReg, $row[''])


            }else{
                $objPHPExcel->setActiveSheetIndex($num_hoja)
                    ->setCellValue('A'.$countReg, $row['idProyecto'])
                    ->setCellValue('B'.$countReg, $row['idCalificacion'])
                    ->setCellValue('C'.$countReg, $row['idAdjudicacion'])
                    ->setCellValue('D'.$countReg, $row['idContratacion'])
                    ->setCellValue('E'.$countReg, $row['proyecto_codigo'])
                    ->setCellValue('F'.$countReg, $row['proyecto_codigo_BIP'])
                    ->setCellValue('G'.$countReg, $row['proyecto_nombre'])
                    ->setCellValue('H'.$countReg, $row['proyecto_descripcion'])
                    ->setCellValue('I'.$countReg, $row['proyecto_proposito'])
                    ->setCellValue('J'.$countReg, $row['proyecto_ambiental'])
                    ->setCellValue('K'.$countReg, $row['proyecto_reasentamiento'])
                    ->setCellValue('L'.$countReg, $row['proyecto_fecha_aprobacion'])
                    ->setCellValue('M'.$countReg, $row['proyecto_presupuesto'])
                    ->setCellValue('N'.$countReg, $row['Proyecto_Beneficio'])
                    ->setCellValue('O'.$countReg, $row['Proyecto_Fuentes'])
                    ->setCellValue('P'.$countReg, $row['proyecto_sector'])
                    ->setCellValue('Q'.$countReg, $row['proyecto_subsector'])
                    ->setCellValue('R'.$countReg, $row['proyecto_ente'])
                    ->setCellValue('S'.$countReg, $row['proyecto_funcionario_nombre'])
                    ->setCellValue('T'.$countReg, $row['calificacion_ente'])
                    ->setCellValue('U'.$countReg, $row['calificacion_numero'])
                    ->setCellValue('V'.$countReg, $row['calificacion_nombre'])
                    ->setCellValue('W'.$countReg, $row['adjudicacion_metodo'])
                    ->setCellValue('X'.$countReg, $row['calificacion_metodo'])
                    ->setCellValue('Y'.$countReg, $row['calificacion_funcionario_nombre'])
                    ->setCellValue('Z'.$countReg, $row['calificacion_oferentes'])
                    ->setCellValue('AA'.$countReg, $row['adjudicacion_tipo_contrato'])
                    ->setCellValue('AB'.$countReg, $row['contratacion_oferente'])
                    ->setCellValue('AC'.$countReg, $row['contratacion_alcances'])
                    ->setCellValue('AD'.$countReg, $row['contratacion_precioLPS'])
                    ->setCellValue('AE'.$countReg, $row['contratacion_precioUSD'])
                    ->setCellValue('AF'.$countReg, $row['contratacion_fecha_contractual_inicio'])
                    ->setCellValue('AG'.$countReg, $row['contratacion_fecha_final'])
                    ->setCellValue('AH'.$countReg, $row['contratacion_duracion'])
                    ->setCellValue('AI'.$countReg, $row['contratacion_fecha_terminacion_actualizada'])
                    ->setCellValue('AJ'.$countReg, $row['contratacion_precio_actualizado'])
                    ->setCellValue('AK'.$countReg, $row['contratacion_adendas'])
                    ->setCellValue('AL'.$countReg, $row['contratacion_numero_participantes'])
                    ->setCellValue('AM'.$countReg, $row['contratacion_costo_estimado'])
                    ->setCellValue('AN'.$countReg, $row['contratacion_numero_contrato'])
                    ->setCellValue('AO'.$countReg, $row['contratacion_titulo_contrato'])
                    ->setCellValue('AP'.$countReg, $row['contratacion_fecha_inicio'])
                    ->setCellValue('AQ'.$countReg, $row['Avances']);
                    //->setCellValue('AR'.$countReg, $row[''])
                    //->setCellValue('AS'.$countReg, $row[''])
                    //->setCellValue('AT'.$countReg, $row[''])
            }


        }



        ob_end_clean();
        ob_start();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$nombrefile.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');


    }

    public function actionViewImagenes($id)
    {
        $imagenes = Yii::app()->db->createCommand()
                            ->select('*')
                            ->from('v_imagenes_poravance')
                            ->where('idAvances=:id', array(':id' => $id))
                            ->queryAll();
        $this->renderPartial('_dialogViewImagenes', array('imagenes'=>$imagenes));
    }
}
