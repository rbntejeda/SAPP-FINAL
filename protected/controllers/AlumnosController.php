<!--

/*************************************************************************/
/*  Nombre del archivo:   AlumnosController.php                        */
/* Descripción:  Controlador correspondiente a las administracion		 */
/*                de los alumnos en el sistema                           */
/*	Contiene las acciones:		-actionBuscarAlumno						*/
/*								-actionIngresarAlumno					*/
/*								-actionEliminarAlumno		 			*/
/*								-actionIngresarBitacora					*/
/*								-actionMostrarBitacora					*/
/*								-actionMostrarBitacoras					*/
/***********************************************************************/
-->


<?php

class AlumnosController extends Controller
{
	public $layout='//layouts/alumnosLayout'; //Todas páginas iguales hasta rules.

	public function filters()
	{
		return array(
			'accessControl', 
			'postOnly + delete', 
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('login'),
				'users'=>array('*'), //todos
			),
			array('allow', 
				'actions'=>array('index','view','bitacora','buscarAlumno','editarAlumno','ingresarAlumno','ingresarBitacora',
				'mostrarBitacora','mostrarBitacoras'), //permite el ingreso a... al admin.
				'users'=>array('admin','profesor'),
			),
			array('allow',
				'actions'=>array('update','logout'),
				'users'=>array('@'), // todos, estando autotentificado.
			),
			array('allow',
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny', //denegar
				'users'=>array('*'),
			),
		);
	}

	public function actionBuscarAlumno()
	{
		$alumnos=Persona::model()->findAll('PER_ROLE=:PER_ROLE',array(':PER_ROLE'=>'alumno'));
		$this->render('buscarAlumno',array('alumnos'=>$alumnos));
	}

	public function actionEditarAlumno()
	{
		$this->render('editarAlumno');
	}

	public function actionIngresarAlumno()
	{
		//$model=new Persona();
		//$this->render('ingresarAlumno',array("model"=>$model));

		$alumno=new Persona('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($alumno);

		if(isset($_POST['Persona']))
		{
			$alumno->attributes=$_POST['Persona'];
			var_dump(Yii::app()->user->name == 'admin');
			$alumno->CAR_CODIGO=(Yii::app()->user->name == 'admin')?$alumno->CAR_CODIGO:Yii::app()->user->carrera;
			$alumno->PER_ROLE='alumno';
			if($alumno->save()){Yii::app()->user->setFlash('success','<div class="alert alert-success">
	  						<strong>Felicidades!</strong> Se han guardado los datos correctamente.
							</div>');}
				//$this->redirect('index');
		}

		$this->render('ingresarAlumno',array(
			'alumno'=>$alumno,
		));
	}

	public function actionIngresarBitacora()
	{
		$this->render('ingresarBitacora');
	}

	public function actionMostrarBitacora()
	{
		$this->render('mostrarBitacora');
	}

	public function actionMostrarBitacoras()
	{
		$this->render('mostrarBitacoras');
	}

	public static function activeEmailField($model,$attribute,$htmlOptions=array())
	{
    	self::resolveNameID($model,$attribute,$htmlOptions);
    	self::clientChange('change',$htmlOptions);
    	return self::activeInputField('email',$model,$attribute,$htmlOptions);
	}
}