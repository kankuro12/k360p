<?php

namespace App\APIModels;

use App\model\admin\Category;

class ProductWrapper 
{
    public $title;
    public $products;
    public function  __construct($_title,$_products)
    {
        $this->title=$_title;
        $this->products=$_products;
        
    }
}