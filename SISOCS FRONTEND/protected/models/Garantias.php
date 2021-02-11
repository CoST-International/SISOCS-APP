<?php

/**
 * This is the model class for table "{{garantias}}".
 *
 * The followings are the available columns in table '{{garantias}}':
 * @property integer $idGarantia
 * @property integer $idInicioEjecucion
 * @property integer $idTipoGarantia
 * @property string $fecha_vencimiento
 * @property double $monto
 * @property string $estado
 * @property integer $usuario_creacion
 * @property string $fecha_creacion
 * @property integer $usuario_publicacion
 * @property string $fecha_publicacion
 */
class Garantias extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{garantias}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idInicioEjecucion, idTipoGarantia, fecha_vencimiento, monto', 'required'),
			array('idInicioEjecucion, idTipoGarantia, usuario_creacion, usuario_publicacion', 'numerical', 'integerOnly'=>true),
			array('monto', 'numerical'),
			array('estado', 'length', 'max'=>25),
			//array('fecha_publicacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idGarantia, idInicioEjecucion, idTipoGarantia, fecha_vencimiento, monto, estado, usuario_creacion, fecha_creacion, usuario_publicacion, fecha_publicacion', 'safe', 'on'=>'search'),
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
                    'idTipoGarantia0' => array(self::BELONGS_TO, 'TipoGarantias', 'idTipoGarantia'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idGarantia' => 'Id Garantia',
			'idInicioEjecucion' => 'Id Implementacion',
			'idTipoGarantia' => 'Id Tipo Garantia',
			'fecha_vencimiento' => 'Fecha Vencimiento',
			'monto' => 'Monto',
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

		$criteria->compare('idGarantia',$this->idGarantia);
		$criteria->compare('idInicioEjecucion',$this->idInicioEjecucion);
		$criteria->compare('idTipoGarantia',$this->idTipoGarantia);
		$criteria->compare('fecha_vencimiento',$this->fecha_vencimiento,true);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('usuario_creacion',$this->usuario_creacion);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('usuario_publicacion',$this->usuario_publicacion);
		$criteria->compare('fecha_publicacion',$this->fecha_publicacion,true);

		if (!Yii::app()->user->isSuperAdmin) {
                $criteria->addSearchCondition('t.usuario_creacion', Yii::app()->user->id, true, 'AND');
                $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
                if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                    $criteria->addSearchCondition('t.estado', 'REVISIÓN', true, 'OR');
                }

            }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function published()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria = new CDbCriteria;

		$criteria->compare('idGarantia',$this->idGarantia);
		$criteria->compare('idInicioEjecucion',$this->idInicioEjecucion);
		$criteria->compare('idTipoGarantia',$this->idTipoGarantia);

		$criteria->addSearchCondition('t.estado', 'PUBLICADO', true, 'AND');

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
				'pagination'=>false
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Garantias the static model class
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

	public function listaTipoGarantias()
        {
            $dat= TipoGarantias::model()->findAll();
            $list = CHtml::listData($dat,'idTipoGarantia', 'nombre');
            return $list ;
        }
}
