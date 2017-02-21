function loadContent(id, pagina) {                
    $(id).slideUp("slow",function(){//efeito de sobe e desce o footer
        $("#carregando").dialog('open');
        $(this).load(pagina, function(){                       
            $("#carregando").dialog('close');
            $(this).slideDown("slow");
        });
    });
}
function loadjscssfile(filename, filetype){                
    if (filetype=="js"){ //if filename is a external JavaScript file
        var fileref=document.createElement('script');
        fileref.setAttribute("type","text/javascript");
        fileref.setAttribute("src", filename);
    }
    else if (filetype=="css"){ //if filename is an external CSS file
        var fileref=document.createElement("link");
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("type", "text/css");
        fileref.setAttribute("href", filename);
    }
    if (typeof fileref!="undefined"){
        document.getElementsByTagName("head")[0].appendChild(fileref);
    }                    
} 
$('#carregando').dialog({autoOpen: false,height:60,modal:true});
$("#menu-2").mouseover(function(){ //sub-menu dar um tempinho
    classe = $(this).attr('class');
    $('.'+classe).css('display','block');
    setTimeout(function(){
        $('.'+classe).css('display','');
    },1250);                    
});    
var sub_menu=$('#sub_menu').val();
$('#conteudo').load(sub_menu);	
$.Shortcuts.add({type: 'down',mask: 'alt+m',enableInInput: true,handler: function() {
    $("#MinhaConta").css("hover", "hover");
    return false;
},list: 'menuPrincipal'});      