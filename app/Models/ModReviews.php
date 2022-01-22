<?php namespace App\Models;
use CodeIgniter\Model;

class ModReviews extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'reviews';
    protected  $primaryKey = "rId";
    protected $returnType = 'array';
    protected $allowedFields = ['rFirstName','rLastName','rEmail','rMessage','rStatus','rDate'];

}