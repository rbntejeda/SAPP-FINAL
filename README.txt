Este Archivo se a Creado en simbolo de ayuda se ira completando en funcion a la necesidad requerida

Acceso a recursos del Sistema

	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/EscudoUBB_horizontal.jpg" width="200" height="50"></h1>
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css"

Paginas o acciones del Sistema

   <li><a href="<?php echo Yii::app()->createUrl('Usuario/logout'); ?>">Cerrar Sesión</a></li>

 Donde: Usuario = controlador.
	logout = accion.

Variables de Session

      <a class="navbar-brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>//define el rol del usuario

        <li><a href="#">Bienvenido <?php if(isset(Yii::app()->user->nombre))echo Yii::app()->user->nombre; ?></a></li>

Rol:
Yii::app()->user->name

PANEL
<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Panel title</h3>
      </div>
      <div class="panel-body">
        Panel content
      </div>
    </div>