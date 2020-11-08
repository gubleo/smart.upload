<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Smart Upload | Upload de Arquivos</title>

    <link rel="icon" href=" " type="image/x-icon">
    <script type="text/javascript" src="js/material.js"></script>
    <link rel="stylesheet" type="text/css" href="css/mdl-style.css">
    <link rel="stylesheet" type="text/css" href="css/material.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_purple-pink.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
</head>
<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-500 mdl-base">
<form action="upload.php" method="post" id="upload">

<div class="demo-blog mdl-layout mdl-js-layout has-drawer is-upgraded">
    <main class="mdl-layout__content">

        <div class="mdl-grid demo-blog__posts pl-2">
            <h2 class="mdl-typography--font-thin">Upload de Arquivos
                <br>
                <p class="mdl-typography--font-thin">Faça upload de arquivos para o servidor. </p></h2>

        </div>

        <!-- Card com Informações -->

        <div class="demo-blog__posts mdl-grid animated fadeIn">

            <div class="mdl-card something-else mdl-cell mdl-cell--8-col mdl-cell--4-col-desktop mdl-shadow--2dp" style="border-bottom: solid 3px darkorange">
                <div class="mdl-card__supporting-text meta meta--fill mdl-color-text--grey-600">
                    <div>
                        <strong>Informações</strong>
                    </div>
                </div>
                <div class="mdl-card__media mdl-color--white mdl-color-text--grey-600 font animated fadeIn">
                    <!-- Numeric Textfield -->
                    <div class="mdl-textfield mdl-js-textfield">
                        <select id="categoria" name="categoria" class="mdl-textfield__input">
                            <option value="" disabled selected style='display:none;'>Selecione a categoria</option>
                            <option value="Categoria1">Informativo</option>
                            <option value="Categoria2">Documentos</option>
                            <option value="Categoria3">Outros</option>
                        </select>
                    </div>

                    <div class="mdl-textfield mdl-js-textfield" style="margin-bottom: 30px">
                        <input class="mdl-textfield__input" type="text"name="postagem" id="postagem" rows="4" cols="100" maxlength="1000"  placeholder="Descrição do Arquivo" required mensagem=mensagem>
                        <span class="mdl-textfield__error">Insira uma breve descrição sobre o Upload</span>
                    </div>
                </div>
            </div>

            <div class="mdl-card something-else mdl-cell mdl-cell--8-col mdl-cell--8-col-desktop mdl-shadow--2dp" style="border-bottom: solid 3px deepskyblue">
                <div class="mdl-card__supporting-text meta meta--fill mdl-color-text--grey-600">
                    <div>
                        <strong>Envio de arquivos</strong>
                    </div>
                </div>
                <div class="mdl-card__media mdl-color--white mdl-color-text--grey-600 font animated fadeIn">

                    <input type="file" name="file" id="file" accept="*"/>
                    <span>Upload apenas de um arquivo por vez.</span>


                    <div style="margin-top: 10px; padding-top: 10px;">
                        <center>
                    <div id="preview"></div>
                        </center>
                    <br>

                    <span>Link Gerado: <a id="caminho" style="color: dodgerblue">Ainda nenhum caminho foi especificado.</a></span>
                    </div>



                </div>
            </div>

            <!-- Botão Continuar-->

            <nav class="demo-nav mdl-cell mdl-cell--12-col animated fadeIn">
                <div class="section-spacer"></div>
                <a href="#" class="demo-nav__button mdl-color-text--grey-600" id="continuar">
                    Fazer Upload dos Arquivos
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-shadow--2dp mdl-color--cyan" value="Publicar" >
                        <i class="material-icons mdl-color-text--white" role="presentation">cloud_upload</i>
                    </button>
                </input>
            </nav>

        </div>

        <!-- Informações parte de baixo -->

    </main>
</div>
</form>

<script>
        //Joga em uma variavel o formulario e o preview onde jogaremos nossas respostas
        var $formUpload = document.getElementById('upload'),
            $preview = document.getElementById('preview'),
            i = 0;
        $formUpload.addEventListener('submit', function(event){
          event.preventDefault();
          var xhr = new XMLHttpRequest();
          xhr.open("POST", $formUpload.getAttribute('action'));
          var formData = new FormData($formUpload);
          formData.append("i", i++);
          xhr.send(formData);
          xhr.addEventListener('readystatechange', function() {
            if (xhr.readyState === 4 && xhr.status == 200) {
              var json = JSON.parse(xhr.responseText);
              alert(json.status);
              if (!json.error && json.status === 'Arquivo enviado com sucesso.') {

                alert("Upload feito com sucesso. Link: http://anima.craos.net/smart.interact/ws/comunicados/"+json.foto);
                  document.getElementById('caminho').innerText = 'http://anima.craos.net/smart.interact/ws/comunicados/' +json.foto;
                document.getElementById("postagem").value = "";
              } else {
                $preview.innerHTML = 'Arquivo não enviado';
              }
            } else {
              $preview.innerHTML = xhr.statusText;
            }
          });
          xhr.upload.addEventListener("progress", function(e) {
            if (e.lengthComputable) {
              var percentage = Math.round((e.loaded * 100) / e.total);
              $preview.innerHTML = String(percentage) + '%';
            }
          }, false);
          xhr.upload.addEventListener("load", function(e){
            $preview.innerHTML = String(100) + '%';
          }, false);
        }, false);
    </script>
</body>
</html>