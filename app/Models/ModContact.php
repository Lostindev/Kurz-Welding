<?php namespace App\Models;
use CodeIgniter\Model;

class ModContact extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'contact';
    protected  $primaryKey = "contactId";
    protected $returnType = 'array';
    protected $allowedFields = ['contactName','contactComment','contactDate','contactEmail'];

}