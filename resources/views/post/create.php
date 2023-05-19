<div class="container py-5">
    <div class="row">
        <h2>Crear nuevo Post</h2>
        <hr class="mb-5">

        <form action="/admin/post/store" method="post" id="form-post" enctype="multipart/form-data">

            <? include_once(URL_SERVIDOR . 'resources/views/post/form.php') ?>

            <div class="text-end">
                <button type="submit" class="btn btn-warning mt-4">Crear</button>
            </div>
        </form>
    </div>
</div>