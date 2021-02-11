<?php

    /**
        * This is the model class for table "{{contratos}}".
        *
        * The followings are the available columns in table '{{contratos}}':
        * @property string $idContratos
        * @property string $idContratacion
        * @property integer $nmodifica
        * @property string $fecha
        * @property string $tipomodifica
        * @property string $justimodcontrato
        * @property double $precioactual
        * @property string $fechatercontra
		* @property string $justificacion_fechatercontra
        * @property string $alcanceactucontrato
        * @property string $adendas
        * @property string $prograactu
        * @property string $estado
        * @property string $otro
        *
        * The followings are the available model relations:
        * @property Contratacion $idContratacion0
    */
    class Contratos extends CActiveRecord
    {
        public $titulo_contrato;
        public $numero_contrato;
        public $image1, $image2, $image3, $image4;

        /**
            * @return string the associated database table name
        */
        public function tableName()
        {
            return '{{contratos}}';
        }

        /**
            * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                  			array('idContratacion, fecha_creacion,fecha', 'required'),
                  			array('idContratacion, nmodifica, usuario_creacion, usuario_publicacion', 'numerical', 'integerOnly'=>true),
                  			array('precioactual', 'numerical'),
                  			//array('fecha', 'length', 'max'=>12),
                  			array('tipomodifica', 'length', 'max'=>50),
                  			//array('fechatercontra', 'length', 'max'=>10),
                  			array('adendas, prograactu, otro', 'length', 'max'=>255),
                  			array('estado', 'length', 'max'=>25),
                  			array('justimodcontrato, alcanceactucontrato, fecha_publicacion,fecha,fechatercontra, justificacion_fechatercontra', 'safe'),
                        array('image1, image2, image3, image4', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),
                        array('justificacion_fecha_final', 'length', 'max'=>2000),
                  			// The following rule is used by search().
                  			// @todo Please remove those attributes that should not be searched.
                  			array('justificacion_fecha_final,image1, image2, image3, image4, numero_contrato, titulo_contrato, idContratos, idContratacion, estatuscontrato, nmodifica, fecha, tipomodifica, justimodcontrato, precioactual, fechatercontra, alcanceactucontrato, detallesreadju, prograini, adendas, prograactu, estado, otro, justificacion_fechatercontra', 'safe', 'on'=>'search'),
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
        			'idContratacion0' => array(self::BELONGS_TO, 'Contratacion', 'idContratacion'),
        		);
        }

        /**
            * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
        			'idContratos' => 'Id Contrato / Modificación',
        			'idContratacion' => 'Id Contratacion ',
        			'nmodifica' => 'Número de Modificación',
        			'fecha' => 'Fecha de Modificación del Contrato',
        			'tipomodifica' => 'Tipo de Modificación al Contrato',
        			'justimodcontrato' => 'Justificación de la Modificación al Contrato',
        			'precioactual' => 'Precio Actualizado del Contrato en Lempiras',
        			'fechatercontra' => 'Fecha Actualizada de Terminación del Contrato',
					'justificacion_fechatercontra' => 'Justificación de Fecha vacia',
        			'alcanceactucontrato' => 'Alcance Actualizado del Proyecto',
        			'adendas' => 'Adendas a los Contratos Debidamente Suscritas',
        			'prograactu' => 'Programa Actualizado de Trabajo',
        			'estado' => 'Estado',
        			'otro' => 'Otro',
              'fecha_publicacion'=>'Fecha de publicación',
              'fecha_creacion'=>'Fecha de creación',
              'usuario_creacion' => 'Usuario Creacion',
              'usuario_publicacion' => 'Usuario Publicacion',
              'justificacion_fecha_final' => 'Justificación Fecha Final'
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
            'idContratacion0' => array('alias'=> 'idContratacion0', 'together' => true, )
            );
            $criteria->together = true;
            $criteria->compare( 'idContratacion0.titulocontrato', $this->titulo_contrato, true ); // related field new
            $criteria->compare( 'idContratacion0.ncontrato', $this->numero_contrato, true ); // related field new

            $criteria->compare('idContratos',$this->idContratos,true);
            $criteria->compare('idContratacion',$this->idContratacion,true);
            $criteria->compare('nmodifica',$this->nmodifica);
            $criteria->compare('fecha',$this->fecha,true);
            $criteria->compare('tipomodifica',$this->tipomodifica,true);
            $criteria->compare('justimodcontrato',$this->justimodcontrato,true);
            $criteria->compare('precioactual',$this->precioactual,true);
            $criteria->compare('fechatercontra',$this->fechatercontra,true);
            $criteria->compare('alcanceactucontrato',$this->alcanceactucontrato,true);
            $criteria->compare('adendas',$this->adendas,true);
            $criteria->compare('prograactu',$this->prograactu,true);
            $criteria->compare('estado',$this->estado,true);
            $criteria->compare('otro',$this->otro,true);
            $criteria->compare('usuario_publicacion',$this->usuario_publicacion);
            $criteria->compare('usuario_creacion',$this->usuario_creacion);

            if (!Yii::app()->user->isSuperAdmin) {
                $criteria->addSearchCondition('t.usuario_creacion', Yii::app()->user->id, true, 'AND');
                $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
                if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                    $criteria->addSearchCondition('t.estado', 'REVISIÓN', true, 'OR');
                }

            }

            //$criteria->order = 't.idContratacion DESC';
            return new CActiveDataProvider(
                $this, array('criteria'=>$criteria,
                'pagination'=>false,
                'sort'=>array(
                  'defaultOrder'=>'t.idContratacion DESC, t.idContratos DESC'
                ),)
            );
        }

        /**
            * Returns the static model of the specified AR class.
            * Please note that you should have this exact method in all your CActiveRecord descendants!
            * @param string $className active record class name.
            * @return Contratos the static model class
        */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

        public function listaEstados() {
          $criteria = new CDbCriteria;
          $criteria->condition = '1';
          if (!Yii::app()->user->isSuperAdmin) {
            if (!Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
              $criteria->condition = "(estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÓN')";
            }
          }

          $dat = Estado::model()->findAll($criteria);
          $list = CHtml::listData($dat, 'estado', 'estado');
          return $list;
        }

        public function listaContratacion()
        {
            $dat= Contratacion::model()->findAll(array('order'=>'idContratacion ASC'));
            $list = array();

            foreach ($dat as $row) {
            	$list[$row->idContratacion] = '('.substr(str_pad($row->idContratacion, 10, ' ', STR_PAD_LEFT),0,10).') '.$row->ncontrato;
            }

            return $list;
        }

		public function listaContratacionID($idContratacion){
			$dat= Contratacion::model()->findAll(array('order'=>'idContratacion ASC'));
            $list = array();

            foreach ($dat as $row) {
                if($row->idContratacion == $idContratacion) {
            	   $list[$row->idContratacion] = '('.substr(str_pad($row->idContratacion, 10, ' ', STR_PAD_LEFT),0,10).') '.$row->ncontrato;
            	}
            }

            return $list;
		}

            public function Usuario($id){
        $nameUser="";
        if($id==0){
            $nameUser="NO Asignado";
        }else{
            try{
            $usuario = Yii::app()->user->um->loadUserById($id);
            $nameUser=$usuario->username;
        }catch(Exception $ex){
            $nameUser="No Asignado";
        }
        }

        return $nameUser ;
    }
    }
