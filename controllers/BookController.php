<?php

require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../utils/Response.php';
class BookController implements ControllerInterface
{
    public function index()
    {
        $Book = Book::getAll();
        Response::json($Book);
    }

    public function show($id)
    {
        $Book = Book::getById($id);
        Response::json($Book);
    }

    public function store($data)
    {
        $Book = new Book();
        $createdBook = $Book->create($data);
        Response::json($createdBook);
    }

    public function update($id, $data)
    {
        $Book = Book::getById($id);
        $updatedBook = $Book->update($data);
        Response::json($updatedBook);
    }

    public function destroy($id)
    {
        $Book = Book::getById($id);
        $Book->delete();
        Response::json(['message' => 'Book deleted']);
    }
    public function getBooksByAuthorId(int $authorId)
{
    $bk=new Book();
    $book=$bk->getBooksByAuthorId($authorId);
    return $book;
}

}
