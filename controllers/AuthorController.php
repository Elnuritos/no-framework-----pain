<?php

require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../models/Author.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../utils/Response.php';
class AuthorController implements ControllerInterface
{
    public function index()
    {
        $Author = Author::getAll();
        Response::json($Author);
    }

    public function show($id)
    {
        $Author = Author::getById($id);
        Response::json($Author);
    }

    public function store($data)
    {
        $Author = new Author();
        $createdAuthor = $Author->create($data);
        Response::json($createdAuthor);
    }

    public function update($id, $data)
    {
        $Author = Author::getById($id);
        $updatedAuthor = $Author->update($data);
        Response::json($updatedAuthor);
    }

    public function destroy($id)
    {
        $Author = Author::getById($id);
        $Author->delete();
        Response::json(['message' => 'Author deleted']);
    }
    public function view(){
        $authors = (new Author())->getAll();
        $books = (new Book())->getAll();

        $data=[
            "authors" => $authors,
            "books" => $books
        ];
    return $data;
    }
}
