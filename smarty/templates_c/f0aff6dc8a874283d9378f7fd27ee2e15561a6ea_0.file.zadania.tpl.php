<?php
/* Smarty version 3.1.33, created on 2025-05-03 21:31:30
  from 'C:\xampp\htdocs\WEBSITE\smarty\templates\zadania.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_68166f12163df0_82282217',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f0aff6dc8a874283d9378f7fd27ee2e15561a6ea' => 
    array (
      0 => 'C:\\xampp\\htdocs\\WEBSITE\\smarty\\templates\\zadania.tpl',
      1 => 1746300687,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68166f12163df0_82282217 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\WEBSITE\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),1=>array('file'=>'C:\\xampp\\htdocs\\WEBSITE\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Zadania projektu: <?php echo $_smarty_tpl->tpl_vars['projekt']->value['nazwa'];?>
</title>
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
            <h1><i class="fas fa-tasks"></i> Zadania projektu: <?php echo $_smarty_tpl->tpl_vars['projekt']->value['nazwa'];?>
</h1>
            <div class="project-details">
                <span class="project-status">
                    <?php if ($_smarty_tpl->tpl_vars['projekt']->value['status'] == 'zakończony') {?>
                        <span class="badge success"><i class="fas fa-check-circle"></i> Zakończony</span>
                    <?php } else { ?>
                        <span class="badge warning"><i class="fas fa-spinner fa-spin"></i> W trakcie</span>
                    <?php }?>
                </span>
                <span class="project-date"><i class="far fa-calendar-alt"></i> Rozpoczęcie: <?php echo $_smarty_tpl->tpl_vars['projekt']->value['data_rozpoczecia'];?>
</span>
                <span class="project-manager"><i class="fas fa-user"></i> Odpowiedzialny: <?php echo $_smarty_tpl->tpl_vars['projekt']->value['odpowiedzialny'];?>
</span>
            </div>
        </div>
        
        <!-- Dodajemy komunikaty o powodzeniu operacji -->
        <?php if (isset($_smarty_tpl->tpl_vars['success_message']->value)) {?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo $_smarty_tpl->tpl_vars['success_message']->value;?>

            <span class="close-alert">&times;</span>
        </div>
        <?php }?>

        <div class="task-controls">
            <a href="index.php?action=add_task&id=<?php echo $_smarty_tpl->tpl_vars['projekt']->value['id'];?>
" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj nowe zadanie</a>
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Powrót do projektów</a>
        </div>

        <?php if (empty($_smarty_tpl->tpl_vars['zadania']->value)) {?>
            <div class="empty-state">
                <i class="fas fa-clipboard-list fa-3x"></i>
                <p>Brak zadań w tym projekcie</p>
                <a href="index.php?action=add_task&id=<?php echo $_smarty_tpl->tpl_vars['projekt']->value['id'];?>
" class="btn btn-primary">Dodaj pierwsze zadanie</a>
            </div>
        <?php } else { ?>
            <div class="task-stats">
                <div class="stat-item">
                    <span class="stat-label">Wszystkie zadania:</span>
                    <span class="stat-value"><?php echo count($_smarty_tpl->tpl_vars['zadania']->value);?>
</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Do zrobienia:</span>
                    <span class="stat-value">
                        <?php $_smarty_tpl->_assignInScope('todo_count', 0);?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['zadania']->value, 'zadanie');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['zadanie']->value) {
?>
                            <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['status'] == 'do zrobienia') {
$_smarty_tpl->_assignInScope('todo_count', $_smarty_tpl->tpl_vars['todo_count']->value+1);
}?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php echo $_smarty_tpl->tpl_vars['todo_count']->value;?>

                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">W trakcie:</span>
                    <span class="stat-value">
                        <?php $_smarty_tpl->_assignInScope('in_progress_count', 0);?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['zadania']->value, 'zadanie');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['zadanie']->value) {
?>
                            <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['status'] == 'w trakcie') {
$_smarty_tpl->_assignInScope('in_progress_count', $_smarty_tpl->tpl_vars['in_progress_count']->value+1);
}?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php echo $_smarty_tpl->tpl_vars['in_progress_count']->value;?>

                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Zakończone:</span>
                    <span class="stat-value">
                        <?php $_smarty_tpl->_assignInScope('done_count', 0);?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['zadania']->value, 'zadanie');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['zadanie']->value) {
?>
                            <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['status'] == 'zakończone') {
$_smarty_tpl->_assignInScope('done_count', $_smarty_tpl->tpl_vars['done_count']->value+1);
}?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php echo $_smarty_tpl->tpl_vars['done_count']->value;?>

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
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['zadania']->value, 'zadanie');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['zadanie']->value) {
?>
                            <tr class="priority-<?php echo $_smarty_tpl->tpl_vars['zadanie']->value['priorytet'];?>
">
                                <td class="task-name"><?php echo $_smarty_tpl->tpl_vars['zadanie']->value['nazwa'];?>
</td>
                                <td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['zadanie']->value['opis'],100,"...");?>
</td>
                                <td class="task-date">
                                    <i class="far fa-calendar-alt"></i> <?php echo $_smarty_tpl->tpl_vars['zadanie']->value['termin'];?>

                                    <?php $_smarty_tpl->_assignInScope('termin', $_smarty_tpl->tpl_vars['zadanie']->value['termin']);?>
                                    <?php $_smarty_tpl->_assignInScope('dzisiaj', smarty_modifier_date_format("now","%Y-%m-%d"));?>
                                    
                                    <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['status'] != 'zakończone' && $_smarty_tpl->tpl_vars['termin']->value < $_smarty_tpl->tpl_vars['dzisiaj']->value) {?>
                                        <span class="badge danger"><i class="fas fa-exclamation-triangle"></i> Opóźnione</span>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['zadanie']->value['status'] != 'zakończone' && $_smarty_tpl->tpl_vars['termin']->value == $_smarty_tpl->tpl_vars['dzisiaj']->value) {?>
                                        <span class="badge warning"><i class="fas fa-clock"></i> Dzisiaj</span>
                                    <?php }?>
                                </td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['status'] == 'zakończone') {?>
                                        <span class="badge success"><i class="fas fa-check-circle"></i> Zakończone</span>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['zadanie']->value['status'] == 'w trakcie') {?>
                                        <span class="badge warning"><i class="fas fa-spinner fa-spin"></i> W trakcie</span>
                                    <?php } else { ?>
                                        <span class="badge secondary"><i class="fas fa-hourglass-start"></i> Do zrobienia</span>
                                    <?php }?>
                                </td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['priorytet'] == 'wysoki') {?>
                                        <span class="badge danger"><i class="fas fa-arrow-up"></i> Wysoki</span>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['zadanie']->value['priorytet'] == 'średni') {?>
                                        <span class="badge warning"><i class="fas fa-equals"></i> Średni</span>
                                    <?php } else { ?>
                                        <span class="badge secondary"><i class="fas fa-arrow-down"></i> Niski</span>
                                    <?php }?>
                                </td>
                                <td><i class="fas fa-user"></i> <?php echo $_smarty_tpl->tpl_vars['zadanie']->value['przypisane_do'];?>
</td>
                                <td class="actions">
                                    <a href="index.php?action=edit_task&task_id=<?php echo $_smarty_tpl->tpl_vars['zadanie']->value['id'];?>
" class="btn btn-edit" title="Edytuj"><i class="fas fa-edit"></i></a>
                                    <a href="index.php?action=delete_task&task_id=<?php echo $_smarty_tpl->tpl_vars['zadanie']->value['id'];?>
" class="btn btn-delete" onclick="return confirm('Czy na pewno chcesz usunąć zadanie \'<?php echo $_smarty_tpl->tpl_vars['zadanie']->value['nazwa'];?>
\'?')" title="Usuń"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }?>
    </div>

    <footer>
        <p>&copy; <?php echo smarty_modifier_date_format(time(),"%Y");?>
 Zarządzanie Projektami | Created by Tomasz Pielecki</p>
    </footer>
    
    <?php echo '<script'; ?>
>
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
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
