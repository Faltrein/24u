<?php

class Database
{
    protected PDO $pdo;

    public function __construct()
    {
        $host     = '127.0.0.1';
        $port     = '3306';
        $dbname   = '24u_test';
        $username = 'u24_user';
        $password = 'heslo123!';

        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

        try {
            $this->pdo = new PDO(
                $dsn,
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        } catch (PDOException $e) {
            die("Chyba připojení: " . htmlspecialchars($e->getMessage()));
        }
    }

    /**
     * query_pole - univerzální metoda pro SELECT/INSERT/UPDATE/DELETE dotazy
     *
     * @param string $sql SQL dotaz (s případnými placeholdery)
     * @param array $params Volitelné parametry
     * @return mixed Výsledné pole (SELECT) nebo true/false (ostatní)
     */
    public function query_pole(string $sql, array $params = []): mixed
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);

            // Pokud je SELECT dotaz, vracíme data
            if (preg_match('/^\s*(SELECT|SHOW|DESCRIBE|PRAGMA)/i', $sql)) {
                return $stmt->fetchAll();
            }

            // INSERT/UPDATE/DELETE/CREATE atd.
            return true;

        } catch (PDOException $e) {
            die("Chyba při dotazu: " . htmlspecialchars($e->getMessage()));
        }
    }
}