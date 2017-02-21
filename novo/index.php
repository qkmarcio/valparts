<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html lang="pt-BR" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Agencia</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/jquery-ui-1.9.1.custom.min.css">
        
        <link rel="stylesheet" href="css/main.css">
        <script src="js/js_1.9/jquery-1.8.2.js" type="text/javascript"></script>
        <script src="js/js_1.9/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jquery.mask.js" type="text/javascript"></script>
        
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <script>
            function loadjscssfile(filename, filetype){             
                var fileref = null;
                if (filetype=="js"){ //if filename is a external JavaScript file
                    fileref=document.createElement('script');
                    fileref.setAttribute("type","text/javascript");
                    fileref.setAttribute("src", filename);
                }
                else if (filetype=="css"){ //if filename is an external CSS file
                    fileref=document.createElement("link");
                    fileref.setAttribute("rel", "stylesheet");
                    fileref.setAttribute("type", "text/css");
                    fileref.setAttribute("href", filename);
                }
                if (typeof fileref!="undefined"){
                    document.getElementsByTagName("head")[0].appendChild(fileref);
                }                    
            }
            loadjscssfile('js/main.js?nocache=1','js');
            //loadContent('#conteudo','html/inicio.php');
            
        </script>
        
        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="javascript:loadContent('#conteudo','html/inicio.php?v=2');">Tabom Tur</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastro <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="javascript:loadContent('#conteudo','html/cadastro/hotel.html?v=2');">Hotel</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:loadContent('#conteudo','html/cadastro/motorista.html?v=2');">Motorista</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:loadContent('#conteudo','html/cadastro/guia.html?v=2');">Guia</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:loadContent('#conteudo','html/cadastro/grupo.html?v=2');">Grupo</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Relatorio <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Grupo para Chegar</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Grupo em Foz</a></li>
                  </ul>
                </li>
                <li><a href="#about">Ajuda</a></li>
              </ul>
            </div><!--/.navbar-collapse Fim -->
          </div><!--/.container Fim -->
        </div><!--/.navbar Fim -->
        <div class="container" style="padding-top: 20px">
            <div id="conteudo"><?php include 'html/inicio.php';?></div>

            <hr>

            <footer>
              <p>&copy; Company 2013</p>
            </footer>
        </div> <!-- /container -->
        
        
        <script>
            /*var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
            loadContent('#conteudo','html/cadastro/hotel.html');*/
        </script>
    </body>
</html>
