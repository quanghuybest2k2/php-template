<?php

namespace App\repositories;

use App\models\User;
use Config\Database;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class UserRepository
{
    public function findById($id): ?User
    {
        $stmt = Database::getPdo()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return $row ? new User($row['id'], $row['name'], $row['email'], $row['created_at']) : null;
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = Database::getPdo()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch();

        return $row ? new User($row['id'], $row['name'], $row['email'], $row['created_at']) : null;
    }

    /**
     * @param int $perPage number of items per page
     * @param int $page current page
     * @param string $pageName page name in query string, example: ?page=1
     * @param bool $paginate = true is paginate, false is not paginate
     * @return array|LengthAwarePaginator
     */
    public function findAll(int $page = 1, int $perPage = 10, string $pageName = 'page', bool $paginate = true): array|LengthAwarePaginator
    {
        $pdo = Database::getPdo();

        // If not paginate, return all data
        if (!$paginate) {
            $stmt = $pdo->prepare("SELECT * FROM users");
            $stmt->execute();
            $rows = $stmt->fetchAll();

            $users = [];
            foreach ($rows as $row) {
                $users[] = new User($row['id'], $row['name'], $row['email'], $row['created_at']);
            }

            return $users;
        }

        // Handle pagination
        $page = $page ?: Paginator::resolveCurrentPage($pageName);

        // Get total number of records
        $countStmt = $pdo->prepare("SELECT COUNT(*) as total FROM users");
        $countStmt->execute();
        $total = (int) $countStmt->fetch()['total'];

        // Get data for the current page
        $offset = ($page - 1) * $perPage;
        $stmt = $pdo->prepare("SELECT * FROM users LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $perPage, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        // Convert array to User objects
        $users = [];
        foreach ($rows as $row) {
            $users[] = new User($row['id'], $row['name'], $row['email'], $row['created_at']);
        }

        return new LengthAwarePaginator(
            $users,
            $total,
            $perPage,
            $page,
            [
                'path' => '/users',
                'pageName' => $pageName,
                'query' => ['perPage' => $perPage],
            ]
        );
    }

    public function create(User $user): User
    {
        $stmt = Database::getPdo()->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$user->name, $user->email, $user->password]);
        $user->id = Database::getPdo()->lastInsertId();
        return $user;
    }
}
