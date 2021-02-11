<?php
/* @var $this CalificacionOferenteController */
/* @var $model2 CalificacionOferente */

	$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider' => $model2->search(),
			'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
			'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
			'enablePagination' => true,
			'htmlOptions' => array('class' => 'grid-view rounded'),
			'columns' => array(
					array('header'=>'Codigo',
						  'name'=> 'idOferente',
						  'htmlOptions'=>array('width'=>'200px', 'align'=>'center')),
					array('header'=>'Nombre de Oferente',
						  'name'=> 'idOferente_rel.nombre_oferente'),
			),
	));

?>
