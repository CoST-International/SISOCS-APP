<?php

/**
 * This is the model class for table "{{act_avances}}".
 *
 * The followings are the available columns in table '{{act_avances}}':
 * @property integer $codigo
 * @property string $cod_contrato
 * @property integer $cod_avances
 * @property integer $cod_actividad
 * @property integer $unidad
 * @property integer $cantidad
 * @property string $precio_unitario
 * @property string $fecha_registro
 * @property string $user_registro
 */
class ActAvances extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{act_avances}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_contrato, cod_avances, cod_actividad, cod_subactividad, unidad', 'required'),
			array('cod_contrato, cod_avances, cod_actividad, cod_subactividad, unidad', 'numerical', 'integerOnly'=>true),
			array('precio_unitario', 'length', 'max'=>10),
			array('cantidad', 'length', 'max'=>10),
                        array('user_registro', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('codigo, cod_contrato, cod_avances, cod_actividad, cod_subactividad, unidad, cantidad, precio_unitario, fecha_registro, user_registro', 'safe', 'on'=>'search'),
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
			'CatgSubActividades' => array(self::HAS_MANY, 'CatgSubActividades', 'cod_actividad'),
			'CatgTipoActividades0' => array(self::BELONGS_TO, 'CatgTipoActividades', 'cod_actividad'),
			'CatgUnidades0' => array(self::BELONGS_TO, 'CatgUnidades', 'unidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigo' => 'Codigo',
			'cod_contrato' => 'Codigo Contrato',
			'cod_avances' => 'Codigo Avances',
			'cod_actividad' => 'Actividad',
			'cod_subactividad' => 'Sub Actividad',			
			'unidad' => 'Unidad',
			'cantidad' => 'Cantidad',
			'precio_unitario' => 'Precio Unitario',
			'fecha_registro' => 'Fecha Registro',
			'user_registro' => 'User Registro',
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
		$criteria->compare('cod_contrato',$this->cod_contrato,true);
		$criteria->compare('cod_avances',$this->cod_avances);
		$criteria->compare('cod_actividad',$this->cod_actividad);
		$criteria->compare('cod_subactividad',$this->cod_subactividad);		
		$criteria->compare('unidad',$this->unidad);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('precio_unitario',$this->precio_unitario,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('user_registro',$this->user_registro,true);
		
		$criteria->with = array('CatgTipoActividades0');
		$criteria->compare('CatgTipoActividades0.descripcion', $this->codigo, true );
		$criteria->together = true;
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActAvances the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
        public function listaSubActividades($codAct)
        {
            $dat= CatgSubActividades::model()->findAllByAttributes(
                                                        array('cod_actividad'=>$codAct),
                                                        array('order'=>'descripcion ASC')
                                                        );
            //$dat= catgSubActividades::model()->findAll();
            $list = CHtml::listData($dat,'codigo', 'descripcion');
            return $list ;
        }
	
        public function listaActividades()
        {
            $dat= CatgTipoActividades::model()->findAll();
            $list = CHtml::listData($dat,'codigo', 'descripcion');
            return $list ;
        }
	
	
        public function listaUnidades()
        {
            $dat= CatgUnidades::model()->findAll();
            $list = CHtml::listData($dat,'codigo', 'descripcion');
            return $list ;
        }
	
	
	
}
