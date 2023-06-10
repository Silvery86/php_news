<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class ArticlesModel extends Model
{
    protected $table = 'articles';
   
    protected $allowedFields = ['slug','author','title','description','url','url_image','publish_date','content'];
    public function getArticles($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}