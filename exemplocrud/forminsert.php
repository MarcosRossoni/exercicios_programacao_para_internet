<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Cadastor de pessoas</title>
</head>
<body>
<h1>Cadastro de Pessoas</h1>
<form method="POST" action="operations.php?q=insert">
    <label>Nome:</label><input type="text" name="nome"><br><br>
    <label>Idade:</label><input type="text" name="idade"><br><br>
    <label>Sexo:</label><input type="text" name="sexo"><br><br>
    <label>Estado Civil:</label>
    <select name="estado_civil">
        <option value="solteiro">Solteiro</option>
        <option value="casado">Casado</option>
        <option value="outro">Outro</option>
    </select><br><br>
    <input type="submit" value="Cadastrar"><br><br>
</form>
</body>
</html>