<?php

/**
 * This is the model class for table "{{calificacion_oferente}}".
 *
 * The followings are the available columns in table '{{calificacion_oferente}}':
 * @property integer $idCalificacion
 * @property integer $idOferente
 */
class CalificacionOferente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{calificacion_oferente}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCalificacion, idOferente', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCalificacion, idOferente', 'safe', 'on'=>'search'),
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
            'idOferente_rel' => array(self::BELONGS_TO, 'Parties', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCalificacion' => 'Código calificacion',
			'idOferente' => 'Código Oferente, Firma o Empresa',
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

		$criteria->compare('idCalificacion',$this->idCalificacion);
		//$criteria->compare('idOferente',$this->idOferente);
		$total=Yii::app()->db->createCommand("SELECT count(*) FROM cs_calificacion_oferente WHERE idCalificacion=".$this->idCalificacion)->queryScalar();
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'Pagination' => array (
                  'PageSize' => $total, //edit your number items per page here
              ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CalificacionOferente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function listaOferentes()
    {
        $dat=  Oferente::model()->findAll(array('order'=>'nombre_oferente ASC'));
        $list = CHtml::listData($dat,'idOferente', 'nombre_oferente');
        return $list ;
    }

    public function listaParties()
    {
        $dat=  Parties::model()->findAll(array('order'=>'legalName ASC','condition'=>'roles=\'Oferente\''));
        $list = CHtml::listData($dat,'id', 'legalName');
        return $list ;
    }
}
