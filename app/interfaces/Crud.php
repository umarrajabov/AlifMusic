<?php


namespace app\interfaces;


interface Crud
{
    public function getAll();
    public function getById($id);
    public function save();
    public function delete($id);
    public function update($id);
}