<body class="gradient-custom">
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <center>
                <?php if (session()->getFlashdata('msg')): ?>
                    <div class="alert alert-warning">
                        <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif; ?>
                <h2>Lista de Productos</h2>
            </center>
            <br>
            <div>
            <a class="btn btn-info text-white" href="<?= base_url('registrar') ?>">Agregar Producto</a>
            </div>
            <br><br>
            <div class="table-responsive">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Baja</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td>
                            <?= $producto['id_producto'] ?>
                        </td>
                        <td>
                            <?= $producto['nombre'] ?>
                        </td>
                        <td>
                            <?= $producto['descripcion'] ?>
                        </td>
                        <?php if($producto['categoria_id'] == 1){?>
                        <td>
                            <a>Interno</a>
                        </td>
                        <?php }else{?>
                            <td>
                            <a>Externo</a>
                            </td>
                            <?php } ?>
                        <td>
                            <?= $producto['stock'] ?>
                        </td>
                        <td>
                            <?= $producto['precio'] ?>
                        </td>
                        <td>
                            <?= $producto['baja'] ?>
                        </td>
                        <td>
                            <a class="btn btn-success"
                                href="<?= base_url("productoeditar/{$producto['id_producto']}") ?>">Editar</a>
                            <?php if ($producto['baja'] === 'NO'): ?>
                                <a class="btn btn-danger" href="<?= base_url("productosbaja/{$producto['id_producto']}") ?>">Baja</a>
                            <?php else: ?>
                                <a class="btn btn-info text-white" href="<?= base_url("productosbaja/{$producto['id_producto']}") ?>">Reactivar</a>
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