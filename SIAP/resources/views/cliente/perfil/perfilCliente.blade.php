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
      Usuario: {{$usuarioactual->nombre}}</p></TD><TD><p style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; float: right;">
      Fecha de Emision: {{$fecha_actual}}</p></TD>
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
                <TR><TD>Nombre: </TD><TD>{{$cliente->nombre}} {{$cliente->apellido}}</h4></TD>
                <TR><TD>Categoria:</TD><TD><b>{{$categoria->letra}}</b></TD>
                <TR><TD>Profesion: </TD><TD>{{$cliente->profesion}}</h4></TD>
                <TR><TD>Fecha de Nacimiento y Edad:</h4></TD><TD>{{$cliente->fechanacimiento}} ({{$edad}} años)</h4></TD>
                <TR><TD>Direccion</TD><TD>{{$cliente->direccion}}</TD>
                <TR><TD>DUI:</TD><TD>{{$cliente->dui}}</TD>
                <TR><TD>NIT:</TD><TD>{{$cliente->nit}}</TD>
                <TR><TD>Lugar de Expedicion:</TD><TD>{{$cliente->lugarexpedicion}}</TD>
                <TR><TD>Fecha de Expedicion:</TD><TD>{{$cliente->fechaexpedicion}}</TD>
                <TR><TD>Domicilio</TD><TD>{{$cliente->domicilio}}</TD>
                <TR><TD>Telefono Fijo:</TD><TD>{{$cliente->telefonofijo}}</TD>
                <TR><TD>Telefono Celular:</TD><TD>{{$cliente->telefonocel}}</TD>
                </TR>
    </table>
        <div class="row user-menu-container square" style="width: 500px;" align="leth">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 user-details">
          <div class="row  white">
              <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 coralbg2 no-pad">
                  <div class="user-pad">
    
  </div>
  <br>
  <br>
  <div>
  </div>
  <div>
    <table align="center" style="width: 80%;" cellpadding="0" cellspacing="0">
      <tr>
        <td style="width: 15%;"><h3>Comentarios:</h3></td>
    </tr>
    <tr>
    </tr>
  </table>
          <div class="col-md-offset-2" id="tab_default_4">
          @foreach ($observaciones as $observacion)
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
              <p class="text-muted"><i class='fas fa-check'></i> *  {{ $observacion->comentario }}</p>
                   </div>
           </div>

          @endforeach  
</body>
</html>