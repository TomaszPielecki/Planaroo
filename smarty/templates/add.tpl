<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Dodaj nowy projekt</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Zarządzanie Projektami</div>
            <ul class="nav-links">
                <li><a href="index.php"><i class="fas fa-home"></i> Strona główna</a></li>
                <li><a href="index.php?action=add" class="active"><i class="fas fa-plus"></i> Nowy projekt</a></li>
                <li><a href="index.php?action=calendar"><i class="fas fa-calendar-alt"></i> Kalendarz</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1><i class="fas fa-plus-circle"></i> Dodaj nowy projekt</h1>
        
        <div class="card">
            <form method="POST" action="index.php?action=add" class="form-horizontal">
                <div class="form-group">
                    <label for="nazwa"><i class="fas fa-tag"></i> Nazwa projektu:</label>
                    <input type="text" id="nazwa" name="nazwa" placeholder="Wprowadź nazwę projektu" required>
                </div>

                <div class="form-group">
                    <label for="opis"><i class="fas fa-file-alt"></i> Opis projektu:</label>
                    <textarea id="opis" name="opis" rows="4" placeholder="Opisz szczegóły projektu" required></textarea>
                </div>

                <div class="form-group">
                    <label for="data_rozpoczecia"><i class="fas fa-calendar"></i> Data rozpoczęcia:</label>
                    <input type="date" id="data_rozpoczecia" name="data_rozpoczecia" required>
                </div>
                
                <div class="form-group">
                    <label for="data_zakonczenia"><i class="fas fa-calendar-check"></i> Planowana data zakończenia:</label>
                    <input type="date" id="data_zakonczenia" name="data_zakonczenia">
                    <small class="form-text">Pozostaw puste jeśli termin nie jest jeszcze określony</small>
                </div>

                <div class="form-group">
                    <label for="status"><i class="fas fa-tasks"></i> Status:</label>
                    <select id="status" name="status" required>
                        <option value="" disabled selected>Wybierz status</option>
                        <option value="zakończony">Zakończony</option>
                        <option value="w trakcie">W trakcie</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="odpowiedzialny"><i class="fas fa-user"></i> Osoba odpowiedzialna:</label>
                    <input type="text" id="odpowiedzialny" name="odpowiedzialny" placeholder="Imię i nazwisko" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Zapisz projekt</button>
                    <a href="index.php" class="btn btn-secondary"><i class="fas fa-times"></i> Anuluj</a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; {$smarty.now|date_format:"%Y"} Zarządzanie Projektami | Created by Tomasz Pielecki</p>
    </footer>
</body>
</html>
