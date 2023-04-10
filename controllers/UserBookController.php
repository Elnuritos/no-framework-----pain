<?php

require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../models/UserBook.php';
require_once __DIR__ . '/../utils/Response.php';
class UserBookController implements ControllerInterface
{
    public function index()
    {
        $UserBook = UserBook::getAll();
        Response::json($UserBook);
    }

    public function show($id)
    {
        $UserBook = UserBook::getById($id);
        Response::json($UserBook);
    }

    public function store($data)
    {
        $UserBook = new UserBook();
        $createdUserBook = $UserBook->create($data);
        Response::json($createdUserBook);
    }

    public function update($id, $data)
    {
        $UserBook = UserBook::getById($id);
        $updatedUserBook = $UserBook->update($data);
        Response::json($updatedUserBook);
    }

    public function destroy($id)
    {
        $UserBook = UserBook::getById($id);
        $UserBook->delete();
        Response::json(['message' => 'UserBook deleted']);
    }
}
