<?php namespace App\Models;
use CodeIgniter\Model;

class ModSpecValues extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'spec_values';
    protected  $primaryKey = "spId";
    protected $returnType = 'array';
    protected $allowedFields = ['spvName','spvDate','adminId','specId'];

}