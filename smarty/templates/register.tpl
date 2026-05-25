<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Rejestracja – Planaroo</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Planaroo</div>
            <ul class="nav-links">
                <li><a href="index.php?action=login"><i class="fas fa-sign-in-alt"></i> Logowanie</a></li>
                <li><a href="index.php?action=register" class="active"><i class="fas fa-user-plus"></i> Rejestracja</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="card wide-form" style="max-width:480px;margin:60px auto;">
            <h1 style="text-align:center;margin-bottom:24px;">
                <i class="fas fa-user-plus"></i> Rejestracja
            </h1>

            {if isset($error) && $error}
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {$error}
            </div>
            {/if}

            <form method="POST" action="index.php?action=register" class="form-horizontal">
                <div class="form-group">
                    <label for="username"><i class="fas fa-user"></i> Nazwa użytkownika</label>
                    <input type="text" id="username" name="username" class="form-control"
                           placeholder="Jan Kowalski" required autofocus>
                </div>
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="twoj@email.pl" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-key"></i> Hasło</label>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="Minimum 6 znaków" required>
                </div>
                <div class="form-group">
                    <label for="password2"><i class="fas fa-key"></i> Powtórz hasło</label>
                    <input type="password" id="password2" name="password2" class="form-control"
                           placeholder="••••••••" required>
                </div>
                <div class="form-group" style="margin-top:20px;">
                    <button type="submit" class="btn btn-primary" style="width:100%;">
                        <i class="fas fa-user-plus"></i> Utwórz konto
                    </button>
                </div>
            </form>

            <p style="text-align:center;margin-top:16px;">
                Masz już konto?
                <a href="index.php?action=login"><i class="fas fa-sign-in-alt"></i> Zaloguj się</a>
            </p>
        </div>
    </div>
</body>
</html>
