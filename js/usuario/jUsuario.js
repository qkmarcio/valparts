var jUsuario = {};

jUsuario.start = function(){jUsuario.eventos();};

jUsuario.mask = function(){
    //$("#usu_celular").mask('(00)0000-0000');
    //$("#usu_telefone").mask('(00)0000-0000');
}

jUsuario.eventos = function(){
    jUsuario.getlista();
    jUsuario.mask();
    
    $('#usu_Salvar').click(function(){jUsuario.salvar();});
    
    $('#UsuNovoEditar').on('hidden.bs.modal', function () {
        $('#titulo').text('Novo Cadastro');
        $('#UsuNovoEditar input,textarea').each(function(){
            $(this).val('');
        });
    });
    $('#UsuNovoEditar').on('shown.bs.modal', function () {
        $("#usu_nome").focus();
    });
    $('#infoModal').on('hidden.bs.modal', function () {
       //loadContent('#conteudo','html/cadastro/hotel.html?v=2');
    });
};
jUsuario.informe = function(msg) {
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

jUsuario.ajax = function(obj, funcao, v) {
    var view = v == null ? 'view/vUsuario.php' : v;
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

jUsuario.getDoForm = function(){
    var obj = new Object();
        obj.usu_id      = $("#usu_id").val();
        obj.usu_nome    = $("#usu_nome").val();
        obj.usu_login   = $("#usu_login").val();
        obj.usu_senha   = $("#usu_senha").val();
   
   return obj;
};

jUsuario.setDoForm = function(obj){
    $("#usu_id").val(obj.usu_id);
    $("#usu_nome").val(obj.usu_nome);
    $("#usu_login").val(obj.usu_login);
    $("#usu_senha").val(obj.usu_senha);
    $("#usu_confirma").val(obj.usu_senha);
};

jUsuario.getlista = function(){
    var json = jUsuario.ajax('','fetchAll');
    
    try{
        main.listarNaTable($('#listaUsu'),json.data,true);
        jUsuario.eventosDaTable();
        //jUsuario.paginacao();
    }catch(erro) {
        $('#listaUsu').empty();
        $('#listaUsu').append("<div colspan='2' style='height:13px;padding-top: 20px'>USUARIOS NÃO LOCALIZADO !</div>");
    }
};

jUsuario.salvar = function(){
    var obj = this.getDoForm();
    console.info(obj);
    if(obj.usu_id ==""){
        var fun = 'insert';
    }else{
        fun = 'update';
    }
    var json = jUsuario.ajax(obj,fun); //!= null ? jUsuario.confirmacao(fun,1):jUsuario.confirmacao(fun,2) //alert("REGISTRADO COM SUCESSO!"): alert("ERRO AO GRAVAR");    
    
    $("#UsuNovoEditar").modal('hide');
    jUsuario.getlista();
    $("#infoText").text(json.message);
    $("#infoModal").modal();
};

jUsuario.confirmacao = function (a,b){
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

jUsuario.editar = function(usu_id){
    var obj = new Object();
        obj.usu_id = usu_id;
    var json = jUsuario.ajax(obj,'buscaid');
    jUsuario.setDoForm(json.data[0]);
    $("#titulo").text('Editar Cadastro');
    $("#UsuNovoEditar").modal();
};

jUsuario.eventosDaTable = function(){
    $('#listaUsu tr').each(function() {
    var codigo;
    $('td', $(this)).each(function(index, item) {            
        if(index === 0){codigo=$(item).text();}
    });            
    $(this).click(function(){jUsuario.editar(codigo);}).css('cursor','pointer');
    });
};
jUsuario.paginacao = function(){
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
jUsuario.validarSenha = function (senha1, senha2, campo) {
    var resultado = document.getElementById(campo);

    var senhaPrimaria = document.getElementById(senha1).value;
    var senhaSecundaria = document.getElementById(senha2).value;

    if (senhaPrimaria == senhaSecundaria && senhaPrimaria.length > 3 && senhaSecundaria.length > 3) {
        resultado.innerHTML = "Senhas iguais";
    } else {
        resultado.innerHTML = "Senhas Incorretas";
    }
}
jUsuario.start();