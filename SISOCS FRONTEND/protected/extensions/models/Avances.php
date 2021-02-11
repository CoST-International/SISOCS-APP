<?php
    
    /**
        * This is the model class for table "{{avances}}".
        *
        * The followings are the available columns in table '{{avances}}':
        * @property integer $codigo
        * @property string $codigo_inicio_ejecucion
        * @property integer $porcent_programado
        * @property integer $porcent_real
        * @property string $finan_programado
        * @property string $finan_real
        * @property string $fecha_registro
        * @property string $user_registro
        * @property string $fecha_avance
        * @property string $desc_problemas
        * @property string $desc_temas
        * @property string $adj_garantias
        * @property string $adj_avances
        * @property string $adj_supervicion
        * @property string $adj_evaluacion
        * @property string $adj_tecnica
        * @property string $adj_financiero
        * @property string $adj_recepcion
        * @property string $adj_disconformidad
        * The followings are the available model relations:
        * @property ActAvances[] $actAvances
    */
    class Avances extends CActiveRecord
    {
        
        public $image1, $image2, $image3, $image4, $image5, $image6, $image7, $image8;
        /**
            * @return string the associated database table name
        */
        public function tableName()
        {
            return '{{avances}}';
        }
        
        /**
            * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
			array('codigo_inicio_ejecucion,porcent_programado,porcent_real', 'required'),
			//array('porcent_programado, porcent_real', 'numerical', 'integerOnly'=>true),
			array('porcent_programado, porcent_real,codigo_inicio_ejecucion, finan_programado, finan_real', 'length', 'max'=>15),
			array('user_registro', 'length', 'max'=>16),
			array('estado_sol', 'length', 'max'=>25),				
			array('desc_problemas, desc_temas', 'length', 'max'=>200),
            array('adj_garantias, adj_avances, adj_supervicion, adj_evaluacion, adj_tecnica, adj_financiero, adj_recepcion, adj_disconformidad', 'length', 'max'=>150),			
			array('fecha_avance', 'safe'),
            
            array('image1, image2, image3, image4, image5, image6, image7, image8', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),
            
            
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image1, image2, image3, image4, image5, image6, image7, image8, codigo, codigo_inicio_ejecucion, porcent_programado, porcent_real, finan_programado, finan_real, fecha_registro,estado_sol, user_registro, fecha_avance, desc_problemas, desc_temas, adj_garantias, adj_avances, adj_supervicion, adj_evaluacion, adj_tecnica, adj_financiero, adj_recepcion, adj_disconformidad', 'safe', 'on'=>'search'),
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
			'actAvances' => array(self::HAS_MANY, 'ActAvances', 'cod_avances'),
			'estadosSolicitud0' => array(self::BELONGS_TO, 'Estado', 'estado'),			
            );
        }
        
        /**
            * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
			'codigo' => 'Id Avance',
			'codigo_inicio_ejecucion' => 'Código Implementación',
			'porcent_programado' => 'Físico Programado',
			'porcent_real' => 'Físico Real',
			'finan_programado' => 'Financiero Programado',
			'finan_real' => 'Financiero Real',
			'fecha_registro' => 'Fecha Registro',
			'estado_sol'=> 'Estado Actual de Solicitud',			
			'user_registro' => 'Usuario Registro',
			'fecha_avance' => 'Fecha de Avance',
			'desc_problemas' => 'Descripción de Problemas',
			'desc_temas' => 'Descripción de Temas',
            'adj_garantias' => 'Doc1 Garantias',
			'adj_avances' => 'Doc2 Avan Info',
			'adj_supervicion' => 'Doc3 Super Info',
			'adj_evaluacion' => 'Doc4 Evalu Info',
			'adj_tecnica' => 'Doc5 Audit Info',
			'adj_financiero' => 'Doc6 Audif Info',
			'adj_recepcion' => 'Doc7 Recep Acta',
			'adj_disconformidad' => 'Doc8 Discon Info',
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
            
            $criteria->compare('codigo',$this->codigo);
            $criteria->compare('codigo_inicio_ejecucion',$this->codigo_inicio_ejecucion,true);
            $criteria->compare('porcent_programado',$this->porcent_programado);
            $criteria->compare('porcent_real',$this->porcent_real);
            $criteria->compare('finan_programado',$this->finan_programado,true);
            $criteria->compare('finan_real',$this->finan_real,true);
            $criteria->compare('fecha_registro',$this->fecha_registro,true);
            $criteria->compare('estado_sol',$this->estado_sol,true);		
            $criteria->compare('user_registro',$this->user_registro,true);
            $criteria->compare('fecha_avance',$this->fecha_avance,true);
            $criteria->compare('desc_problemas',$this->desc_problemas,true);
            $criteria->compare('desc_temas',$this->desc_temas,true);
            $criteria->compare('adj_garantias',$this->adj_garantias,true);
            $criteria->compare('adj_avances',$this->adj_avances,true);
            $criteria->compare('adj_supervicion',$this->adj_supervicion,true);
            $criteria->compare('adj_evaluacion',$this->adj_evaluacion,true);
            $criteria->compare('adj_tecnica',$this->adj_tecnica,true);
            $criteria->compare('adj_financiero',$this->adj_financiero,true);
            $criteria->compare('adj_recepcion',$this->adj_recepcion,true);
            $criteria->compare('adj_disconformidad',$this->adj_disconformidad,true);
            
            if (!Yii::app()->user->isSuperAdmin) {
                $criteria->addSearchCondition('estado', 'BORRADOR', true, 'AND');
            }
            
            return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            ));
        }
        
		//
		//function actionDownload($name){
		//  $filecontent=file_get_contents('path_to_file'.$name);
		//  header("Content-Type: text/plain");
		//  header("Content-disposition: attachment; filename=$name");
		//  header("Pragma: no-cache");
		//  echo $filecontent;
		//  exit;
		//}	
        
        /**
            * Returns the static model of the specified AR class.
            * Please note that you should have this exact method in all your CActiveRecord descendants!
            * @param string $className active record class name.
            * @return Avances the static model class
        */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
        
        
        public function listaEstadosSol()
        {
            $dat= Estado::model()->findAll();
            $list = CHtml::listData($dat,'estado', 'estado');
            return $list ;
        }	
        
        public function getPorsentageReal($id){
            $pReal=$this->model()->findByPk($id);
            return $pReal['porcent_real'];     
        }
        
        public function getPorsentageProgramado($id){
            $pReal=$this->model()->findByPk($id);
            return $pReal['porcent_programado'];     
        }
        
        
        
    }
