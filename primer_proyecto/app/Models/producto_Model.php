<?php
namespace App\Models;
use CodeIgniter\Model;

class producto_Model extends Model{

    protected $table='productos';
    protected $primaryKey='id_producto';

    protected $allowedFields = [
        'nombre',
        'descripcion',
        'categoria_id',
        'precio',
        'stock',
        'baja',
        'created_at'
    ];
}