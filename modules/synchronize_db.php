<?php
require_once __DIR__ . "/../init/db.php";

class Db_sync extends Database {
    public function create_book_table() {
        $sql = <<<SQL
                    CREATE TABLE books (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    title VARCHAR(255) NOT NULL,
                    author VARCHAR(255) NOT NULL,
                    year YEAR NOT NULL,
                    annotation TEXT,
                    rating DECIMAL(3,1), -- např. 4.5
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                SQL;

        $this->query_pole($sql);
    }

    public function insert_data() {
       $base_insert = '[
                {
                    "title": "1984",
                    "author": "George Orwell",
                    "year": 1949,
                    "annotation": "Dystopický román o totalitní společnosti.",
                    "rating": 4.8
                },
                {
                    "title": "Brave New World",
                    "author": "Aldous Huxley",
                    "year": 1932,
                    "annotation": "Klasický sci-fi román o řízené společnosti.",
                    "rating": 4.5
                },
                {
                    "title": "Fahrenheit 451",
                    "author": "Ray Bradbury",
                    "year": 1953,
                    "annotation": "Příběh o společnosti, kde je zakázáno číst knihy.",
                    "rating": 4.3
                }
            ]';

        $books = json_decode($base_insert, true);

        if (!is_array($books)) {
            echo "Chybný JSON.";
            return;
        }

        foreach ($books as $book) {
            $this->query_pole(
                "INSERT INTO books (title, author, year, annotation, rating) VALUES (?, ?, ?, ?, ?)",
                [$book['title'], $book['author'], (int)$book['year'], $book['annotation'], $book['rating']]
            );
        }

    }
}
