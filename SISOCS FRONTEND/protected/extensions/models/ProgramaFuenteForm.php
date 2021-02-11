<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProgramaFuenteForm
 *
 * @author juan
 */
class ProgramaFuenteForm extends CForm {
    //put your code here
    public $programa;
    public $fuente;
    public $monto;
    public $moneda;
    public $tasa;
    public  $fecha;
    
    public function attributeLabels()
	{
		return array(
			'programa' => 'Programa',
			'fuente' => 'Fuente',
			'monto' => 'Monto',
			'moneda' => 'Moneda',
			'tasacambio' => 'Tasacambio',
			'fecha' => 'Fecha',
			//'id' => 'ID',
		);
	}
        
         public function primaryKey()
        {
            return array('programa','fuente');
            // For composite primary key, return an array like the following
            // return array('pk1', 'pk2');
            }
      public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('programa','required'),
			array('programa', 'length', 'max'=>20),
			array('fuente','required'),
			array('fuente', 'length', 'max'=>200),
			array('monto','required'),
			array('monto', 'length', 'max'=>27),
			array('tasacambio','required'),
			array('moneda, tasacambio, fecha', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('programa, fuente, monto, moneda, tasacambio, fecha', 'safe', 'on'=>'search'),
		);
	}
}

?>
