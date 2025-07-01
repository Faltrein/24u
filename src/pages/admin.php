<?php
session_start();

$message = $_SESSION['message'] ?? '';
$error = $_SESSION['error'] ?? '';

unset($_SESSION['message'], $_SESSION['error']);
?>
<div class='container'>
    <h1>Admin - správa knih</h1>

    <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
        <h2>Přidat novou knihu</h2>
        <form method="POST" action="/24u/modules/knihy_router.php" novalidate>
            <input type="hidden" name="action" value="add_book" />
            <div class="mb-3">
                <label for="title" class="form-label">Název knihy</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Autor</label>
                <input type="text" name="author" id="author" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="annotation" class="form-label">Annotation</label>
                <input type="text" name="annotation" id="annotation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="number" name="rating" id="rating" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Rok vydání</label>
                <input type="number" name="year" id="year" class="form-control" min="1500" max="<?= date('Y') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Přidat knihu</button>
        </form>

        <hr>

        <h2>Import knih ze souboru books.json</h2>
        <form method="POST" action="/24u/modules/knihy_router.php" >
            <input type="hidden" name="action" value="import_books" />
            <button type="submit" class="btn btn-secondary">Importovat knihy</button>
        </form>

        <hr>
    </div>