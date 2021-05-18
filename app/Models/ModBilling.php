<?php namespace App\Models;
use CodeIgniter\Model;

class ModBilling extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'ub_address';
    protected  $primaryKey = "bId";
    protected $returnType = 'array';
    protected $allowedFields = ['bFirstName','bLastName','bCompany','bAddress','bApt','bZip','bCity','bCountry','bState','userId'];

}