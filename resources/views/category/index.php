<div class="container my-5">
    <div class="row">
            <h2 class="float-start">Listado de Categorias</h2>
        <hr class="mb-5">

        <div class="col-lg-7">
            <? if (isset($_GET['status']) && $_GET['status'] == 'duplicated') : ?>
                <div class="alert alert-danger" role="alert">
                    Esta categor&iacute;a ya existe
                </div>
            <? endif ?>
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
                        <?php foreach ($categories as $key => $category) : ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $category['name'] ?></td>
                                <td><a href="/post/<?= $category['slug'] ?>" target="_blank" rel="noopener noreferrer"><?= $category['slug'] ?></a></td>
                                <td class="text-center">
                                    <div class="d-flex gap-4 justify-content-center">
                                        <a href="<?= '/admin/category/' . $category['slug'] . '/edit'; ?>" class="btn btn-warning btn-sm">
                                            Editar
                                        </a>
                                        <form action="/admin/category/<?= $category['slug'] ?>/delete/" method="post">
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
        <div class="col-lg-5">
            <h4>Crear nueva categor&iacute;a</h4>

            <form action="/admin/category/<?= (!isset($categoryEdit)) ? 'store' : 'update' ?>" method="post" id="frm-tags">
                <div class="mb-3">
                    <label for="name" class="fw-bold">Titulo de la etiqueta</label>
                    <span id="slug-span" class="d-none"></span>
                    <input type="text" name="name" id="name" class="form-control sluggeable" value="<?= $categoryEdit['name'] ?? '' ?>">

                </div>

                <div class="mb-3">
                    <label for="slug" class="fw-bold">slug</label>
                    <input type="text" name="slug" id="slug" value="<?= $categoryEdit['slug'] ?? '' ?>" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="status" class="fw-bold">Titulo de la etiqueta</label>
                    <select name="status" id="status" class="form-select">
                        <option value="1" <?= (isset($categoryEdit['status']) && $categoryEdit['status'] == 1) ? 'selected' : '' ?>>Borrador</option>
                        <option value="2" <?= (isset($categoryEdit['status']) && $categoryEdit['status'] == 2) ? 'selected' : '' ?>>Publicado</option>
                    </select>
                </div>

                <div class="text-end">
                    <? if (isset($categoryEdit)) : ?>
                        <input type="hidden" name="cid" value="<?= $categoryEdit['id'] ?? '' ?>">
                    <? endif ?>
                    <button type="submit" class="btn btn-warning"><?= (!isset($categoryEdit)) ? 'Crear' : 'Actualizar' ?></button>
                </div>
            </form>
        </div>
    </div>
</div>