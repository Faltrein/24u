<?php
require_once __DIR__ . "/../init/db.php";

class Knihy extends Database {

   public function existence_tabulky(string $tableName): bool {
        // Bez parametru, rovnou vložíme hodnotu do SQL
        $sql = "SHOW TABLES LIKE " . $this->pdo->quote($tableName);
        $result = $this->query_pole($sql);
        return !empty($result);
    }

    public function knihy_get(): array {
        $sql = "SELECT * FROM books";
        return $this->query_pole($sql);
    }

    public function existence_titulu_knihy(string $title): bool {
        $sql = "SELECT COUNT(*) AS pocet FROM books WHERE LOWER(TRIM(title)) = LOWER(TRIM(:title))";
        $rows = $this->query_pole($sql, [':title' => $title]);

        if (is_array($rows) && count($rows) > 0) {
            return (int)$rows[0]['pocet'] > 0;
        }

        return false;
    }

    public function pridat_knihu(string $title, string $author, string $annotation, float $rating, int $year): bool {
        $sql = "INSERT INTO books (title, author, annotation, rating, year) 
                VALUES (:title, :author, :annotation, :rating, :year)";
        return $this->query_pole($sql, [
            ':title' => $title,
            ':author' => $author,
            ':annotation' => $annotation,
            ':rating' => $rating,
            ':year' => $year
        ]);
    }
}
