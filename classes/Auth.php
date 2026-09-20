<?php
require_once __DIR__ . "/../config/database.php";

class Auth {
    private PDO $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function login(string $username, string $password): bool {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user"] = [
                "id" => $user["id"],
                "username" => $user["username"],
                "name" => $user["name"],
                "role" => $user["role"]
            ];
            return true;
        }
        return false;
    }

    public static function check(): bool {
        return isset($_SESSION["user"]);
    }

    public static function user(): ?array {
        return $_SESSION["user"] ?? null;
    }

    public static function requireLogin(): void {
        if (!self::check()) {
            header("Location: login.php");
            exit;
        }
    }

    public static function logout(): void {
        unset($_SESSION["user"]);
        session_destroy();
    }
}
