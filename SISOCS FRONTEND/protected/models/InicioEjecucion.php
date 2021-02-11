<?php

/**
 * This is the model class for table "{{inicio_ejecucion}}".
 *
 * The followings are the available columns in table '{{inicio_ejecucion}}':
* @property integer $idInicioEjecucion
* @property integer $idContratacion
* @property integer $idContacto
* @property string fecha_inicio
* @property string programainicial
* @property string estado
* @property integer $usuario_creacion
* @property string fecha_creacion
* @property integer $usuario_publicacion
* @property string fecha_publicacion
 */
class InicioEjecucion extends CActiveRecord {

    public $titulo_contrato;
    public $numero_contrato;
    public $nombre_contacto;
    public $telefono_contacto;
    public $image1;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{inicio_ejecucion}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idContratacion, idContacto', 'required'),
            array('idContratacion,usuario_creacion,usuario_publicacion, idContacto', 'numerical', 'integerOnly' => true),
            array('estado', 'length', 'max' => 25),
            array('programainicial', 'length', 'max' => 255),
            array('image1', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('image1, numero_contrato, titulo_contrato, nombre_contacto, telefono_contacto, idInicioEjecucion, idContratacion, fecha_inicio,fecha_publicacion, estado', 'safe', 'on' => 'edit, post, search, published'),
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
              'desembolsosMontoses' => array(self::HAS_MANY, 'DesembolsosMontos', 'idInicioEjecucion'),
              'avances' => array(self::HAS_MANY, 'Avances', 'idInicioEjecucion'),
              'garantiases' => array(self::HAS_MANY, 'Garantias', 'idInicioEjecucion'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'idInicioEjecucion' => 'Código de Ejecución',
            'idContratacion' => 'Número de Contrato',
            'idContacto' => 'Datos de Contacto del responsable',
            'fecha_inicio' => 'Fecha de Orden de Inicio',
            'estado' => 'Estado',
            'fecha_creacion' => 'Fecha de creación',
            'usuariocreacion' => 'Usuario de creación',
            'fecha_publicacion' => 'Fecha Publicacion',
            'usuario_publicacion' => 'Usuario Publicacion',
            'programainicial'=>'Programa inicial de trabajo presentado a la firma del contrato',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     *   models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->with = array('idContratacion0' => array('alias' => 'idContratacion0', 'together' => true,));
        //$criteria->with = array('idContacto0' => array('alias' => 'idContacto0', 'together' => true,));
        $criteria->together = true;
        $criteria->compare('idContratacion0.titulocontrato', $this->titulo_contrato, true); // related field new
        $criteria->compare('idContratacion0.ncontrato', $this->numero_contrato, true); // related field new
        //$criteria->compare('idContacto0.Nombres', $this->nombre_contacto, true); // related field new

        $criteria->compare('idInicioEjecucion', $this->idInicioEjecucion);
        $criteria->compare('idContratacion', $this->idContratacion);
        $criteria->compare('idContacto', $this->idContacto);
        $criteria->compare('fecha_inicio', $this->fecha_inicio, true);
        $criteria->compare('estado', $this->estado, true);
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
            'criteria' => $criteria,
            'sort'=>array('defaultOrder'=>'idInicioEjecucion DESC'),
            'pagination'=>false
        ));
    }

    public function published() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->with = array('idContratacion0' => array('alias' => 'idContratacion0', 'together' => true,));
        $criteria->together = true;
        $criteria->compare('idContratacion0.titulocontrato', $this->titulo_contrato, true); // related field new
        $criteria->compare('idContratacion0.ncontrato', $this->numero_contrato, true); // related field new
        $criteria->compare('fecha_inicio', $this->fecha_inicio, true);
        $criteria->compare('idInicioEjecucion', $this->idInicioEjecucion, true);

        $criteria->addSearchCondition('t.estado', 'PUBLICADO', true, 'AND');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array('defaultOrder'=>'idInicioEjecucion DESC'),'pagination'=>false
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

    public function getContacto($id) {
      /*
      * Obtiene el contacto asociado con el inicio_ejecucion, utiliza idContacto para recuperar
      * el contacto asociado
      */
      $contacto = array();
      if (is_numeric($id)) {
          $row = Contactos::model()->findById('idContacto='.$id);
          if (isset($row)) {
            $contacto = array('idContacto'=>$row->idContacto, 'Nombres'=>$row->Nombres, 'telefono'=>$row->telefono, 'email'=>$row->emal);
          }
      }
      return $contacto;
    }


    public function listaContactos() {
        $dat = Contactos::model()->findAll(array('order' => 'Nombres'));
        $list = CHtml::listData($dat, 'idContacto', 'Nombres');
        return $list;
    }

    public function listaContratacion() {
        $dat = Contratacion::model()->findAll(array('order' => 'idContratacion ASC'));
        $list = array();

        foreach ($dat as $row) {
            $list[$row->idContratacion] = '(' . substr(str_pad($row->idContratacion, 10, ' ', STR_PAD_LEFT), 0, 10) . ') ' . $row->ncontrato;
        }

        return $list;
    }

    public function listaEstados() {
      $criteria = new CDbCriteria;
      $criteria->condition = '1';
      if (!Yii::app()->user->isSuperAdmin) {
        if (!Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
          $criteria->condition = "(estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÓN')";
        }
      }

      $dat = Estado::model()->findAll($criteria);
      $list = CHtml::listData($dat, 'estado', 'estado');
      return $list;
    }

    public function Usuario($id){
      $nameUser="";
      if($id==0){
          $nameUser="NO Asignado";
      }else{
          try{
              $usuario = Yii::app()->user->um->loadUserById($id);
              $nameUser=$usuario->username;
          }catch(Exception $ex){
              $nameUser="No Asignado";
          }
      }

      return $nameUser ;
    }

    public function idEstadoContrato($idContratacion){
        $idC=0;
        $Contrato = Yii::app()->db->createCommand()
                    ->select('estado')
                    ->from('cs_contratacion')
                    ->where('idContratacion=:id', array(':id' => $idContratacion))
                    ->queryRow();

        switch ($Contrato['estado']){
              case "BORRADOR":{
                  $idC=1;
                  break;
              }
              case "REVISIÓN":{
                  $idC=2;
                  break;
              }
              case "PUBLICADO":{
                  $idC=3;
                  break;
              }
         }
        return $idC;
    }

}
