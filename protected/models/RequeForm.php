<?php 
class RequeForm extends CFormModel
{
	//campos del formulario
	public $rut;
	public $nombre;
	public $form1;  //checkbox
	public $form2;   //checkbox
	public $informe;  //checkbox
	public $est_prac; 
	public $opcion;

	public function rules()
	{
		return array(
			array('form1, form2, informe, est_prac' , 'required'),
			array('form1, form2, informe, est_prac' , 'boolean'),	//checkbox	//safe = puede poner lo que sea	
		);
	}
}