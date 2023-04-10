<?php 
interface ModelInterface
{
    public static function getAll();
    public static function getById($id);
    public function create($data);
    public function update($data);
    public function delete();
}
