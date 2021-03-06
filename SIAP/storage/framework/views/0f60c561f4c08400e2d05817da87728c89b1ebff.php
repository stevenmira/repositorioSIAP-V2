         <li class="treeview">
            <a href="">
               <i class="fa fa-sort-alpha-asc"></i>
                <span>Carteras</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo e(URL::action('CarteraController@index')); ?>"><i class="fa fa-circle-o"></i> Activas </a></li>
              <li><a href="<?php echo e(URL::action('CarteraController@inactivos')); ?>"><i class="fa fa-circle-o"></i> Inactivas</a></li>
            </ul>
        </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Clientes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo e(URL::action('ClienteController@index')); ?>"><i class="fa fa-circle-o"></i> Activos</a></li>
                <li><a href="<?php echo e(URL::action('ClienteController@inactivos')); ?>"><i class="fa fa-circle-o"></i> Inactivos</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-text"></i>
                <span>Gestión de Crédito</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

                <li><a  href="<?php echo e(URL::action('calcularCreditoController@create')); ?>"><i class="fa fa-circle-o"></i> Calcular Crédito</a></li>

                <li><a href="<?php echo e(URL::action('TipoCreditoController@create')); ?>"><i class="fa fa-circle-o"></i> Credito Completo</a></li>
                <li><a href="<?php echo e(URL::action('RefinanciamientoController@create')); ?>"><i class="fa fa-circle-o"></i> Refinanciamiento</a></li>
              </ul>
            </li>
                     
            <li class="treeview">
              <a href="<?php echo e(URL::action('RecordClienteController@index')); ?>">
                <i class="fa fa-folder-open"></i> 
                <span>Récord de Cliente</span>
                <i class="fa fa-info-circle pull-right"></i>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo e(URL::action('UsuarioController@index')); ?>">
                <i class="fa fa-users"></i> 
                <span>Gestión de Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo e(URL::action('UsuarioController@index')); ?>"><i class="fa fa-circle-o"></i> Lista usuarios</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i> 
                <span>Ajustes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo e(URL::action('CategoriaController@index')); ?>"><i class="fa fa-circle-o"></i>  Categorias</a></li>
                <li><a href="<?php echo e(URL::action('EmpleadoController@indexPersonal')); ?>"><i class="fa fa-circle-o"></i> Personal</a></li>
                <li><a href="<?php echo e(URL::action('TasaInteresController@index')); ?>"><i class="fa fa-circle-o"></i> Tasas de interés</a></li>
              </ul>
            </li>

             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> 
                <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>