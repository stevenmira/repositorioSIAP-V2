<?php $__env->startSection('contenido'); ?>
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('EjecutivoController@index')); ?>"> Ejecutivo</a></li>
    <li class="active">Perfil</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>PERFIL DEL EJECUTIVO</b></h4>

<section>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
      <div class="panel panel-info">

        <div class="panel-heading">
          <h3 class="panel-title">INFORMACIÓN PERSONAL</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3 col-lg-3 " align="center"> 
              <img alt="User Pic" src="<?php echo e(asset('imagenes/ejecutivo/'.$ejecutivo->fotografia)); ?>" class="img-rounded img-responsive"> 
            </div>

            <div class=" col-md-9 col-lg-9 "> 
              <table class="table table-user-information">
                <tbody>

                  <tr>
                    <td>NOMBRES Y APELLIDOS:</td>
                    <td><?php echo e($ejecutivo->nombre); ?> <?php echo e($ejecutivo->apellido); ?></td>
                  </tr>

                  <tr>
                    <td>DUI:</td>
                    <td><?php echo e($ejecutivo->dui); ?></td>
                  </tr>

                  <tr>
                    <td>FECHA DE NACIMIENTO:</td>
                    <td><?php echo e($ejecutivo->fechanacimiento); ?> (<?php echo e($edad); ?> años)</td>
                  </tr>

                  <tr>
                    <td>DIRECCIÓN:</td>
                    <td><?php echo e($ejecutivo->direccion); ?></td>
                  </tr>

                  <tr>
                    <td>SEXO:</td>
                    <td><?php echo e($ejecutivo->sexo); ?></td>
                  </tr>

                  <tr>
                    <td>NÚMERO TELEFONICO:</td>
                    <td><?php echo e($ejecutivo->telefono); ?></td>
                  </tr>

                  <tr>
                    <td>CORREO:</td>
                    <td><?php echo e($ejecutivo->correo); ?></td>
                  </tr>

                  <tr>
                    <td>COMENTARIO:</td>
                    <td><?php echo e($ejecutivo->comentario); ?></td>
                  </tr>

                </tbody>
              </table>
              <a href="<?php echo e(URL::action('EjecutivoController@edit',$ejecutivo->idejecutivo)); ?>" class="btn btn-primary btn-lg  pull-right">Actualizar</a>
            </div>
          </div>
        </div>
      </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>