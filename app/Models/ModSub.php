<?php namespace App\Models;
use CodeIgniter\Model;

class ModSub extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'sub_categories';
    protected  $primaryKey = "scId";
    protected $returnType = 'array';
    protected $allowedFields = ['scName','scDp','scDate','adminId','categoryId'];

}