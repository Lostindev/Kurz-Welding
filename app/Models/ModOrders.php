<?php namespace App\Models;
use CodeIgniter\Model;

class ModOrders extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'orders';
    protected  $primaryKey = "oId";
    protected $returnType = 'array';
    protected $allowedFields = ['oStatus','tempId','billingCompany','billingCountry','billingAddress','billingApt','billingCity','billingZip','billingPhone','billingState','billingFirst','billingLast','shippingFirst','shippingLast','shippingCountry','shippingAddress','shippingApt','shippingCity','shippingState','shippingZip','shippingPhone','billingEmail','billingNotes','oProducts','oDate','userId','oPrice'];

}