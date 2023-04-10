<?php

require_once __DIR__ . '/../interfaces/ModelInterface.php';
require_once __DIR__ . '/../utils/Database.php';

class UserBook implements ModelInterface
{
    public $id;
    public $user_id;
    public $book_id;
    public $start_date;
    public $due_date;
    public $returned;
    public $created_at;
    public $updated_at;


    
    public static function getAll()
    {
        $db = Database::getInstance();
        $result = $db->query("SELECT * FROM user_books");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = Database::getInstance();
        $result = $db->query("SELECT * FROM user_books WHERE id = :id");
        $userBookData = $result->fetch(PDO::FETCH_ASSOC);

        if (!$userBookData) {
            return null;
        }

        $userBook = new self();
        $userBook->id = $userBookData['id'];
        $userBook->user_id = $userBookData['user_id'];
        $userBook->book_id = $userBookData['book_id'];
        $userBook->start_date = $userBookData['start_date'];
        $userBook->due_date = $userBookData['due_date'];
        $userBook->returned = $userBookData['returned'];
        $userBook->created_at = $userBookData['created_at'];
        $userBook->updated_at = $userBookData['updated_at'];

        return $userBook;
    }

    public function create($data)
    {
        $db = Database::getInstance();

        $sql = "INSERT INTO user_books (user_id, book_id, start_date, due_date) VALUES (:user_id, :book_id, :start_date, :due_date)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':user_id' => $data['user_id'],
            ':book_id' => $data['book_id'],
            ':start_date' => $data['start_date'],
            ':due_date' => $data['due_date'],
            ':returned' => $data['returned'],
           
          
        ]);

        $this->id = $db->lastInsertId();
        $this->user_id = $data['user_id'];
        $this->book_id = $data['book_id'];
        $this->start_date = $data['start_date'];
        $this->due_date = $data['due_date'];
        $this->returned = $data['returned'];
     

        return $this;
    }

    public function update($data)
    {
        $db = Database::getInstance();

        $sql = "UPDATE user_books SET user_id = :user_id, book_id = :book_id, start_date = :start_date, due_date = :due_date, returned = :returned, updated_at = NOW() WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id' => $this->id,
            ':user_id' => $data['user_id'],
            ':book_id' => $data['book_id'],
            ':start_date' => $data['start_date'],
            ':due_date' => $data['due_date'],
            ':returned' => $data['returned'],
        ]);

        $this->user_id = $data['user_id'];
        $this->book_id = $data['book_id'];
        $this->start_date = $data['start_date'];
        $this->due_date = $data['due_date'];
        $this->returned = $data['returned'];
        $this->updated_at = new DateTime();

        return $this;
    }

    public function delete()
    {
        $db = Database::getInstance();
        $db->query(("DELETE FROM user_books WHERE id = :id"));
    }
    public function getUserBooksByUserId(int $userId): array
{   
    $db = Database::getInstance();
    $query = 'SELECT books.title, user_books.start_date, user_books.due_date, user_books.returned
              FROM user_books
              JOIN books ON user_books.book_id = books.id
              WHERE user_books.user_id = :userId';

    $stmt = $db->prepare($query);
    $stmt->execute(['userId' => $userId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

 
}
