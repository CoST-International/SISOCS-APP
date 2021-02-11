<?php
    
    /**
        * This is the model class for table "{{proyecto}}".
        *
        * The followings are the available columns in table '{{proyecto}}':
        * @property string $idProyecto
        * @property string $idPrograma
        * @property string $codigo
        * @property string $nombre_proyecto
        * @property string $idUbicacion
        * @property string $idRegion
        * @property string $idDepto
        * @property string $idTramo
        * @property integer $idRuta
        * @property string $idTipoRed
        * @property string $idEstadoRed
        * @property integer $idProposito
        * @property string $descrip
        * @property double $presupuesto
        * @property string $especiplano
        * @property string $presuprogra
        * @property string $estudiofact
        * @property string $estudioimpact
        * @property string $licambi
        * @property string $estuimpactierra
        * @property string $planreasea
        * @property string $plananual
        * @property string $acuerdofinan
        * @property string $otro
        * @property string $fechacreacion
        * @property string $estado
        * @property string $idFuncionario
        * @property string $fechaaprob
        * @property string $idfuente
        * @property string $codsefin
        * @property string $notaprioridad
        * @property string $constanciabanco
        *
        * The followings are the available model relations:
        * @property Calificacion[] $calificacions
        * @property Programa $idPrograma0
        * @property Departamento $idDepto0
        * @property Estadored $idEstadoRed0
        * @property Fuentesfinan $idfuente0
        * @property Region $idRegion0
        * @property Tipored $idTipoRed0
        * @property Tramo $idTramo0
        * @property Ruta $idRuta0
        * @property Ruta $idProposito0
        * @property Ubicacionvial $idUbicacion0
        * @property Funcionarios $idFuncionario0
        * @property Beneficiario[] $csBeneficiarios
    */
    class Proyecto extends CActiveRecord
    {
        public $nombre_programa;
        public $nombre_region;
        public $image1, $image2, $image3, $image4, $image5, $image6, $image7, $image8, $image9, $image10, $image11, $image12;
        
        /**
            * @return string the associated database table name
        */
        public function tableName()
        {
            return '{{proyecto}}';
        }
        
        /**
            * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
			array('idPrograma, codigo, nombre_proyecto', 'required'),
			array('idRuta, idProposito', 'numerical', 'integerOnly'=>true),
			array('presupuesto', 'numerical'),
			array('idPrograma, idUbicacion, idRegion, idFuncionario, idfuente', 'length', 'max'=>50),
			array('codigo, codsefin', 'length', 'max'=>20),
			array('nombre_proyecto', 'length', 'max'=>500),
			array('entes', 'length', 'max'=>15),
			array('idDepto, idTramo, idTipoRed', 'length', 'max'=>4),
			array('especiplano, presuprogra, estudiofact, estudioimpact, licambi, estuimpactierra, planreasea, plananual, acuerdofinan, otro, notaprioridad, constanciabanco', 'length', 'max'=>150),
			array('estado', 'length', 'max'=>25),
            array('fecharecibido,clase', 'length', 'max'=>25),
			array('descrip, fechacreacion, fechaaprob', 'safe'),
            
            array('image1, image2, image3, image4, image5, image6, image7, image8, image9, image10, image11, image12', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),
            
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image1, image2, image3, image4, image5, image6, image7, image8, image9, image10, image11, image12, nombre_programa, nombre_region, idProyecto, idPrograma, codigo, nombre_proyecto,entes, idUbicacion, idRegion, idDepto, idTramo, idRuta, idTipoRed, idProposito, descrip, presupuesto, especiplano, presuprogra, estudiofact, estudioimpact, licambi, estuimpactierra, planreasea, plananual, acuerdofinan, otro, fechacreacion, estado, idFuncionario, fechaaprob, idfuente, codsefin,fecharecibido, notaprioridad, constanciabanco', 'safe', 'on'=>'search'),
            );
        }
        
        /**
            * @return array relational rules.
        */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
			'calificacions' => array(self::HAS_MANY, 'Calificacion', 'idProyecto'),
			'idPrograma0' => array(self::BELONGS_TO, 'Programa', 'idPrograma'),
			'idDepto0' => array(self::BELONGS_TO, 'Departamento', 'idDepto'),
			'idfuente0' => array(self::BELONGS_TO, 'Fuentesfinan', 'idfuente'),
			'idRegion0' => array(self::BELONGS_TO, 'Region', 'idRegion'),
			'idTipoRed0' => array(self::BELONGS_TO, 'Tipored', 'idTipoRed'),
			'idTramo0' => array(self::BELONGS_TO, 'Tramo', 'idTramo'),
			'idRuta0' => array(self::BELONGS_TO, 'Ruta', 'idRuta'),
			'idProposito0' => array(self::BELONGS_TO, 'Proposito', 'idProposito'),
			'idUbicacion0' => array(self::BELONGS_TO, 'Ubicacionvial', 'idUbicacion'),
			'idFuncionario0' => array(self::BELONGS_TO, 'Funcionarios', 'idFuncionario'),
			'csBeneficiarios' => array(self::MANY_MANY, 'Beneficiario', '{{proyecto_beneficiario}}(idproyecto, idbeneficiario)'),
			'entes0' => array(self::BELONGS_TO, 'Entes', 'entes'),
            );
        }
        
        /**
            * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
			'idProyecto' => 'Id del Proyecto',
			'idPrograma' => 'Id Programa',
			'codigo' => 'Código del Proyecto',
			'nombre_proyecto' => 'Nombre del Proyecto',
			'idUbicacion' => 'Ubicación',
			'idRegion' => 'Región',
			'entes' => 'Ente resposable',
			'idDepto' => 'Departamento Principal',
			'idTramo' => 'Tramo',
			'idRuta' => 'Ruta',
			'idTipoRed' => 'Tipo de Red Vial',
			'idProposito' => 'Propósito',
			'descrip' => 'Descripción Detallada y Alcances del Proyecto',
			'presupuesto' => 'Presupuesto en LPS',
			'especiplano' => 'Especificaciones y Planos de la Obra',
			'presuprogra' => 'Presupuesto y Programa Multianual del Proyecto',
			'estudiofact' => 'Estudio de Factibilidad',
			'estudioimpact' => 'Estudio de Impacto Ambiental',
			'licambi' => 'Licencia Ambiental y Contrato de Medidas de Mitigación',
			'estuimpactierra' => 'Estudio de Impacto en Tierras y Reasentamiento',
			'planreasea' => 'Plan de Reasentamiento y Compensación',
			'plananual' => 'Plan Anual de Compras y Contrataciones (PACC)',
			'acuerdofinan' => 'Acuerdo de Financiamiento',
			'otro' => 'Otro',
			'fechacreacion' => 'Fecha de Creación de la Ficha',
			'estado' => 'Estado',
			'idFuncionario' => 'Funcionario Responsable',
			'fechaaprob' => 'Fecha de Aprobación del Presupuesto',
			'idfuente' => 'Fuente de Financiamiento',
			'codsefin' => 'Código de Secretaria de Finanzas(BIP)',
			'notaprioridad' => 'Nota Prioridad',
			'constanciabanco' => 'Constancia del Banco',
            'fecharecibido'=>'Fecha en que Recibió la Información',
            'clase'=>'Clase',
            );
        }
        
        /**
            * Retrieves a list of models based on the current search/filter conditions.
            *
            * Typical usecase:
            * - Initialize the model fields with values from filter form.
            * - Execute this method to get CActiveDataProvider instance which will filter
            * models according to data in model fields.
            * - Pass data provider to CGridView, CListView or any similar widget.
            *
            * @return CActiveDataProvider the data provider that can return the models
            * based on the search/filter conditions.
        */
        public function search()
        {
            // @todo Please modify the following code to remove attributes that should not be searched.
            
            $criteria=new CDbCriteria;
            
            $criteria->with = array(
            'idPrograma0' => array('alias'=> 'idPrograma0', 'together' => true, ),
            'idRegion0' => array('alias'=> 'idRegion0', 'together' => true, ),
            );
            $criteria->together = true;
            $criteria->compare( 'idPrograma0.nombreprograma', $this->nombre_programa, true ); // related field new
            $criteria->compare( 'idRegion0.region', $this->nombre_region, true ); // related field new
            
            $criteria->compare('idProyecto',$this->idProyecto,true);
            $criteria->compare('idPrograma',$this->idPrograma,true);
            
            $criteria->compare('codigo',$this->codigo,true);
            $criteria->compare('nombre_proyecto',$this->nombre_proyecto,true);
            $criteria->compare('idUbicacion',$this->idUbicacion,true);
            $criteria->compare('idRegion',$this->idRegion,true);
            $criteria->compare('entes',$this->entes,true);
            $criteria->compare('idDepto',$this->idDepto,true);
            $criteria->compare('idTramo',$this->idTramo,true);
            $criteria->compare('idRuta',$this->idRuta);
            $criteria->compare('idTipoRed',$this->idTipoRed,true);
            $criteria->compare('idProposito',$this->idProposito);
            $criteria->compare('descrip',$this->descrip,true);
            $criteria->compare('presupuesto',$this->presupuesto);
            $criteria->compare('especiplano',$this->especiplano,true);
            $criteria->compare('presuprogra',$this->presuprogra,true);
            $criteria->compare('estudiofact',$this->estudiofact,true);
            $criteria->compare('estudioimpact',$this->estudioimpact,true);
            $criteria->compare('licambi',$this->licambi,true);
            $criteria->compare('estuimpactierra',$this->estuimpactierra,true);
            $criteria->compare('planreasea',$this->planreasea,true);
            $criteria->compare('plananual',$this->plananual,true);
            $criteria->compare('acuerdofinan',$this->acuerdofinan,true);
            $criteria->compare('otro',$this->otro,true);
            $criteria->compare('fechacreacion',$this->fechacreacion,true);
            $criteria->compare('estado',$this->estado,true);
            $criteria->compare('idFuncionario',$this->idFuncionario,true);
            $criteria->compare('fechaaprob',$this->fechaaprob,true);
            $criteria->compare('idfuente',$this->idfuente,true);
            $criteria->compare('codsefin',$this->codsefin,true);
            $criteria->compare('notaprioridad',$this->notaprioridad,true);
            $criteria->compare('constanciabanco',$this->constanciabanco,true);
            
            if (!Yii::app()->user->isSuperAdmin) {
                $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
            }
            
            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            ));
            
            /* if (Yii::app()->user->isSuperAdmin) {
                return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,//array('condition'=>'estado ="PUBLICADO"',),//
                ));
                }else{
                return new CActiveDataProvider($this, array(
                'criteria'=>array('condition'=>'estado ="BORRADOR"',),//
                ));
            } */
        }
        
        /**
            * Returns the static model of the specified AR class.
            * Please note that you should have this exact method in all your CActiveRecord descendants!
            * @param string $className active record class name.
            * @return Proyecto the static model class
        */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
        
        public function listaProgramas()
        {
            $dat= Programa::model()->findAll();
            $list = CHtml::listData($dat,'idPrograma', 'nombreprograma');
            return $list ;
        }
        public function listaEstados()
        {
            $dat= Estado::model()->findAll();
            $list = CHtml::listData($dat,'estado', 'estado');
            return $list ;
        }
        public function listaFuentes()
        {
            $dat=  Fuentesfinan::model()->findAll();
            $list = CHtml::listData($dat,'idfuente','fuente');
            return $list ;  
        }
        public function listaTipored()
        {
            $dat= Tipored::model()->findAll();
            $list = CHtml::listData($dat,'Idtipored','descripcion_tipo');
            return $list ;  
        }
        public function listaTipolicitacion()
        {
            $dat= Tiposadquisicion::model()->findAll();
            $list = CHtml::listData($dat,'adquisicion','adquisicion');
            return $list ;  
        }
        
		public function listaDepartamentos()
        {
            $dat= Departamento::model()->findAll();
            $list = CHtml::listData($dat,'codigoDepto','departamento');
            return $list ;  
        }
        
        public function listaTUvial()
        {
            $dat= Ubicacionvial::model()->findAll();
            $list = CHtml::listData($dat,'idubicacion','codigo');
            return $list ;          
        }
        public function listaRuta()
        {
            $dat= Ruta::model()->findAll();
            $list = CHtml::listData($dat,'idruta','tramo');
            return $list ;  
        }
        
        
        public function listaRegion()
        {
            $dat= Region::model()->findAll();
            $list = CHtml::listData($dat,'idregion','region');
            return $list ;  
        }
        public function listaPropositos()
        {
            $dat= Proposito::model()->findAll();
            $list = CHtml::listData($dat,'idproposito', 'proposito');
            return $list ;
        }
		
        public function listaTramo()
        {
            $dat= Tramo::model()->findAll();
            $list = CHtml::listData($dat,'idtramo', 'tramo');
            return $list ;
        }
        public function listaFuncionarios()
        {
            $dat= Funcionarios::model()->findAll();
            $list = CHtml::listData($dat,'idfuncionario', 'nombre');
            return $list ;
        }
        public function listaClases() {
            $dat=Clase::model()->findAll();
            $list = CHtml::listData($dat,'idclase', 'clase');
            return $list ;
        }
		public function listaEntes()  
        {
            $dat= Entes::model()->findAll();
            $list = CHtml::listData($dat,'idente', 'descripcion');
            return $list ;
        }
    }
