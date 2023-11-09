<body class="gradient-custom">
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <center>
                <?php if (session()->getFlashdata('msg')): ?>
                    <div class="alert alert-warning">
                        <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif; ?>
                <h2>Lista de Usuarios</h2>
            </center>
            <br><br><br>
            <div class="table-responsive">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Tipo de Usuario</th>
                    <th>Baja</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td>
                            <?= $usuario['id_usuario'] ?>
                        </td>
                        <td>
                            <?= $usuario['nombre'] ?>
                        </td>
                        <td>
                            <?= $usuario['apellido'] ?>
                        </td>
                        <td>
                            <?= $usuario['usuario'] ?>
                        </td>
                        <td>
                            <?= $usuario['email'] ?>
                        </td>
                        
                        <?php if ($usuario['perfil_id'] == 1){ ?>
                        <td>
                            <a>Admin</a>
                        </td>
                        <?php }else{ ?>
                        <td>
                            <a>Cliente</a>
                        </td>
                        <?php } ?>
                        <td>
                            <?= $usuario['baja'] ?>
                        </td>
                        <td>
                            <a class="btn btn-success"
                                href="<?= base_url("usuarioeditar/{$usuario['id_usuario']}") ?>">Editar</a>
                            <?php if ($usuario['baja'] === 'NO'): ?>
                                <a class="btn btn-danger" href="<?= base_url("usuariobaja/{$usuario['id_usuario']}") ?>">Baja</a>
                            <?php else: ?>
                                <a class="btn btn-info text-white" href="<?= base_url("usuariobaja/{$usuario['id_usuario']}") ?>">Reactivar</a>
                            <?php endif; ?>
                        </td>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            </div>
        </div>
    </div>
</body>