<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Pages extends BaseController
{
    public function index()
    {
        return view('pages/home.php');
    }

    public function view($page = '')
    {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }

        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => ucfirst($page),
        ];
       
        return view('templates/header', $data)
            . view('pages/' . $page)
            . view('templates/footer');
    }
}