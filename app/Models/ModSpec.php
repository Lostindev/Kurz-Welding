<?php namespace App\Models;
use CodeIgniter\Model;

class ModSpec extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'specs';
    protected  $primaryKey = "spId";
    protected $returnType = 'array';
    protected $allowedFields = ['spId','spName','spDate','adminId','productId'];

}