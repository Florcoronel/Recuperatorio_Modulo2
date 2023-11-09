<?php
namespace App\Controllers;
Use App\Models\producto_Model;
use CodeIgniter\Controller;

class Producto_controller extends Controller{

    public function __construct(){
        helper(['form','url']);
    }

    public function create(){
        $dato['titulo']='Registro de Producto';
        echo view('front/header',$dato);
        echo view('front/navbar');
        echo view('back/producto/registroproducto');
        echo view('front/footer');
    }

    public function formValidation()
    {
        $input = $this->validate([
            'nombre' => 'required|min_length[3]',
            'descripcion' => 'required|min_length[3]',
            'categoria_id' => 'required|integer',
            'precio' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $formModel = new producto_Model();

        if (!$input) {
            $data['titulo'] = 'Registro de Producto';
            echo view('front/header', $data);
            echo view('front/navbar');
            echo view('back/producto/registroproducto', ['validation' => $this->validator]);
            echo view('front/footer');
        } else {
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'descripcion' => $this->request->getVar('descripcion'),
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'stock' => $this->request->getVar('stock')
            ]);

            session()->setFlashdata('success', 'Producto Registrado con Éxito');
            return redirect()->to(base_url('/productoListado'));
        }
    }


    public function ListadoProducto() {
        $formModel = new producto_Model();
        $data['titulo'] = 'Lista de Productos';
        $data['productos'] = $formModel->findAll(); // Obtener todos los productos
    
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('back/producto/producto_listado', $data); // Vista para mostrar la lista de productos
        echo view('front/footer');
    }

    public function editarproducto($id_producto) {
        $formModel = new producto_Model();
    
        // Obtener los datos del producto a editar
        $producto = $formModel->find($id_producto);
    
        if (empty($producto)) {
            return redirect()->to(base_url('productoListado')); // Redirigir o mostrar un mensaje de error
        }
    
        $data['titulo'] = 'Editar Producto';
        $data['produc'] = $producto;
    
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('back/producto/producto_editar', $data); // Vista para editar el producto
        echo view('front/footer');
    }

    public function update($id_producto) {
        $productoModel = new producto_Model();
    
        $input = $this->validate([
            'nombre' => 'required|min_length[3]',
            'descripcion' => 'required|min_length[3]',
            'categoria_id' => 'required|integer',
            'precio' => 'required|numeric',
            'stock' => 'required|integer'
        ]);
    
        if (!$input) {
            $data['titulo'] = 'Editar Producto';
            $data['producto'] = $productoModel->find($id_producto);
    
            echo view('front/header', $data);
            echo view('front/navbar');
            echo view('back/producto/producto_editar', ['validation' => $this->validator, 'producto' => $data['producto']]);
            echo view('front/footer');
        } else {
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'descripcion' => $this->request->getVar('descripcion'),
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'stock' => $this->request->getVar('stock')
            ];
    
            $productoModel->update($id_producto, $data);
    
            session()->setFlashdata('msg', 'Producto actualizado con éxito');
            return redirect()->to(base_url('productoListado'));
        }
    }

    public function baja($id) {
        $productoModel = new producto_Model(); // Reemplaza 'ProductoModel' con el nombre de tu modelo de productos
    
        // Obtén el producto que deseas dar de baja
        $producto = $productoModel->find($id);
    
        if ($producto) {
            // Verifica el estado actual de 'baja'
            if ($producto['baja'] === 'NO') {
                $data = ['baja' => 'SI']; // Cambia a 'SI' para dar de baja
            } else {
                $data = ['baja' => 'NO']; // Cambia a 'NO' para reactivar
            }
    
            $productoModel->update($id, $data);
    
            $message = ($data['baja'] === 'SI') ? 'Producto dado de baja con éxito' : 'Producto reactivado con éxito';
    
            session()->setFlashdata('msg', $message);
        } else {
            session()->setFlashdata('error', 'Producto no encontrado');
        }
    
        return redirect()->to(base_url('productoListado'));
    }
    


}