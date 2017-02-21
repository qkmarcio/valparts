var main = {};

main.ajax=function(obj,funcao,view){                                                  // FUNÇÃO AJAX
        var data = {'obj':obj,'action':funcao};                                             // SETA OS PARAMETROS
        var retorno;                                                                        // VAR DE RETORNO
        $.ajax({type:"POST", url:view, dataType:"json", data:data,async:false,              // FAZ UM AJAX SINCRONIZADO COM A FUNCAO
            success: function(json) { retorno = json; },                                    // RETORNO DO AJAX NO SUCCESS
            error: function(json) { retorno=json; }                                         // RETORNO DO AJAX NO ERROR
        });                                                                                 // FIM DO AJAX        
        return retorno;                                                                     // RETORNO DA FUNÇÃO
};
    
main.listarNaTable=function(jQueryTable,json,cab){                                    // FUNÇÃO LISTAR NA TABLE
    if(json === null){ return 0;}                                                       // CASO JSON NAO TENHA NENHUM ELEMENTO
    jQueryTable.empty();                                                                // LIMPA A TABLE
    if(cab){                                                                            // VERIFICA SE VAI ESCREVER O CABEÇALHO DA TABELA
        var c;                                                                          // VAR LOCAL
        var obj = json[0];                                                              // OBJ LOCAL
        c = "<tr>";                                                                     // NOVA TR
        for(var k in obj) { c = c + "<th id=th"+k+" >"+k+"</th>"; }                  // SETANDO OS ATRIBUTOS DO OBJECT            
        c = c +"</tr>";                                                                 // FECHA A TR
        $('<thead></thead>').append(c).appendTo(jQueryTable);                           // ADD CABEÇALHO E FAZ APPEND NA TABLE
    }                                                                                   // FIM DO IF 
    for(var i =0; i < json.length; i++){                                                // LAÇO DE REPETIÇÃO
        var obj = json[i];                                                              // PEGA OBJETO                                                
        var colunas = '';                                                               // VAR COLUNAS
        for(var k in obj) {                                                             // LAÇO PARA PEGAR OS ATRIBUTOS DO OBJETO
            colunas = colunas +                                                         // COLUNA RECEBE O QUE JÁ TEM NELA +
            "<td id='td"+k+"'>"+obj[k]+"</td>";                                      // O QUE ESTA NO OBJETO
        }                                                                               // FIM DO LAÇO
        $('<tr></tr>').append(colunas).appendTo(jQueryTable);          // APPEND PARA O TABLE
    }                                                                                   // FIM DO FOR
};
/**
     * custom.autocomplet(jQuery,strLabel,ajaxFuncao,ajaxView)<br/>
     * paramentros:<br/>
     * &nbsp; jQuery = elemento jQuery ex: $('#ex')<br/>
     * &nbsp; strLabel = string atributo da tab que vai no input <br/>
     * &nbsp; strFuncao = string funcao php a ser chamada<br/>
     * &nbsp; strView = string view a ser chamada<br/>
     * return:<br/>
     * &nbsp; para o RETORNO use a seguinte assinatura: <br/>
     * &nbsp; custom.autocomplet.retorno=function(obj){<br/> &nbsp;...<br/> &nbsp;};
     */
    main.autocomplet=function(jQuery,strLabel,strFuncao,strView){                       // FUNÇÃO AUTOCOMPLETAR        
        jQuery.autocomplete({                                                               // AUTOCOMPLETAR O FORNECEDOR
            minLength: 2,                                                                   // CARACTERES MINIMO PARA AUTOCOMPLETAR
            source: function(request, response) {                                           // ORIGEM DA INFORMAÇÃO                
                var obj = new Object();                                                     // NOVO OBJETO
                obj.maxRows = 10;                                                           // MAXIMO DE REGISTROS NO RETORNO
                obj.letra = request.term;                                                   // TERMO DA PESQUISA
                var data = main.ajax(obj, strFuncao, strView);                          // DATA RECEBE RESULTADOS DO AJAX
                response($.map(data, function(item) {                                       // FUNCAO RESPONSE 
                    return {label: item[strLabel], obj: item}                               // LABEL E OBJ DE RETORNO
                }));                                                                        // RETORNO
            },                                                                              // FIM DA ORIGEM DOS DADOS
            select: function(event, ui) {                                                   // PARAMETRO SELECT                                
                var obj = ui.item.obj;                                                      // RECEBE O OBJETO DE RETORNO                
                jQuery.val(obj[strLabel]);                                                  // PREENCHE RETORNO DA CONSULTA                
                main.autocomplet.retorno(obj);
                main.objRetorno = obj;
            }                                                                               // FIM DO PARAMETRO SELECT
        });                                                                                 // FIM DO JQUERYAUTOCOMPLETE        
    };
    main.autocomplet.retorno=function(obj){};
            
            function loadContent(id, pagina) {           
                $(id).slideUp("slow",function(){//efeito de sobe e desce o footer
                    pagina = pagina + "?nocache="+Math.random();                        // FAZ NO-CACHE EM TODOS OS ARQUIVOS A SEREM CHAMADOS
                    $(this).load(pagina, function(){                                    // CARREGA A PAGINA 
                        $(this).slideDown("slow");                                      // EFEITO ABAIXAR QUADRO                
                    });
                });
            }
/*$app = angular.module('app',[]);
$app.config(function($routeProvider){
    $routeProvider.when('/',{controller:listaInicio, templateUrl:'html/inicio.php'}).
    when('/home',{controller:listaInicio, templateUrl:'html/inicio.php'}).
    when('/hotel',{controller:colHotel, templateUrl:'html/cadastro/hotel.html'}).
    otherwise({redirectTo:'/'});
    
    
    
 });
 



function listaInicio($scope){
    $scope.titulo = "Marcio";
}

function colHotel($scope, $window, $http){
    
	var 
		$ = jQuery,
		ng = $scope,
		aj = $http,
		wi = $window
	;
        ng.salvar = function(){
		
		if(ng.unidade.id > 0){
			$.ajax({
				type: 'put',
				url: 'service/produtos',
				data: ng.unidade,
			});
		} else {
			aj.post('service/produtos', ng.unidade).success(function(data){
				ng.lista.unshift(data);
				reset();
			});	
		}
		
	};

	ng.editar = function(unidade){
		ng.unidade = unidade;
	};

	ng.excluir = function(unidade){
		var confirm = wi.confirm('Tem certeza que deseja excluir o produto '+ unidade.title+ '?');
		if(confirm){
			aj.delete('service/produtos/'+unidade.id).success(function(data){
				var index = ng.lista.indexOf(unidade);
				ng.lista.splice(index, 1);
			});
		}
	};

	var reset = function(){
		ng.unidade = {id:0, category:'', title: '', google_id:''};
	};

	var init = function(){

		aj.get('view/vHotel.php?action=fetchAll').success(function(json){
			ng.lista = json.data;
                        console.info(json.data);
		});

		reset();
	};

	init();

}*/

/*var app = angular.module('app', ['Controllers']);

    app.config(['$routeProvider',
        function($routeProvider) {
            $routeProvider.
                when('', {
                    templateUrl: 'html/inicio.php',
                    controller: 'listaInicio'
                }).
                when('/hotel', {
                    templateUrl: 'html/cadastro/guia.html',
                    controller: 'listaHotel'
                }).
                otherwise({
                    redirectTo: ''
                });
        }
    ]);*/