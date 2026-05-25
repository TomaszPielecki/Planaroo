<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Zadania projektu: {$projekt.nazwa}</title>
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
        <div class="project-header">
            <h1><i class="fas fa-tasks"></i> Zadania projektu: {$projekt.nazwa}</h1>
            <div class="project-details">
                <span class="project-status">
                    {if $projekt.status == 'zakończony'}
                        <span class="badge success"><i class="fas fa-check-circle"></i> Zakończony</span>
                    {else}
                        <span class="badge warning"><i class="fas fa-spinner fa-spin"></i> W trakcie</span>
                    {/if}
                </span>
                <span class="project-date"><i class="far fa-calendar-alt"></i> Rozpoczęcie: {$projekt.data_rozpoczecia}</span>
                <span class="project-manager"><i class="fas fa-user"></i> Odpowiedzialny: {$projekt.odpowiedzialny}</span>
            </div>
        </div>
        
        <!-- Dodajemy komunikaty o powodzeniu operacji -->
        {if isset($success_message)}
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {$success_message}
            <span class="close-alert">&times;</span>
        </div>
        {/if}        <div class="task-controls">
            <a href="index.php?action=add_task&id={$projekt.id}" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj nowe zadanie</a>
            <a href="exports.php?action=export_tasks_csv&id={$projekt.id}" class="btn btn-secondary"><i class="fas fa-file-csv"></i> Eksportuj do CSV</a>
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Powrót do projektów</a>
        </div>

        {if empty($zadania)}
            <div class="empty-state">
                <i class="fas fa-clipboard-list fa-3x"></i>
                <p>Brak zadań w tym projekcie</p>
                <a href="index.php?action=add_task&id={$projekt.id}" class="btn btn-primary">Dodaj pierwsze zadanie</a>
            </div>
        {else}
            <div class="task-stats">
                <div class="stat-item">
                    <span class="stat-label">Wszystkie zadania:</span>
                    <span class="stat-value">{count($zadania)}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Do zrobienia:</span>
                    <span class="stat-value">
                        {$todo_count = 0}
                        {foreach from=$zadania item=zadanie}
                            {if $zadanie.status == 'do zrobienia'}{$todo_count = $todo_count + 1}{/if}
                        {/foreach}
                        {$todo_count}
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">W trakcie:</span>
                    <span class="stat-value">
                        {$in_progress_count = 0}
                        {foreach from=$zadania item=zadanie}
                            {if $zadanie.status == 'w trakcie'}{$in_progress_count = $in_progress_count + 1}{/if}
                        {/foreach}
                        {$in_progress_count}
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Zakończone:</span>
                    <span class="stat-value">
                        {$done_count = 0}
                        {foreach from=$zadania item=zadanie}
                            {if $zadanie.status == 'zakończone'}{$done_count = $done_count + 1}{/if}
                        {/foreach}
                        {$done_count}
                    </span>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="task-table">
                        <thead>
                            <tr>
                                <th>Zadanie</th>
                                <th>Opis</th>
                                <th>Termin</th>
                                <th>Status</th>
                                <th>Priorytet</th>
                                <th>Przypisane do</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$zadania item=zadanie}
                            <tr class="priority-{$zadanie.priorytet}">
                                <td class="task-name">{$zadanie.nazwa}</td>
                                <td>{$zadanie.opis|truncate:100:"..."}</td>
                                <td class="task-date">
                                    <i class="far fa-calendar-alt"></i> {$zadanie.termin}
                                    {assign var="termin" value=$zadanie.termin}
                                    {assign var="dzisiaj" value="now"|date_format:"%Y-%m-%d"}
                                    
                                    {if $zadanie.status != 'zakończone' && $termin < $dzisiaj}
                                        <span class="badge danger"><i class="fas fa-exclamation-triangle"></i> Opóźnione</span>
                                    {elseif $zadanie.status != 'zakończone' && $termin == $dzisiaj}
                                        <span class="badge warning"><i class="fas fa-clock"></i> Dzisiaj</span>
                                    {/if}
                                </td>
                                <td>
                                    {if $zadanie.status == 'zakończone'}
                                        <span class="badge success"><i class="fas fa-check-circle"></i> Zakończone</span>
                                    {elseif $zadanie.status == 'w trakcie'}
                                        <span class="badge warning"><i class="fas fa-spinner fa-spin"></i> W trakcie</span>
                                    {else}
                                        <span class="badge secondary"><i class="fas fa-hourglass-start"></i> Do zrobienia</span>
                                    {/if}
                                </td>
                                <td>
                                    {if $zadanie.priorytet == 'wysoki'}
                                        <span class="badge danger"><i class="fas fa-arrow-up"></i> Wysoki</span>
                                    {elseif $zadanie.priorytet == 'średni'}
                                        <span class="badge warning"><i class="fas fa-equals"></i> Średni</span>
                                    {else}
                                        <span class="badge secondary"><i class="fas fa-arrow-down"></i> Niski</span>
                                    {/if}
                                </td>
                                <td><i class="fas fa-user"></i> {$zadanie.przypisane_do}</td>                                <td class="actions">
                                    <a href="time_tracking.php?task_id={$zadanie.id}" class="btn btn-primary" title="Śledzenie czasu"><i class="fas fa-clock"></i></a>
                                    <a href="index.php?action=edit_task&task_id={$zadanie.id}" class="btn btn-edit" title="Edytuj"><i class="fas fa-edit"></i></a>
                                    <a href="index.php?action=delete_task&task_id={$zadanie.id}" class="btn btn-delete" onclick="return confirm('Czy na pewno chcesz usunąć zadanie \'{$zadanie.nazwa}\'?')" title="Usuń"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        {/if}
    </div>

    <footer>
        <p>&copy; {$smarty.now|date_format:"%Y"} Zarządzanie Projektami | Created by Tomasz Pielecki</p>
    </footer>
    
    <script>
    // Skrypt do zamykania alertów
    document.addEventListener('DOMContentLoaded', function() {
        var closeButtons = document.querySelectorAll('.close-alert');
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                this.parentElement.style.display = 'none';
            });
        });
        
        // Automatyczne ukrywanie alertów po 5 sekundach
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