<?php namespace App\Models;
use CodeIgniter\Model;

class ModAdmin extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'categories';
    protected  $primaryKey = "aId";
    protected $returnType = 'array';
    protected $allowedFields = ['cName','cDp','cDate','adminId'];

}