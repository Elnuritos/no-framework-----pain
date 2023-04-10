<?php

require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/UserBook.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../utils/Response.php';

class UserController implements ControllerInterface
{
    public function index()
    {
        $users = User::getAll();
        Response::json($users);
    }

    public function show($id)
    {
        $user = User::getById($id);
        Response::json($user);
    }

    public function store($data)
    {
        $user = new User();
        $createdUser = $user->create($data);
        Response::json($createdUser);
    }

    public function update($id, $data)
    {
        $user = User::getById($id);
        $updatedUser = $user->update($data);
        Response::json($updatedUser);
    }

    public function destroy($id)
    {
        $user = User::getById($id);
        $user->delete();
        Response::json(['message' => 'User deleted']);
    }
    public function register()
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $users=new User();
    $userId = $users->register($username, $email, $password);
    
    if ($userId) {
        header("Location: /login");
        exit();
    } else {
        http_response_code(400);
        echo "Failed to register user";
    }
}

    
   
            public function login()
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $users = new User();
                    $user = $users->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header("Location: /authors_books");
                exit();
            } else {
                http_response_code(401);
                echo "Invalid email or password";
            }
        }
        public function view(){
            
            $allUserBooks = [];
        
            $users = (new User())->getAll();
            $userbooks= new UserBook();
            foreach ($users as $user) {
                $userBooks = $userbooks->getUserBooksByUserId($user['id']);
                $allUserBooks[$user['username']] = $userBooks;
            }
            
            
        return $allUserBooks;
        }
    
    

}
