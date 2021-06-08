<?php namespace App\Models;
use CodeIgniter\Model;

class ModProducts extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'products';
    protected  $primaryKey = "pId";
    protected $returnType = 'array';
    protected $allowedFields = ['pName','pDp','pDp2','pDp3','pDp4','pDate','pDescription','adminId','subCatId','categoryId','pPrice','pId'];

}