<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIAP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Register -->
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
  </head>
  
<body>     

  <div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">
    <br><br>
    @if (Session::has('error'))
      <div class="alert  fade in" style="background:  #ff8a80;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <P>{{ Session::get('error')}}</P>
      </div>
    @endif 

    @if (Session::has('update'))
      <div class="alert  fade in" style="background:  #bbdefb;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <P>{{ Session::get('update')}}</P>
      </div>
    @endif 

    @if (Session::has('message'))
      <div class="alert  fade in" style="background:  #ccff90;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <P>{{ Session::get('message')}}</P>
      </div>
    @endif 
  </div>


  <div class="container">
    <div class="row main">  
      <div class="panel-heading">
         <div class="panel-title text-center">
            <h1 class="title"><a style="text-decoration: none; color: black;" href="{{ url('home')}}">AFIMID</a></h1>
            <hr />
          </div>
      </div>
      <div class="main-login main-center">   
        <form class="form-horizontal"  action="register" method="post">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

          <div class="form-group">
            <p for="name" class="cols-sm-2 control-label" style="text-align: center;">
              <b>Registro de Usuario Administrador</b>
            </p>
          </div>

          <div class="form-group">
            <label for="name" class="cols-sm-2 control-label">Nombre de Empleado</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre de Empleado" p required >
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="cols-sm-2 control-label">Username</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <input type="text" class="form-control" id="name" name="name"  placeholder="Nombre de Usuario" p required >
              </div>
            </div>
          </div> 

          <div class="form-group">
            <label for="name" class="cols-sm-2 control-label">Tipo Usuario</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <select id="idtipousuario" name="idtipousuario" class="form-control" >
                <?php  for($i=0;$i<=count($tiposusuario)-1;$i++){   ?>
                  <option value="<?= $tiposusuario[$i]->idtipousuario  ?>" ><?= $tiposusuario[$i]->nombre ?> </option>
                <?php  } ?>
              </select>  
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="cols-sm-2 control-label">Email</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil fa" aria-hidden="true"></i></span>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" p required>
              </div>
            </div>
          </div> 

          <div class="form-group">
            <label for="name" class="cols-sm-2 control-label">Contraseña</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil fa" aria-hidden="true"></i></span>
                <input type="password" class="form-control" id="password" name="password" p required >
              </div>
            </div>
          </div>

          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
          </div>
        </form>
      </div>
    </div>  
  </div>
</body>
</html>
