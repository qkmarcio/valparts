    /*
     * Maison K. Sakamoto - 06/11/2013 - Desing Patterner
     * É bom adotar a pratica de começar o código já com um TAB da margem
     * isso deixa o código mais limpo no NetBeans, pois temos o numero da linha e
     * a linha de agrupamento tudo muito proximo, talvez em outra IDE isso seja
     * desnecessário.
     * 
     * 1. Usar 
     */
    
    var ctCompra = {};                                                          // NOVO PADRAO DE DESENVOLVIMENTO        
    ctCompra.start = function(){ ctCompra.eventos(); };                         // PRIMEIRA FUNCAO
    ctCompra.confirmar = function(){ console.info('confirmar *implementar'); }; // BOTAO CONFIRMAR
    ctCompra.retornar = function(){ $('.botaocontrolecompras').click(); };      // BOTAO CANCELAR
    ctCompra.setObjCompra = function(obj){ ctCompra.obj = obj; };               // SETANDO OBJETO
    ctCompra.getObjCompra = function(){ return ctCompra.obj; };                 // RETORNANDO O OBJETO    
    
    ctCompra.novoFornec=function(){                                             // FUNCAO NOVOFORNEC        
        var url = "Agendas/compromissocontrolecompranovo.php";                  // PEGA URL
         $('#grid2').slideUp("slow",                                            // INI EFEITO 
             function(){                                                        // INI FUNCAO 
                $('#grid2').load(url, function(){                               // CARREGAR PAGINA
                $(this).slideDown("slow");});                                   // EFEITO
             }                                                                  // FIM FUNCAO
         );                                                                     // FIM EFEITO
    };                                                                          // FIM FUNCAO NOVOFORNEC
    
    ctCompra.fornecedor=function(id_fornecedor){                                // FUNCAO FORNECEDOR
        var id = id_fornecedor;                                                 // RECEBE O ID
        var nome =$("#"+id+"nome").text();                                      // PEGA O NOME
        var diahoje = new Date()                                                // PEGA A DATA ATUAL
        $("#emissao").text("Emissao: " + diahoje.asString());                   // ESCREVE NA TELA A DATA ATUAL
        $("#nomeFornecedor").text("Fornecedor: "+nome);                         // ESCREVE O NOME DO FORNECEDOR
        $('#vlrprevisto').focus();                                              // DA FOCUS NO VALOR
        $('#fornec_id').val(id);                                                // SETA O CAMPO HIDDEN FORNCEC_ID
    };                                                                          // FIM DA FUNCAO FORNCECEDOR
    
    ctCompra.abrirShowBotoes=function(){                                        // FUNCAO ABRIR SHOW BOTOES
        $("#mostrapendente").show();                                            // BOTAO MOSTRAR PENDENTES
        $("#mostratodos").show();                                               // BOTAO MOSTRAR TODOS
        $("#btEncerrar").hide();                                                // BOTAO ENCERRAR
        $("#btVoltar").hide();                                                  // BOTAO VOLTAR
    };                                                                          // FIM DA FUNCAO ABRIR SHOW BOTOES
    
    ctCompra.abrirAutorizacao=function(id_fornecedor){                          // FUNCAO ABRIRAUTORIZACAO
        $('#infoAutorizacaoUnica').hide();                                      // OCULTAR FORMULARIO DESCRICAO
        var id = id_fornecedor;                                                 // PEGA O ID_FORNECEDOR
        $('#fornec_id').val(id);                                                // SETA O ID_FORNECEDOR NO FORMULARIO
        var nome = $("#"+id+"nome").text();                                     // PEGA O NOME DO FORNEC        
        ctCompra.abrirShowBotoes();                                             // MOSTRAR OS BOTOES DE OPCAO        
        $("#nomeFornecedor").text("FORNECEDOR: " + nome );                      // ESCREVE NOME NA TELA        
        $("#infoAutorizacao").empty();                                          // LIMPAR TELA DE AUTORIZACOES        
        var obj = new Object();                                                 // NOVO OBJETO                                 
        obj.id = id;                                                            // SETA O ID_FORNECEDOR NO OBJETO
        var retorno = ctCompra.ajax(obj,'getAutorizacao');                      // FAZ A CONSULTA NO BANCO
        ctCompra.listar(retorno);                                               // LISTAR NA TELA        
    };                                                                          // FIM DA FUNCAO ABRIRAUTORIZACAO

    ctCompra.autorizacaounica=function(id){                                     // FUNCAO ATORIZACAO UNICA
        var id = id;                                                            // SETA O ID
        var nome = $("#"+id+"data").text();                                     // PEGA O NOME DO FORNEC
        $("#btEncerrar").show();                                                // MOSTRA BOTAO ENCERRAR
        $("#btVoltar").show();                                                  // MOSTRA BOTAO VOLTAR
        $("#data").text("FORNECEDOR: " + nome );                                // ESCREVE A DATA ATUAL        
        var obj = new Object();                                                 // CRIA NOVO OBJETO
        obj.id = id;                                                            // SETA OBJETO COM ID_FORNEC
        var r = ctCompra.ajax(obj,'getAutorizacaoUnica');                       // FAZ A CONSULTA EM BANCO
        ctCompra.listarAutorizacaoUnica(r);                                     // LISTAR NA TELA                
        ctCompra.datasConfig();                                                 // CONFIG DATAS
        ctCompra.limparDescricao();                                             // LIMPAR FORMULARIO DESCRICAO
        ctCompra.selectPgt();                                                   // DISPARAR EVENTO PARCELAS
    };                                                                          // FIM AUTORIZACAO UNICA
    
    ctCompra.listarAutorizacaoUnica=function(json){                             // FUNCAO LISTAR AUTORIZACAO UNICA
        var obj = json;                                                         // RECEBE O OBJETO JSON
        ctCompra.setObjCompra(obj);                                             // SETA COMO OBJETO
        obj.placa = obj.placa == null ? '': obj.placa;                          // VALIDAÇÃO PARA CAMPO NULL
        obj.veiculo = obj.veiculo==null ? '' : obj.veiculo;                     // VALIDAÇÃO PARA CAMPO NULL
        obj.contato = obj.contato== null ? '' : obj.contato;                    // VALIDAÇÃO PARA CAMPO NULL
        obj.obs = obj.obs== null ? '' : obj.obs;                                // VALIDAÇÃO PARA CAMPO NULL
        $( '#span-numero' ).text( obj.id ) ;                                    // INSERE NUMERO
        $( '#span-emissao' ).text( convertDateSqltoPortugues(obj.data) );       // INSERE EMISSAO
        $( '#span-previsto' ).text( convertFloatToMoeda(obj.valor_previsto) );  // INSERE VALOR PREVISTO
        $( '#span-veiculo').text( obj.veiculo );                                // INSERE VEICULO
        $( '#span-placa').text( obj.placa );                                    // INSERE PLACA
        $( '#span-contato').text( obj.contato );                                // INSERE CONTATO
        $( '#obs').val( obj.obs );                                              // INSERE OBS
        $( '#valor_final').val( convertFloatToMoeda(obj.valor_final) );         // INSERE VALOR FINAL        
        $("#infoAutorizacaoUnica").show();                                      // MOSTRA NA TELA
    };                                                                          // FIM DA FUNCAO LISTAR AUTORIZACAO UNICA
    
    ctCompra.eventos = function(){                                                      // FUNCAO EVENTOS
        $('#novaautorizacao').button().click(function(){ctCompra.novoFornec();});       // BOTAO NOVA AUTORIZACAO        
        $('#dialog-confirm').hide();                                                    // ESCONDER TELA DE AVISO
        $('button').hide();                                                             // ESCONDER TODOS OS BOTOES
        $("#btEncerrar").button().click(function(){ ctCompra.encerrar(); });            // BOTAO ENCERRAR
        $("#btVoltar").button().click(function(){ ctCompra.retornar(); });              // BOTAO VOLTAR
        $("#mostratodos").button().click(function(){ ctCompra.mostraTodos(); });        // BOTAO MOSTRAR TODOS 
        $("#mostrapendente").button().click(function(){ ctCompra.mostraPendente(); });  // BOTAO MOSTRAR DEPENDENTE        
        $('input:text').setMask();                                                      // CONFIG DE MASKARAS NOS INPUT
        $('#novaautorizacao').show();                                                   // BOTAO NOVA AUTORIZACAO MOSTRAR        
        $('#valor_final').change(function(){ ctCompra.selectPgt(); });                  // CARREGAR PARCELAS
        ctCompra.ajusteSpinner();                                                       // DEPENDENCIA DE EVENTOS
        ctCompra.ajusteTela();                                                          // CHAMADA DA FUNCAO AJUSTE DE TELA
        ctCompra.colorirTr();                                                           // CHAMADA DA FUNCAO COLORIR TR        
    };                                                                                  // FIM DOS EVENTOS
    
    ctCompra.datasConfig=function(){                                                    // FUNÇAO DATA ATUAL
        $('.data').val( new Date().asString() );                                        // SETA A DATA ATUAL NOS CAMPOS DATA
        $('#ui-datepicker-div').css('line-height','1');                                 // CORREÇÃO DA LINHA JQUERY        
        $('#ini-venc').change(function(){ ctCompra.encadearDatas(); });                 // ENCADEAR DATAS
        $('#dia-prox').change(function(){ ctCompra.encadearDatas(); });                 // ENCADEAR DATAS        
    };                                                                                  // FIM DATA ATUAL
            
    ctCompra.encadearDatas=function(){                                                  // ENCADEAR DATAS
        var dias = $('#dia-prox').val();                                                // PEGA OS DIAS
        var dataIni = Date.fromString( $('#ini-venc').val() );                          // PEGA A DATA
        var qtd = ctCompra.parcelas.spinner( 'value' );                                 // PEGA A QTD DE PARCELAS (DATAS)
        for(var i=1; i<=qtd; i++){                                                      // FOR
            $('#parc-venc-'+i).val( dataIni.asString() );                               // SETA A NOVA DATA
            dataIni.addDays(dias);                                                      // INCREMENTA OS DIAS
        }                                                                               // FIM DO FOR
    };                                                                                  // FIM DA FUNCAO
    
    ctCompra.valoresParcela=function(){                                                 // FUNCAO VALOR PARCELAS
        var valorTotal = convertFloatNumber( $('#valor_final').val() );                 // VALOT TOTAL
        var qtd = ctCompra.parcelas.spinner( 'value' );                                 // QTD DE PARCELAS
        var valorParcela = valorTotal / new Number(qtd);                                // VALOR DE CADA PARCELA
        var valorParcela = valorParcela.toFixed(2);                                     // AREDONDAR P/ 2 CASAS DECIMAIS
        for(var i=1; i<=qtd; i++){                                                      // FOR
            $('#parc-valor-'+i).val( convertFloatToMoeda(valorParcela) );               // ESCREVE O VALOR
        }                                                                               // FIM DO FOR
    };                                                                                  // FIM DA FUNCAO
    
    ctCompra.ajusteSpinner=function(){                                                  // FUNCAO AJUSTE SPINNER
        ctCompra.parcelas = $('#qtd_parcelas').spinner();                               // BOTAOZINHOS DE INCREMENTAR E DECREMENTAR NO CANTO DO FIELD        
        $('.ui-spinner').removeClass('ui-corner-all').css('float','right');             // STYLE
        $('.ui-spinner').css('margin-right','10px');                                    // STYLE
        ctCompra.parcelas.spinner('disable');                                           // DEFAULT DESABILITADO POIS COMEÇA COM PGT À VISTA QTD=1
        ctCompra.parcelas.spinner({min: 1, max:99});                                    // NÃO ACEITAR VALORES NEGATIVOS NEM ZERO
        $('#select-forma-pgt').change(function(){ ctCompra.selectPgt(); });             // EVENTO SELECIONAR À VISTA OU A PRAZO
        $('.ui-spinner-button').click(function(){ ctCompra.evParcelas(); });            // EVENTO DE CLICAR NA QTD PARCELAS        
    };                                                                                  // FIM DA FUNÇAO
    
    ctCompra.selectPgt=function(){                                                      // FUNCAO SELECTPGT                                  
        $('#vista').attr('selected') === 'selected' ?                                   // VERIFICA SE É A VISTA
            ctCompra.parcelas.spinner('disable').spinner( "value", 1 ) :                // À VISTA SETA VALOR 1 E DESABILITA INCRE/DECRE
            ctCompra.parcelas.spinner('enable');                                        // A PRAZO ENTAO LIBERA INCRE/DECRE
        ctCompra.evParcelas();                                                          // CHAMAR EVENDOS PARCELA
    };                                                                                  // FIM DA FUNÇÃO
    
    ctCompra.evParcelas=function(){                                                     // FUNÇAO EVENTO PARCELAS        
        var qtd = ctCompra.parcelas.spinner( 'value' );                                 // PEGA A QTD DE PARCELAS
        $('#div-qtd-parcelas').empty();                                                 // ESVAZIAR DIV
        $(".data").removeClass('hasDatepicker').datepicker();                           // REMOVER AS DATAS
        for(var i=1; i<=qtd; i++){                                                      // LAÇO DE REPETIÇÃO
            var n = $('#div-parc-0').clone();                                           // CLONA DIV
            $('#div-qtd-parcelas').append(n);                                           // ADD NA DIV
            n.attr('id', 'div-parc-'+i);// RENOMEAR A DIV                               // RENOMEAR ID
            $('#div-parc-'+i+' #parc-venc').attr('id', 'parc-venc-'+i);                 // RENOMEAR VENCIMENTO
            $('#div-parc-'+i+' #parc-valor').attr('id', 'parc-valor-'+i);               // RENOMEAR VALOR
            $('#div-parc-'+i+' #div-parc-inf').text('Nº '+i);                           // NUMERO DA PARCELA
            n.css('display','block');                                                   // MOSTRA
        }                                                                               // FIM DO FOR
        ctCompra.encadearDatas();                                                       // ENCADEAR DATAS
        ctCompra.datepickerBR();                                                        // PADRAO PT-BR
        ctCompra.valoresParcela();                                                      // DIVIDIR VALOR FINAL EM PARCELAS
    };                                                                                  // FIM DA FUNÇÃO
    
    ctCompra.datepickerBR=function(){                                                   // DATEPICKER
        $(".data").removeClass('hasDatepicker').                                        // REMOVE DATEPICKER ANTIGO
            datepicker({changeMonth: true, changeYear: true, yearRange:"c-10:c+1"});    // CRIA NOVO DATEPICKER
        datepickerBR();                                                                 // CONFIGURA PARA PT-BR
    };                                                                                  // FIM DA FUNCAO
    
    ctCompra.ajusteTela=function(){                                                     // FUNÇAO AJUSTE DE TELA
        $('#fieldset-menu').css('height','670px');                                      // TELA CONTROLE COMPRA
        $('#fieldset-menu').css('margin','0 70px 10px 0');                              // TELA CONTROLE COMPRA
        $('#div-compromisso').css('padding-top','12px');                                // TELA MENU DE OPÇOES        
    };                                                                                  // FIM DA FUNCAO AJUSTE DE TELA
    
    ctCompra.eventosCompraNovo=function(){                                                  // FUNCAO ENVENTOS COMPRA NOVO
        $('#retornar').button().click(function(){ ctCompra.retornar(); });                  // BOTAO RETORNAR
        $('#salvarautorizacao').button().click(function(){ctCompra.salvarAutorizacao();});  // BOTAO SALVAR
        $('input:text').setMask();                                                          // CONFIG DE MASKARAS NOS INPUT (DENOVO POIS A PAGINA É RECARREGADA)
        $('#placa').autocomplete({                                                          // AUTOCOMPLETAR A PLACA DO VEICULO
            minLength: 2,                                                                   // TAMANHO MINIMO PARA AUTOCOMPLETAR
            source: function( request, response ) {                                         // ORIGEM DA INFORMAÇÃO
                var obj = new Object();                                                     // NOVO OBJETO
                obj.maxRows = 10;                                                           // MAXIMO DE REGISTROS NO RETORNO
                obj.letra = request.term;                                                   // TERMO DA PESQUISA
                var data = ctCompra.ajax(obj,'getVeiculo','../view/vEditarVeiculo.php');    // CONSULTA EM BANCO
                response( $.map( data.consulta, function( item ) {                          // FUNCAO RESPONSE 
                    return {label: item.vplaca,value: item.vplaca,i:item} }));              // RETORNO
            },                                                                              // FIM DA ORIGEM DOS DADOS
            select: function( event, ui ) {                                                 // PARAMETRO SELECT
                $( "#b_none" ).val( ui.item.value );                                        // PREENCHE RETORNO DA CONSULTA
                $( "#id_veic" ).val(ui.item.i.veic_id);                                     // PREENCHE RETORNO DA CONSULTA
                $( "#placa" ).val( ui.item.i.vplaca );                                      // PREENCHE RETORNO DA CONSULTA
                $( "#veiculo" ).val(ui.item.i.marca);                                       // PREENCHE RETORNO DA CONSULTA
            }                                                                               // FIM DO PARAMETRO SELECT
        });                                                                                 // FIM DO AUTOCOMPLETE
    };                                                                                      // FIM DA FUNCAO EVENTOS COMPRA NOVO
    
    ctCompra.mostraPendente = function(){                                               // FUNCAO MOSTRA PENDENTE
        ctCompra.abrirAutorizacao( $("#fornec_id").val() );                             // CHAMA FUNCAO ABRIR AUTORIZACAO
    };                                                                                  // CHAMA FUNCAO ABRIR AUTORIZACAO
    
    ctCompra.mostraTodos = function(){                                                  // FUNCAO MOSTRA TODOS
        var obj = new Object();                                                         // NOVO OBJETO
        obj.idFornecedor = $("#fornec_id" ).val();                                      // PEGA ID DO FORNEC
        var json = ctCompra.ajax(obj,'mostraTodos');                                    // FAZ CONSULTA EM BANCO
        ctCompra.listar(json);                                                          // LISTA NA TELA
    };                                                                                  // FIM DA FUNCAO MOSTRA TODOS
    
    ctCompra.salvarAutorizacao = function(){                                            // FUNCAO SALVAR AUTORIZACAO
        var fornec_id =$("#fornec_id").val();                                           // PEGA O ID FORNEC
        if(fornec_id == 0){                                                             // VERIFICA SE FOI SELECIONADO
            ctCompra.informe('SELECIONE UM FORNECEDOR PRIMEIRO');                       // INFORMA NA TELA
            return 0;                                                                   // RETORNA 0
        }                                                                               // FIM DO IF
        var obj = new Object();                                                         // NOVO OBJETO  
        obj.valor_previsto = $("#vlrprevisto").val();                                   // SETA VALOR PREVISTO
        obj.valor_final = $("#vlrfinal").val();                                         // SETA VALOR FINAL
        obj.placa = $("#placa").val();                                                  // SETA PLACA
        obj.veiculo = $("#veiculo").val();                                              // SETA VEICULO
        obj.contato = $("#contato").val();                                              // SETA CONTATO
        obj.obs = $("#obs").val();                                                      // SETA OBS
        obj.id_fornecedor = fornec_id;                                                  // SETA ID_FORNEC
        ctCompra.ajax(obj,'salvar') != null ?                                           // VALIDA A INSERÇÃO NA BASE
            alert("REGISTRADO COM SUCESSO!"):                                           // INFORMA SE SUCESSO
            alert("ERRO AO GRAVAR");                                                    // INFORMA SE ERRO
        ctCompra.retornar();                                                            // CHAMA RETORNAR
    };                                                                                  // FIM DA FUNCAO SALVAR AUTORIZACAO
    
    ctCompra.getParcelas=function(){                                                    // FUNCAO GET PARCELAS
        var array = new Array();                                                        // NOVO ARRAY
        var qtd = $('#qtd_parcelas').val();                                             // PEGA QTD
        for(var i=1; i<=qtd; i++){                                                      // FOR
            var obj = new Object();                                                     // NOVO OBJETO
            obj.comp_num_parcela = i;                                                   // PEGA A PARCELA
            obj.comp_valor_parcela = convertFloatNumber( $('#parc-valor-'+i).val() );   // VALOR DA PARCELA
            obj.comp_dt_venc = $('#parc-venc-'+i).val();;                               // VENCIMENTO
            array.push(obj);                                                            // POE NO ARRAY
        }                                                                               // FIM DO FOR
        return array;                                                                   // RETORNO DA FUNCAO
    };                                                                                  // FIM DA FUNCAO
    
    ctCompra.encerrar = function(){                                                     // FUNCAO ENCERRAR        
        var obj = ctCompra.getObjCompra();                                              // PEGA OJETO COMPRA
        obj.obs = $("#obs").val();                                                      // SETA OBS
        obj.valor_final = $("#valor_final").val();                                      // SETA VALOR FINAL
        obj.num_nf = $("#num_nf").val();                                                // SETA VALOR FINAL
        obj.forma_pgt = $("#vista").attr('selected') === true ? 1 : 2;                  // 1=À VISTA, 2= A PRAZO
        obj.qtd_parcelas = $('#qtd_parcelas').val();                                    // QTD PARCELAS        
        obj.ArrayParcelas = ctCompra.getParcelas();                                     // ARRAY DE PARCELAS(VENCIMENTO E VALOR)        
        if(obj.num_nf === ''){                                                          // VERIFICA SE A NF ESTA PREENCHIDA
            ctCompra.informe("FAVOR PREENCHER O CAMPO 'NUMERO NF'");                    // MSG FINALIZADO        
            return 0;                                                                   // SAIR DA FUNÇÃO SEM REGISTRAR NADA
        }                                                                               // FIM DO IF
        if(ctCompra.existeNF(obj)===false){                                             // VERIFICA SE EXISTE NF JÁ REGISTRADA NO B.D.
            ctCompra.ajax(obj,'encerrar');                                              // FAZ O UPDATE NO BANCO
            ctCompra.informe("Finalizado");                                             // MSG FINALIZADO        
        }                                                                               // FIM O IF
        else{ ctCompra.informe("JÁ EXISTE REGISTRO PARA ESTA NOTA FISCAL"); }           // MSG FINALIZADO                
    };                                                                                  // FIM DA FUNC  AO ENCERRAR
    
    ctCompra.existeNF=function(o){                                                      // FUNCAO EXISTENF
        var obj = ctCompra.ajax(o,'existeNF');                                          // CONSULTA SE EXISTE NF CASO SIM TRAS O OBJ        
        var b = obj instanceof Object;                                                  // VERIFICA SE OBJ É INSTANCIA DE UM OBJECT
        return b;                                                                       // RETORNO DA FUNCAO
    };                                                                                  // FIM DA FUNÇÃO
    
    ctCompra.limparDescricao=function(){                                                // FUNÇÃO LIMPAR DESCRIÇÃO
        $('#div-qtd-parcelas').empty();                                                 // ESVAZIA A DIV
        ctCompra.parcelas.spinner('value',1);                                           // SETA VALOR 1 NA QTD PARCELAS
        $('#dia-prox').val(30);                                                         // SETA 30 DIAS NO DIA-PROX
        $('#vista').attr('selected',true);                                              // SELECIONA PAGAMENTO À VISTA POR PADRÃO
        $('#num_nf').val('');                                                           // NUMERO DA NOTA FISCAL
    };                                                                                  // FIM DA FUNÇÃO LIMPAR DESCRIÇÃO
    
    ctCompra.ajax = function(obj,funcao,v){                                             // FUNCAO RESPONSAVEL POR CONVERSAR COM A VIEW        
        var view = v==null ? '../view/Agendas/vCompromissocontrolecompra.php':v;        // CAMINHO DA VIEW
        var data = {'obj':obj,'funcao':funcao};                                         // SETA OS PARAMETROS
        var retorno;                                                                    // VAR DE RETORNO
        $.ajax({type:"POST", url:view, dataType:"json", data:data,async:false,          // FAZ UM AJAX SINCRONIZADO COM A FUNCAO
            success: function(json) { retorno = json; },                                // RETORNO DO AJAX NO SUCCESS
            error: function() { retorno=null; }                                         // RETORNO DO AJAX NO ERROR
        });                                                                             // FIM DO AJAX
        return retorno;                                                                 // RETORNAR
    };                                                                                  // FIM DA FUNCAO AJAX
    
    ctCompra.informe=function(msg){                                                     // FUNCAO INFORME
        $( "#msg" ).text(msg);                                                          // SETA O TEXTO
        $( "#dialog" ).dialog({with :300,height: 150,                                   // FAZ UM DIALOG JQUERY
            modal: true, buttons: {                                                     // SETA CONFIGURAÇÃO DA TELA
                Ok:function(){                                                          // BOTAO PARAMETRO 
                    $( "#dialog" ).dialog( "close" );                                   // BOTAO FECHAR
                    $( "#btVoltar" ).click();                                           // EVENTO RETORNAR
                }                                                                       // FIM PARAMETRO
            }                                                                           // FIM BUTTONS
        });                                                                             // FIM DO DIALOG
    };                                                                                  // FIM DA FUNCAO INFORME                  
    
    ctCompra.colorirTr=function(){                                                      // FUNCAO COLORIR TR
        $(".a").mouseover(function(){ $(this).addClass('hover'); });                    // EVENTO MOUSEOVER COLOCAR COR NA TR
        $(".a").mouseout(function(){ $(this).removeClass('hover'); });                  // EVENTO MOUSEOUT RETIRAR COR DA TR  
    };                                                                                  // FIM DA FUNCAO
    
    ctCompra.listar=function(json){                                                     // FUNCAO LISTAR
        if(json == null || json == 'null'){                                             // VERIFICA SE NAO É NULL
            ctCompra.informe("REGISTRO(S) NÃO LOCALIZADOS!");                           // INFORMA SE FOR
            return 0;                                                                   // RETORNA 0
        }                                                                               // FIM DO IF
        $("#infoAutorizacao").empty();                                                  // LIMPA A DIV INFO AUTORIZAÇÃO
        var html=                                                                       // PREPARA HTML
        "<table id='t-result' style='width: 445px; max-height:200px;'>"+                // MONTA A TABLE
            "<tr style='color:red; height:15px; widht:50px;'>"+                         // TR
                "<th widht='50px'>Lançamento"+"</th>"+                                  // TH
                "<th widht='100px'>Emissão"+"</th>"+                                    // TH
                "<th widht='100px'>Valor Previsto"+                                     // TH
                "<th widht='100px'>Status"+"</th>"+                                     // TH
            "</tr>";                                                                    // /TR
        for(var i =0; i < json.length; i++){                                            // LAÇO DE REPETIÇÃO
            var obj = json[i];                                                          // PEGA OBJETO
            var status = obj.fecha_frota == 1 ? 'Finalizado' : 'Pendente';              // SETA STATUS
            var param = obj.fecha_frota == 1 ? " off'" : "a cursor' "+                  // SETA PARAM
                    "onclick='ctCompra.autorizacaounica("+obj.id+")'";                  // FAZ EVENTO ONCLICK
            var classe;                                                                 // VAR CLASSE;
            if(i%2==0){                                                                 // COLORIR LINHAS ALTERNADAS
                classe = "class='corSim ";                                              // CLASSE CORSIM
                html = html + "<tr height='15px' "+classe+param+                        // TR
                        " > <th width='50px'>"+obj.id+"</th>";                          // TH
            }                                                                           // FIM IF
            else{                                                                       // ELSE
                classe = "class='corNao ";                                              // CLASSE CORNAO
                html = html + "<tr height='15px' "+classe+param+                        // TR
                        "> <th width='50px'>"+obj.id+"</th>";                           // TH
            }                                                                           // FIM ELSE
                html = html +                                                           // HTML RECEBE O QUE TEM NELE +
                "<th width='100px'>"+convertDateSqltoPortugues(obj.data) +"</th>"+      // TH
                "<th width='100px'>"+convertFloatToMoeda(obj.valor_previsto)+"</th>"+   // TH
                "<th width='100px'>"+status+"</th></tr>";                               // TH
        }                                                                               // FIM DO LAÇO FOR
        html = html + "</table>";                                                       // FIM DA TABLE
        $("#infoAutorizacao").append(html);                                             // ADD HTML NO DIV INFO AUTORIZAÇÃO
        ctCompra.colorirTr();                                                           // CHAMA COLORIR TR
        $("#t-result").animate('puff');                                                 // RESULTADO COM EFEITO ANIMADO
    };                                                                                  // FIM DA FUNÇÃO LISTAR