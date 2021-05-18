<?php namespace App\Models;
use CodeIgniter\Model;

class ModShipping extends Model
{
    protected $DBGroup = 'default';

    protected $table = 's_address';
    protected  $primaryKey = "sId";
    protected $returnType = 'array';
    protected $allowedFields = ['sFirstName','sLastName','sCompany','sAddress','sApt','sZip','sCity','sCountry','sState','userId'];

}