<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Leitura de Dados</title>

  <style type="text/css">
    table, th, td {
      border-style: solid;
      border-width: 1px;
      padding: 4px;
      text-align: center;
    }
  </style>
</head>
<?php require_once ("menu.php")?>
<body onload="readPessoas()">
<table id="tabela"></table>
</body>
<script>
    function readPessoas() {
        document.getElementById("tabela").innerHTML = "";
        let xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let response = JSON.parse(this.responseText);

                let table =
                    "<thead>" +
                    "<tr>" +
                    "<th>Nome</th>" +
                    "<th>Idade</th>" +
                    "<th>Sexo</th>" +
                    "<th>Estado Civil</th>" +
                    "<th>Salvar</th>" +
                    "<th>Deletar</th>" +
                    "</tr>" +
                    "</thead>"

                let newLine = "";
                for (let i = response.length - 1; i >= 0; i--) {

                    newLine += `<tr>
                                    <td hidden='true'><p>${response[i].id}</p></td>
                                    <td ondblclick="includeEvents(this)"><p>${response[i].nome}</p></td>
                                    <td ondblclick="includeEvents(this)"><p>${response[i].idade}</p></td>
                                    <td ondblclick="includeEvents(this)"><p>${response[i].sexo}</p></td>
                                    <td ondblclick="includeEvents(this)"><p>${response[i].estado_civil}</p></td>
                                    <td ondblclick="includeEvents(this)">
                                        <a href="#" id="save" onclick="salva()">
                                            <img src="https://upload.wikimedia.org/wikipedia/pt/0/02/Homer_Simpson_2006.png"
                                                    width="40px" height="40px">
                                        </a>
                                    </td>
                                    <td ondblclick="includeEvents(this)">
                                        <a href="#" id="delete" onclick="deletar(this)">
                                            <img src="https://slm-assets.secondlife.com/assets/9409761/lightbox/Homer_Doh.jpg?1395664916"
                                                    width="40px" height="40px">
                                        </a>
                                    </td>
                                </tr>`
                }
                table += newLine;
                document.getElementById("tabela").innerHTML = table;
            }
        }
        xhttp.open("GET", "operations.php?q=readPessoas", true);
        xhttp.send();
    }

    function includeEvents(elemento){
        elemento.setAttribute("contenteditable", "true");
        elemento.setAttribute("onblur", "salva(this)");
    }

    function salva(elemento){
        elemento.setAttribute("contenteditable", "false")

        let line = elemento.parentElement;
        let id = line.children[0].children[0].innerHTML;
        let nome = line.children[1].children[0].innerHTML;
        let idade = line.children[2].children[0].innerHTML;
        let sexo = line.children[3].children[0].innerHTML;
        let estado_civil = line.children[4].children[0].innerHTML;
        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200){
                window.alert("" + this.responseText)
            }
        }
        xhttp.open("GET", `operations.php?q=update&id=${id}&nome=${nome}&idade=${idade}&sexo=${sexo}&
                        estado_civil=${estado_civil}`, true);
        xhttp.send();
    }

    function deletar(elemento){
        let xhttp = new XMLHttpRequest();
        let line = elemento.parentElement.parentElement;
        let id = line.children[0].children[0].innerHTML;

        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200){
                document.getElementById("tabela").innerHTML = "";
                window.alert("" + this.responseText);
                readPessoas();
            }
        }
        xhttp.open("GET", `operations.php?q=delete&id=${id}`, true);
        xhttp.send();
    }

</script>
</html>