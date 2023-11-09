<?php
$session = session();
$nombre = $session->get('nombre');
$perfil = $session->get('perfil_id');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container"> <!-- Agregamos un contenedor para centrar el contenido -->

        <a class="navbar-brand" href="<?php echo base_url('Inicio')?>">
            <img src="<?php echo base_url('assets/img/icono.png')?>" alt="marca" width="75" height="30" class="img-fluid">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if($perfil == 1):?>
                    <div class="btn btn-info active btnUser btn-sm">
                        <a href="<?php echo base_url('/panel')?>">ADMIN: <?php echo $nombre;?></a>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('usuarioListado')?>" id="usuarioListado">Listado de Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=<?php echo base_url('productoListado')?> id="productoListado">Listado de Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=<?php echo base_url('registro')?> id="registro">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('/logout');?>" id="salir">Cerrar Sesión</a>
                    </li>
                <?php elseif($perfil == 2):?>
                    <div class="btn btn-info active btnUser btn-sm">
                        <a href="<?php echo base_url('/panel')?>">CLIENTE: <?php echo $nombre;?></a>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('Inicio')?>" id="enlace">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('quienes_somos')?>" id="enlace">Quiénes Somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('acerca_de')?>" id="enlace">Acerca de</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('catalogo')?>" id="enlace">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('/logout');?>" id="salir">Cerrar Sesión</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('Inicio')?>" id="enlace">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('quienes_somos')?>" id="enlace">Quiénes Somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('acerca_de')?>" id="enlace">Acerca de</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('catalogo')?>" id="enlace">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=<?php echo base_url('registro')?> id="registro">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

    </div> <!-- Cierre del contenedor -->
</nav>