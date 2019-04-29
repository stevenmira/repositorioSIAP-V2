<!DOCTYPE html>
<html>
<head>
  <title>Perfil Cliente</title>
  <style type="text/css">
    @page{
      margin-top: 10.0mm;
            margin-bottom: 10.0mm;
    }
    body{
      line-height: 22px;
    }
  </style>
</head>
<body>
  <div>
    <table>
      <tr>
        <th style="width: 500px;" align="center" valign="bottom">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AFIMID, S.A. DE C.V.
        </th>
        <td>
          <img src="img/log.jpg" width="180px" height="70px">
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS<br>SOCIEDAD ANONIMA DE CAPITAL VARIABLE</td>
      </tr>
    </table>
  </div>
  <br>
  <table BORDER WIDTH="50%" align="center" style="width: 90%; border-collapse: collapse;">
                <TR><TD><p style="font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: ">
      Usuario: <?php echo e($usuarioactual->nombre); ?></p></TD><TD><p style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; float: right;">
      Fecha de Emision: <?php echo e($fecha_actual); ?></p></TD>
      </TR>
  </table>
    <B>
      
    </B>

  <br><br>
 
  <div>
<br>
<p>
  
</p>
</br>
    <b></b>
    <table BORDER WIDTH="50%" align="center" style="width: 90%; border-collapse: collapse;">
                <TR><TD> DATOS DEL CLIENTE :</TD><TD> <h2 style="font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #000000; float: ">
      </h2></TD>
                <TR><TD> </TD><TD></TD>
                </TR>
                </TR>
    </table>
 
  <div>
<br>
<p>
  
</p>
</br>
    <b></b>
    <table BORDER WIDTH="25%" align="center" style="width: 90%; border-collapse: collapse;">
                <TR><TD>Nombre: </TD><TD><?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></h4></TD>
                <TR><TD>Categoria:</TD><TD><b><?php echo e($categoria->letra); ?></b></TD>
                <TR><TD>Profesion: </TD><TD><?php echo e($cliente->profesion); ?></h4></TD>
                <TR><TD>Fecha de Nacimiento y Edad:</h4></TD><TD><?php echo e($cliente->fechanacimiento); ?> (<?php echo e($edad); ?> años)</h4></TD>
                <TR><TD>Direccion</TD><TD><?php echo e($cliente->direccion); ?></TD>
                <TR><TD>DUI:</TD><TD><?php echo e($cliente->dui); ?></TD>
                <TR><TD>NIT:</TD><TD><?php echo e($cliente->nit); ?></TD>
                <TR><TD>Lugar de Expedicion:</TD><TD><?php echo e($cliente->lugarexpedicion); ?></TD>
                <TR><TD>Fecha de Expedicion:</TD><TD><?php echo e($cliente->fechaexpedicion); ?></TD>
                <TR><TD>Domicilio</TD><TD><?php echo e($cliente->domicilio); ?></TD>
                <TR><TD>Telefono Fijo:</TD><TD><?php echo e($cliente->telefonofijo); ?></TD>
                <TR><TD>Telefono Celular:</TD><TD><?php echo e($cliente->telefonocel); ?></TD>
                </TR>
    </table>
  <div>
    <table align="center" style="width: 80%;" cellpadding="0" cellspacing="0">
      <tr>
        <td style="width: 15%;"><h3>Comentarios:</h3></td>
    </tr>
  </table>
  </div>
  <div>
  <table align="left" style="width: 40%;" cellpadding="0" cellspacing="0">
      <tr>
        <td><?php foreach($observaciones as $observacion): ?>
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" align="center">
              <p class="text-muted"><i class='fas fa-check'></i> *  <?php echo e($observacion->comentario); ?></p></td>
           </div>
      </tr>
  </table>
  </div>

          <?php endforeach; ?>  
</body>
</html>