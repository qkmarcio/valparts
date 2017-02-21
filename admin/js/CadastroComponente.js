function getDatePickerDefault(){
    return {dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
            dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab','Dom'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro', 'Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set', 'Out','Nov','Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
    };
}

function maskaras(){
            (function($){
            $(function(){
                $('input:text').setMask();
            });
            })(jQuery); 
            $.mask.masks = $.extend($.mask.masks, {
                cep:{ mask: '99999-999' },
                phone:{ mask: '(99)9999-9999' }
            }); 
        }

    

function scriptLocal(){
    maskaras();
    // CONFIGURAÇÃO DO DATEPICKER DO JQUERYUI PARA PT-BR Funcao no js/custom_jquery.js
    $.datepicker.setDefaults(getDatePickerDefault());
    $("#data").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:"c-50:c+2" 
    });
    $("#data").attr("readonly","readonly");

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
                    celular: {
                            required: true,
                            minlength: 14
                    },			
                    instrumento: {
                            required: true
                    }
            },
            messages: {
                    nome: {
                            required: "Favor digite o nome",
                            minlength: "Minimo 2 digitos"
                    },

                    celular: {
                            required: "Favor digite o celular",
                            minlength: "Minimo 14 digitos"
                    },

                    instrumento: {
                            required: "Favor selecionar um Instrumento"
                    }
            }
    });
}
scriptLocal();