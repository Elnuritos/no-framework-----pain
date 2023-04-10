<?php

require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../models/Genre.php';
require_once __DIR__ . '/../utils/Response.php';
class GenreController implements ControllerInterface
{
    public function index()
    {
        $Genre = Genre::getAll();
        Response::json($Genre);
    }

    public function show($id)
    {
        $Genre = Genre::getById($id);
        Response::json($Genre);
    }

    public function store($data)
    {
        $Genre = new Genre();
        $createdGenre = $Genre->create($data);
        Response::json($createdGenre);
    }

    public function update($id, $data)
    {
        $Genre = Genre::getById($id);
        $updatedGenre = $Genre->update($data);
        Response::json($updatedGenre);
    }

    public function destroy($id)
    {
        $Genre = Genre::getById($id);
        $Genre->delete();
        Response::json(['message' => 'Genre deleted']);
    }
}
