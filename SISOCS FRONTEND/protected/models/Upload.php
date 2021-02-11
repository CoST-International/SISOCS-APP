<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Upload
 *
 * @author juan
 */
class Upload extends CFormModel {
    //put your code here
     public $file;
     public $file2;
     public $file3;
     public $file4;
     public $file5;
     public $file6;
    public $file7;
    public $file8;
    public $file9;
    public $file10;
   public function rules()
   {
        return array(
            array('file', 'file', 'types'=>array('png','jpg','doc','docx','pdf','xls','xlsx','png')),
            array('file2', 'file', 'types'=>array('png','jpg','doc','docx','pdf','xls','xlsx','png')),
            array('fil3', 'file', 'types'=>array('png','jpg','doc','docx','pdf','xls','xlsx','png')),
            array('fils4', 'file', 'types'=>array('png','jpg','doc','docx','pdf','xls','xlsx','png')),
            array('file5', 'file', 'types'=>array('png','jpg','doc','docx','pdf','xls','xlsx','png')),
            array('file6', 'file', 'types'=>array('png','jpg','doc','docx','pdf','xls','xlsx','png')),
            array('file7', 'file', 'types'=>array('png','jpg','doc','docx','pdf','xls','xlsx','png')),
            array('file8', 'file', 'types'=>array('png','jpg','doc','docx','pdf','xls','xlsx','png')),
            array('file9', 'file', 'types'=>array('png','jpg','doc','docx','pdf','xls','xlsx','png')),
            array('file10', 'file', 'types'=>array('png','jpg','doc','docx','pdf','xls','xlsx','png')),
        );
    }
}

?>
