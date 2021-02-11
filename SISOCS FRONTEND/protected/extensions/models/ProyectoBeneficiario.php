<?php

/**
 * This is the model class for table "{{proyecto_beneficiario}}".
 *
 * The followings are the available columns in table '{{proyecto_beneficiario}}':
 * @property string $idproyecto
 * @property string $idbeneficiario
 */
class ProyectoBeneficiario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{proyecto_beneficiario}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idproyecto, idbeneficiario', 'length', 'max'=>10),
                        array('km','length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idproyecto, idbeneficiario', 'safe', 'on'=>'search'),
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
                    'rmuni'=>array(self::HAS_MANY, 'Municipio', 'idmunicipio'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idproyecto' => 'Código de Proyecto',
			'idbeneficiario' => 'Código Beneficiario',
                        'km'=>'Kilometros',
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

		$criteria->compare('idproyecto',$this->idproyecto,true);
		$criteria->compare('idbeneficiario',$this->idbeneficiario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProyectoBeneficiario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function primaryKey()
        {
            return array('idproyecto', 'idbeneficiario');
        }
        
         
         public function listaproyectos()
        {
           $dat= Proyecto::model()->findAll();
           $list = CHtml::listData($dat,'idProyecto','nombre_proyecto');
           return $list ;  
        }

         public function listaBeneficiarios()
        {
             // $dat= Beneficiario::model()->findAll();
            //$dr=array();
            //$list = CHtml::listData($dat,'idbeneficiarios','muni');
           /************************************************************/
           $sql = 'Select
                      idmunicipio As idBeneficiario,
                      depto As codigo_depto,
                      id As codigo_muni,
                      municipio As municipio
                    From
                      cs_municipio
                  ';
           
            $dat =Yii::app()->db->createCommand($sql)->queryAll();
            $list = CHtml::listData($dat,'idBeneficiario','municipio');
            /************************************************************/
            return $list ;  
        }
        
         public function listaDepartamentos()
        {
             
            $sql = 'Select
                      codigoDepto,
                      departamento
                    From
                      cs_departamento
                  ';
                  
            $dat =Yii::app()->db->createCommand($sql)->queryAll();
            $list = CHtml::listData($dat,'codigoDepto','departamento');
            return $list ;  
        }
        
        
}
