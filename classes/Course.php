<?php
require_once __DIR__ . "/../config/database.php";

class Course {
    private PDO $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function all(): array {
        return $this->db->query(
            "SELECT c.*, 
                    (SELECT COUNT(*) FROM registrations r WHERE r.course_id = c.id) AS registered
             FROM courses c ORDER BY c.id DESC"
        )->fetchAll();
    }

    public function find(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function register(int $userId, int $courseId): bool {
        $course = $this->find($courseId);
        if (!$course) return false;

        $check = $this->db->prepare("SELECT id FROM registrations WHERE user_id = ? AND course_id = ?");
        $check->execute([$userId, $courseId]);
        if ($check->fetch()) return false;

        $count = $this->db->prepare("SELECT COUNT(*) FROM registrations WHERE course_id = ?");
        $count->execute([$courseId]);
        if ((int)$count->fetchColumn() >= (int)$course["capacity"]) return false;

        $stmt = $this->db->prepare("INSERT INTO registrations (user_id, course_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $courseId]);
    }

    public function myCourses(int $userId): array {
        $stmt = $this->db->prepare(
            "SELECT c.*, r.registered_at
             FROM registrations r
             JOIN courses c ON c.id = r.course_id
             WHERE r.user_id = ?
             ORDER BY r.registered_at DESC"
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
