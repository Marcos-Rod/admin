<?php

namespace App\Controllers;

use App\Functions;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        if (!AuthController::isLoggedIn()) {
            return $this->view('assets.login');
        }

        $model = new Category();
        $categories =  $model->all();

        $metas = [
            'title' => 'Admin',
            'description' => 'Administrador',
            'slug' => 'blog',
            'file' => 'category/index',
        ];

        return $this->view('assets.template', compact('metas', 'categories'));
    }

    public function store()
    {
        if (!AuthController::isLoggedIn()) {
            return $this->view('assets.login');
        }

        $model = new Category();
        $data = $_POST;

        if($model->where('slug', $data['slug'])->get()){
            return $this->redirect("/admin/category?status=duplicated");
        }
        
        $data['create_at'] = Functions::hoy();
        $data['update_at'] = Functions::hoy();

        $model->create($data);

        return $this->redirect('/admin/category');
    }

    public function edit($slug)
    {
        if (!AuthController::isLoggedIn()) {
            return $this->view('assets.login');
        }

        $model = new Category();
        $categories =  $model->all();

        $categoryEdit = $model->where('slug', $slug)->first();
        $categoryEdit['id'] = Functions::encrypt($categoryEdit['id'], 'category');
        $metas = [
            'title' => 'Admin',
            'description' => 'Administrador',
            'slug' => 'blog',
            'file' => 'category/index',
        ];

        return $this->view('assets.template', compact('metas', 'categories', 'categoryEdit'));
    }

    public function update(){
        if (!AuthController::isLoggedIn()) {
            return $this->view('assets.login');
        }
        
        $data = $_POST;
        $model = new Category;

        $match = $model->where('slug', $data['slug'])->where('id', '!=', Functions::decrypt($data['cid'], 'category'))->get();

        if(!empty($match)){
            return $this->redirect("/admin/category?status=duplicated");
        }
        
        $data['update_at'] = Functions::hoy();
        unset($data['cid']);
        
        

        $model->update(Functions::decrypt($_POST['cid'], 'category'), $data);

        return $this->redirect('/admin/category');
    }

    public function destroy($slug)
    {
        $model = new Category;
        $model->delete($slug, 'slug');

        return $this->redirect('/admin/category');
    }
}
