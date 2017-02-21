var jsGrupo = {};

jsGrupo.arrayIntegrantes = new Array();

jsGrupo.start = function(){jsGrupo.eventos();};
jsGrupo.mask = function(){
    $("#gru_hot_saida").mask('00/00/0000');
    $("#gru_hot_entrada").mask('00/00/0000');
    $("#mov_dataIn").mask('00/00/0000 - 00:00');
    $("#mov_dataOut").mask('00/00/0000 - 00:00');
    $("#pas_nascimento").mask('00/00/0000');
};

jsGrupo.eventos = function(){
    jsGrupo.getlista();
    jsGrupo.mask();
    jsGrupo.autoGuia();
    //jsGrupo.autoHotel();
    //jsGrupo.autoMotorista();
    
    $('#gru_Salvar').click(function(){jsGrupo.salvar();});
    
    $('#GrupoNovoEditar').on('hidden.bs.modal', function () {
        $('#titulo').text('Novo Cadastro');
        $('#GrupoNovoEditar input,textarea').each(function(){
            $(this).val('');
        });
    });
    $('#GrupoNovoEditar').on('shown.bs.modal', function () {
        $("#gru_nome").focus();
    });
    $('#infoModal').on('hidden.bs.modal', function () {
       //loadContent('#conteudo','html/cadastro/hotel.html?v=2');
    });    
    
    $('#pss_Salvar').click(function(){ jsGrupo.regIntegrantes(); });
    $('#PassageiroNovoEditar').focus(function(){ $('#pas_nome').focus(); }); // dar focus na segunda tela
    //$('#btMaisIntegrante').click(function(){ jsGrupo.addCampoIntegrante(); });
};

/*jsGrupo.addCampoIntegrante=function(){
    var linha = jsGrupo.getNovaLinha();
    $('.divCadastroIntegrante').append(linha);
};*/

jsGrupo.regIntegrantes=function(){
    var obj = new Object();                 // NOVO OBJETO
    obj.pas_nome = $('#pas_nome').val(); 
    obj.pas_nascimento = $('#pas_nascimento').val();
    obj.pas_documento = $('#pas_documento').val();
    obj.mov_tipoIn = $('#mov_tipoIn :selected').text();
    obj.mov_transporteIn = $('#mov_transporteIn').val();
    obj.mov_dataIn = $('#mov_dataIn').val();
    obj.mov_tipoOut = $('#mov_tipoOut :selected').text();
    obj.mov_transporteOut = $('#mov_transporteOut').val();
    obj.mov_dataOut = $('#mov_dataOut').val();
    jsGrupo.arrayIntegrantes.push(obj);     // ADD O OBJETO DENTRO DO ARRAY
    
    //apagar campos que nao irá se repetir num proximo cadastro
    $('#pas_nome').val(''); 
    $('#pas_nascimento').val('');
    $('#pas_documento').val('');
    $('#voltar').click();  //  FECHAR A JANELA DO CADASTRO DE PASSAGEIRO
    
    jsGrupo.listarPassageiros();
};

jsGrupo.listarPassageiros=function(){
    $('#integrantes').val('');
    for(var i=0; i< jsGrupo.arrayIntegrantes.length; i++){
        var obj = jsGrupo.arrayIntegrantes[i];
        var v = $('#integrantes').val();
        $('#integrantes').val(v+obj.pas_nome+'\n');        
    }
};

/*jsGrupo.getNovaLinha=function(){
    var linha = $('.linha:first').clone();  // PEGA O PRIMEIRO ELEMENTO COM CLASS=LINHA E CLONA
    linha.find('.nome').val('');            // LIMPA O NOME
    linha.find('.id').val('');              // LIMPA O ID
    return linha;                           // DEVOLVE NOVO ELEMENTO
};*/

jsGrupo.autoGuia=function(){    
    main.autocomplet($('#guia_nome'),'guia_nome','buscaNome','view/vGuia.php');    
    main.autocomplet.retorno=function(obj){ console.info(obj.guia_id);$("#guia_id").val(obj.guia_id); };        
};

jsGrupo.autoMotorista=function(){    
    main.autocomplet($('#mot_nome'),'mot_nome','buscaNome','view/vMotorista.php');    
    var obj = main.objRetorno;
    $("#mot_id").val(obj.guia_id);  
};

jsGrupo.autoHotel=function(){    
    main.autocomplet($('#hot_nome'),'hot_nome','buscaNome','view/vHotel.php');    
    var obj = main.objRetorno;
    $("#hot_id").val( obj.guia_id ) ;        
};

jsGrupo.informe = function(msg) {
    $("#msg").text(msg);
    $("#dialog").dialog({with : 300, height: 150,
        modal: true, buttons: {
            Ok: function() {
                $("#dialog").dialog("close");
                $("#btVoltar").click();
            }
        }
    });
};

jsGrupo.ajax = function(obj, funcao, v) {
    var view = v == null ? 'view/vGrupo.php' : v;
    var data = {'obj': obj, 'action': funcao};
    var retorno;
    $.ajax({type: "POST", url: view, dataType: "json", data: data, async: false,
        success: function(json) {
            retorno = json;
        },
        error: function() {
            retorno = null;
        }
    });
    return retorno;
};

jsGrupo.getDoForm = function(){
    var obj = new Object();
        obj.gru_id              = $("#gru_id").val();
        obj.gru_nome            = $("#gru_nome").val();
        obj.gru_nome_paxs       = $("#gru_nome_paxs").val();
        obj.guia_id             = $("#guia_id").val() == "" ? "NULL" : $("#guia_id").val();
        obj.mot_id              = $("#mot_id").val() == "" ? "NULL" :$("#mot_id").val() ;
        obj.gru_placa           = $("#gru_placa").val();
        obj.gru_veiculo         = $("#gru_veiculo").val();
        obj.gru_coordenador     = $("#gru_coordenador").val();
        obj.hot_id              = $("#hot_id").val() == "" ? 'NULL' : $("#hot_id").val();
        obj.gru_hot_entrada     = $("#gru_hot_entrada").val();
        obj.gru_hot_saida       = $("#gru_hot_saida").val();
        obj.gru_hotel_detalhes  = $("#gru_hotel_detalhes").val();
        obj.gru_entinerario     = $("#gru_entinerario").val();
   
   return obj;
};

jsGrupo.setDoForm = function(obj){
    $("#gru_id").val(obj.gru_id);
    $("#gru_nome").val(obj.gru_nome);
    $("#gru_nome_paxs").val(obj.gru_nome_paxs);
    $("#guia_id").val(obj.guia_id);
    $("#mot_id").val(obj.mot_id);
    $("#gru_placa").val(obj.gru_placa);
    $("#gru_veiculo").val(obj.gru_veiculo);
    $("#gru_coordenador").val(obj.gru_coordenador);
    $("#hot_id").val(obj.hot_id);
    $("#gru_hot_entrada").val(obj.gru_hot_entrada);
    $("#gru_hot_saida").val(obj.gru_hot_saida);
    $("#gru_hotel_detalhes").val(obj.gru_hotel_detalhes);
    $("#gru_entinerario").val(obj.gru_entinerario);
};

jsGrupo.getlista = function(){
    var obj = new Object();
        obj.gru_nome = 'gru_nome';
    var json = jsGrupo.ajax(obj,'fetchAll');
    
    try{
        main.listarNaTable($('#listaGrupo'),json.data,true);
        jsGrupo.eventosDaTable();
        //jsGrupo.paginacao();
    }catch(erro){
        $('#listaGrupo').empty();
        $('#listaGrupo').append("<div colspan='2' style='height:13px;padding-top: 20px'>GRUPOS NÃO LOCALIZADO !</div>");
    }
};

jsGrupo.salvar = function(){
    var obj = this.getDoForm();
    
    obj.arrayIntegrantes = jsGrupo.arrayIntegrantes; // ADD INTEGRANTES NO SUBMIT
    console.info(obj);
    if(obj.gru_id ==""){
        var fun = 'insert';
    }else{
        fun = 'update';
    }
    var json = jsGrupo.ajax(obj,fun); //!= null ? jsGrupo.confirmacao(fun,1):jsGrupo.confirmacao(fun,2) //alert("REGISTRADO COM SUCESSO!"): alert("ERRO AO GRAVAR");    
    
    $("#GrupoNovoEditar").modal('hide');
    jsGrupo.getlista();
    $("#infoText").text(json.message);
    $("#infoModal").modal();
    jsGrupo.arrayIntegrantes = new Array(); // limpa o array depois de inserir tudo
};

jsGrupo.confirmacao = function (a,b){
    if(a =="update"){
        if(b==1){
            var msg = "REGISTRO EDITADO COM SUCESSO!";
        }else{msg = "ERRO AO EDITAR REGISTRO!";}
    }else{
        if(b==1){
            msg = "REGISTRADO COM SUCESSO!";
        }else{msg = "ERRO AO REGISTRAR!";}
    }
    $("#infoText").text(msg);
    $("#infoModal").modal();
}

jsGrupo.editar = function(gru_id){
    var obj = new Object();
        obj.gru_id = gru_id;
    var json = jsGrupo.ajax(obj,'buscaid');
    jsGrupo.setDoForm(json.data[0]);
    $("#titulo").text('Editar Cadastro');
    $("#GrupoNovoEditar").modal();
    jsGrupo.mask();
};

jsGrupo.eventosDaTable = function(){
    $('#listaGrupo tr').each(function() {
    var codigo;
    $('td', $(this)).each(function(index, item) {            
        if(index === 0){codigo=$(item).text();}
    });            
    $(this).click(function(){jsGrupo.editar(codigo);}).css('cursor','pointer');
    });
};
jsGrupo.guia = function (){
    var json = jsGrupo.ajax('','getGuia');
    fo
}

jsGrupo.paginacao = function(){
    $("table") 
        .tablesorter({
          dateFormat: 'uk',
          headers: {
            0: {
              sorter: false
            },
            5: {
              sorter: false
            }
          }
        }) 
        .tablesorterPager({container: $("#pager")});
}
jsGrupo.start();


