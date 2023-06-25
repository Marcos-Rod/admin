<div class="container py-5">
    <div class="row">
        <h2>Editando Post</h2>
        <hr>

        <form action="/<?= FOLDER_ADMIN ?>/post/<?= $post['slug'] ?>/update" method="post" id="form-post" enctype="multipart/form-data">
            <? include_once(URL_SERVIDOR . 'resources/views/post/form.php') ?>
            <input type="hidden" name="pid" value="<?=$post['id']?>">
            <div class="text-end">
                <button type="submit" class="btn btn-warning mt-4">Editar</button>
            </div>
        </form>
    </div>
</div>