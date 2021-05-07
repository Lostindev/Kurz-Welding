<?php namespace App\Models;
use CodeIgniter\Model;

class ModProducts extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'products';
    protected  $primaryKey = "pId";
    protected $returnType = 'array';
    protected $allowedFields = ['pName','pDp','pDate','pDescription','adminId','subCatId','categoryId','pPrice'];

}