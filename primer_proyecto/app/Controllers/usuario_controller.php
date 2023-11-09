<?php
namespace App\Controllers;
Use App\Models\usuario_Model;
use CodeIgniter\Controller;

class Usuario_controller extends Controller{
    public function __construct(){
        helper(['form','url']);
    }

    public function create(){
        $dato['titulo']='Registro';
        echo view('front/header',$dato);
        echo view('front/navbar');
        echo view('back/usuario/registro');
        echo view('front/footer');
    }

    public function formValidation(){
        $input = $this->validate([
            'nombre' => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'usuario' => 'required|min_length[3]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass' => 'required|min_length[3]|max_length[10]'
        ],
    );
    $formModel = new usuario_Model();

    if (!$input){
        $data['titulo']='Registro';
        echo view('front/header',$data);
        echo view('front/navbar');
        echo view('back/usuario/registro',['validation' => $this->validator]);
        echo view('front/footer');
    }else{
        $formModel->save([
            'nombre' => $this->request->getVar('nombre'),
            'apellido' => $this->request->getVar('apellido'),
            'usuario' => $this->request->getVar('usuario'),
            'email' => $this->request->getVar('email'),
            'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
        ]);

        session()->setFlashdata('success','Usuario Registrado con Exito');
        return redirect()->to(base_url('/registro'));
    }
    }

    public function ListadoUsuario() {
        $formModel = new usuario_Model();
        $data['titulo'] = 'Lista de Usuarios';
        $data['usuarios'] = $formModel->findAll(); // Obtener todos los usuarios
    
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('back/usuario/usuario_listado', $data); // Vista para mostrar la lista de usuarios
        echo view('front/footer');
    }
    
    public function editarusuario($id) {
        $formModel = new usuario_Model();
    
        // Obtener los datos del usuario a editar
        $user = $formModel->find($id);
    
        if (empty($user)) {
            return redirect()->to(base_url('usuarioListado')); // Redirigir o mostrar un mensaje de error
        }
    
        $data['titulo'] = 'Editar Usuario';
        $data['user'] = $user;
    
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('back/usuario/usuario_editar', $data); // Vista para editar el usuario
        echo view('front/footer');
    }

    public function update($id) {
        $formModel = new usuario_Model();
    
        $input = $this->validate([
            'nombre' => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'usuario' => 'required|min_length[3]',
            'perfil_id'=> 'required|in_list[1,2]',
            'email' => "required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email,id_usuario,{$id}]",
            'pass' => 'permit_empty|min_length[3]|max_length[10]'
        ]);
    
        if (!$input) {
            $data['titulo'] = 'Editar Usuario';
            $data['user'] = $formModel->find($id); // Recuperar los datos del usuario nuevamente
    
            echo view('front/header', $data);
            echo view('front/navbar');
            echo view('back/usuario/usuario_editar', ['validation' => $this->validator, 'user' => $data['user']]);
            echo view('front/footer');
        } else {
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'usuario' => $this->request->getVar('usuario'),
                'perfil_id'=> $this->request->getVar('perfil_id'),
                'email' => $this->request->getVar('email')
            ];
    
            // Verificar si se está actualizando la contraseña
            $password = $this->request->getVar('pass');
            if (!empty($password)) {
                $data['pass'] = password_hash($password, PASSWORD_DEFAULT);
            }
    
            $formModel->update($id, $data);
    
            session()->setFlashdata('msg', 'Usuario actualizado con éxito');
            return redirect()->to(base_url('/usuarioListado'));
            
        }
    }
    
    public function baja($id) {
        $formModel = new usuario_Model();
    
        // Obtener los datos del usuario a "dar de baja"
        $user = $formModel->find($id);
    
        if (empty($user)) {
            return redirect()->to(base_url('/usuarioListado')); // Redirigir o mostrar un mensaje de error
        }
    
        // Verificar el valor actual del campo "baja"
        if ($user['baja'] === 'SI') {
            // Si ya estaba en "SI", cambiarlo a "NO"
            $data = ['baja' => 'NO'];
        } else {
            // Si no estaba en "SI", cambiarlo a "SI"
            $data = ['baja' => 'SI'];
        }
    
        $formModel->update($id, $data);
        $message = ($data['baja'] === 'SI') ? 'Usuario dado de baja con éxito' : 'Usuario reactivado con éxito';
        session()->setFlashdata('msg', $message);
        return redirect()->to(base_url('/usuarioListado'));
    }
    
    
}