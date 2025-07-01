<?php 
require_once __DIR__ . "/../../modules/knihy_class.php";
require_once __DIR__ . "/../../modules/synchronize_db.php";

$knihy = new Knihy();

if (!$knihy->existence_tabulky('books')) {
    $sync = new Db_sync();
    $sync->create_book_table();
    $sync->insert_data();
}

$knihovna = $knihy->knihy_get();

echo "
    <div class='container mt-4'>
        <div class='d-flex align-items-center justify-content-center'>
            <h2>Knihovna</h2>    
            <button type='button' id='print' class='ms-3 btn'>
                <i class='bi bi-printer fs-3'></i>
            </button>
        </div>
    
        <table class='table table-striped table-hover cursor-pointer'>
            <thead>
                <tr>
                    <th>Název</th>
                    <th>Autor</th>
                    <th>Rok</th>
                </tr>
            </thead>
            <tbody>
    ";

foreach ($knihovna as $index => $kniha) {
    $title = htmlspecialchars($kniha['title']);
    $author = htmlspecialchars($kniha['author']);
    $year = htmlspecialchars($kniha['year']);
    $annotation = htmlspecialchars($kniha['annotation'] ?? '—');
    $rating = htmlspecialchars($kniha['rating'] ?? '—');
    $created = htmlspecialchars($kniha['created_at']);

    echo "
        <tr data-bs-toggle='modal' data-bs-target='#modal$index'>
            <td>$title</td>
            <td>$author</td>
            <td>$year</td>
        </tr>

        <div class='modal fade' id='modal$index' tabindex='-1' aria-labelledby='modalLabel$index' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='modalLabel$index'>$title</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Zavřít'></button>
                    </div>
                    <div class='modal-body'>
                        <p><strong>Autor:</strong> $author</p>
                        <p><strong>Rok:</strong> $year</p>
                        <p><strong>Anotace:</strong> $annotation</p>
                        <p><strong>Hodnocení:</strong> $rating</p>
                        <p><strong>Vytvořeno:</strong> $created</p>
                    </div>
                </div>
            </div>
        </div>
    ";
}

echo "
        </tbody>
    </table>
</div>" . "\n";