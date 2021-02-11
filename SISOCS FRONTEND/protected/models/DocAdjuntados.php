<?php

/**
 * This is the model class for table "{{doc_adjuntados}}".
 *
 * The followings are the available columns in table '{{doc_adjuntados}}':
 * @property integer $codigo
 * @property string $cod_contrato
 * @property string $nombre_doc
 * @property string $ubicacion_doc
 * @property string $fecha_registro
 * @property string $user_registro
 */
class DocAdjuntados extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	
	public function tableName()
	{
		return '{{doc_adjuntados}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_contrato, cod_avance', 'required'),
			array('cod_contrato, cod_avance', 'length', 'max'=>25),
			//array('nombre_doc', 'length', 'max'=>200),
			array('ubicacion_doc', 'length', 'max'=>3000),
			array('user_registro', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('codigo, cod_contrato,cod_avance, nombre_doc1, nombre_doc2,nombre_doc3,nombre_doc4,nombre_doc5,nombre_doc6,nombre_doc7,nombre_doc8,
			      nombre_fisico1,nombre_fisico2,nombre_fisico3,nombre_fisico4,nombre_fisico5,nombre_fisico6,nombre_fisico7,nombre_fisico8,
			      ubicacion_doc, fecha_registro, user_registro', 'safe', 'on'=>'search'),
			array('nombre_doc1','file', 
				'types'=>'doc,docx,txt,pdf',
				//'maxSize'=>1024 * 1024 * 2, // 2MB
				//'tooLarge'=>'No se puede subir archivos de mas de 2MB. Por favor subir otro archivo.',
				'allowEmpty'=>1),
			array('nombre_doc2','file', 
				'types'=>'doc,docx,txt,pdf',
				'allowEmpty'=>1),
			array('nombre_doc3','file', 
				'types'=>'doc,docx,txt,pdf',
				'allowEmpty'=>1),
			array('nombre_doc4','file', 
				'types'=>'doc,docx,txt,pdf',
				'allowEmpty'=>1),
			array('nombre_doc5','file', 
				'types'=>'doc,docx,txt,pdf',
				'allowEmpty'=>1),
			array('nombre_doc6','file', 
				'types'=>'doc,docx,txt,pdf',
				'allowEmpty'=>1),
			array('nombre_doc7','file', 
				'types'=>'doc,docx,txt,pdf',
				'allowEmpty'=>1),			
			array('nombre_doc8','file', 
				'types'=>'doc,docx,txt,pdf',
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
			'cod_avance'  => 'Cod Avance',
			'nombre_doc1' => 'Doc. Garantias',
			'nombre_doc2' => 'Doc. Avances',
			'nombre_doc3' => 'Doc. Supervision',
			'nombre_doc4' => 'Doc. Evaluacion',
			'nombre_doc5' => 'Doc. Audt. Tecnica',
			'nombre_doc6' => 'Doc. Audt. Financiera',
			'nombre_doc7' => 'Doc. Acta Recepcion',
			'nombre_doc8' => 'Doc. Disconformidad',			
			'nombre_fisico1' => 'Doc. Garantias',
			'nombre_fisico2' => 'Doc. Avances',
			'nombre_fisico3' => 'Doc. Supervision',
			'nombre_fisico4' => 'Doc. Evaluacion',
			'nombre_fisico5' => 'Doc. Audt. Tecnica',
			'nombre_fisico6' => 'Doc. Audt. Financiera',
			'nombre_fisico7' => 'Doc. Acta Recepcion',
			'nombre_fisico8' => 'Doc. Disconformidad',						
			'ubicacion_doc' => 'Ubicacion Doc',
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
		$criteria->compare('cod_avance',$this->cod_avance,true);		
		$criteria->compare('nombre_doc1',$this->nombre_doc1,true);
		$criteria->compare('nombre_doc2',$this->nombre_doc2,true);
		$criteria->compare('nombre_doc3',$this->nombre_doc3,true);
		$criteria->compare('nombre_doc4',$this->nombre_doc4,true);
		$criteria->compare('nombre_doc5',$this->nombre_doc5,true);
		$criteria->compare('nombre_doc6',$this->nombre_doc6,true);
		$criteria->compare('nombre_doc7',$this->nombre_doc7,true);
		$criteria->compare('nombre_doc8',$this->nombre_doc8,true);		
		$criteria->compare('nombre_fisico1',$this->nombre_fisico1,true);
		$criteria->compare('nombre_fisico2',$this->nombre_fisico2,true);
		$criteria->compare('nombre_fisico3',$this->nombre_fisico3,true);
		$criteria->compare('nombre_fisico4',$this->nombre_fisico4,true);
		$criteria->compare('nombre_fisico5',$this->nombre_fisico5,true);
		$criteria->compare('nombre_fisico6',$this->nombre_fisico6,true);
		$criteria->compare('nombre_fisico7',$this->nombre_fisico7,true);
		$criteria->compare('nombre_fisico8',$this->nombre_fisico8,true);			
		$criteria->compare('ubicacion_doc',$this->ubicacion_doc,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('user_registro',$this->user_registro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function direccionDocumento1(){        
	   return Yii::app()->request->hostInfo.'/sisocs3/images/doc_subidos/'.$this->nombre_fisico1;
         }
	public function direccionDocumento2(){        
	   return Yii::app()->request->hostInfo.'/sisocs3/images/doc_subidos/'.$this->nombre_fisico2;
         }
	public function direccionDocumento3(){        
	   return Yii::app()->request->hostInfo.'/sisocs3/images/doc_subidos/'.$this->nombre_fisico3;
         }
	public function direccionDocumento4(){        
	   return Yii::app()->request->hostInfo.'/sisocs3/images/doc_subidos/'.$this->nombre_fisico4;
         }
	public function direccionDocumento5(){        
	   return Yii::app()->request->hostInfo.'/sisocs3/images/doc_subidos/'.$this->nombre_fisico5;
         }
	public function direccionDocumento6(){        
	   return Yii::app()->request->hostInfo.'/sisocs3/images/doc_subidos/'.$this->nombre_fisico6;
         }
	public function direccionDocumento7(){        
	   return Yii::app()->request->hostInfo.'/sisocs3/images/doc_subidos/'.$this->nombre_fisico7;
         }
	public function direccionDocumento8(){        
	   return Yii::app()->request->hostInfo.'/sisocs3/images/doc_subidos/'.$this->nombre_fisico8;
         }	 
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DocAdjuntados the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
