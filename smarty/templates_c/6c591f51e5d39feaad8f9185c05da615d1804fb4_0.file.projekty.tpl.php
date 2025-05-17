<?php
/* Smarty version 3.1.33, created on 2025-05-17 18:28:46
  from 'C:\Users\tomas\Desktop\planaroMVC\smarty\templates\projekty.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6828b93e813d80_43588066',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c591f51e5d39feaad8f9185c05da615d1804fb4' => 
    array (
      0 => 'C:\\Users\\tomas\\Desktop\\planaroMVC\\smarty\\templates\\projekty.tpl',
      1 => 1747321074,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6828b93e813d80_43588066 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\tomas\\Desktop\\planaroMVC\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),1=>array('file'=>'C:\\Users\\tomas\\Desktop\\planaroMVC\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
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
        <?php if (isset($_smarty_tpl->tpl_vars['success_message']->value)) {?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo $_smarty_tpl->tpl_vars['success_message']->value;?>

            <span class="close-alert">&times;</span>
        </div>
        <?php }?>

        <!-- Panel statystyk -->
        <div class="stats-panel">
            <div class="stat-card">
                <div class="stat-value"><?php echo $_smarty_tpl->tpl_vars['total_projects']->value;?>
</div>
                <div class="stat-label"><i class="fas fa-folder"></i> Wszystkie projekty</div>
            </div>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['status_stats']->value, 'stat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['stat']->value) {
?>
            <div class="stat-card">
                <div class="stat-value"><?php echo $_smarty_tpl->tpl_vars['stat']->value['count'];?>
</div>
                <div class="stat-label">
                    <?php if ($_smarty_tpl->tpl_vars['stat']->value['status'] == 'zakończony') {?>
                        <i class="fas fa-check-circle"></i> Zakończone
                    <?php } else { ?>
                        <i class="fas fa-spinner"></i> W trakcie
                    <?php }?>
                </div>
            </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>

        <!-- Powiadomienia o zbliżających się terminach zadań -->
        <?php if (isset($_smarty_tpl->tpl_vars['upcoming_tasks']->value) && count($_smarty_tpl->tpl_vars['upcoming_tasks']->value) > 0) {?>
        <div class="notifications-panel">
            <h3><i class="fas fa-bell"></i> Zbliżające się terminy zadań</h3>
            <div class="notifications-list">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['upcoming_tasks']->value, 'task');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['task']->value) {
?>
                <div class="notification-item priority-<?php echo $_smarty_tpl->tpl_vars['task']->value['priorytet'];?>
">
                    <div class="notification-content">
                        <div class="notification-title"><?php echo $_smarty_tpl->tpl_vars['task']->value['nazwa'];?>
</div>
                        <div class="notification-details">
                            <span><i class="fas fa-project-diagram"></i> <?php echo $_smarty_tpl->tpl_vars['task']->value['projekt_nazwa'];?>
</span>
                            <span><i class="fas fa-calendar"></i> <?php echo $_smarty_tpl->tpl_vars['task']->value['termin'];?>
</span>
                            <?php $_smarty_tpl->_assignInScope('days_left', (strtotime($_smarty_tpl->tpl_vars['task']->value['termin'])-time())/86400);?>
                            <span class="days-left">
                                <?php if ($_smarty_tpl->tpl_vars['days_left']->value < 0) {?>
                                    <span class="badge danger"><i class="fas fa-exclamation-triangle"></i> Opóźnione o <?php echo sprintf("%d",abs($_smarty_tpl->tpl_vars['days_left']->value));?>
 dni</span>
                                <?php } elseif ($_smarty_tpl->tpl_vars['days_left']->value == 0) {?>
                                    <span class="badge warning"><i class="fas fa-clock"></i> Termin dzisiaj!</span>
                                <?php } elseif ($_smarty_tpl->tpl_vars['days_left']->value == 1) {?>
                                    <span class="badge warning"><i class="fas fa-clock"></i> Termin jutro!</span>
                                <?php } else { ?>
                                    <span class="badge secondary"><i class="fas fa-clock"></i> Zostało <?php echo sprintf("%d",$_smarty_tpl->tpl_vars['days_left']->value);?>
 dni</span>
                                <?php }?>
                            </span>
                        </div>
                    </div>
                    <div class="notification-actions">
                        <a href="index.php?action=edit_task&task_id=<?php echo $_smarty_tpl->tpl_vars['task']->value['id'];?>
" class="btn btn-edit" title="Edytuj zadanie"><i class="fas fa-edit"></i></a>
                        <a href="index.php?action=view_tasks&id=<?php echo $_smarty_tpl->tpl_vars['task']->value['projekt_id'];?>
" class="btn btn-primary" title="Zobacz projekt"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
            <div class="notification-footer">
                <a href="index.php?action=calendar" class="btn btn-secondary"><i class="fas fa-calendar-alt"></i> Zobacz kalendarz</a>
            </div>
        </div>
        <?php }?>

        <div class="card search-card">
            <!-- Formularz wyszukiwania projektów -->
            <form method="GET" action="" class="search-form">
                <div class="search-container">
                    <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value, ENT_QUOTES, 'UTF-8', true);?>
" placeholder="Wyszukaj projekt...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
                <div class="filter-container">
                    <select name="filter_status" onchange="this.form.submit()">
                        <option value="">Wszystkie statusy</option>
                        <option value="zakończony" <?php if ($_smarty_tpl->tpl_vars['filter_status']->value == 'zakończony') {?>selected<?php }?>>Zakończone</option>
                        <option value="w trakcie" <?php if ($_smarty_tpl->tpl_vars['filter_status']->value == 'w trakcie') {?>selected<?php }?>>W trakcie</option>
                    </select>                </div>
            </form>
            
            <!-- Przyciski eksportu -->
            <div class="export-buttons" style="margin-top: 15px;">
                <a href="exports.php?action=export_projects_csv<?php if ($_smarty_tpl->tpl_vars['search']->value) {?>&search=<?php echo $_smarty_tpl->tpl_vars['search']->value;
}
if ($_smarty_tpl->tpl_vars['filter_status']->value) {?>&filter_status=<?php echo $_smarty_tpl->tpl_vars['filter_status']->value;
}?>" class="btn btn-secondary">
                    <i class="fas fa-file-csv"></i> Eksportuj do CSV
                </a>
            </div>
        </div>

        <?php if (!$_smarty_tpl->tpl_vars['projekty']->value) {?>
            <div class="empty-state">
                <i class="fas fa-folder-open fa-3x"></i>
                <p>Brak projektów spełniających kryteria wyszukiwania</p>
                <a href="index.php?action=add" class="btn btn-primary">Dodaj pierwszy projekt</a>
            </div>
        <?php } else { ?>
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
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['projekty']->value, 'projekt');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['projekt']->value) {
?>
                            <tr>
                                <td><strong><?php echo $_smarty_tpl->tpl_vars['projekt']->value['nazwa'];?>
</strong></td>
                                <td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['projekt']->value['opis'],100,"...");?>
</td>
                                <td><i class="far fa-calendar-alt"></i> <?php echo $_smarty_tpl->tpl_vars['projekt']->value['data_rozpoczecia'];?>
</td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['projekt']->value['status'] == 'zakończony') {?>
                                        <span class="badge success"><i class="fas fa-check-circle"></i> Zakończony</span>
                                    <?php } else { ?>
                                        <span class="badge warning"><i class="fas fa-spinner fa-spin"></i> W trakcie</span>
                                    <?php }?>
                                </td>
                                <td><i class="fas fa-user"></i> <?php echo $_smarty_tpl->tpl_vars['projekt']->value['odpowiedzialny'];?>
</td>
                                <td>
                                    <?php $_smarty_tpl->_assignInScope('data_rozpoczecia', $_smarty_tpl->tpl_vars['projekt']->value['data_rozpoczecia']);?>
                                    <?php $_smarty_tpl->_assignInScope('aktualna_data', smarty_modifier_date_format("now","%Y-%m-%d"));?>
                                    <?php $_smarty_tpl->_assignInScope('roznica', (strtotime($_smarty_tpl->tpl_vars['aktualna_data']->value)-strtotime($_smarty_tpl->tpl_vars['data_rozpoczecia']->value))/(60*60*24));?>
                                    <?php if ($_smarty_tpl->tpl_vars['roznica']->value >= 0) {?>
                                        <i class="fas fa-clock"></i> <?php echo sprintf("%d",$_smarty_tpl->tpl_vars['roznica']->value);?>
 dni
                                    <?php } else { ?>
                                        <i class="fas fa-hourglass-start"></i> Niedawno rozpoczęty
                                    <?php }?>
                                </td>
                                <td class="actions">
                                    <a href="index.php?action=view_tasks&id=<?php echo $_smarty_tpl->tpl_vars['projekt']->value['id'];?>
" class="btn btn-primary" title="Zadania"><i class="fas fa-tasks"></i></a>
                                    <a href="index.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['projekt']->value['id'];?>
" class="btn btn-edit" title="Edytuj"><i class="fas fa-edit"></i></a>
                                    <a href="index.php?action=delete&id=<?php echo $_smarty_tpl->tpl_vars['projekt']->value['id'];?>
" class="btn btn-delete" onclick="return confirm('Czy na pewno chcesz usunąć projekt \'<?php echo $_smarty_tpl->tpl_vars['projekt']->value['nazwa'];?>
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

            <div class="action-buttons">
                <a href="index.php?action=add" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj nowy projekt</a>
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
</html>
<?php }
}
