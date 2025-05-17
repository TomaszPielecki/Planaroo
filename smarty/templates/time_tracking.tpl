<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Śledzenie czasu pracy - {$zadanie.nazwa}</title>
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
        <h1><i class="fas fa-clock"></i> Śledzenie czasu pracy</h1>
        
        <div class="task-header">
            <h2>{$zadanie.nazwa}</h2>
            <div class="task-details">
                <span><i class="fas fa-project-diagram"></i> Projekt: {$zadanie.projekt_nazwa}</span>
                <span><i class="fas fa-calendar-day"></i> Termin: {$zadanie.termin}</span>
                <span><i class="fas fa-user"></i> Przypisane do: {$zadanie.przypisane_do}</span>
            </div>
        </div>
        
        <!-- Komunikaty o sukcesie -->
        {if isset($success_message)}
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {$success_message}
            <span class="close-alert">&times;</span>
        </div>
        {/if}
        
        <div class="card">
            <div class="time-summary">
                <h3><i class="fas fa-stopwatch"></i> Podsumowanie czasu pracy</h3>
                <div class="time-stats">
                    <div class="stat-item">
                        <div class="stat-value">{$formatted_total_time}</div>
                        <div class="stat-label">Łączny czas pracy</div>
                    </div>
                </div>
            </div>
            
            <h3><i class="fas fa-plus-circle"></i> Dodaj nowy wpis czasu pracy</h3>
            <form method="POST" action="time_tracking.php" class="form-horizontal">
                <input type="hidden" name="zadanie_id" value="{$zadanie.id}">
                <input type="hidden" name="add_time_log" value="1">
                  <div class="form-group">
                    <label for="uzytkownik"><i class="fas fa-user"></i> Osoba wykonująca:</label>
                    <input type="text" id="uzytkownik" name="uzytkownik" required>
                </div>
                
                <div class="form-group">
                    <label for="czas_pracy"><i class="fas fa-stopwatch"></i> Czas pracy (minuty):</label>
                    <input type="number" id="czas_pracy" name="czas_pracy" min="1" required>
                </div>
                  <div class="form-group">
                    <label for="opis"><i class="fas fa-file-alt"></i> Komentarz do wykonanych prac:</label>
                    <textarea id="opis" name="opis" rows="3" required></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Zapisz wpis</button>
                </div>
            </form>
        </div>
        
        <div class="card">
            <h3><i class="fas fa-history"></i> Historia czasu pracy</h3>
            
            {if empty($time_logs)}
                <div class="empty-state">
                    <i class="fas fa-clock fa-3x"></i>
                    <p>Brak wpisów czasu pracy dla tego zadania</p>
                </div>
            {else}
                <div class="table-responsive">
                    <table>                        <thead>
                            <tr>
                                <th>Data dodania</th>
                                <th>Osoba</th>
                                <th>Czas (min)</th>
                                <th>Komentarz</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$time_logs item=log}
                            <tr>                                <td>
                                    {if isset($log.data_utworzenia)}
                                        {$log.data_utworzenia|date_format:'%Y-%m-%d %H:%M'}
                                    {else}
                                        -
                                    {/if}
                                </td>                                <td>{$log.uzytkownik}</td>
                                <td>{$log.czas_pracy}</td>
                                <td>{$log.komentarz}</td>
                                <td class="actions">
                                    <a href="time_tracking.php?action=delete_log&log_id={$log.id}&task_id={$zadanie.id}" class="btn btn-delete" onclick="return confirm('Czy na pewno chcesz usunąć ten wpis?')">
                                        <i class="fas fa-trash"></i> Usuń
                                    </a>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            {/if}
            
            <div class="action-buttons">
                <a href="index.php?action=view_tasks&id={$zadanie.projekt_id}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Powrót do zadań
                </a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; {$smarty.now|date_format:"%Y"} Zarządzanie Projektami | Created by Tomasz Pielecki</p>
    </footer>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var closeButtons = document.querySelectorAll('.close-alert');
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                this.parentElement.style.display = 'none';
            });
        });
        
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 5000);
    });
    </script>
</body>
</html>