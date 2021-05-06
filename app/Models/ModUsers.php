<?php namespace App\Models;
use CodeIgniter\Model;

class ModUsers extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'users';
    protected  $primaryKey = "uId";
    protected $returnType = 'array';
    protected $allowedFields = ['firstName','lastName','email','password','link','date','status'];

}