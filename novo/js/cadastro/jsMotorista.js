var jsMotorista = {};

jsMotorista.start = function(){jsMotorista.eventos();};
jsMotorista.mask = function(){
    $("#mot_celular").mask('(00)0000-0000');
    $("#mot_telefone").mask('(00)0000-0000');
    $("#mot_cpf").mask('000.000.000-00');
    $("#mot_rg").mask('00000000000000000000');
}
jsMotorista.eventos = function(){
    
    jsMotorista.getlista();
    jsMotorista.mask();
    
    $('#mot_Salvar').click(function(){jsMotorista.salvar();});
    
    $('#MotoristaNovoEditar').on('hidden.bs.modal', function () {
        $('#titulo').text('Novo Cadastro');
        $('#MotoristaNovoEditar input,textarea').each(function(){
            $(this).val('');
        });
    });
    $('#MotoristaNovoEditar').on('shown.bs.modal', function () {
        $("#mot_nome").focus();
    });
    $('#infoModal').on('hidden.bs.modal', function () {
       //loadContent('#conteudo','html/cadastro/hotel.html?v=2');
    });
};

jsMotorista.informe = function(msg) {
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

jsMotorista.ajax = function(obj, funcao, v) {
    var view = v == null ? 'view/vMotorista.php' : v;
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

jsMotorista.getDoForm = function(){
    var obj = new Object();
        obj.mot_id          = $("#mot_id").val();
        obj.mot_nome        = $("#mot_nome").val();
        obj.mot_endereco    = $("#mot_endereco").val();
        obj.mot_celular     = $("#mot_celular").val();
        obj.mot_telefone    = $("#mot_telefone").val();
        obj.mot_cpf         = $("#mot_cpf").val();
        obj.mot_rg          = $("#mot_rg").val();
        obj.mot_outros      = $("#mot_outros").val();
   
   return obj;
};

jsMotorista.setDoForm = function(obj){
    $("#mot_id").val(obj.mot_id);
    $("#mot_nome").val(obj.mot_nome);
    $("#mot_endereco").val(obj.mot_endereco);
    $("#mot_celular").val(obj.mot_celular);
    $("#mot_telefone").val(obj.mot_telefone);
    $("#mot_cpf").val(obj.mot_cpf);
    $("#mot_rg").val(obj.mot_rg);
    $("#mot_outros").val(obj.mot_outros);
};

jsMotorista.getlista = function(){
    var json = jsMotorista.ajax('','fetchAll');
    try{
        main.listarNaTable($('#listaMotorista'),json.data,true);
        jsMotorista.eventosDaTable();
        //jsMotorista.paginacao();
    }catch (erro){
        $('#listaMotorista').empty();
        $('#listaMotorista').append("<div colspan='2' style='height:13px;padding-top: 20px'>MOTORISTAS NÃO LOCALIZADO !</div>");
    }
};

jsMotorista.salvar = function(){
    var obj = this.getDoForm();
    console.info(obj);
    if(obj.mot_id ==""){
        var fun = 'insert';
    }else{
        fun = 'update';
    }
    var json = jsMotorista.ajax(obj,fun); //!= null ? jsMotorista.confirmacao(fun,1):jsMotorista.confirmacao(fun,2) //alert("REGISTRADO COM SUCESSO!"): alert("ERRO AO GRAVAR");    
    
    $("#MotoristaNovoEditar").modal('hide');
    jsMotorista.getlista();
    $("#infoText").text(json.message);
    $("#infoModal").modal();
};

jsMotorista.confirmacao = function (a,b){
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

jsMotorista.editar = function(mot_id){
    var obj = new Object();
        obj.mot_id = mot_id;
    var json = jsMotorista.ajax(obj,'buscaid');
    jsMotorista.setDoForm(json.data[0]);
    $("#titulo").text('Editar Cadastro');
    $("#MotoristaNovoEditar").modal();
    jsMotorista.mask();
};

jsMotorista.eventosDaTable = function(){
    $('#listaMotorista tr').each(function() {
    var codigo;
    $('td', $(this)).each(function(index, item) {            
        if(index === 0){codigo=$(item).text();}
    });            
    $(this).click(function(){jsMotorista.editar(codigo);}).css('cursor','pointer');
    });
};
jsMotorista.paginacao = function(){
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
jsMotorista.start();