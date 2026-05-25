<?php
/* Smarty version 3.1.33, created on 2025-05-03 21:08:29
  from 'C:\xampp\htdocs\WEBSITE\smarty\templates\add_task.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_681669ad6c7d78_41391445',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d04d8b76da3fd2830cdf8a8a10b887d5376b162' => 
    array (
      0 => 'C:\\xampp\\htdocs\\WEBSITE\\smarty\\templates\\add_task.tpl',
      1 => 1746297623,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_681669ad6c7d78_41391445 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\WEBSITE\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Dodaj nowe zadanie</title>
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
        <h1><i class="fas fa-plus-circle"></i> Dodaj nowe zadanie do projektu: <?php echo $_smarty_tpl->tpl_vars['projekt']->value['nazwa'];?>
</h1>
        
        <div class="card">
            <form method="POST" action="index.php?action=add_task&id=<?php echo $_smarty_tpl->tpl_vars['projekt']->value['id'];?>
" class="form-horizontal">
                <div class="form-group">
                    <label for="nazwa"><i class="fas fa-tag"></i> Nazwa zadania:</label>
                    <input type="text" id="nazwa" name="nazwa" placeholder="Wprowadź nazwę zadania" required>
                </div>

                <div class="form-group">
                    <label for="opis"><i class="fas fa-file-alt"></i> Opis zadania:</label>
                    <textarea id="opis" name="opis" rows="4" placeholder="Opisz szczegóły zadania" required></textarea>
                </div>

                <div class="form-group">
                    <label for="termin"><i class="fas fa-calendar"></i> Termin wykonania:</label>
                    <input type="date" id="termin" name="termin" required>
                </div>

                <div class="form-group">
                    <label for="status"><i class="fas fa-tasks"></i> Status:</label>
                    <select id="status" name="status" required>
                        <option value="" disabled selected>Wybierz status</option>
                        <option value="do zrobienia">Do zrobienia</option>
                        <option value="w trakcie">W trakcie</option>
                        <option value="zakończone">Zakończone</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="przypisane_do"><i class="fas fa-user"></i> Przypisane do:</label>
                    <input type="text" id="przypisane_do" name="przypisane_do" placeholder="Imię i nazwisko" required>
                </div>

                <div class="form-group">
                    <label for="priorytet"><i class="fas fa-exclamation"></i> Priorytet:</label>
                    <select id="priorytet" name="priorytet" required>
                        <option value="" disabled selected>Wybierz priorytet</option>
                        <option value="niski">Niski</option>
                        <option value="średni">Średni</option>
                        <option value="wysoki">Wysoki</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Zapisz zadanie</button>
                    <a href="index.php?action=view_tasks&id=<?php echo $_smarty_tpl->tpl_vars['projekt']->value['id'];?>
" class="btn btn-secondary"><i class="fas fa-times"></i> Anuluj</a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo smarty_modifier_date_format(time(),"%Y");?>
 Zarządzanie Projektami | Created by Tomasz Pielecki</p>
    </footer>
</body>
</html><?php }
}
