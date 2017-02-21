var jsHotel = {};

jsHotel.start = function(){jsHotel.eventos();};
jsHotel.eventos = function(){
    jsHotel.getlista();
    
    $('#hot_Salvar').click(function(){jsHotel.salvar();});
    
    $('#HotelNovoEditar').on('hidden.bs.modal', function () {
        $('#titulo').text('Novo Cadastro');
        $('#HotelNovoEditar input,textarea').each(function(){
            $(this).val('');
        });
    });
    $('#HotelNovoEditar').on('shown.bs.modal', function () {
        $("#hot_nome").focus();
    });
    $('#infoModal').on('hidden.bs.modal', function () {
       //loadContent('#conteudo','html/cadastro/hotel.html?v=2');
    });
};
jsHotel.informe = function(msg) {
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

jsHotel.ajax = function(obj, funcao, v) {
    var view = v == null ? 'view/vHotel.php' : v;
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

jsHotel.getDoForm = function(){
    var obj = new Object();
        obj.hot_id          = $("#hot_id").val();
        obj.hot_nome        = $("#hot_nome").val();
        obj.hot_endereco    = $("#hot_endereco").val();
        obj.hot_outros      = $("#hot_outros").val();
        //obj.erro            = $( ".valicadClie" );
   
   return obj;
};

jsHotel.setDoForm = function(obj){
    $("#hot_id").val(obj.hot_id);
    $("#hot_nome").val(obj.hot_nome);
    $("#hot_endereco").val(obj.hot_endereco);
    $("#hot_outros").val(obj.hot_outros);
};

jsHotel.getlista = function(){
    var json = jsHotel.ajax('','fetchAll');
    
    try{
        main.listarNaTable($('#listaHotel'),json.data,true);
        jsHotel.eventosDaTable();
        //jsHotel.paginacao();
    }catch (erro){
        $('#listaHotel').empty();
        $('#listaHotel').append("<div colspan='2' style='height:13px;padding-top: 20px'>HOTEIS NÃO LOCALIZADO !</div>");
    }
};

jsHotel.salvar = function(){
    var obj = this.getDoForm();
    if(obj.hot_id ==""){
        var fun = 'insert';
    }else{
        fun = 'update';
    }
    var json = jsHotel.ajax(obj,fun); //!= null ? jsHotel.confirmacao(fun,1):jsHotel.confirmacao(fun,2) //alert("REGISTRADO COM SUCESSO!"): alert("ERRO AO GRAVAR");    
    
    $("#HotelNovoEditar").modal('hide');
    jsHotel.getlista();
    $("#infoText").text(json.message);
    $("#infoModal").modal();
};

jsHotel.confirmacao = function (a,b){
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

jsHotel.editar = function(hot_id){
    var obj = new Object();
        obj.hot_id = hot_id;
    var json = jsHotel.ajax(obj,'buscaid');
    jsHotel.setDoForm(json.data[0]);
    $("#titulo").text('Editar Cadastro');
    $("#HotelNovoEditar").modal();
};

jsHotel.eventosDaTable = function(){
    $('#listaHotel tr').each(function() {
    var codigo;
    $('td', $(this)).each(function(index, item) {            
        if(index === 0){codigo=$(item).text();}
    });            
    $(this).click(function(){jsHotel.editar(codigo);}).css('cursor','pointer');
    });
};
jsHotel.paginacao = function(){
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
jsHotel.start();


