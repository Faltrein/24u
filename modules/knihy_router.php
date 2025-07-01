<?php 
require_once "knihy_class.php";
session_start();
$knihy = new Knihy();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add_book':
            $title = trim($_POST['title'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $annotation = trim($_POST['annotation'] ?? '');
            $rating = filter_var($_POST['rating'] ?? '', FILTER_VALIDATE_FLOAT);
            $year = filter_var($_POST['year'] ?? '', FILTER_VALIDATE_INT);
            $currentYear = (int)date('Y');

            if (
                $title !== '' &&
                $author !== '' &&
                $annotation !== '' &&
                $rating !== false && $rating >= 0.0 && $rating <= 5.0 &&
                $year !== false && $year >= 1500 && $year <= $currentYear
            ) {
                if ($knihy->existence_titulu_knihy($title)) {
                    $_SESSION['error'] = "Kniha s názvem '$title' již existuje.";
                } else {
                    $success = $knihy->pridat_knihu($title, $author, $annotation, $rating, $year);
                    $_SESSION[$success ? 'message' : 'error'] = $success
                        ? "Kniha úspěšně přidána."
                        : "Chyba při přidávání knihy.";
                }
            } else {
                $_SESSION['error'] = "Neplatná data!";
            }

            header('Location: /u24/admin');
            exit;

        case 'import_books':
            $jsonPath = dirname(__DIR__) . '/books.json';
            if (!file_exists($jsonPath)) {
                $_SESSION['error'] = "Soubor books.json nebyl nalezen.";
                header('Location: /u24/admin');
                exit;
            }

            $jsonData = file_get_contents($jsonPath);
            $books = json_decode($jsonData, true);

            if (!is_array($books)) {
                $_SESSION['error'] = "Neplatný formát JSON dat.";
                header('Location: /u24/admin');
                exit;
            }

            $added = 0;
            $skipped = 0;

            foreach ($books as $book) {
                $title = trim($book['title'] ?? '');
                $author = trim($book['author'] ?? '');
                $annotation = trim($book['annotation'] ?? '');
                $rating = filter_var($book['rating'] ?? '', FILTER_VALIDATE_FLOAT);
                $year = filter_var($book['year'] ?? '', FILTER_VALIDATE_INT);
                $currentYear = (int)date('Y');

                if (
                    $title !== '' &&
                    $author !== '' &&
                    $annotation !== '' &&
                    $rating !== false && $rating >= 0.0 && $rating <= 5.0 &&
                    $year !== false && $year >= 1500 && $year <= $currentYear
                ) {
                    if (!$knihy->existence_titulu_knihy($title)) {
                        if ($knihy->pridat_knihu($title, $author, $annotation, $rating, $year)) {
                            $added++;
                        }
                    } else {
                        $skipped++;
                    }
                }
            }

            $_SESSION['message'] = "$added knih bylo importováno. Přeskočeno duplicit: $skipped.";
            header('Location: /u24/admin');
            exit;

        default:
            $_SESSION['error'] = "Neznámá akce.";
            header('Location: /u24/admin');
            exit;
    }
} else {
    $_SESSION['error'] = "Nepodporovaný HTTP method.";
    header('Location: /u24/admin');
    exit;
}
