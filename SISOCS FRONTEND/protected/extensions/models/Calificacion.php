<?php
    
    /**
        * This is the model class for table "{{calificacion}}".
        *
        * The followings are the available columns in table '{{calificacion}}':
        * @property string $idCalificacion
        * @property string $idProyecto
        * @property string $numproceso
        * @property string $nomprocesoproyecto
        * @property string $fechactualizacion
        * @property string $idFuncionario
        * @property string $estatusproceso
        * @property string $proceseval
        * @property string $invitainter
        * @property string $basespreca
        * @property string $resolucion
        * @property string $nombreante
        * @property string $convocainvi
        * @property string $tdr
        * @property string $aclaraciones
        * @property string $actarecpcion
        * @property string $fechaingreso
        * @property string $tipocontrato
        * @property string $estado
        * @property string $otro1
        * @property string $otro2
        * @property string $identidadadquisicion
        * @property string $idmetodo
        *
        * The followings are the available model relations:
        * @property Adjudicacion[] $adjudicacions
        * @property Funcionarios $idFuncionario0
        * @property Proyecto $idProyecto0
        * @property Entes $idEnte0
        * @property Tipoadquisicion $idMetodo0
        * @property Empresa[] $csEmpresas
        * @property Firma[] $csFirmas
        * @property Oferente[] $csOferentes
    */
    class Calificacion extends CActiveRecord
    {
        
        public $image1, $image2, $image3, $image4, $image5, $image6, $image7, $image8, $image9;
        
        /**
            * @return string the associated database table name
        */
        public function tableName()
        {
            return '{{calificacion}}';
        }
        
        //public $filter_idProyecto
        
        /**
            * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
			array('idProyecto', 'required'),
			array('idProyecto, idFuncionario, identidadadquisicion, idmetodo', 'length', 'max'=>10),
			array('numproceso', 'length', 'max'=>30),
			array('nomprocesoproyecto', 'length', 'max'=>500),
			array('estatusproceso, estado', 'length', 'max'=>25),
			array('proceseval', 'length', 'max'=>100),
			array('invitainter, basespreca, resolucion, nombreante, convocainvi, tdr, aclaraciones, actarecpcion, otro1, otro2', 'length', 'max'=>150),
			array('fechaingreso', 'length', 'max'=>12),
			array('fecharecibido', 'length', 'max'=>10),
			array('tipocontrato', 'length', 'max'=>50),
            array('fecharecibido','length', 'max'=>10),
			array('fechactualizacion', 'safe'),
            
            array('image1, image2, image3, image4, image5, image6, image7, image8, image9', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),
            
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image1, image2, image3, image4, image5, image6, image7, image8, image9, idCalificacion, idProyecto, numproceso, nomprocesoproyecto, fechactualizacion, idFuncionario, estatusproceso, proceseval, invitainter, basespreca, resolucion, nombreante, convocainvi, tdr, aclaraciones, actarecpcion, fechaingreso, fecharecibido, tipocontrato, estado, otro1, otro2, identidadadquisicion, idmetodo', 'safe', 'on'=>'search'),
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
			'adjudicacions' => array(self::HAS_MANY, 'Adjudicacion', 'idCalificacion'),
			'idFuncionario0' => array(self::BELONGS_TO, 'Funcionarios', 'idFuncionario'),
			'idProyecto0' => array(self::BELONGS_TO, 'Proyecto', 'idProyecto'),
			'csEmpresas' => array(self::MANY_MANY, 'Empresa', '{{calificacion_empresa}}(idcalificacion, idempresa)'),
			'csFirmas' => array(self::MANY_MANY, 'Firma', '{{calificacion_firma}}(idcalificacion, idfirma)'),
			'csOferentes' => array(self::MANY_MANY, 'Oferente', '{{calificacion_oferente}}(idcalificacion, idoferente)'),
            'idEnte0' => array(self::BELONGS_TO, 'Entes', 'identidadadquisicion'),
            'idMetodo0' => array(self::BELONGS_TO, 'Tipoadquisicion', 'idmetodo'),
            
            );
        }
        
        /**
            * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
			'idCalificacion' => 'Id Calificación',
			'idProyecto' => 'Id del Proyecto',
			'numproceso' => 'Número del Proceso',
			'nomprocesoproyecto' => 'Nombre del Proceso',
			'fechactualizacion' => 'Fecha de Actualización',
			'idFuncionario' => 'Nombre del Funcionario',
			'estatusproceso' => 'Estatus del Proceso',
			'proceseval' => 'Proceso de Evaluación',
			'invitainter' => 'Invitación a los Interesados para Participar en el Proceso de Calificación para la Ejecución del Proyecto o en la Calificación para el Concurso para la Supervición de Obras',
			'basespreca' => 'Bases de Precalificación del Proceso',
			'resolucion' => 'Resolución declarando la Precalificación de los Interesados que Acreditaron los Requisitos 
            Exigidos en las Bases.',
			'nombreante' => 'Nombre y Antecedentes de las Empresas Pre-calificadas para Participar en la Licitación',
			'convocainvi' => 'Convocatoria o Invitación a Licitar ',
			'tdr' => 'Pliego de Condiciones o Bases del Concurso (TdR)',
			'aclaraciones' => 'Aclaraciones  o Enmiendas al Pliego de Condiciones',
			'actarecpcion' => 'Acta de Recepción/ Presentación de Ofertas',
			'fechaingreso' => 'Fecha de Ingreso de la Información',
			'fechacreacion'=>'Fecha de Creación de la Ficha',
			'tipocontrato' => 'Tipo de Contrato',
			'estado' => 'Estado',
			'otro1' => 'Otro1',
			'otro2' => 'Otro ',
			'identidadadquisicion' => 'Entidad de Adquisición (Unidad Ejecutora)',
			'idmetodo' => 'Método de Adquisición o Proceso de Contratación',
			'fecharecibido'=>'Fecha en que se Genera la Información',
			'idEnte0'=>'descripcion'
			//'filter_idProyecto' => 'Filtrar por Proyecto',
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
            
            $criteria->compare('idCalificacion',$this->idCalificacion,true);
            $criteria->compare('idProyecto',$this->idProyecto,true);
            $criteria->compare('numproceso',$this->numproceso,true);
            $criteria->compare('nomprocesoproyecto',$this->nomprocesoproyecto,true);
            $criteria->compare('fechactualizacion',$this->fechactualizacion,true);
            $criteria->compare('idFuncionario',$this->idFuncionario,true);
            $criteria->compare('estatusproceso',$this->estatusproceso,true);
            $criteria->compare('proceseval',$this->proceseval,true);
            $criteria->compare('invitainter',$this->invitainter,true);
            $criteria->compare('basespreca',$this->basespreca,true);
            $criteria->compare('resolucion',$this->resolucion,true);
            $criteria->compare('nombreante',$this->nombreante,true);
            $criteria->compare('convocainvi',$this->convocainvi,true);
            $criteria->compare('tdr',$this->tdr,true);
            $criteria->compare('aclaraciones',$this->aclaraciones,true);
            $criteria->compare('actarecpcion',$this->actarecpcion,true);
            $criteria->compare('fechaingreso',$this->fechaingreso,true);
            $criteria->compare('fecharecibido',$this->fecharecibido,true);
            $criteria->compare('tipocontrato',$this->tipocontrato,true);
            $criteria->compare('estado',$this->estado,true);
            $criteria->compare('otro1',$this->otro1,true);
            $criteria->compare('otro2',$this->otro2,true);
            $criteria->compare('identidadadquisicion',$this->identidadadquisicion,true);
            $criteria->compare('idmetodo',$this->idmetodo,true);
            
            if (!Yii::app()->user->isSuperAdmin) {
                $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
            }
            
            return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            ));
            
            /*
                if($this->filter_idProyecto)
                {
                $criteria->together  =  true;
                $criteria->with = array('idProyecto0');
                $criteria->compare('idProyecto0.idProyecto',$this->idProyecto,true);
                }
            */
            
            /* if (Yii::app()->user->isSuperAdmin) {
                return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,//array('condition'=>'estado ="PUBLICADO"',),//
                ));
                }else{
                return new CActiveDataProvider($this, array(
                'criteria'=>array('condition'=>'estado ="PUBLICADO"',),//
                ));
            } */
        }
        
        /**
            * Returns the static model of the specified AR class.
            * Please note that you should have this exact method in all your CActiveRecord descendants!
            * @param string $className active record class name.
            * @return Calificacion the static model class
        */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
        public function listaEstados()
        {
            $dat= Estado::model()->findAll();
            $list = CHtml::listData($dat,'estado', 'estado');
            return $list ;
        }
        public function listaTipocontrato()
        {
            $dat= Tipocontrato::model()->findAll();
            $list = CHtml::listData($dat,'contrato','contrato');
            return $list ;  
        }
        public function listaFuncionarios()
        {
            $dat= Funcionarios::model()->findAll();
            $list = CHtml::listData($dat,'idfuncionario', 'nombre');
            return $list ;
        }
        public function listaEstadospro()
        {
            $dat= Estadoproceso::model()->findAll();
            $list = CHtml::listData($dat,'estadoproceso', 'estadoproceso');
            return $list ;
        }
        public function listaProyectos()
        {
            $dat= Proyecto::model()->findAll();
            $list = CHtml::listData($dat,'idProyecto', 'nombre_proyecto');
            return $list ;
        }
        public function listaEntidades()
        {
            $dat= Entes::model()->findAll();
            $list = CHtml::listData($dat,'idente', 'descripcion');
            return $list ;
        }
        public function listaTipoAdqui()
        {
            $dat= Tiposadquisicion::model()->findAll();
            $list = CHtml::listData($dat,'idtipo', 'adquisicion');
            return $list ;
        }
		
        public function listaTipoAdqui_Construccion()
        {
            $dat= Tiposadquisicion::model()->findAll('idtipo = 7 or idtipo between 2 and 4 ;');
            $list = CHtml::listData($dat,'idtipo', 'adquisicion');
            return $list ;
        }
        
        public function listaTipoAdqui_Disenio()
        {
            $dat= Tiposadquisicion::model()->findAll(' idtipo between 5 and 7 ;');
            $list = CHtml::listData($dat,'idtipo', 'adquisicion');
            return $list ;
        }
		
    }
