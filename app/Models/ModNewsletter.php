<?php namespace App\Models;
use CodeIgniter\Model;

class ModNewsletter extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'newsletter';
    protected  $primaryKey = "nId";
    protected $returnType = 'array';
    protected $allowedFields = ['nId','nEmail','nDate','nActive'];

}