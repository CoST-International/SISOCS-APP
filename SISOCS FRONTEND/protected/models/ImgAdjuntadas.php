<?php

/**
 * This is the model class for table "{{img_adjuntadas}}".
 *
 * The followings are the available columns in table '{{img_adjuntadas}}':
 * @property integer $codigo
 * @property string $cod_contrato
 * @property string $nombre_img
 * @property string $ubicacion_img
 * @property string $fecha_registro
 * @property string $user_registro
 */
class ImgAdjuntadas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{img_adjuntadas}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_contrato, nombre_img, nombre_fisico', 'required'),
			array('cod_contrato', 'length', 'max'=>25),
			array('nombre_img', 'length', 'max'=>200),
			array('nombre_fisico', 'length', 'max'=>200),
			array('ubicacion_img', 'length', 'max'=>3000),
			array('user_registro', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('codigo, cod_contrato, nombre_img,nombre_fisico, ubicacion_img, fecha_registro, user_registro', 'safe', 'on'=>'search'),
			array('nombre_img','file', 
				'types'=>'jpg,bmp,gif,png',
				//'maxSize'=>1024 * 1024 * 1, // 1MB
				//'tooLarge'=>'No se puede subir archivos de mas de 1MB. Por favor subir otro archivo.',
				'allowEmpty'=>1),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigo' => 'Codigo',
			'cod_contrato' => 'Cod Contrato',
			'nombre_img' => 'Imagenes',
			'nombre_fisico' => 'Imagenes',
			'ubicacion_img' => 'Ubicación Img',
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
		$criteria->compare('nombre_img',$this->nombre_img,true);
		$criteria->compare('nombre_fisico',$this->nombre_fisico,true);		
		$criteria->compare('ubicacion_img',$this->ubicacion_img,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('user_registro',$this->user_registro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
public function direccionImagenes(){        
	//return Yii::app()->request->hostInfo.'/sisocs3/images/img_subidas/'.$this->nombre_fisico;
	return Yii::app()->request->hostInfo.'/sisocs3/images/img_subidas/'.$this->ubicacion_img;
	//return Yii::app()->request->$this->ubicacion_img;
}		
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImgAdjuntadas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
