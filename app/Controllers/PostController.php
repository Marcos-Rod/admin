<?php

namespace App\Controllers;

use App\Functions;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        if (!AuthController::isLoggedIn()) {
            return $this->view('assets.login');
        }

        $model = new Post();
        $posts =  $model->all();

        $metas = [
            'title' => 'Admin',
            'description' => 'Administrador',
            'slug' => 'blog',
            'file' => 'post/index',
        ];

        return $this->view('assets.template', compact('metas', 'posts'));
    }

    public function create()
    {
        if (!AuthController::isLoggedIn()) {
            return $this->view('assets.login');
        }

        $modelCategory = new Category;
        $categories = $modelCategory->where('status', 2)->get();

        $metas = [
            'title' => 'Admin',
            'description' => 'Administrador',
            'slug' => 'blog',
            'file' => 'post/create',
        ];
        return $this->view('assets.template', compact('metas', 'categories'));
    }

    public function store()
    {
        if (!AuthController::isLoggedIn()) {
            return $this->view('assets.login');
        }

        $data = $_POST;
        $data['create_at'] = Functions::hoy();
        $data['update_at'] = Functions::hoy();

        $model = new Post;
        $post = $model->create($data);

        if (isset($_FILES) && !empty($_FILES['file']['name'])) {
            $file = Functions::uploadFile($_FILES['file'], URL_SERVIDOR . '../userfiles/images/posts/');

            $model->images('posts/' . $file, $post['id']);
        }

        return $this->redirect("/" . FOLDER_ADMIN . "/post/{$post['slug']}/edit");
    }

    public function edit($slug)
    {
        if (!AuthController::isLoggedIn()) {
            return $this->view('assets.login');
        }

        $metas = [
            'title' => 'Admin',
            'description' => 'Administrador',
            'slug' => 'blog',
            'file' => 'post/edit',
        ];

        $model = new Post();
        $modelCategory = new Category();
        $modelImage = new Image();
        $post = $model->where('slug', $slug)->first();
        $post['id'] = Functions::encrypt($post['id'], 'post');
        $categories = $modelCategory->where('status', 2)->get();

        $image = $modelImage->where('imageable_id', Functions::decrypt($post['id'], 'post'))->first();
        if ($image) {
            $post['image'] = $image;
        }

        return $this->view('assets.template', compact('metas', 'post', 'categories'));
    }

    public function update()
    {
        if (!AuthController::isLoggedIn()) {
            return $this->view('assets.login');
        }

        $model = new Post();
        $data = $_POST;
        $data['update_at'] = Functions::hoy();
        $data['pid'] = Functions::decrypt($_POST['pid'], 'post');

        $post = $model->update($data['pid'], $data);

        if (isset($_FILES) && !empty($_FILES['file']['name'])) {
            $file = Functions::uploadFile($_FILES['file'], URL_SERVIDOR . '../userfiles/images/posts/');
            $modelImage = new Image;
            $image = $modelImage->where('imageable_id', $post['id'])->first();

            if ($image) {
                $dataImage = [
                    'url' => 'posts/' . $file,
                    'update_at' => Functions::hoy()
                ];
                $modelImage->updateImage($image['id'], $dataImage);
            } else {
                $model->images('posts/' . $file, $post['id']);
            }
        }

        return $this->redirect("/" . FOLDER_ADMIN . "/post/{$data['slug']}/edit");
    }

    public function delete($slug){
        $model = new Post;

        $model->delete($slug, 'slug');
        return $this->redirect('/' . FOLDER_ADMIN . '/post');
    }
}
