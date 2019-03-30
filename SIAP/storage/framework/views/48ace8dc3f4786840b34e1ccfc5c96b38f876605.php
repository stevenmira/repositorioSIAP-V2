<?php $__env->startSection('contenido'); ?>
	<h1>Formularios Vacios PDF</h1>
	<br>
	<div align="center"><a class="btn btn-primary btn-lg" style="width: 40%" href="<?php echo e(URL::action('ImprimirController@licitacionPDF')); ?>" target="_blank">Cartera de Pagos</a></div>
	<br>
	<br>
	<div align="center"><a class="btn btn-primary btn-lg" style="width: 40%" href="<?php echo e(URL::action('ImprimirController@carteraPDF')); ?>" target="_blank">Cartera de Clientes</a></div>
	<br>
	<br>
	<div align="center"><a class="btn btn-primary btn-lg" style="width: 40%" href="<?php echo e(URL::action('ImprimirController@desembolsoPDF')); ?>" target="_blank">Desembolso</a></div>
	<br>
	<br>
	<div align="center"><a class="btn btn-primary btn-lg" style="width: 40%" href="<?php echo e(URL::action('ImprimirController@desembolsoRefinanciamientoPDF')); ?>" target="_blank">Desembolso Refinanciamiento</a></div>
	<br>
	<br>
	<div align="center"><a class="btn btn-primary btn-lg" style="width: 40%" href="<?php echo e(URL::action('ImprimirController@estadoCuentaPDF')); ?>" target="_blank">Estado de Cuenta</a></div>
	<br>
	<br>
	<div align="center"><a class="btn btn-primary btn-lg" style="width: 40%" href="<?php echo e(URL::action('ImprimirController@estadoCuentaVencidoPDF')); ?>" target="_blank">Estado Cuenta Vencido</a></div>
	<br>
	<br>
	<div align="center"><a class="btn btn-primary btn-lg" style="width: 40%" href="<?php echo e(URL::action('ImprimirController@pagarePDF')); ?>" target="_blank">Pagare</a></div>
	<br>
	<br>
	<div align="center"><a class="btn btn-primary btn-lg" style="width: 40%" href="<?php echo e(URL::action('ImprimirController@reciboPDF')); ?>" target="_blank">Recibo</a></div>
	<br>
	<br>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>