<?php namespace App\Models;
use CodeIgniter\Model;

class ModAdmin extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'admin';
    protected  $primaryKey = "AId";
    protected $returnType = 'array';
    protected $useTimestamps = True;
    protected $allowedFields = ['aEmail','aPassword'];
    protected $createdField = 'aDate';
    protected $updatedField ='clientUpdate';
}