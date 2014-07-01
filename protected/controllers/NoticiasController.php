<!--

/*************************************************************************/
/*  Nombre del archivo:   NoticiasController.php                        */
/* Descripción:  Controlador correspondiente a las administracion		 */
/*                de noticias				                             */
/*	Contiene las acciones:		-actionAgregarNoticia					*/
/*								-actionOfrecerNoticia					*/
/*								-actionUpdate		 					*/
/*								-actioneliminarOfrecimiento				*/
/*								-actionEliminar 						*/
/***********************************************************************/
-->





<?php

class NoticiasController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='noticiasLayout';

	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','AgregarNoticia','AdministrarNoticia','OfrecerNoticia','eliminarOfrecimiento','eliminar'),
				'users'=>array('admin','profesor'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionAgregarNoticia()
	{
		$model=new Noticias('create');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Noticias']))
		{
			$model->attributes=$_POST['Noticias'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->NOT_ID));
		}

		$this->render('create',array(
		'model'=>$model,
		));
	}
	public function actionOfrecerNoticia($id)
	{
		$model=new Ofrece('create');		
		$model->NOT_ID=$id;
		$model->OFR_INICIO=date('Y-m-d');
		// Uncomment the following line if AJAX validation is needed

		if(isset($_POST['Ofrece']))
		{
			$model->attributes=$_POST['Ofrece'];
			$model->OFR_ESTADO="Activo";
			if($model->save())
				$this->redirect(array('ofrecerNoticia','id'=>$model->NOT_ID));
		}

		$this->render('ofrecerNoticia',array(
		'model'=>$model
		));
	}
	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Noticias']))
		{
			$model->attributes=$_POST['Noticias'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->NOT_ID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionEliminar($id)
	{
		if(Ofrece::model()->exists("NOT_ID=$id")){
			Yii::app()->user->setFlash('error',BsHtml::alert(BsHtml::ALERT_COLOR_DANGER, BsHtml::bold('Error al eliminar ') . 'La noticia se encuentra ofrecida a una o mas carreras.'));
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('AdministrarNoticia'));
		}
		else{
			$this->loadModel($id)->delete();
			Yii::app()->user->setFlash('error',BsHtml::alert(BsHtml::ALERT_COLOR_SUCCESS, BsHtml::bold('Éxito al eliminar ') . 'La noticia se ha eliminado con éxito.'));
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('AdministrarNoticia'));
		}
	}

	public function actioneliminarOfrecimiento($id)
	{
			$model=Ofrece::model()->findByAttributes(array('OFR_ID'=>$id));
			$num=$model->NOT_ID;
			$model->delete();
			$this->redirect(array('ofrecerNoticia','id'=>$num));
	}
	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Noticias');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	* Manages all models.
	*/
	public function actionAdministrarNoticia()
	{
		$model=new Noticias;
		if(isset($_GET['Noticias']))
			$model->attributes=$_GET['Noticias'];
		$buscar=($model->NOT_TITULO=='')?Noticias::model()->findAll():Noticias::model()->findAll("NOT_TITULO Like '%$model->NOT_TITULO%'");
		$this->render('admin',array('model'=>$model,'buscar'=>$buscar));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Noticias the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Noticias::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'La solitud no se encuentra disponible');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Noticias $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='noticias-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}