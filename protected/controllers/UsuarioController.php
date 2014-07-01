<!--

/*************************************************************************/
/*  Nombre del archivo:   UsuarioController.php                        */
/* Descripción:  Controlador correspondiente a la administración de 	*/
/*				usuario 												*/
/*	Contiene las acciones:												*/
/*								-actionLogin							*/
/*								-actionLogout							*/
/*								-actionCrear							*/
/*								-actionEditar 							*/
/*								-actionAdministrar						*/
/*								-actionEliminar							*/
/***********************************************************************/
-->




<?php

class UsuarioController extends Controller
{

	public $layout='//layouts/usuarioLayout';
	public $action='administrar';

	public function filters()
	{
		return array(
			'accessControl', 
			'postOnly + delete', 
		);
	}
// Se Definen las reglas de acceso a las acciones
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('login'),
				'users'=>array('*'),
			),
			array('allow', 
				'actions'=>array('crear','administrar','editar','eliminar'),
				'users'=>array('admin','profesor'),
			),
			array('allow', 
				'actions'=>array('index','editar'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('logout'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('admin','eliminar'),
				'users'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
//Login
	public function actionLogin()
	{
		$model=new LoginForm;//lamada al modelo LoginForm
		//Validacion Mediante Ajax
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		//Ingreso de Datos via Post
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			//Se valida que los datos cumplan con las reglas exigidas y carga la variables de session puestas en useridentity
			if($model->validate() && $model->login())
					$this->redirect(Yii::app()->user->returnUrl);
		}
		//Carga Su propia Layout
		$this->layout='LoginLayout';
		$this->render('login',array('model'=>$model));
	}
	
	public function actionAdministrar()
	{
		//Vista Simple de Administracion dependiendo del Role de Usuario
		if(Yii::app()->user->name == 'admin')
		{//busca a todos los elementos de la Vista Usu_Todos
		$users=UsuTodos::model()->findAll();
		$this->render('administrar',array('users'=>$users));
		}
		if(Yii::app()->user->name == 'profesor')
		{//Carga el modelo con restricciones de Carrera
		$users=UsuAlumnos::model()->findAllByAttributes(array('CAR_CODIGO'=>Yii::app()->user->carrera));
		$this->render('administrarProfesor',array('users'=>$users));
		}
	}

	public function actionLogout()
	{//Destruccion de Varuables de Session
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionCrear()
	{
		//Se Crea la Clase Usuario Para Guardar Un usuario
		$user=new Usuario;
		if(isset($_POST['Usuario']))
		{
			$user->attributes=$_POST['Usuario'];
			if ($user->USU_PASSWORD==''&&$user->PER_ID!=null) {
				//si no se le asigna Contraseña Guarda los primeros 5 digitos del rut
				$usu=Persona::model()->findByAttributes(array('PER_ID'=>$user->PER_ID));
				$user->USU_PASSWORD=substr($usu->PER_RUT,0,2).substr($usu->PER_RUT,3,3);
			}

			if (strlen($user->USU_PASSWORD)>=5) {
				$user->USU_PASSWORD=md5($user->USU_PASSWORD);
			}
			$user->USU_CREATE=date('Y-m-d H:i:s');
			$user->USU_MODIFIED=date('Y-m-d H:i:s');
			if($user->save())
			{
				$this->redirect(array('administrar'));
			}
			$user->USU_PASSWORD='';

		}

		if(Yii::app()->user->name == 'admin')
		{
			$personas=UsuSinasignar::model()->findAll();
		}
		if(Yii::app()->user->name == 'profesor')
		{
			$personas=UsuSinasignar::model()->findAllByAttributes(array('CAR_CODIGO'=>Yii::app()->user->carrera,'PER_ROLE'=>'alumno'));
		}
		if($personas==null)
			throw new CHttpException(500,'No se puede acceder a la pagina solicitada,No existen Personas en el sistema que se les pueda asignar un usuario');
		
		$this->render('crear',array('user'=>$user,'personas'=>$personas));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEditar($id=null)
	{
		if(Yii::app()->user->name != 'admin'&&Yii::app()->user->name != 'profesor'&&Yii::app()->user->ID != $id)
		{
			$this->redirect(Yii::app()->createUrl('Usuario/editar/'.Yii::app()->user->ID));
		}
		$user=Usuario::model()->findByPk($id);
		$persona=Persona::model()->findByAttributes(array('PER_ID'=>$id));
		if(isset($_POST['Usuario']))
		{
			$nuevo=new Usuario;
			$nuevo->attributes=$_POST['Usuario'];
			if($nuevo->USU_PASSWORD!='')
			{
				if (strlen($nuevo->USU_PASSWORD)>=5) {
				$user->USU_PASSWORD=md5($nuevo->USU_PASSWORD);
			}
			}
			$user->USU_MODIFIED=date('Y-m-d H:i:s');
			$user->save();
			if ($nuevo->USU_ESTADO!=$user->USU_ESTADO) 
			{
				$user->USU_ESTADO=$nuevo->USU_ESTADO;
				$user->save();
			}
			$persona->attributes=$_POST['Persona'];
			if($persona->save())
			$this->redirect(Yii::app()->createUrl('Usuario/'));
		}

		if(Yii::app()->user->name == 'alumno')
			$this->layout='sappLayout';
		$this->render('editar',array(
			'user'=>$user,
			'persona'=>$persona
		));
	}

	public function actionEliminar($id=null)
	{
		Usuario::model()->findByPk($id)->delete();
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('administrar'));
	}

	public function actionIndex()
	{
		if(Yii::app()->user->name == 'admin')
		{
			$this->redirect(Yii::app()->createUrl('Usuario/administrar'));
		}
		if (Yii::app()->user->name == 'alumno')
		{
			$this->redirect(Yii::app()->createUrl('Bitacora/administrar'));
		}
		if(Yii::app()->user->name == 'profesor')
		{
			$this->redirect(Yii::app()->createUrl('Usuario/administrar'));
		}
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
