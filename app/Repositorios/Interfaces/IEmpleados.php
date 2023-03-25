<?php
namespace App\Repositorios\Interfaces;

Interface IEmpleados{
    
    public function getAll();
    public function getById($id);
    public function create($data);
    public function updateCategory($data, $id); 
    public function delete($id);
}