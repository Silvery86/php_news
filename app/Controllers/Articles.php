<?php namespace App\Controllers;
 
 use App\Models\ArticlesModel;
 use CodeIgniter\Exceptions\PageNotFoundException;
 
class Articles extends BaseController
{
    
    // get all product
    public function index()
    {   
        $model = model(ArticlesModel::class);
        $data = [
            'article' => $model -> getArticles(),
            'page_title' => 'All Articles'
        ];
        return view('templates/header', $data)
        . view('pages/index')
        . view('templates/footer');
    }
 
    public function view($slug = null)
    {
        $model = model(ArticlesModel::class);

        $data['article'] = $model->getArticles($slug);

        if (empty($data['article'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['page_title'] = $data['article']['title'];

        return view('templates/header', $data)
            . view('pages/view')
            . view('templates/footer');
    }
    public function create()
    {
        helper('form');

        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', ['page_title' => 'Create a news article'])
                . view('pages/create')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['author', 'title', 'description', 'url', 'url_image', 'published_date', 'content']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'author' => 'required|max_length[255]|min_length[3]',
            'title' => 'required|max_length[255]|min_length[3]',
            'content'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return view('templates/header', ['page_title' => 'Create a news article'])
                . view('pages/create')
                . view('templates/footer');
        }
        $model = model(ArticlesModel::class);
        $data = [
            'author' => $this->request->getVar('author'),
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'url' => $this->request->getVar('url'),
            'url_image' => $this->request->getVar('url_image'),
            'published_date' => $this->request->getVar('published_date'),
            'content' => $this->request->getVar('content'),
            'slug'  => url_title($post['title'], '-', true),
        ];
        $model->save($data);
        
        return view('templates/header', ['page_title' => 'Create a news item'])
        . view('pages/success')
        . view('templates/footer');
    }
 
    // update from json
    public function upload_json_file()
    {
        $model = model(ArticlesModel::class);
        helper('filesystem');
        $file_path = APPPATH . 'Views/data/data.json';
        $json_data = file_get_contents($file_path);
        $data = json_decode($json_data,true);
        
        

        $inputdata = [
            'author'          => $this->request->getVar('author'),
            'title'           => $this->request->getVar('title'),
            'description'     => $this->request->getVar('description'),
            'url'             => $this->request->getVar('url'),
            'url_image'       => $this->request->getVar('url_image'),
            'published_date'  => $this->request->getVar('published_date'),
            'content'         => $this->request->getVar('content'),
            'slug'            => '',
        ];
        
        foreach ($data as $data_item) {
            echo "<pre>";
                     
                $inputdata['author'] = $data_item['author'];
                $inputdata['title'] = $data_item['title'];
                $inputdata['description'] = $data_item['description'];
                $inputdata['url'] = $data_item['url'];
                $inputdata['url_image'] = $data_item['urlToImage'];
                $inputdata['published_date'] = $data_item['publishedAt'];
                $inputdata['content'] = $data_item['content'];
                $inputdata['slug'] = url_title($data_item['title'], '-', true);
            

                $model->save($inputdata);
        }
       
        
        
       
      
       
        
        
        
        
        return view('pages/json',['data' => $data]);
    }
 
    // // delete product
    // public function delete($id = null)
    // {
    //     $model = new Articles();
    //     $data = $model->find($id);
    //     if($data){
    //         $model->delete($id);
    //         $response = [
    //             'status'   => 200,
    //             'error'    => null,
    //             'messages' => [
    //                 'success' => 'Data Deleted'
    //             ]
    //         ];
    //         return $this->respondDeleted($response);
    //     }else{
    //         return $this->failNotFound('No Data Found with id '.$id);
    //     }
         
    // }
 
}