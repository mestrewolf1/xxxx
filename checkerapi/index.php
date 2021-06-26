<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Checker CC Checkout</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <style>
            html {
                font-size: 16px;
                background-color: #2e3e4e;
                color: #1ABB9C;
                font-family: "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;
                overflow: hidden;
            }
            body {
                background-color: #2e3e4e;
            }
            .lista {
                width: 1300px;
                height: 150px;
                text-align: center;
                resize: none;
                background-color: #2C3A48;
                color: #fff;
                font-size: 17px;
                border: none;
                border-radius: 8px;
                overflow: auto;
            }
            .lista:focus {
                outline: none;
            }
            .afs {
                font-weight: bold;
            }
            .green {
                background-color: #4caf50;
                color: rgba(255, 255, 255, 0.87);
                padding: 0.25em 0.5em;
                border-radius: 500px;
            }
            .red {
                background-color: #f44336;
                color: rgba(255, 255, 255, 0.87);
                padding: 0.25em 0.5em;
                border-radius: 500px;
            }
            .check {
                background-color: #fcc100;
                color: rgba(255, 255, 255, 0.87);
                padding: 0.25em 0.5em;
                border-radius: 500px;
            }
            .botao {
                margin-top: 10px;
                width: 150px;
                height: 50px;
                background-color: #2C3A48;
                border-radius: 5px;
                border: none;
                color: rgba(255, 255, 255, 0.87);
                cursor: pointer;
                -webkit-appearance: button;
                transition: all .2s ease-in-out;
                font-family: "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;
            }
            .botao:hover {
                background-color: rgba(255, 255, 255, 0.87);
                color: #2C3A48;
            }
            .botao:focus {
                outline: none;
            }
            .test {
                resize: none;
                background-color: #2C3A48;
                color: #fff;
                border: none;
                text-align: center;
                width: 1340px;
                height: 150px;
            }
            .test:focus {
                outline: none;
            }
            .back {
                color: #1ABB9C;
                text-decoration: none;
            }
            .back:hover {
                text-shadow: 1px 1px 1px #1ABB9C;
            }
            #stats {
                background-color: #f44336;

                color: rgba(255, 255, 255, 0.87);
                padding: 0.25em 0.5em;
                border-radius: 500px;
            }
            #aps {
                background-color: #4caf50;
                color: rgba(255, 255, 255, 0.87);
                padding: 0.25em 0.5em;
                border-radius: 500px;
            }
            #ups {
                background-color: #fcc100;;
                color: rgba(255, 255, 255, 0.87);
                padding: 0.25em 0.5em;
                border-radius: 500px;
            }
            #reps {
                background-color: #f44336;
                color: rgba(255, 255, 255, 0.87);
                padding: 0.25em 0.5em;
                border-radius: 500px;
            }
            #test {
                background-color: #E69A00;
                color: rgba(255, 255, 255, 0.87);
                padding: 0.25em 0.5em;
                border-radius: 500px;
            }
        </style>
        <script>
            var loop = 0;
            var total = 0;
            function start()
            {
                var i;
                var tudo = $('#text').val();
                var linha = tudo.split("\n");
                var separador = "|";
                for (i = 0; i < linha.length; i++) {
                    document.getElementById('stats').innerText = 'Testando!';
                    document.getElementById("stats").style = "background-color: #72B7D4;";
                    var separado = linha[i];
                    var id = i;
                    check(separado, separador, id);
                    var total = linha.length;
                    document.getElementById('ups').innerText = total;
                }
            }
            var aps = 0;
            var rps = 0;
            var testadas = 0;
            function check(separado, separador, id) {
                setTimeout(function () {
                    $.ajax({
                        type: 'GET',
                        url: 'api.php',
                        dataType: 'html',
                        data: {'testar': 'linha', 'receive': separado, 'separador': separador, 'id': id},
                        success: function (msg)
                        {
                            ++testadas;
                            document.getElementById('test').innerText = testadas;
                            if (msg.indexOf("{Die}") >= 0) {
                                var reprovadas2 = $("#resultado2").val();
                                ++rps;
                                document.getElementById('reps').innerText = rps;
                                $("#resultado2").val(reprovadas2 + msg + "\n");
                            } else {
                                var reprovadas = $("#resultado").val();
                                ++aps;
                                document.getElementById('aps').innerText = aps;
                                $("#resultado").val(reprovadas + msg + "\n");
                            }

                        }
                    });
                }, id * 1500);
            }
        </script>
    </head>
    <body>
    <center>
        <font size="7"></font> <br />
        <font size="3" class="afs">Checker CC Checkout<a style="text-decoration: none;color: #1ABB9C;" href="" target="_blank">By Crook</a></font>
        <br /><br />
        <textarea class="lista" id="text" name="text" placeholder="Formato: Email|Senha"></textarea>
        <br /><div class="afs"><font size="2">
            Status: <span class="stats" id="stats"><b>Parado!</b></span>
            | Upadas: <span class="ups" id="ups"><b>0</b></span>
            | Aprovadas: <span class="aps" id="aps"><b>0</b></span>
            | Reprovadas: <span class="reps" id="reps"><b>0</b></span>
            | Testadas: <span class="test" id="test"><b>0</b></span>
        </div>
        <button type="submit" id="x" name="x" class="botao" onclick="start()">Testar</button>
        <font></font>
        <br /><br /><textarea class="test" id="resultado" style="color: #0FFC0F;"></textarea><br>
        <textarea class="test" id="resultado2" style="color: #FC0F0F;"></textarea>
    </center>
</body>
</html>
