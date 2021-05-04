<?php namespace App\Models;
use CodeIgniter\Model;

class ModProducts extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'specs';
    protected  $primaryKey = "spId";
    protected $returnType = 'array';
    protected $allowedFields = ['spName','spDate','adminId','productId'];

}