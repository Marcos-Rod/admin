<div class="row">
    <div class="col-lg-9">
        <div class="row mb-4">
            <div class="col-lg-5 text-center">
                <label for="img_destacada" class="text-start w-100 fw-bold">Imagen destacada</label>
                <div class="img-destacada my-4 mx-auto">
                    <img src="<?=(isset($post['image'])) ? '/userfiles/images/' . $post['image']['url'] : '/admin/resources/image/default-1200-x-800.jpg'?>" alt="Destacada" id="picture">
                </div>
                <input type="file" name="file" id="file" class="form-control-file" />
            </div>
            <div class="col-lg-7">
                <label for="name" class="fw-bold mb-1 w-100">Titulo del post</label>
                <span id="slug-span" class="fw-normal text-secondary"></span>
                <input type="text" name="name" id="name" class="form-control sluggeable" value="<?=$post['name'] ?? null?>">

                <input type="hidden" name="slug" id="slug" value="<?=$post['slug'] ?? null?>">
                <input type="hidden" name="aid" id="aid" value="<?= $_SESSION['admin_id'] ?>">

                <label for="description" class="fw-bold mb-2">Descripci&oacute;n (extracto)</label>
                <textarea name="description" id="description" rows="7" class="form-control"><?=$post['description'] ?? null?></textarea>
            </div>
        </div>

        <div class="row">
            <textarea name="body" id="body"><?=$post['body'] ?? null?></textarea>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="form-group mb-4">
            <p class="fw-bold mb-1">Estatus</p>
            <select name="status" id="status" class="form-select">
                <option value="1" <?=(isset($post) && $post['status'] == 1) ? 'selected' : null ?>>Borrador</option>
                <option value="2" <?=(isset($post) && $post['status'] == 2) ? 'selected' : null ?>>Publicado</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <p class="fw-bold mb-1">Keywords</p>
            <p class="mb-0 text-muted"><small>Separadas por ,</small></p>
            <textarea name="keywords" id="keywords" rows="4" class="form-control" placeholder="Separadas por ,"><?=$post['keywords'] ?? null?></textarea>
        </div>
        <div class="form-group">
            <p class="fw-bold mb-1">Categor&iacute;a</p>

            <select name="category_id" id="category" class="form-select">
                <? foreach ($categories as $category) : ?>
                    <option value="<?=$category['id']?>" <?=(isset($post) && $post['category_id'] == $category['id']) ? 'selected' : null ?> ><?=$category['name']?></option>
                <? endforeach ?>
            </select>
        </div>
    </div>
</div>