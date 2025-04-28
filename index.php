<?php
require_once 'php/db_connect.php';
require_once 'php/create_corretor.php';
require_once 'php/delete_corretor.php';


$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

$editing = false;
$corretor_edit = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM corretores WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $corretor_edit = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($corretor_edit) {
        $editing = true;    
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Corretor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Corretor</h1>
        
        <?php if ($success_message): ?>
            <div class="alert success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <form id="corretorForm" action="php/create_corretor.php" method="POST">
            <?php if ($editing): ?>
                <input type="hidden" name="id" value="<?php echo $corretor_edit['id']; ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf"
                    value="<?php echo $editing ? $corretor_edit['cpf'] : ''; ?>"
                    required pattern="\d{11}"
                    title="CPF deve conter exatamente 11 dígitos">
            </div>
            
            <div class="form-group">
                <label for="creci">CRECI:</label>
                <input type="text" id="creci" name="creci"
                    value="<?php echo $editing ? $corretor_edit['creci'] : ''; ?>"
                    required minlength="2"
                    title="CRECI deve ter pelo menos 2 caracteres">
            </div>
            
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" 
                    value="<?php echo $editing ? $corretor_edit['nome'] : ''; ?>"
                    required minlength="2"
                    title="Nome deve ter pelo menos 2 caracteres">
            </div>
            
            <button type="submit" class="btn-submit">
                <?php echo $editing ? 'Salvar' : 'Enviar'; ?>
            </button>
            
            <?php if ($editing): ?>
                <a href="index.php" class="btn-cancel">Cancelar</a>
            <?php endif; ?>
        </form>
        
        <h2>Corretores Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>CRECI</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM corretores ORDER BY id DESC");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['nome']}</td>";
                    echo "<td>{$row['cpf']}</td>";
                    echo "<td>{$row['creci']}</td>";
                    echo "<td class='actions'>";
                    echo "<a href='index.php?edit={$row['id']}' class='btn-edit'>Editar</a>";
                    echo "<a href='php/delete_corretor.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir este corretor?\")'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>