<?php namespace App\Models;
use CodeIgniter\Model;

class ModGallery extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'gallery';
    protected  $primaryKey = "gId";
    protected $returnType = 'array';
    protected $allowedFields = ['gName','gDp','gDate','gDescription','adminId','gDp2','categoryName','gDp3','gDp4'];

}