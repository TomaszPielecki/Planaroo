<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Zarządzanie Projektami</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Zarządzanie Projektami</div>
            <ul class="nav-links">
                <li><a href="index.php" class="active"><i class="fas fa-home"></i> Strona główna</a></li>
                <li><a href="index.php?action=add"><i class="fas fa-plus"></i> Nowy projekt</a></li>
                <li><a href="index.php?action=calendar"><i class="fas fa-calendar-alt"></i> Kalendarz</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1><i class="fas fa-project-diagram"></i> Lista projektów</h1>
        
        <!-- Dodajemy komunikaty o powodzeniu operacji -->
        {if isset($success_message)}
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {$success_message}
            <span class="close-alert">&times;</span>
        </div>
        {/if}

        <!-- Panel statystyk -->
        <div class="stats-panel">
            <div class="stat-card">
                <div class="stat-value">{$total_projects}</div>
                <div class="stat-label"><i class="fas fa-folder"></i> Wszystkie projekty</div>
            </div>
            {foreach from=$status_stats item=stat}
            <div class="stat-card">
                <div class="stat-value">{$stat.count}</div>
                <div class="stat-label">
                    {if $stat.status == 'zakończony'}
                        <i class="fas fa-check-circle"></i> Zakończone
                    {else}
                        <i class="fas fa-spinner"></i> W trakcie
                    {/if}
                </div>
            </div>
            {/foreach}
        </div>

        <!-- Powiadomienia o zbliżających się terminach zadań -->
        {if isset($upcoming_tasks) && count($upcoming_tasks) > 0}
        <div class="notifications-panel">
            <h3><i class="fas fa-bell"></i> Zbliżające się terminy zadań</h3>
            <div class="notifications-list">
                {foreach from=$upcoming_tasks item=task}
                <div class="notification-item priority-{$task.priorytet}">
                    <div class="notification-content">
                        <div class="notification-title">{$task.nazwa}</div>
                        <div class="notification-details">
                            <span><i class="fas fa-project-diagram"></i> {$task.projekt_nazwa}</span>
                            <span><i class="fas fa-calendar"></i> {$task.termin}</span>
                            {assign var="days_left" value=(strtotime($task.termin) - time()) / 86400}
                            <span class="days-left">
                                {if $days_left < 0}
                                    <span class="badge danger"><i class="fas fa-exclamation-triangle"></i> Opóźnione o {$days_left|abs|string_format:"%d"} dni</span>
                                {elseif $days_left == 0}
                                    <span class="badge warning"><i class="fas fa-clock"></i> Termin dzisiaj!</span>
                                {elseif $days_left == 1}
                                    <span class="badge warning"><i class="fas fa-clock"></i> Termin jutro!</span>
                                {else}
                                    <span class="badge secondary"><i class="fas fa-clock"></i> Zostało {$days_left|string_format:"%d"} dni</span>
                                {/if}
                            </span>
                        </div>
                    </div>
                    <div class="notification-actions">
                        <a href="index.php?action=edit_task&task_id={$task.id}" class="btn btn-edit" title="Edytuj zadanie"><i class="fas fa-edit"></i></a>
                        <a href="index.php?action=view_tasks&id={$task.projekt_id}" class="btn btn-primary" title="Zobacz projekt"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
                {/foreach}
            </div>
            <div class="notification-footer">
                <a href="index.php?action=calendar" class="btn btn-secondary"><i class="fas fa-calendar-alt"></i> Zobacz kalendarz</a>
            </div>
        </div>
        {/if}

        <div class="card search-card">
            <!-- Formularz wyszukiwania projektów -->
            <form method="GET" action="" class="search-form">
                <div class="search-container">
                    <input type="text" id="search" name="search" value="{$search|escape}" placeholder="Wyszukaj projekt...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
                <div class="filter-container">
                    <select name="filter_status" onchange="this.form.submit()">
                        <option value="">Wszystkie statusy</option>
                        <option value="zakończony" {if $filter_status == 'zakończony'}selected{/if}>Zakończone</option>
                        <option value="w trakcie" {if $filter_status == 'w trakcie'}selected{/if}>W trakcie</option>
                    </select>                </div>
            </form>
            
            <!-- Przyciski eksportu -->
            <div class="export-buttons" style="margin-top: 15px;">
                <a href="exports.php?action=export_projects_csv{if $search}&search={$search}{/if}{if $filter_status}&filter_status={$filter_status}{/if}" class="btn btn-secondary">
                    <i class="fas fa-file-csv"></i> Eksportuj do CSV
                </a>
            </div>
        </div>

        {if !$projekty}
            <div class="empty-state">
                <i class="fas fa-folder-open fa-3x"></i>
                <p>Brak projektów spełniających kryteria wyszukiwania</p>
                <a href="index.php?action=add" class="btn btn-primary">Dodaj pierwszy projekt</a>
            </div>
        {else}
            <div class="card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nazwa projektu</th>
                                <th>Opis</th>
                                <th>Data rozpoczęcia</th>
                                <th>Status</th>
                                <th>Odpowiedzialny</th>
                                <th>Czas trwania</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$projekty item=projekt}
                            <tr>
                                <td><strong>{$projekt.nazwa}</strong></td>
                                <td>{$projekt.opis|truncate:100:"..."}</td>
                                <td><i class="far fa-calendar-alt"></i> {$projekt.data_rozpoczecia}</td>
                                <td>
                                    {if $projekt.status == 'zakończony'}
                                        <span class="badge success"><i class="fas fa-check-circle"></i> Zakończony</span>
                                    {else}
                                        <span class="badge warning"><i class="fas fa-spinner fa-spin"></i> W trakcie</span>
                                    {/if}
                                </td>
                                <td><i class="fas fa-user"></i> {$projekt.odpowiedzialny}</td>
                                <td>
                                    {assign var="data_rozpoczecia" value=$projekt.data_rozpoczecia}
                                    {assign var="aktualna_data" value="now"|date_format:"%Y-%m-%d"}
                                    {assign var="roznica" value=(strtotime($aktualna_data) - strtotime($data_rozpoczecia)) / (60 * 60 * 24)}
                                    {if $roznica >= 0}
                                        <i class="fas fa-clock"></i> {$roznica|string_format:"%d"} dni
                                    {else}
                                        <i class="fas fa-hourglass-start"></i> Niedawno rozpoczęty
                                    {/if}
                                </td>
                                <td class="actions">
                                    <a href="index.php?action=view_tasks&id={$projekt.id}" class="btn btn-primary" title="Zadania"><i class="fas fa-tasks"></i></a>
                                    <a href="index.php?action=edit&id={$projekt.id}" class="btn btn-edit" title="Edytuj"><i class="fas fa-edit"></i></a>
                                    <a href="index.php?action=delete&id={$projekt.id}" class="btn btn-delete" onclick="return confirm('Czy na pewno chcesz usunąć projekt \'{$projekt.nazwa}\'?')" title="Usuń"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="action-buttons">
                <a href="index.php?action=add" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj nowy projekt</a>
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
