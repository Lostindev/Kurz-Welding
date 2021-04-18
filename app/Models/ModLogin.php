<?php namespace App\Models;
use CodeIgniter\Model;

class ModLogin extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'admin';
    protected  $primaryKey = "aId";
    protected $returnType = 'array';

}