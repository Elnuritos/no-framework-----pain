<?php

require_once __DIR__ . '/../interfaces/ModelInterface.php';
require_once __DIR__ . '/../utils/Database.php';

class Book implements ModelInterface
{
    public $id;
    public $title;
    public $author_id;
    public $genre_id;
    public $stock;
    public $created_at;
    public $updated_at;


    
    public static function getAll()
    {
        $db = Database::getInstance();
        $result = $db->query("SELECT * FROM books");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = Database::getInstance();
        $result = $db->query("SELECT * FROM books WHERE id = :id");
        $BookData = $result->fetch(PDO::FETCH_ASSOC);

        if (!$BookData) {
            return null;
        }

        $Book = new self();
        $Book->id = $BookData['id'];
        $Book->title = $BookData['title'];
        $Book->author_id = $BookData['author_id'];
        $Book->genre_id = $BookData['genre_id'];
        $Book->stock = $BookData['stock'];
        $Book->created_at = $BookData['created_at'];
        $Book->updated_at = $BookData['updated_at'];

        return $Book;
    }

    public function create($data)
    {
        $db = Database::getInstance();

        $sql = "INSERT INTO books (title, author_id, genre_id, stock) VALUES (:title, :author_id, :genre_id, :stock)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':title' => $data['title'],
            ':author_id' => $data['author_id'],
            ':genre_id' => $data['genre_id'],
            ':stock' => $data['stock'],
            
           
          
        ]);

        $this->id = $db->lastInsertId();
        $this->title = $data['title'];
        $this->author_id = $data['author_id'];
        $this->genre_id = $data['genre_id'];
        $this->stock = $data['stock'];
        
     

        return $this;
    }

    public function update($data)
    {
        $db = Database::getInstance();

        $sql = "UPDATE books SET title = :title, author_id = :author_id, genre_id = :genre_id,stock = :stock, updated_at = NOW() WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id' => $this->id,
            ':title' => $data['title'],
            ':author_id' => $data['author_id'],
            ':genre_id' => $data['genre_id'],
            ':stock' => $data['stock'],
        ]);

        $this->id = $db->lastInsertId();
        $this->title = $data['title'];
        $this->author_id = $data['author_id'];
        $this->genre_id = $data['genre_id'];
        $this->stock = $data['stock'];
        $this->updated_at = new DateTime();

        return $this;
    }

    public function delete()
    {
        $db = Database::getInstance();
        $db->query(("DELETE FROM books WHERE id = :id"));
    }

    public function getBooksByAuthorId(int $authorId)
{
    $db = Database::getInstance();
    $query = "SELECT * FROM books WHERE author_id = :author_id";
    $statement = $db->prepare($query);
    $statement->execute([':author_id' => $authorId]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

}
