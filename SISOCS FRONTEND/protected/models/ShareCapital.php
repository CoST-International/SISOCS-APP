<?php

/**
 * This is the model class for table "{{share_capital}}".
 *
 * The followings are the available columns in table '{{share_capital}}':
 * @property integer $id
 * @property integer $idContratacion
 * @property double $debtEquityRatio
 * @property double $shareCapital_amount
 * @property string $shareCapital_currency
 * @property double $projectIRR
 *
 * The followings are the available model relations:
 * @property Contratacion $idContratacion0
 */
class ShareCapital extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{share_capital}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idContratacion, debtEquityRatio, shareCapital_amount, shareCapital_currency, projectIRR', 'required'),
			array('idContratacion', 'numerical', 'integerOnly'=>true),
			array('debtEquityRatio, shareCapital_amount, projectIRR', 'numerical'),
			array('shareCapital_currency', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idContratacion, debtEquityRatio, shareCapital_amount, shareCapital_currency, projectIRR', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'idContratacion' => 'Id Contratacion',
			'debtEquityRatio' => 'Ratio de Capital de la Deuda',
			'shareCapital_amount' => 'Monto Capital Compartido',
			'shareCapital_currency' => 'Moneda Capital Compartido',
			'projectIRR' => 'Project Irr',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('idContratacion',$this->idContratacion);
		$criteria->compare('debtEquityRatio',$this->debtEquityRatio);
		$criteria->compare('shareCapital_amount',$this->shareCapital_amount);
		$criteria->compare('shareCapital_currency',$this->shareCapital_currency,true);
		$criteria->compare('projectIRR',$this->projectIRR);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShareCapital the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
