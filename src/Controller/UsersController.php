<?php
include_once 'ConnectionController.php';

class UsersController
{

    private $conn;

    /**
     * ClientsController constructor.
     */
    public function __construct()
    {
        $this->conn = connect();
    }

    public function login(User $user)
    {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = ? AND password = ? AND active = TRUE");
        $stmt->bindValue(1, $user->getUsername());
        $stmt->bindValue(2, $user->getPass());
        $stmt->execute();

        if ($stmt->rowCount() != 0) {
            session_start();
            $_SESSION['username'] = $user->getUsername();
            return true;
        }
        return false;
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['username']);
        $this->redirect('login');
    }

    public function redirect($url = '/trabalho-final-prog2')
    {
        header("Location: $url");
    }

    public function isLogged()
    {
        session_start();
        if (isset($_SESSION['username'])) {
            return true;
        }

        return false;
    }

    public function usernameAlready(User $user)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bindValue(1, $user->getUsername());
        $stmt->execute();

        if ($stmt->rowCount() != 0) {
            return true;
        }
        return false;
    }

    public function registry(User $user)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (name, username, password) VALUE (?, ?, ?)");
            $stmt->bindValue(1, $user->getName());
            $stmt->bindValue(2, $user->getUsername());
            $stmt->bindValue(3, $user->getPass());
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function search(User $user)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE users.name LIKE ?");
            $stmt->bindValue(1, '%'.$user->getName().'%');
            $stmt->execute();

            $users = [];
            while ($user = $stmt->fetch()) {
                $users[] = $user;
            }

            return $users;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function enable($id)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE users SET active = TRUE WHERE users.id = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
        return false;
    }

    public function disable($id)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE users SET active = FALSE WHERE users.id = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
        return false;
    }
}