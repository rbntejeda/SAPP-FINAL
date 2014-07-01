<!--

/*************************************************************************/
/*  Nombre del archivo:  empresasContrller.php                        */
/* Descripción:  Controlador correspondiente a las administracion		 */
/*                de empresas y Convenios				                             */
/*	Contiene las acciones:		-actionBuscar							*/
/*								-actionConvenio 						*/
/*								-actionCrearConvenio	 				*/
/*								-actionVerConvenio						*/
/*								-actionEditarConvenio					*/
/*								-actionBorrarConvenio 					*/
/*								-actionEditar 							*/
/*								-actionIngresar							*/
/*								-actionMostrar							*/
/***********************************************************************/
-->


<?php

class EmpresaController extends Controller
{
	public $layout='//layouts/empresasLayout'; //Todas páginas iguales hasta rules.

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
				'actions'=>array('index','view','buscar','convenio','editar','ingresar','mostrar','verConvenio','editarConvenio','crearConvenio', 'borrarConvenio'), //permite el ingreso a... al admin.
				'users'=>array('admin'),
			),
			array('allow',
				'actions'=>array('update','logout'),
				'users'=>array('@'), // todos, estando autotentificado.
			),
			array('allow',
				'actions'=>array('admin','delete', 'borrarConvenio'),
				'users'=>array('admin'),
			),
			array('deny', //denegar
				'users'=>array('*'),
			),
		);
	}


	public function actionBuscar()
	{
		$empresas=Empresa::model()->findAll();
		$this->render('buscar',array('empresas'=>$empresas));
	}

	public function actionConvenio()
	{
		//mostrar todas las empresas
		$empresas = Empresa::model()->findAll();
		$this->render('convenio', array('empresas'=>$empresas));
	}

	public function actionCrearConvenio($id)
	{
		$nuevo = new Convenio;

		$nombre = Empresa::model()->findByAttributes(array('EMP_ID' =>$id));
		//$empresas = Empresa::model()->findAll();

		if(isset($_POST['Convenio']))
		{
			$nuevo->EMP_ID = $id;
			$nuevo->CON_TERMINO = null;
			$nuevo->attributes= $_POST['Convenio'];		
			//$nuevo->CON_INGRESO=date("Y-m-d");
			
			if($nuevo->save())
			{
			$nuevo->unsetAttributes();	
			Yii::app()->user->setFlash('success','<div class="alert alert-success">
	  						<strong>Felicidades!</strong> Se han guardado los datos correctamente.
							</div>');
			//$this->render('convenio', array('empresas'=>$empresas));
		}
		}
		$this->render('crearConvenio', array('nombre' => $nombre, 'nuevo'=>$nuevo));
	}


	public function actionVerConvenio($id)
	{
		$sql = "SELECT * FROM convenios WHERE EMP_ID = '$id'";
		$convEmpresa = Convenios::model()->findAllBySql($sql);
		$this->render('verConvenio', array('convEmpresa'=>$convEmpresa));
	}

	public function actionEditarConvenio($id)
	{
		$nombre = Convenios::model()->findByAttributes(array('CON_ID'=>$id));


		$sql = "SELECT * FROM convenio WHERE CON_ID = '$id'";
		$convenio = Convenio::model()->findBySql($sql);

		if(isset($_POST['Convenio']))
		{
			$convenio->attributes=$_POST['Convenio'];
			if($convenio->save())
				Yii::app()->user->setFlash('success','<div class="alert alert-success">
	  						<strong>Felicidades!</strong> Se han actualizado los datos correctamente.
							</div>');
		}
		

		$this->render('editarConvenio',array('nombre'=>$nombre, 'convenio'=>$convenio));
	}

	public function actionBorrarConvenio($id)
	{
			$model= Convenio::model()->findByAttributes(array('CON_ID'=>$id));
			$model->delete();
			$empresas = Empresa::model()->findAll();
			$this->render('convenio', array('empresas'=>$empresas));
	}

	public function actionEditar()
	{
		$this->render('editar');
	}

	public function actionIngresar()
	{
		$model=new Empresa;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Empresa']))
		{
			$model->attributes=$_POST['Empresa'];
			if($model->save()){Yii::app()->user->setFlash('success','<div class="alert alert-success">
	  						<strong>Felicidades!</strong> Se han guardado los datos correctamente.
							</div>');}
				//$this->redirect('index');
		}

		$this->render('ingresar',array(
			'model'=>$model,
		));
	}

	public function actionMostrar()
	{
		$this->render('mostrar');
	}

	public static function activeEmailField($model,$attribute,$htmlOptions=array())
	{
    	self::resolveNameID($model,$attribute,$htmlOptions);
    	self::clientChange('change',$htmlOptions);
    	return self::activeInputField('email',$model,$attribute,$htmlOptions);
	}
}