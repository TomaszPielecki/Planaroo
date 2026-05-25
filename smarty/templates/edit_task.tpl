<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Edytuj zadanie</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Zarządzanie Projektami</div>
            <ul class="nav-links">
                <li><a href="index.php"><i class="fas fa-home"></i> Strona główna</a></li>
                <li><a href="index.php?action=add"><i class="fas fa-plus"></i> Nowy projekt</a></li>
                <li><a href="index.php?action=calendar"><i class="fas fa-calendar-alt"></i> Kalendarz</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1><i class="fas fa-edit"></i> Edytuj zadanie: {$zadanie.nazwa}</h1>
        <h3>Projekt: {$projekt.nazwa}</h3>
        
        <div class="card">
            <form method="POST" action="index.php?action=edit_task&task_id={$zadanie.id}" class="form-horizontal">
                <div class="form-group">
                    <label for="nazwa"><i class="fas fa-tag"></i> Nazwa zadania:</label>
                    <input type="text" id="nazwa" name="nazwa" value="{$zadanie.nazwa}" required>
                </div>

                <div class="form-group">
                    <label for="opis"><i class="fas fa-file-alt"></i> Opis zadania:</label>
                    <textarea id="opis" name="opis" rows="4" required>{$zadanie.opis}</textarea>
                </div>

                <div class="form-group">
                    <label for="termin"><i class="fas fa-calendar"></i> Termin wykonania:</label>
                    <input type="date" id="termin" name="termin" value="{$zadanie.termin}" required>
                </div>

                <div class="form-group">
                    <label for="status"><i class="fas fa-tasks"></i> Status:</label>
                    <select id="status" name="status" required>
                        <option value="do zrobienia" {if $zadanie.status == 'do zrobienia'}selected{/if}>Do zrobienia</option>
                        <option value="w trakcie" {if $zadanie.status == 'w trakcie'}selected{/if}>W trakcie</option>
                        <option value="zakończone" {if $zadanie.status == 'zakończone'}selected{/if}>Zakończone</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="przypisane_do"><i class="fas fa-user"></i> Przypisane do:</label>
                    <input type="text" id="przypisane_do" name="przypisane_do" value="{$zadanie.przypisane_do}" required>
                </div>

                <div class="form-group">
                    <label for="priorytet"><i class="fas fa-exclamation"></i> Priorytet:</label>
                    <select id="priorytet" name="priorytet" required>
                        <option value="niski" {if $zadanie.priorytet == 'niski'}selected{/if}>Niski</option>
                        <option value="średni" {if $zadanie.priorytet == 'średni'}selected{/if}>Średni</option>
                        <option value="wysoki" {if $zadanie.priorytet == 'wysoki'}selected{/if}>Wysoki</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Zapisz zmiany</button>
                    <a href="index.php?action=view_tasks&id={$projekt.id}" class="btn btn-secondary"><i class="fas fa-times"></i> Anuluj</a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; {$smarty.now|date_format:"%Y"} Zarządzanie Projektami | Created by Tomasz Pielecki</p>
    </footer>
</body>
</html>