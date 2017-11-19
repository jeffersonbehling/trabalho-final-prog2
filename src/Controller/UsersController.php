<?php
include_once 'ConnectionController.php';

class UsersController {

    private $conn;

    /**
     * ClientsController constructor.
     */
    public function __construct()
    {

    }

    public function login(User $user)
    {
       /* $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
        $stmt->bindValue(1, $user->getUsername());
        $stmt->bindValue(2, $user->getPass());
        $stmt->execute();

        if ($stmt->rowCount() != 0) {
            return true;
        }
        return false; */
       return true;
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

}