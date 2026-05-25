<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Logowanie – Planaroo</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Planaroo</div>
            <ul class="nav-links">
                <li><a href="index.php?action=login" class="active"><i class="fas fa-sign-in-alt"></i> Logowanie</a></li>
                <li><a href="index.php?action=register"><i class="fas fa-user-plus"></i> Rejestracja</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="card wide-form" style="max-width:440px;margin:60px auto;">
            <h1 style="text-align:center;margin-bottom:24px;">
                <i class="fas fa-lock"></i> Logowanie
            </h1>

            {if isset($success_message)}
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {$success_message}
            </div>
            {/if}

            {if isset($error) && $error}
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {$error}
            </div>
            {/if}

            <form method="POST" action="index.php?action=login" class="form-horizontal">
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="twoj@email.pl" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-key"></i> Hasło</label>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="••••••••" required>
                </div>
                <div class="form-group" style="margin-top:20px;">
                    <button type="submit" class="btn btn-primary" style="width:100%;">
                        <i class="fas fa-sign-in-alt"></i> Zaloguj się
                    </button>
                </div>
            </form>

            <p style="text-align:center;margin-top:16px;">
                Nie masz konta?
                <a href="index.php?action=register"><i class="fas fa-user-plus"></i> Zarejestruj się</a>
            </p>
            <p style="text-align:center;font-size:0.85em;color:#888;margin-top:8px;">
                Domyślne konto: <strong>admin@planaroo.pl</strong> / <strong>password</strong>
            </p>
        </div>
    </div>
</body>
</html>
