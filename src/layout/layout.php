<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Katalog knih</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="public/css/main.css" rel="stylesheet" />
</head>
<body>
    <div class="page-wrapper">
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/24u/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/24u/knihovna">Knihovna</a>
                        </li>
                        <li>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn">
                                Login
                            </button>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>

            <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="loginModalLabel">Přihlášení</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zavřít"></button>
                    </div>
                    <div class="modal-body">
                        <form id="loginForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">Uživatelské jméno</label>
                            <input type="text" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Heslo</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Přihlásit</button>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <?php include __DIR__ . "/../pages/{$view}.php"; ?>
        </main>

        <footer>
            <div class="d-flex align-items-center justify-content-center pt-3">
                <p>&copy; <?= date('Y') ?> 24u komplexní úkol Václav Balek</p>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
    <script src="js/knihovna.js"></script>
</body>
</html>