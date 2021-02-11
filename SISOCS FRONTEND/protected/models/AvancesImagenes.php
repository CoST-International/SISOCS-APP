<?php

/**
 * This is the model class for table "{{avances_imagenes}}".
 *
 * The followings are the available columns in table '{{avances_imagenes}}':
 * @property integer $idImagen
 * @property integer $idAvances
 * @property string $nombre_imagen
 * @property string $nombre_fisico
 * @property string $ubicacion_imagen
 * @property string $estado
 * @property integer $usuario_creacion
 * @property string $fecha_creacion
 * @property integer $usuario_publicacion
 * @property string $fecha_publicacion
 *
 * The followings are the available model relations:
 * @property Avances $idAvances0
 */
class AvancesImagenes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{avances_imagenes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idAvances, nombre_imagen, nombre_fisico, ubicacion_imagen, fecha_creacion', 'required'),
			array('idAvances, usuario_creacion, usuario_publicacion', 'numerical', 'integerOnly'=>true),
			array('nombre_imagen, nombre_fisico', 'length', 'max'=>200),
			array('ubicacion_imagen', 'length', 'max'=>3000),
			array('estado', 'length', 'max'=>25),
			array('fecha_publicacion', 'safe'),
			array('nombre_imagen', 'file', 'types' => 'jpg, png', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),
            // The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idImagen, idAvances, nombre_imagen, nombre_fisico, ubicacion_imagen, estado, usuario_creacion, fecha_creacion, usuario_publicacion, fecha_publicacion', 'safe', 'on'=>'search'),
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
			'idAvances0' => array(self::BELONGS_TO, 'Avances', 'idAvances'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idImagen' => 'Id Imagen',
			'idAvances' => 'Id Avances',
			'nombre_imagen' => 'Nombre Imagen',
			'nombre_fisico' => 'Nombre Fisico',
			'ubicacion_imagen' => 'Ubicacion Imagen',
			'estado' => 'Estado',
			'usuario_creacion' => 'Usuario Creacion',
			'fecha_creacion' => 'Fecha Creacion',
			'usuario_publicacion' => 'Usuario Publicacion',
			'fecha_publicacion' => 'Fecha Publicacion',
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

		$criteria->compare('idImagen',$this->idImagen);
		$criteria->compare('idAvances',$this->idAvances);
		$criteria->compare('nombre_imagen',$this->nombre_imagen,true);
		$criteria->compare('nombre_fisico',$this->nombre_fisico,true);
		$criteria->compare('ubicacion_imagen',$this->ubicacion_imagen,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('usuario_creacion',$this->usuario_creacion);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('usuario_publicacion',$this->usuario_publicacion);
		$criteria->compare('fecha_publicacion',$this->fecha_publicacion,true);
		
		if (!Yii::app()->user->isSuperAdmin) {
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criteria->addSearchCondition('t.estado', 'REVISIÓN', true, 'AND');
            } else {
                $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
                $criteria->addSearchCondition('t.usuario_creacion', Yii::app()->user->id, true, 'AND');
            }                
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AvancesImagenes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
