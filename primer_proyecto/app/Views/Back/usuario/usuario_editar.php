<body class="gradient-custom">
    <div class="container mt-5">
        <div class="row justify-content-md-center">
        <div class="card col-lg-3 bg-dark" style="width: 50%; color:white">
            <center>
                <h2>Editar Usuario</h2>
            </center>
            <br>

            <?php if (isset($user)): ?>
                <center><form action="<?= base_url("usuarioupdate/{$user['id_usuario']}") ?>" method="post">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?= $user['nombre'] ?>"><br>
                    <br>
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" value="<?= $user['apellido'] ?>"><br>
                    <br>
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" value="<?= $user['usuario'] ?>"><br>
                    <br>
                    <label for="perfil_id">Perfil:</label>
                    <select class="form-control" name="perfil_id" id="perfil_id">
                                    <option value="1">Admin</option>
                                    <option value="2">Cliente</option>
                                </select>
                    <br>
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?= $user['email'] ?>"><br>
                    <br>
                    <label for="pass">Contraseña:</label>
                    <input type="password" name="pass" value=""><br>
                    <br>
                    <input class="btn btn-success" type="submit" value="Guardar Cambios">
                    <a class="btn btn-danger" href="<?php echo base_url('usuarioListado')?>">Cancelar</a>
                </form></center>
            <?php else: ?>
                <p>Usuario no encontrado.</p>
            <?php endif; ?>
            <br>
        </div>
        </div>
    </div>
</body>