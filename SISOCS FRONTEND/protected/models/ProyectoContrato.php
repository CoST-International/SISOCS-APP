<?php

/**
 * This is the model class for table "{{Proyecto_Contrato}}".
 *
 * The followings are the available columns in table '{{Proyecto_Contrato}}':
 * @property integer $idProyecto
 * @property integer $idCalificacion
 * @property integer $idAdjudicacion
 * @property integer $idContratacion
 * @property string $proyecto_codigo
 * @property string $proyecto_nombre
 * @property string $proyecto_descripcion
 * @property string $proyecto_proposito
 * @property string $proyecto_ambiental
 * @property string $proyecto_reasentamiento
 * @property string $proyecto_fecha_aprobacion
 * @property string $proyecto_presupuesto
 * @property string $proyecto_departamento
 * @property string $proyecto_municipio
 * @property string $proyecto_beneficio
 * @property string $proyecto_fuente
 * @property string $proyecto_fuente_monto
 * @property string $proyecto_fuente_moneda
 * @property string $proyecto_sector
 * @property string $proyecto_subsector   
 * @property string $proyecto_ente
 * @property string $proyecto_funcionario_nombre
 * @property string $calificacion_ente   
 * @property string $calificacion_numero
 * @property string $calificacion_nombre
 * @property string $calificacion_oferente
 * @property string $adjudicacion_metodo
 * @property string $calificacion_metodo   
 * @property string $calificacion_funcionario_nombre
 * @property string $adjudicacion_tipo_contrato
 * @property string $contratacion_oferente
 * @property string $contratacion_alcances
 * @property string $contratacion_precioLPS
 * @property string $contratacion_precioUSD
 * @property string $contratacion_fecha_inicio
 * @property string $contratacion_fecha_final
 * @property integer $contratacion_duracion
 */
class ProyectoContrato extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{Proyecto_Contrato}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('proyecto_codigo, proyecto_nombre, proyecto_descripcion', 'safe', 'on' => 'edit, post, search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
      /* return array(
                    'avances' => array(self::HAS_MANY, 'Avances', 'idInicioEjecucion')
                  ); */
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'idProyecto' => 'idProyecto',
                'idCalificacion' => 'idCalificacion',
                'idAdjudicacion' => 'idAdjudicacion',
                'idContratacion' => 'idContratacion',
                'proyecto_codigo' => 'Codigo Proyecto',
                'proyecto_nombre' => 'Nombre Proyecto',
                'proyecto_descripcion' => 'Descripcion Proyecto',
                'proyecto_proposito' => 'Proposito Proyecto',
                'proyecto_ambiental' => 'Ambiental',
                'proyecto_reasentamiento' => 'Reasentamiento',
                'proyecto_fecha_aprobacion' => 'fecha aprobacion',
                'proyecto_presupuesto' => 'Presupuesto',
                'proyecto_departamento' => 'Departamento',
                'proyecto_municipio' => 'Municipio',
                'proyecto_beneficio' => 'Beneficios',
                'proyecto_fuente' => 'Fuente de financiamiento',
                'proyecto_fuente_monto' => 'Monto por fuente',
                'proyecto_fuente_moneda' => 'Moneda',
                'proyecto_sector' => 'Setor',
                'proyecto_subsector   ' => 'Sub sector',
                'proyecto_ente' => 'Ente',
                'proyecto_funcionario_nombre' => 'Funcionario Proyecto',
                'calificacion_ente' => 'Ente Adquisicion',
                'calificacion_numero' => 'Numero de proceso',
                'calificacion_nombre' => 'Nombre de proceso',
                'calificacion_oferente' => 'Oferente participante',
                'adjudicacion_metodo' => 'Metodo de Adjudicacion',
                'calificacion_metodo   ' => 'Metodo de Calificacion',
                'calificacion_funcionario_nombre' => 'Funcionario Adquisicion',
                'adjudicacion_tipo_contrato' => 'Tipo de Contrato',
                'contratacion_oferente' => 'Oferente Contratado',
                'contratacion_alcances' => 'Alcances Contrato',
                'contratacion_precioLPS' => 'Precio Contrato (LPS)',
                'contratacion_precioUSD' => 'Precio Contrato (USD)',
                'contratacion_fecha_inicio' => 'Fecha de inicio',
                'contratacion_fecha_final' => 'Fecha de finalizacion',
                'contratacion_duracion' => 'Duracion del contrato' 
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idProyecto', $this->idProyecto);
        $criteria->compare('idCalificacion', $this->idCalificacion);
        $criteria->compare('idAdjudicacion', $this->idAdjudicacion);
        $criteria->compare('idContratacion', $this->idContratacion);
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InicioEjecucion the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
