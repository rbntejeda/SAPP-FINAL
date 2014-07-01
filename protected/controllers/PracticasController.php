<!--

/*************************************************************************/
/*  Nombre del archivo:   PracticasController.php                        */
/* Descripción:  Controlador correspondiente a las practicas 			 */
/*                profesionales				                             */
/*	Contiene las acciones:		-actionEditarPractica
								-actionCrearPractica					*/
/*								-actionAdministrar 						*/
/*								-actionEditarNotasInf  					*/
/*								-actionEditarNotaEmp 					*/
/***********************************************************************/
-->

<?php

class PracticasController extends Controller
{
	public $layout='//layouts/practicasLayout'; //Todas páginas iguales hasta rules.

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
				'actions'=>array('index','view','crear','CrearPractica','editarPractica','administrar','editarNotasInf', 'editarNotaEmp'), //permite el ingreso a... al admin.
				'users'=>array('admin'),
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


	public function actionEditarPractica($id)
	{
		$pra=PraTotales::model()->findByAttributes(array('PRA_ID'=>$id)); // ID de la practica
			$practica=Practica::model()->findByAttributes(array('PRA_ID'=>$id));//acceso a la Tabla fisica de la BD
		if(isset($_POST['PraTotales']))  //existe el wn
		{
			$pra->attributes=$_POST['PraTotales']; //recibir todos los atributos que voy a modificar
			
					$practica->PRA_ESTF1=(integer)$pra->PRA_ESTF1;
					$practica->PRA_ESTF3=(integer)$pra->PRA_ESTF3;
					$practica->PRA_ESTINFORME=(integer)$pra->PRA_ESTINFORME;
					if ($pra->PRA_ESTPRACTICA=='Aprobado') 
					{
						if ($practica->PRA_ESTF1&&$practica->PRA_ESTF3&&$practica->PRA_ESTINFORME) 
						{
							$practica->PRA_ESTPRACTICA=$pra->PRA_ESTPRACTICA;
							$practica->save();
							Yii::app()->user->setFlash('success','<div class="alert alert-success">
	  						<strong>Felicidades!</strong> Se han guardado los datos correctamente.
							</div>');
						} else 
						{
							$pra->addError('PRA_ESTPRACTICA','<div class="alert alert-danger">
	  						<strong>No se puede guardar!</strong> La nota es menor a cuatro.
							</div>');
						}
						
					} else 
					{

						if($practica->save())
						{
							$practica->PRA_ESTPRACTICA=$pra->PRA_ESTPRACTICA;
							$practica->save();
							Yii::app()->user->setFlash('success','<div class="alert alert-success">
	  						<strong>Felicidades!</strong> Se han guardado los datos correctamente.
							</div>');
						} else
						{
							$pra->addError('PRA_ESTPRACTICA','La nota es Invalida.');
						}	
					}
							

					/*Yii::app()->user->setFlash('success','<div class="alert alert-success">
      				<strong>Felicidades!</strong> Se han guardado los datos correctamente.
    				</div>');*/
		}

		$this->render('editarPractica',array(
			'pra'=>$pra,'prac'=>$practica
		));
	}
	

	public function actionCrearPractica() // viene de practicasLayout 
	{
		$model=new Practica;

		if(isset($_POST['Practica']))
		{
			$model->attributes=$_POST['Practica'];
			$model->PRA_ESTPRACTICA='Pendiente';
			$model->PRA_ESTF1=0;
			$model->PRA_ESTF3=0;
			$model->PRA_ESTINFORME=0;
			
			if($model->save()){ echo "Guardado";
				Yii::app()->user->setFlash('success','<div class="alert alert-success">
	  						<strong>Felicidades!</strong> Se han guardado los datos correctamente.
							</div>');$practicas=PraTotales::model()->findAll();
		$this->render('administrar',array('practicas'=>$practicas));}
				//$this->redirect('index');
			else {echo "no Guardado";
				Yii::app()->user->setFlash('success','<div class="alert alert-success">
	  						<strong>Felicidades!</strong> no guarda
							</div>');}
		}

		$this->render('crearPractica',array(
			'model'=>$model,
		));
	}

	public function actionAdministrar()
	{
		$practicas=PraTotales::model()->findAll();
		$this->render('administrar',array('practicas'=>$practicas));
	}


	/* editarNotasInf actualiza visualmente y en la BD la nota del alumno
	correspondiente a el informe entregado
	para la segunda entrega se requieren validaciones como que no se pueda editar 
	la nota del informe mientras no se entregue éste*/

	public function actionEditarNotasInf($id)
	{		
		//se busca la nota dentro de la vista segun el id recibido*/
		$nota = PraTotales::model()->findByAttributes(array('PRA_ID'=>$id));
		//solo se edita la nota si el usuario a ingresado una nueva nota
		if(isset($_POST['PraTotales']))  
		{
			//se recupera el id desde el modelo
			$nueva=Practica::model()->findByAttributes(array('PRA_ID'=>$id));
			//se recupera la nota ingresad por teclado
			$nota->attributes=$_POST['PraTotales'];
			$nueva->PRA_EVAPROFESOR =(float)$nota->PRA_EVAPROFESOR;
			//se almacena la nueva nota en la tabla
			$nueva->save();
				if($nueva->save())$this->redirect(Yii::app()->createUrl('Practicas/Administrar'));
				else
				{
					$nota->addError('PRA_EVAPROFESOR','La nota es Invalida.');
				}			
		}
		$this->render('editarNotasInf', array('nota'=>$nota));
	}

	/* editarNotasEmp actualiza visualmente y en la BD la nota del alumno
	correspondiente a la empresa donde realizo la practica*/

	public function actionEditarNotaEmp($id)
	{		
		
		$nota = PraTotales::model()->findByAttributes(array('PRA_ID'=>$id));
		if(isset($_POST['PraTotales']))  
		{
			$nueva=Practica::model()->findByAttributes(array('PRA_ID'=>$id));
			$nota->attributes=$_POST['PraTotales'];
			$nueva->PRA_EVAEMPRESA =(float)$nota->PRA_EVAEMPRESA;
			$nueva->save();
				if($nueva->save())$this->redirect(Yii::app()->createUrl('Practicas/Administrar'));
				else
				{
					$nota->addError('PRA_EVAEMPRESA','La nota es Invalida.');
				}			
		}
		$this->render('editarNotaEmp', array('nota'=>$nota));
	}
}