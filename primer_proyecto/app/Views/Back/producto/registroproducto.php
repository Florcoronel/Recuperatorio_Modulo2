<body class="gradient-custom">
    <br>
    <div class="container mt-0 mb-0">
        <div class="card-header text-justify">
            <div class="row d-flex justify-content-center">
                <div class="card col-lg-3 bg-dark" style="width: 50%; color:white">
                <br>
                    <center>
                        <h4 >Registrar Producto</h4>
                    </center>


                    <?php $validation = \Config\Services::validation(); ?>
                    <form method="post" action="<?php echo base_url('/enviar-formu') ?>">
                        <?= csrf_field(); ?>
                        <?= csrf_field(); ?>
                        <?php if (!empty(session()->getFlashdata('fail'))): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                        <?php endif ?>
                        <?php if (!empty(session()->getFlashdata('success'))): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('success'); ?></div>
                        <?php endif ?>
                        <div class="card-body justify-content-center" media="(max-width:768px)">
                            <div class="form">
                                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                                <input name="nombre" type="text" class="form-control" placeholder="Nombre">

                                <?php if ($validation->getError('nombre')) { ?>
                                    <div class='alert alert-danger mt-2'>
                                        <?= $error = $validation->getError('nombre'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Descripcion</label>
                                <input name="descripcion" type="text" class="form-control" placeholder="Descripcion">

                                <?php if ($validation->getError('descripcion')) { ?>
                                    <div class='alert alert-danger mt-2'>
                                        <?= $error = $validation->getError('descripcion'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Categoria:</label>
                                <select class="form-control" name="categoria_id" id="categoria_id">
                                    <option value="1">Interno</option>
                                    <option value="2">Externo</option>
                                </select>
                                <?php if ($validation->getError('categoria_id')) { ?>
                                    <div class='alert alert-danger mt-2'>
                                        <?= $error = $validation->getError('categoria_id'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Precio</label>
                                <input name="precio" type="number" class="form-control" placeholder="Precio">

                                <?php if ($validation->getError('precio')) { ?>
                                    <div class='alert alert-danger mt-2'>
                                        <?= $error = $validation->getError('precio'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Stock</label>
                                <input name="stock" type="number" class="form-control" placeholder="Stock">

                                <?php if ($validation->getError('stock')) { ?>
                                    <div class='alert alert-danger mt-2'>
                                        <?= $error = $validation->getError('stock'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <input type="submit" value="Guardar" class="btn btn-success">
                            <input type="reset" value="Cancelar" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>