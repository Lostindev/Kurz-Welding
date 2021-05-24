<?php namespace App\Models;
use CodeIgniter\Model;

class ModCustomOrders extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'custom_orders';
    protected  $primaryKey = "coId";
    protected $returnType = 'array';
    protected $allowedFields = ['coFirst','coLast','coEmail','coPhone','coSize','coMessage','coDp','coDp2','coUser'];

}