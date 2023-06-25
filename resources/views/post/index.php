<div class="container my-5">
    <div class="row">
        <div class="flex">
            <h2 class="float-start">Notas de Blog</h2>
            <div class="float-end">
                <a href="./post/create" class="btn btn-primary">Crear nueva entrada</a>
            </div>
        </div>
        <hr>

        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover w-100">
                    <thead>
                        <tr>
                            <th style="width: 70px;">#</th>
                            <th>Titulo</th>
                            <th>Slug</th>
                            <th style="width: 170px;">Acciones</th>
                            <!-- <th style="min-width: 170px;">Acciones</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $key => $post) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $post['name']?></td>
                                <td><a href="/post/<?= $post['slug']?>" target="_blank" rel="noopener noreferrer"><?= $post['slug']?></a></td>
                                <td class="text-center">
                                    <div class="d-flex gap-4 justify-content-center">
                                        <a href="<?= './post/'. $post['slug'] .'/edit'; ?>" class="btn btn-warning btn-sm">
                                            Editar
                                        </a>
                                        <form action="./post/<?= $post['slug'] ?>/delete/" method="post">
                                            <button type="submit" class="btn btn-danger btn-sm del-button">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>