<?php
/* Smarty version 3.1.33, created on 2025-05-15 16:58:24
  from 'C:\Users\tomas\Desktop\WEBSITE\smarty\templates\edit_task.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_68260110821770_86861072',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7fa0d27037f23f52ddf8fc0324b36b3f468867c' => 
    array (
      0 => 'C:\\Users\\tomas\\Desktop\\WEBSITE\\smarty\\templates\\edit_task.tpl',
      1 => 1746297624,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68260110821770_86861072 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\tomas\\Desktop\\WEBSITE\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
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
        <h1><i class="fas fa-edit"></i> Edytuj zadanie: <?php echo $_smarty_tpl->tpl_vars['zadanie']->value['nazwa'];?>
</h1>
        <h3>Projekt: <?php echo $_smarty_tpl->tpl_vars['projekt']->value['nazwa'];?>
</h3>
        
        <div class="card">
            <form method="POST" action="index.php?action=edit_task&task_id=<?php echo $_smarty_tpl->tpl_vars['zadanie']->value['id'];?>
" class="form-horizontal">
                <div class="form-group">
                    <label for="nazwa"><i class="fas fa-tag"></i> Nazwa zadania:</label>
                    <input type="text" id="nazwa" name="nazwa" value="<?php echo $_smarty_tpl->tpl_vars['zadanie']->value['nazwa'];?>
" required>
                </div>

                <div class="form-group">
                    <label for="opis"><i class="fas fa-file-alt"></i> Opis zadania:</label>
                    <textarea id="opis" name="opis" rows="4" required><?php echo $_smarty_tpl->tpl_vars['zadanie']->value['opis'];?>
</textarea>
                </div>

                <div class="form-group">
                    <label for="termin"><i class="fas fa-calendar"></i> Termin wykonania:</label>
                    <input type="date" id="termin" name="termin" value="<?php echo $_smarty_tpl->tpl_vars['zadanie']->value['termin'];?>
" required>
                </div>

                <div class="form-group">
                    <label for="status"><i class="fas fa-tasks"></i> Status:</label>
                    <select id="status" name="status" required>
                        <option value="do zrobienia" <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['status'] == 'do zrobienia') {?>selected<?php }?>>Do zrobienia</option>
                        <option value="w trakcie" <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['status'] == 'w trakcie') {?>selected<?php }?>>W trakcie</option>
                        <option value="zakończone" <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['status'] == 'zakończone') {?>selected<?php }?>>Zakończone</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="przypisane_do"><i class="fas fa-user"></i> Przypisane do:</label>
                    <input type="text" id="przypisane_do" name="przypisane_do" value="<?php echo $_smarty_tpl->tpl_vars['zadanie']->value['przypisane_do'];?>
" required>
                </div>

                <div class="form-group">
                    <label for="priorytet"><i class="fas fa-exclamation"></i> Priorytet:</label>
                    <select id="priorytet" name="priorytet" required>
                        <option value="niski" <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['priorytet'] == 'niski') {?>selected<?php }?>>Niski</option>
                        <option value="średni" <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['priorytet'] == 'średni') {?>selected<?php }?>>Średni</option>
                        <option value="wysoki" <?php if ($_smarty_tpl->tpl_vars['zadanie']->value['priorytet'] == 'wysoki') {?>selected<?php }?>>Wysoki</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Zapisz zmiany</button>
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
