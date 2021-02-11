<?php
    
    /**
        * This is the model class for table "{{inicio_ejecucion}}".
        *
        * The followings are the available columns in table '{{inicio_ejecucion}}':
        * @property integer $codigo
        * @property integer $idContratacion
        * @property string $imagen
        * @property integer $cod_contacto_01
        * @property integer $cod_contacto_02
        * @property integer $cod_contacto_03
        * @property integer $tipo_garant_01
        * @property integer $tipo_garant_02
        * @property integer $tipo_garant_03
        * @property string $monto_garant_01
        * @property string $monto_garant_02
        * @property string $monto_garant_03
        * @property integer $estado_garant_01
        * @property integer $estado_garant_02
        * @property integer $estado_garant_03
        * @property string $fecha_venc_01
        * @property string $fecha_venc_02
        * @property string $fecha_venc_03
        * @property string $geo_latitud
        * @property string $geo_longitud
        * @property string $geo_lati_final
        * @property string $geo_long_final
        * @property string $fecha_inicio
        * @property string $estado_sol
        * @property string $fecha_registro
        * @property string $user_registro
    */
    class InicioEjecucion extends CActiveRecord
    {
        public $titulo_contrato;
        /**
            * @return string the associated database table name
        */
        public function tableName()
        {
            return '{{inicio_ejecucion}}';
        }
        
        /**
            * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
			array('idContratacion, cod_contacto_01, cod_contacto_02, cod_contacto_03, tipo_garant_01, tipo_garant_02, tipo_garant_03, estado_garant_01, estado_garant_02, estado_garant_03, geo_lati_final, geo_long_final, fecha_registro', 'required'),
			array('idContratacion, cod_contacto_01, cod_contacto_02, cod_contacto_03, tipo_garant_01, tipo_garant_02, tipo_garant_03, estado_garant_01, estado_garant_02, estado_garant_03', 'numerical', 'integerOnly'=>true),
			array('imagen', 'length', 'max'=>255),
			array('monto_garant_01, monto_garant_02, monto_garant_03', 'length', 'max'=>15),
			array('geo_latitud, geo_longitud, geo_lati_final, geo_long_final', 'length', 'max'=>10),
			array('estado_sol', 'length', 'max'=>25),
			array('user_registro', 'length', 'max'=>16),
			array('fecha_venc_01, fecha_venc_02, fecha_venc_03, fecha_inicio', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('titulo_contrato, codigo, idContratacion, imagen, cod_contacto_01, cod_contacto_02, cod_contacto_03, tipo_garant_01, tipo_garant_02, tipo_garant_03, monto_garant_01, monto_garant_02, monto_garant_03, estado_garant_01, estado_garant_02, estado_garant_03, fecha_venc_01, fecha_venc_02, fecha_venc_03, geo_latitud, geo_longitud, geo_lati_final, geo_long_final, fecha_inicio, estado_sol, fecha_registro, user_registro', 'safe', 'on'=>'edit, post, search'),
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
			'codContacto03' => array(self::BELONGS_TO, 'Contactos', 'cod_contacto_03'),
			'codContacto01' => array(self::BELONGS_TO, 'Contactos', 'cod_contacto_01'),
			'codContacto02' => array(self::BELONGS_TO, 'Contactos', 'cod_contacto_02'),
			
			'tipoGarant03' => array(self::BELONGS_TO, 'CatgTipoGarantias', 'tipo_garant_03'),
			'tipoGarant01' => array(self::BELONGS_TO, 'CatgTipoGarantias', 'tipo_garant_01'),
			'tipoGarant02' => array(self::BELONGS_TO, 'CatgTipoGarantias', 'tipo_garant_02'),
			
			'estadoGarant03' => array(self::BELONGS_TO, 'Estadosgestcontra', 'estado_garant_03'),
			'estadoGarant01' => array(self::BELONGS_TO, 'Estadosgestcontra', 'estado_garant_01'),
			'estadoGarant02' => array(self::BELONGS_TO, 'Estadosgestcontra', 'estado_garant_02'),
			
            'contratacion0' => array(self::BELONGS_TO, 'Contratacion', 'idContratacion'),
			'estadosSolicitud0' => array(self::BELONGS_TO, 'Estado', 'estado'),
			
			/*'contactos0' => array(self::BELONGS_TO, 'Contactos', 'codigo'),
                'catgTipoGarantias0' => array(self::BELONGS_TO, 'CatgTipoGarantias', 'codigo'),
                //'estado0' => array(self::BELONGS_TO, 'estadosgestcontra', 'codigo'),
            'estadosgestcontra0' => array(self::BELONGS_TO, 'Estadosgestcontra', 'codigo'),*/
			
			
            );
        }
        
        /**
            * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
			'codigo' => 'Código de Ejecución',
			'idContratacion' => 'Número de Contrato',
			'cod_contacto_01' => 'Datos de Contacto del Consultor a Cargo del Diseño del Proyecto',
			'cod_contacto_02' => 'Datos de Contacto del Representante del Contratista',
			'cod_contacto_03' => 'Datos de Contacto del Representante del Supervisor',
			'tipo_garant_01' => 'Tipo de Garantía Otorgada 1',
			'tipo_garant_02' => 'Tipo de Garantía Otorgada 2',
			'tipo_garant_03' => 'Tipo de Garantía Otorgada 3',
			'monto_garant_01' => 'Monto de Garantía 1',
			'monto_garant_02' => 'Monto de Garantía 2',
			'monto_garant_03' => 'Monto de Garantía 3',
			'estado_garant_01' => 'Estado de la Garantía 1',
			'estado_garant_02' => 'Estado de la Garantía 2',
			'estado_garant_03' => 'Estado de la Garantia 3',
			'fecha_venc_01' => 'Fecha de Vencimiento de la Garantía 1',
			'fecha_venc_02' => 'Fecha de Vencimiento de la Garantía 2',
			'fecha_venc_03' => 'Fecha de Vencimiento de la Garantía 3',
			'geo_latitud' => 'Ubicación Aproximada del Proyecto (Latitud) Inicial',
			'geo_longitud' => 'Ubicación Aproximada del Proyecto (Longitud) Inicial',
			'geo_lati_final' => 'Ubicación Aproximada del Proyecto (Latitud) Final',
			'geo_long_final' => 'Ubicación Aproximada del Proyecto (Longitud) Final',
			'fecha_inicio' => 'Fecha de Orden de Inicio',
			'estado_sol'=> 'Estado',
			'fecha_registro' => 'Fecha registro',
			'user_registro' => 'Usuario de registro',
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
            'contratacion0' => array('alias'=> 'contratacion0', 'together' => true, ),
            );
            $criteria->together = true;
            $criteria->compare( 'contratacion0.titulocontrato', $this->titulo_contrato, true ); // related field new
            
            $criteria->compare('codigo',$this->codigo);
            $criteria->compare('idContratacion',$this->idContratacion);
            $criteria->compare('imagen',$this->imagen,true);
            $criteria->compare('cod_contacto_01',$this->cod_contacto_01);
            $criteria->compare('cod_contacto_02',$this->cod_contacto_02);
            $criteria->compare('cod_contacto_03',$this->cod_contacto_03);
            $criteria->compare('tipo_garant_01',$this->tipo_garant_01);
            $criteria->compare('tipo_garant_02',$this->tipo_garant_02);
            $criteria->compare('tipo_garant_03',$this->tipo_garant_03);
            $criteria->compare('monto_garant_01',$this->monto_garant_01,true);
            $criteria->compare('monto_garant_02',$this->monto_garant_02,true);
            $criteria->compare('monto_garant_03',$this->monto_garant_03,true);
            $criteria->compare('estado_garant_01',$this->estado_garant_01);
            $criteria->compare('estado_garant_02',$this->estado_garant_02);
            $criteria->compare('estado_garant_03',$this->estado_garant_03);
            $criteria->compare('fecha_venc_01',$this->fecha_venc_01,true);
            $criteria->compare('fecha_venc_02',$this->fecha_venc_02,true);
            $criteria->compare('fecha_venc_03',$this->fecha_venc_03,true);
            $criteria->compare('geo_latitud',$this->geo_latitud,true);
            $criteria->compare('geo_longitud',$this->geo_longitud,true);
            $criteria->compare('geo_lati_final',$this->geo_lati_final,true);
            $criteria->compare('geo_long_final',$this->geo_long_final,true);
            $criteria->compare('fecha_inicio',$this->fecha_inicio,true);
            $criteria->compare('estado_sol',$this->estado_sol,true);
            $criteria->compare('fecha_registro',$this->fecha_registro,true);
            $criteria->compare('user_registro',$this->user_registro,true);
            
            if (!Yii::app()->user->isSuperAdmin) {
                $criteria->addSearchCondition('estado_sol', 'BORRADOR', true, 'AND');
            }
            
            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            ));
        }
        
        /**
            * Returns the static model of the specified AR class.
            * Please note that you should have this exact method in all your CActiveRecord descendants!
            * @param string $className active record class name.
            * @return InicioEjecucion the static model class
        */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
        
        public function listaContactos()
        {
            $dat= Contactos::model()->findAll(array('order'=>'Nombres'));
            $list = CHtml::listData($dat,'codigo', 'Nombres');
            return $list ;
        }
        
        
        public function listaEstadosGestContra()
        {
            $dat= Estadosgestcontra::model()->findAll();
            $list = CHtml::listData($dat,'codigo', 'descripcion');
            return $list ;
        }
        
        
        
        public function listaCatgTipoGarantias()
        {
            $dat= CatgTipoGarantias::model()->findAll();
            $list = CHtml::listData($dat,'codigo', 'descripcion');
            return $list ;
        }
        
        
        
        public function listaContratacion()
        {
            $dat= Contratacion::model()->findAll();
            $list = CHtml::listData($dat,'idContratacion', 'ncontrato');
            return $list ;
        }	
        
        public function listaEstadosSol()
        {
            $dat= Estado::model()->findAll();
            $list = CHtml::listData($dat,'estado', 'estado');
            return $list ;
        }
		
    }
