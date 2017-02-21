function maskaras(){
            (function($){
            $(function(){
                $('input:text').setMask();
            });
            })(jQuery); 
            /*$.mask.masks = $.extend($.mask.masks, {
                preco:{ mask: '99999-999' },
                desconto:{ mask: '(99)9999-9999' }
            }); */
}

function scriptLocal(){
    maskaras();
    $.noConflict();//usado para separar as variaveis já iniciadas
    $.validator.setDefaults({
            //submitHandler - Caso nao precise fazer alguma instrucao antes de enviar o formulario
            submitHandler: function() {             
                    document.frm.submit();                
            },
            highlight: function(input) {
                    $(input).addClass("ui-state-highlight");
            },
            unhighlight: function(input) {
                    $(input).removeClass("ui-state-highlight");
            }
    });
    // Validacao na tela e depois do submit
    $("#signupForm").validate({
            rules: {

                    nome: {
                            required: true,
                            minlength: 2
                    },
                    preco: {
                            required: true,
                            minlength: 2
                    }
            },
            messages: {
                    nome: {
                            required: "Favor digite o nome",
                            minlength: "Minimo 2 digitos"
                    },

                    preco: {
                            required: "Favor digite o preço",
                            minlength: "Minimo 14 digitos"
                    }
            }
    });
}
scriptLocal();


