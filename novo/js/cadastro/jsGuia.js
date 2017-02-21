var jsGuia = {};

jsGuia.start = function(){jsGuia.eventos();};

jsGuia.mask = function(){
    $("#guia_celular").mask('(00)0000-0000');
    $("#guia_telefone").mask('(00)0000-0000');
}

jsGuia.eventos = function(){
    jsGuia.getlista();
    jsGuia.mask();
    
    $('#guia_Salvar').click(function(){jsGuia.salvar();});
    
    $('#GuiaNovoEditar').on('hidden.bs.modal', function () {
        $('#titulo').text('Novo Cadastro');
        $('#GuiaNovoEditar input,textarea').each(function(){
            $(this).val('');
        });
    });
    $('#GuiaNovoEditar').on('shown.bs.modal', function () {
        $("#guia_nome").focus();
    });
    $('#infoModal').on('hidden.bs.modal', function () {
       //loadContent('#conteudo','html/cadastro/hotel.html?v=2');
    });
};
jsGuia.informe = function(msg) {
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

jsGuia.ajax = function(obj, funcao, v) {
    var view = v == null ? 'view/vGuia.php' : v;
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

jsGuia.getDoForm = function(){
    var obj = new Object();
        obj.guia_id          = $("#guia_id").val();
        obj.guia_nome        = $("#guia_nome").val();
        obj.guia_endereco    = $("#guia_endereco").val();
        obj.guia_celular     = $("#guia_celular").val();
        obj.guia_telefone    = $("#guia_telefone").val();
        obj.guia_outros      = $("#guia_outros").val();
   
   return obj;
};

jsGuia.setDoForm = function(obj){
    $("#guia_id").val(obj.guia_id);
    $("#guia_nome").val(obj.guia_nome);
    $("#guia_endereco").val(obj.guia_endereco);
    $("#guia_celular").val(obj.guia_celular);
    $("#guia_telefone").val(obj.guia_telefone);
    $("#guia_outros").val(obj.guia_outros);
};

jsGuia.getlista = function(){
    var json = jsGuia.ajax('','fetchAll');
    
    try{
        main.listarNaTable($('#listaGuia'),json.data,true);
        jsGuia.eventosDaTable();
        //jsGuia.paginacao();
    }catch(erro) {
        $('#listaGuia').empty();
        $('#listaGuia').append("<div colspan='2' style='height:13px;padding-top: 20px'>GUIAS NÃO LOCALIZADO !</div>");
    }
};

jsGuia.salvar = function(){
    var obj = this.getDoForm();
    console.info(obj);
    if(obj.guia_id ==""){
        var fun = 'insert';
    }else{
        fun = 'update';
    }
    var json = jsGuia.ajax(obj,fun); //!= null ? jsGuia.confirmacao(fun,1):jsGuia.confirmacao(fun,2) //alert("REGISTRADO COM SUCESSO!"): alert("ERRO AO GRAVAR");    
    
    $("#GuiaNovoEditar").modal('hide');
    jsGuia.getlista();
    $("#infoText").text(json.message);
    $("#infoModal").modal();
};

jsGuia.confirmacao = function (a,b){
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

jsGuia.editar = function(guia_id){
    var obj = new Object();
        obj.guia_id = guia_id;
    var json = jsGuia.ajax(obj,'buscaid');
    jsGuia.setDoForm(json.data[0]);
    $("#titulo").text('Editar Cadastro');
    $("#GuiaNovoEditar").modal();
};

jsGuia.eventosDaTable = function(){
    $('#listaGuia tr').each(function() {
    var codigo;
    $('td', $(this)).each(function(index, item) {            
        if(index === 0){codigo=$(item).text();}
    });            
    $(this).click(function(){jsGuia.editar(codigo);}).css('cursor','pointer');
    });
};
jsGuia.paginacao = function(){
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
jsGuia.start();


