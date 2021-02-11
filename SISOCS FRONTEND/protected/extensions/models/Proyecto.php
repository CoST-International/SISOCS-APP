<?php

/**
 * This is the model class for table "{{proyecto}}".
 *
 * The followings are the available columns in table '{{proyecto}}':
 * @property integer $idProyecto
 * @property string $codigo
 * @property string $nombre_proyecto
 * @property string $Proposito
 * @property string $descrip
 * @property integer $idSector
 * @property integer $idSubSector
 * @property integer $idEnte
 * @property integer $idFuncionario
 * @property integer $idRol
 * @property double $presupuesto
 * @property string $fechaaprob
 * @property string $codsefin
 * @property string $descambiental
 * @property string $descreasentamiento
 * @property string $especiplano
 * @property string $presuprogra
 * @property string $estudiofact
 * @property string $estudioimpact
 * @property string $licambi
 * @property string $planreasea
 * @property string $acuerdofinan
 * @property string $notaprioridad
 * @property string $otro
 * @property string $estado
 * @property string $fechacreacion
 * @property string $fecharecibido
 *
 * The followings are the available model relations:
 * @property Entes $idEnte0
 * @property Funcionarios $idFuncionario0
 * @property Rol $idRol0
 * @property Sector $idSector0
 * @property Subsector $idSubSector0
 * @property Fuentesfinan[] $csFuentesfinans
 * @property ProyectoMunicipio[] $proyectoMunicipios
 */
class Proyecto extends CActiveRecord
{
	public $image1, $image2, $image3, $image4, $image5, $image6, $image7, $image8, $image9, $image10, $image11, $image12;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{proyecto}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, nombre_proyecto', 'required'),
			array('idSector, idSubSector, idEnte, idFuncionario, idRol', 'numerical', 'integerOnly'=>true),
			array('presupuesto', 'numerical'),
			array('codigo, codsefin', 'length', 'max'=>20),
			array('nombre_proyecto', 'length', 'max'=>500),
			array('Proposito, descambiental, descreasentamiento, especiplano, presuprogra, estudiofact, estudioimpact, licambi, planreasea, acuerdofinan, notaprioridad, otro, fechacreacion, fecharecibido', 'length', 'max'=>255),
			array('fechaaprob', 'length', 'max'=>15),
			array('estado', 'length', 'max'=>25),
			array('descrip', 'safe'),
			
			array('image1, image2, image3, image4, image5, image6, image7, image8, image9, image10, image11, image12', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image1, image2, image3, image4, image5, image6, image7, image8, image9, image10, image11, image12, idProyecto, codigo, nombre_proyecto, Proposito, descrip, idSector, idSubSector, idEnte, idFuncionario, idRol, presupuesto, fechaaprob, codsefin, descambiental, descreasentamiento, especiplano, presuprogra, estudiofact, estudioimpact, licambi, planreasea, acuerdofinan, notaprioridad, otro, estado, fechacreacion, fecharecibido', 'safe', 'on'=>'search'),
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
			'idEnte0' => array(self::BELONGS_TO, 'Entes', 'idEnte'),
			'idFuncionario0' => array(self::BELONGS_TO, 'Funcionarios', 'idFuncionario'),
			'idRol0' => array(self::BELONGS_TO, 'Rol', 'idRol'),
			'idSector0' => array(self::BELONGS_TO, 'Sector', 'idSector'),
			'idSubSector0' => array(self::BELONGS_TO, 'Subsector', 'idSubSector'),
			'csFuentesfinans' => array(self::MANY_MANY, 'Fuentesfinan', '{{proyecto_fuente}}(idProyecto, idFuente)'),
			'proyectoMunicipios' => array(self::HAS_MANY, 'ProyectoMunicipio', 'idProyecto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idProyecto' => 'Id Proyecto',
			'codigo' => 'Código',
			'nombre_proyecto' => 'Nombre del Proyecto',
			'Proposito' => 'Proposito u Objetivo',
			'descrip' => 'Descripción detallada y alcances del proyecto',
			'idSector' => 'Sector',
			'idSubSector' => 'Sub sector',
			'idEnte' => 'Ente responsable',
			'idFuncionario' => 'Funcionario responsable',
			'idRol' => 'Rol del funcionario',
			'presupuesto' => 'Presupuesto en LPS',
			'fechaaprob' => 'Fecha de aprbacion del presupuesto',
			'codsefin' => 'Codigo BIP (SEFIN)',
			'descambiental' => 'Descripción del impacto ambiental',
			'descreasentamiento' => 'Descripción de reasentamiento ',
			'especiplano' => 'Especificaciones y planos de la obra',
			'presuprogra' => 'Presupuesto y programa multianual del proyecto',
			'estudiofact' => 'Estudio de factibilidad o Perfil del propyecto',
			'estudioimpact' => 'Estudio de Impacto Ambiental (Diagnóstico o Evaluación)',
			'licambi' => 'Licencia Ambiental y Contrato de Medidas de Mitigación',
			'planreasea' => 'Plan de Reasentamiento y Compensación',
			'acuerdofinan' => 'Acuerdo de Financiamiento',
			'notaprioridad' => 'Descripción de aprobación del proyecto (Nota de prioridad o similar)',
			'otro' => 'Otro',
			'estado' => 'Estado',
			'fechacreacion' => 'Fecha de creación',
			'fecharecibido' => 'Fecha en que se publicó la información',
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

		$criteria->compare('idProyecto',$this->idProyecto);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('nombre_proyecto',$this->nombre_proyecto,true);
		$criteria->compare('Proposito',$this->Proposito,true);
		$criteria->compare('descrip',$this->descrip,true);
		$criteria->compare('idSector',$this->idSector);
		$criteria->compare('idSubSector',$this->idSubSector);
		$criteria->compare('idEnte',$this->idEnte);
		$criteria->compare('idFuncionario',$this->idFuncionario);
		$criteria->compare('idRol',$this->idRol);
		$criteria->compare('presupuesto',$this->presupuesto);
		$criteria->compare('fechaaprob',$this->fechaaprob,true);
		$criteria->compare('codsefin',$this->codsefin,true);
		$criteria->compare('descambiental',$this->descambiental,true);
		$criteria->compare('descreasentamiento',$this->descreasentamiento,true);
		$criteria->compare('especiplano',$this->especiplano,true);
		$criteria->compare('presuprogra',$this->presuprogra,true);
		$criteria->compare('estudiofact',$this->estudiofact,true);
		$criteria->compare('estudioimpact',$this->estudioimpact,true);
		$criteria->compare('licambi',$this->licambi,true);
		$criteria->compare('planreasea',$this->planreasea,true);
		$criteria->compare('acuerdofinan',$this->acuerdofinan,true);
		$criteria->compare('notaprioridad',$this->notaprioridad,true);
		$criteria->compare('otro',$this->otro,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('fecharecibido',$this->fecharecibido,true);

		if (!Yii::app()->user->isSuperAdmin) {
                $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
        }
			
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Proyecto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	// Funciones personalizadas
	public function listaEntes() {
		$dat= Entes::model()->findAll();
		$list = CHtml::listData($dat,'idente', 'descripcion');
		return $list ;
	}
	
	public function listaFuncionarios($idEnte) {
		if (isset($idEnte)) {
			$dat= Funcionarios::model()->findByAttributes(array('idEnte'=>$idEnte));
		}
		else {
			$dat= Funcionarios::model()->findAll();
		}
		$list = CHtml::listData($dat,'idfuncionario', 'nombre');
		return $list ;
	}
	
	public function listaEstados() {
		$dat= Estado::model()->findAll();
		$list = CHtml::listData($dat,'estado', 'estado');
		return $list ;
	}
	
}
