            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-text"></i>
                <span>Gestión de Crédito</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a  href="{{URL::action('calcularCreditoController@create')}}"><i class="fa fa-circle-o"></i> Calcular Crédito</a></li>
               </ul>
            </li>

            <li class="treeview">
              <a href="{{URL::action('RecordClienteController@index')}}">
                <i class="fa fa-folder-open"></i> 
                <span>Récord de Cliente</span>
                <i class="fa fa-info-circle pull-right"></i>
              </a>
            </li>
           