<?php
/* Smarty version 3.1.33, created on 2025-05-15 17:02:59
  from 'C:\Users\tomas\Desktop\WEBSITE\smarty\templates\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_68260223d8c780_79438719',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b025219664e420afd196c6a70af935d1304e3c11' => 
    array (
      0 => 'C:\\Users\\tomas\\Desktop\\WEBSITE\\smarty\\templates\\edit.tpl',
      1 => 1746298256,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68260223d8c780_79438719 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\tomas\\Desktop\\WEBSITE\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Edytuj projekt</title>
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
        <h1><i class="fas fa-edit"></i> Edytuj projekt</h1>
        
        <div class="card">
            <form method="POST" action="index.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['projekt']->value['id'];?>
" class="form-horizontal">
                <div class="form-group">
                    <label for="nazwa"><i class="fas fa-tag"></i> Nazwa projektu:</label>
                    <input type="text" id="nazwa" name="nazwa" value="<?php echo $_smarty_tpl->tpl_vars['projekt']->value['nazwa'];?>
" required>
                </div>

                <div class="form-group">
                    <label for="opis"><i class="fas fa-file-alt"></i> Opis projektu:</label>
                    <textarea id="opis" name="opis" rows="4" required><?php echo $_smarty_tpl->tpl_vars['projekt']->value['opis'];?>
</textarea>
                </div>

                <div class="form-group">
                    <label for="data_rozpoczecia"><i class="fas fa-calendar"></i> Data rozpoczęcia:</label>
                    <input type="date" id="data_rozpoczecia" name="data_rozpoczecia" value="<?php echo $_smarty_tpl->tpl_vars['projekt']->value['data_rozpoczecia'];?>
" required>
                </div>
                
                <div class="form-group">
                    <label for="data_zakonczenia"><i class="fas fa-calendar-check"></i> Data zakończenia:</label>
                    <input type="date" id="data_zakonczenia" name="data_zakonczenia" value="<?php echo $_smarty_tpl->tpl_vars['projekt']->value['data_zakonczenia'];?>
">
                    <small class="form-text">Pozostaw puste jeśli termin nie jest jeszcze określony</small>
                </div>

                <div class="form-group">
                    <label for="status"><i class="fas fa-tasks"></i> Status:</label>
                    <select id="status" name="status" required>
                        <option value="zakończony" <?php if ($_smarty_tpl->tpl_vars['projekt']->value['status'] == 'zakończony') {?>selected<?php }?>>Zakończony</option>
                        <option value="w trakcie" <?php if ($_smarty_tpl->tpl_vars['projekt']->value['status'] == 'w trakcie') {?>selected<?php }?>>W trakcie</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="odpowiedzialny"><i class="fas fa-user"></i> Osoba odpowiedzialna:</label>
                    <input type="text" id="odpowiedzialny" name="odpowiedzialny" value="<?php echo $_smarty_tpl->tpl_vars['projekt']->value['odpowiedzialny'];?>
" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Zapisz zmiany</button>
                    <a href="index.php" class="btn btn-secondary"><i class="fas fa-times"></i> Anuluj</a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo smarty_modifier_date_format(time(),"%Y");?>
 Zarządzanie Projektami | Created by Tomasz Pielecki</p>
    </footer>
</body>
</html>
<?php }
}
