<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index($slug = "dashboard")
    {
        
        if (!AuthController::isLoggedIn()) {
            return $this->view('assets.login');
        }

        $metas = [
            'title' => 'Admin',
            'description' => 'Administrador',
            'slug' => $slug,
            'file' => 'dashboard',
        ];

        return $this->view('assets.template', compact('metas'));
        
    }

    
}
