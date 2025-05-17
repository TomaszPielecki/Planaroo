<?php
/* Smarty version 3.1.33, created on 2025-05-17 18:37:33
  from 'C:\Users\tomas\Desktop\Planaroo\smarty\templates\calendar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6828bb4db03be4_80701585',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a09914eeb5b5b589cbf156ea00ad5398fb20d4a0' => 
    array (
      0 => 'C:\\Users\\tomas\\Desktop\\Planaroo\\smarty\\templates\\calendar.tpl',
      1 => 1747211556,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6828bb4db03be4_80701585 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\tomas\\Desktop\\Planaroo\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    <title>Kalendarz projektów i zadań</title>
    <style>
        .fc-event {
            cursor: pointer;
        }
        .calendar-container {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }
        .event-details {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            padding: 20px;
            z-index: 1000;
            width: 90%;
            max-width: 600px;
        }
        .event-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .close-event {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 1.2rem;
        }
        .event-priority-wysoki {
            border-left: 5px solid #e74c3c !important;
        }
        .event-priority-średni {
            border-left: 5px solid #f39c12 !important;
        }
        .event-priority-niski {
            border-left: 5px solid #3498db !important;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Zarządzanie Projektami</div>
            <ul class="nav-links">
                <li><a href="index.php"><i class="fas fa-home"></i> Strona główna</a></li>
                <li><a href="index.php?action=add"><i class="fas fa-plus"></i> Nowy projekt</a></li>
                <li><a href="index.php?action=calendar" class="active"><i class="fas fa-calendar-alt"></i> Kalendarz</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1><i class="fas fa-calendar-alt"></i> Kalendarz projektów i zadań</h1>
        
        <!-- Legenda i filtry -->
        <div class="calendar-legend-filters" style="margin-bottom: 20px;">
            <div class="legend" style="margin-bottom: 10px; display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                <strong>Legenda:</strong>
                <span class="badge" style="background:#3498db;color:#fff;">Projekt (w trakcie)</span>
                <span class="badge" style="background:#2ecc71;color:#fff;">Projekt (zakończony)</span>
                <span class="badge" style="background:#2ecc71;color:#fff;">Zadanie zakończone <span id="count-zadanie-zakonczone" class="legend-count"></span></span>
                <span class="badge" style="background:#f39c12;color:#fff;">Zadanie w trakcie <span id="count-zadanie-wtrakcie" class="legend-count"></span></span>
                <span class="badge" style="background:#95a5a6;color:#fff;">Zadanie do zrobienia <span id="count-zadanie-dozrobienia" class="legend-count"></span></span>
                <span class="badge danger">Priorytet: Wysoki <span id="count-priorytet-wysoki" class="legend-count"></span></span>
                <span class="badge warning">Priorytet: Średni <span id="count-priorytet-sredni" class="legend-count"></span></span>
                <span class="badge secondary">Priorytet: Niski <span id="count-priorytet-niski" class="legend-count"></span></span>
            </div>
            <div class="filters" style="display:flex;gap:15px;flex-wrap:wrap;align-items:center;">
                <label><input type="checkbox" id="filter-projects" checked> Projekty</label>
                <label><input type="checkbox" id="filter-tasks" checked> Zadania</label>
                <label><input type="checkbox" class="filter-status" value="do zrobienia" checked> Do zrobienia</label>
                <label><input type="checkbox" class="filter-status" value="w trakcie" checked> W trakcie</label>
                <label><input type="checkbox" class="filter-status" value="zakończone" checked> Zakończone</label>
                <label><input type="checkbox" class="filter-priority" value="wysoki" checked> Wysoki</label>
                <label><input type="checkbox" class="filter-priority" value="średni" checked> Średni</label>
                <label><input type="checkbox" class="filter-priority" value="niski" checked> Niski</label>
            </div>
        </div>
        <div class="calendar-container">
            <div id="calendar"></div>
        </div>
    </div>
    
    <!-- Event overlay and details popup -->
    <div class="event-overlay" id="event-overlay"></div>
    <div class="event-details" id="event-details">
        <span class="close-event" id="close-event"><i class="fas fa-times"></i></span>
        <h2 id="event-title"></h2>
        <div id="event-content"></div>
    </div>

    <footer>
        <p>&copy; 2025 Zarządzanie Projektami | Created by Tomasz Pielecki</p>
    </footer>
    
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
      document.addEventListener('DOMContentLoaded', function() {
        // Przygotowanie danych o projektach dla kalendarza
        const projectEvents = [
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['projekty']->value, 'projekt', true);
$_smarty_tpl->tpl_vars['projekt']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['projekt']->value) {
$_smarty_tpl->tpl_vars['projekt']->iteration++;
$_smarty_tpl->tpl_vars['projekt']->last = $_smarty_tpl->tpl_vars['projekt']->iteration === $_smarty_tpl->tpl_vars['projekt']->total;
$__foreach_projekt_0_saved = $_smarty_tpl->tpl_vars['projekt'];
?>
            {
              title: '<?php echo strtr($_smarty_tpl->tpl_vars['projekt']->value['nazwa'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
              start: '<?php echo $_smarty_tpl->tpl_vars['projekt']->value['data_rozpoczecia'];?>
',
              end: '<?php echo $_smarty_tpl->tpl_vars['projekt']->value['data_zakonczenia'];?>
',
              allDay: true,
              color: '<?php if ($_smarty_tpl->tpl_vars['projekt']->value['status'] == "zakończony") {?>#2ecc71<?php } else { ?>#3498db<?php }?>',
              extendedProps: {
                type: 'project',
                id: <?php echo $_smarty_tpl->tpl_vars['projekt']->value['id'];?>
,
                status: '<?php echo strtr($_smarty_tpl->tpl_vars['projekt']->value['status'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
                description: '<?php echo smarty_modifier_truncate(strtr($_smarty_tpl->tpl_vars['projekt']->value['opis'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" )),200,"...");?>
'
              }
            }<?php if (!$_smarty_tpl->tpl_vars['projekt']->last) {?>,<?php }?>
          <?php
$_smarty_tpl->tpl_vars['projekt'] = $__foreach_projekt_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        ];
        // Przygotowanie danych o zadaniach dla kalendarza
        const taskEvents = [
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['zadania']->value, 'zadanie', true);
$_smarty_tpl->tpl_vars['zadanie']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['zadanie']->value) {
$_smarty_tpl->tpl_vars['zadanie']->iteration++;
$_smarty_tpl->tpl_vars['zadanie']->last = $_smarty_tpl->tpl_vars['zadanie']->iteration === $_smarty_tpl->tpl_vars['zadanie']->total;
$__foreach_zadanie_1_saved = $_smarty_tpl->tpl_vars['zadanie'];
?>
            {
              title: '<?php echo strtr($_smarty_tpl->tpl_vars['zadanie']->value['nazwa'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
              start: '<?php echo $_smarty_tpl->tpl_vars['zadanie']->value['termin'];?>
',
              allDay: true,
              color: '<?php if ($_smarty_tpl->tpl_vars['zadanie']->value['status'] == "zakończone") {?>#2ecc71<?php } elseif ($_smarty_tpl->tpl_vars['zadanie']->value['status'] == "w trakcie") {?>#f39c12<?php } else { ?>#95a5a6<?php }?>',
              classNames: ['event-priority-<?php echo $_smarty_tpl->tpl_vars['zadanie']->value['priorytet'];?>
'],
              extendedProps: {
                type: 'task',
                id: <?php echo $_smarty_tpl->tpl_vars['zadanie']->value['id'];?>
,
                status: '<?php echo strtr($_smarty_tpl->tpl_vars['zadanie']->value['status'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
                priority: '<?php echo strtr($_smarty_tpl->tpl_vars['zadanie']->value['priorytet'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
                project: '<?php echo strtr($_smarty_tpl->tpl_vars['zadanie']->value['projekt_nazwa'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
                assigned: '<?php echo strtr($_smarty_tpl->tpl_vars['zadanie']->value['przypisane_do'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
                description: '<?php echo smarty_modifier_truncate(strtr($_smarty_tpl->tpl_vars['zadanie']->value['opis'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" )),200,"...");?>
',
                projectId: <?php echo $_smarty_tpl->tpl_vars['zadanie']->value['projekt_id'];?>

              }
            }<?php if (!$_smarty_tpl->tpl_vars['zadanie']->last) {?>,<?php }?>
          <?php
$_smarty_tpl->tpl_vars['zadanie'] = $__foreach_zadanie_1_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        ];
        let allEvents = [...projectEvents, ...taskEvents];
        let calendar;
        const calendarEl = document.getElementById('calendar');
        function updateLegendCounts(events) {
          // Statusy
          let countZakonczone = 0, countWTrakcie = 0, countDoZrobienia = 0;
          // Priorytety
          let countWysoki = 0, countSredni = 0, countNiski = 0;
          events.forEach(ev => {
            if (ev.extendedProps.type === 'task') {
              if (ev.extendedProps.status === 'zakończone') countZakonczone++;
              if (ev.extendedProps.status === 'w trakcie') countWTrakcie++;
              if (ev.extendedProps.status === 'do zrobienia') countDoZrobienia++;
              if (ev.extendedProps.priority === 'wysoki') countWysoki++;
              if (ev.extendedProps.priority === 'średni') countSredni++;
              if (ev.extendedProps.priority === 'niski') countNiski++;
            }
          });
          document.getElementById('count-zadanie-zakonczone').textContent = countZakonczone > 0 ? '('+countZakonczone+')' : '';
          document.getElementById('count-zadanie-wtrakcie').textContent = countWTrakcie > 0 ? '('+countWTrakcie+')' : '';
          document.getElementById('count-zadanie-dozrobienia').textContent = countDoZrobienia > 0 ? '('+countDoZrobienia+')' : '';
          document.getElementById('count-priorytet-wysoki').textContent = countWysoki > 0 ? '('+countWysoki+')' : '';
          document.getElementById('count-priorytet-sredni').textContent = countSredni > 0 ? '('+countSredni+')' : '';
          document.getElementById('count-priorytet-niski').textContent = countNiski > 0 ? '('+countNiski+')' : '';
        }
        function renderCalendar(events) {
          if (calendar) calendar.destroy();
          calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,listMonth'
            },
            events: events,
            eventClick: function(info) {
              const event = info.event;
              const props = event.extendedProps;
              const title = event.title;
              
              // Przygotowanie klas CSS dla statusu i priorytetu
              let statusBadgeClass = '';
              let statusIcon = '';
              let statusText = '';
              if (props.status === 'zakończony' || props.status === 'zakończone') {
                statusBadgeClass = 'success';
                statusIcon = 'fa-check-circle';
                statusText = 'Zakończone';
              } else if (props.status === 'w trakcie') {
                statusBadgeClass = 'warning';
                statusIcon = 'fa-spinner fa-spin';
                statusText = 'W trakcie';
              } else {
                statusBadgeClass = 'secondary';
                statusIcon = 'fa-hourglass-start';
                statusText = 'Do zrobienia';
              }

              let priorityBadgeClass = '';
              let priorityIcon = '';
              let priorityText = '';
              if (props.priority === 'wysoki') {
                priorityBadgeClass = 'danger';
                priorityIcon = 'fa-arrow-up';
                priorityText = 'wysoki';
              } else if (props.priority === 'średni') {
                priorityBadgeClass = 'warning';
                priorityIcon = 'fa-equals';
                priorityText = 'średni';
              } else if (props.priority === 'niski') {
                priorityBadgeClass = 'secondary';
                priorityIcon = 'fa-arrow-down';
                priorityText = 'niski';
              }

              document.getElementById('event-title').textContent = title;
              let content = '';
              if (props.type === 'project') {
                content = '<div class="event-info">' +
                  '<p><strong>Typ:</strong> Projekt</p>' +
                  '<p><strong>Status:</strong> ' +
                    '<span class="badge ' + statusBadgeClass + '"><i class="fas ' + statusIcon + '"></i> ' + statusText + '</span>' +
                  '</p>' +
                  '<p><strong>Opis:</strong> ' + props.description + '</p>' +
                  '<p><strong>Data rozpoczęcia:</strong> ' + (event.start ? event.start.toLocaleDateString() : 'Nie określono') + '</p>' +
                  '<p><strong>Data zakończenia:</strong> ' + (event.end ? event.end.toLocaleDateString() : 'Nie określono') + '</p>' +
                  '<div class="event-actions" style="margin-top: 15px;">' +
                    '<a href="index.php?action=view_tasks&id=' + props.id + '" class="btn btn-primary">' +
                      '<i class="fas fa-tasks"></i> Zarządzaj zadaniami' +
                    '</a>' +
                    '<a href="index.php?action=edit&id=' + props.id + '" class="btn btn-edit">' +
                      '<i class="fas fa-edit"></i> Edytuj projekt' +
                    '</a>' +
                  '</div>' +
                '</div>';
              } else {
                content = '<div class="event-info">' +
                  '<p><strong>Typ:</strong> Zadanie</p>' +
                  '<p><strong>Projekt:</strong> ' + props.project + '</p>' +
                  '<p><strong>Status:</strong> ' +
                    '<span class="badge ' + statusBadgeClass + '"><i class="fas ' + statusIcon + '"></i> ' + statusText + '</span>' +
                  '</p>' +
                  '<p><strong>Priorytet:</strong> ' +
                    '<span class="badge ' + priorityBadgeClass + '"><i class="fas ' + priorityIcon + '"></i> ' + priorityText + '</span>' +
                  '</p>' +
                  '<p><strong>Przypisane do:</strong> ' + props.assigned + '</p>' +
                  '<p><strong>Termin:</strong> ' + (event.start ? event.start.toLocaleDateString() : 'Nie określono') + '</p>' +
                  '<p><strong>Opis:</strong> ' + props.description + '</p>' +
                  '<div class="event-actions" style="margin-top: 15px;">' +
                    '<a href="index.php?action=edit_task&task_id=' + props.id + '" class="btn btn-edit">' +
                      '<i class="fas fa-edit"></i> Edytuj zadanie' +
                    '</a>' +
                    '<a href="index.php?action=view_tasks&id=' + (props.projectId ? props.projectId : '') + '" class="btn btn-primary">' +
                      '<i class="fas fa-eye"></i> Zobacz projekt' +
                    '</a>' +
                  '</div>' +
                '</div>';
              }
              document.getElementById('event-content').innerHTML = content;
              document.getElementById('event-overlay').style.display = 'block';
              document.getElementById('event-details').style.display = 'block';
            },
            locale: 'pl',
            firstDay: 1, // Poniedziałek jako pierwszy dzień tygodnia
            buttonText: {
              today: 'Dzisiaj',
              month: 'Miesiąc',
              week: 'Tydzień',
              list: 'Lista'
            },
            dayHeaderFormat: { weekday: 'short' },
            allDayText: 'Cały dzień',
            height: 'auto'
          });
          calendar.render();
          updateLegendCounts(events);
        }
        // Filtry
        function applyFilters() {
          const showProjects = document.getElementById('filter-projects').checked;
          const showTasks = document.getElementById('filter-tasks').checked;
          const checkedStatuses = Array.from(document.querySelectorAll('.filter-status:checked')).map(cb => cb.value);
          const checkedPriorities = Array.from(document.querySelectorAll('.filter-priority:checked')).map(cb => cb.value);
          const filtered = allEvents.filter(ev => {
            if (ev.extendedProps.type === 'project' && !showProjects) return false;
            if (ev.extendedProps.type === 'task' && !showTasks) return false;
            if (ev.extendedProps.type === 'task') {
              // Dla zadań status to np. 'zakończone', 'w trakcie', 'do zrobienia'
              let zadanieStatus = ev.extendedProps.status;
              // Poprawka: jeśli filtr zawiera 'zakończone', to akceptuj tylko dokładnie 'zakończone'
              if (!checkedStatuses.includes(zadanieStatus)) return false;
              if (!checkedPriorities.includes(ev.extendedProps.priority)) return false;
            }
            if (ev.extendedProps.type === 'project') {
              // Dla projektów status to 'zakończony' lub 'w trakcie'
              let projektStatus = ev.extendedProps.status;
              // Poprawka: jeśli filtr zawiera 'zakończone', to akceptuj też 'zakończony' dla projektów
              if (projektStatus === 'zakończony' && !checkedStatuses.includes('zakończone') && !checkedStatuses.includes('zakończony')) return false;
              if (projektStatus === 'w trakcie' && !checkedStatuses.includes('w trakcie')) return false;
            }
            return true;
          });
          renderCalendar(filtered);
          updateLegendCounts(filtered);
        }
        document.getElementById('filter-projects').addEventListener('change', applyFilters);
        document.getElementById('filter-tasks').addEventListener('change', applyFilters);
        document.querySelectorAll('.filter-status').forEach(cb => cb.addEventListener('change', applyFilters));
        document.querySelectorAll('.filter-priority').forEach(cb => cb.addEventListener('change', applyFilters));
        // Inicjalizacja
        renderCalendar(allEvents);
        // Obsługa zamykania popup
        document.getElementById('close-event').addEventListener('click', function() {
          document.getElementById('event-overlay').style.display = 'none';
          document.getElementById('event-details').style.display = 'none';
        });
        
        document.getElementById('event-overlay').addEventListener('click', function() {
          document.getElementById('event-overlay').style.display = 'none';
          document.getElementById('event-details').style.display = 'none';
        });
      });
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
