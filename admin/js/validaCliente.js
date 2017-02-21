$.noConflict();
$.validator.setDefaults({
	submitHandler: function() { document.frm.submit(); },
	highlight: function(input) {
		$(input).addClass("ui-state-highlight");
	},
	unhighlight: function(input) {
		$(input).removeClass("ui-state-highlight");
	}
});

$().ready(function() {
        $.validator.addMethod("inss", function() {
            
            if (ChecaPIS($('#inss').val()) == false ){           //FUNCAO ChecaPIS esta no arquivo CUSTOM.JS
                    return false;
            } else {
                    return true;
            }
	}, 'PIS INVALIDO');
        
        $.validator.addMethod("cpf", function() {
            
            if (valida_cpf($('#cpf').val()) == false ){           //FUNCAO ChecaPIS esta no arquivo CUSTOM.JS
                    return false;
            } else {
                    return true;
            }
	}, 'CPF INVALIDO');
        
        $.validator.addMethod("cnpj", function() {
            
            if (valida_cnpj($('#cnpj').val()) == false ){           //FUNCAO ChecaPIS esta no arquivo CUSTOM.JS
                    return false;
            } else {
                    return true;
            }
	}, 'CNPJ INVALIDO');
        

	// Validacao na tela e depois do submit
	$("#signupForm1").validate({ //JURIDICO
		rules: {
			cid_nome: {
				required: true
			},
			cid_cod_nome: {
				required: true
			},
			nome: {
				required: true,
				minlength: 2
			},
			cnpj: {
				cnpj: true				
			},
                        rtb: {
				required: true,
				minlength: 2
			},
			rntrc: {
				required: true,
				minlength: 3
			},
			rntrcVenc: {
				required: true,
				minlength: 10,
				maxlength: 10
			}
		},
		messages: {
			cid_nome: {
				required: "Consulte uma cidade cadastrada no sistema"
			},
			cid_cod_nome: {
				required: "Insira uma Cidade valida no campo Consulta Cidade "
			},
			nome: {
				required: "Favor digite o nome",
				minlength: "Minimo 2 digitos"
			},			
			cnpj: {
				required: "Favor digite o cpf",
				minlength: "Formato 99.999.999/9999-99"
			},
                        rtb: {
				required: "Favor digite o rtb",
                                minlength: "Minimo 2 digitos"
			},
			rntrc: {
				required: "Campo Obrigatorio",
				minlength: "Minimo 3 digitos"
			},			
			rntrcVenc: {
				required: "Favor digite o vencimento",
				minlength: "Formato dd/mm/aaaa",
				maxlength: "Formato dd/mm/aaaa"
			}			
		}
	});
	$("#signupForm2").validate({//ESTRANGEIRO
		rules: {
			nome: {
                            required: true,
                            minlength: 2
			},
                        cedula:{
                            required:true,
                            minlength: 3
                        }
		},
		messages: {
			nome: {
				required: "Favor digite o nome",
				minlength: "Minimo 2 digitos"
			},
                        cedula:{
                            required:"Favor digite Cedula",
                            minlength:"Minimo 3 digitos"
                        }
		}
	});
	$("#signupForm3").validate({//FISICO
		rules: {
			cid_nome2: {
				required: true
			},
			cid_cod_nome2: {
				required: true
			},
			nome: {
				required: true,
				minlength: 2
			},
			cpf: {
				cpf: true
			},
                        inss: {
				inss: true
			},
			rntrc: {
				required: true,
				minlength: 3
			},
			rntrcVenc: {
				required: true,
				minlength: 10,
				maxlength: 10
			}
		},
		messages: {
			cid_nome2: {
				required: "Consulte uma cidade cadastrada no sistema"
			},
			cid_cod_nome2: {
				required: "Insira uma Cidade valida no campo Consulta Cidade "
			},
			nome: {
				required: "Favor digite o nome",
				minlength: "Minimo 2 digitos"
			},			
			cpf: {
				required: "Favor digite o cpf",
				minlength: "Minimo 11 digitos"
			},
			rntrc: {
				required: "Campo Obrigatório",
				minlength: "Minimo 3 digitos"
			},			
			rntrcVenc: {
				required: "Favor digite o vencimento",
				minlength: "Formato dd/mm/aaaa",
				maxlength: "Formato dd/mm/aaaa"
			}			
		}
	});
	
	$("#signupForm input:not(:submit)").addClass("ui-widget-content");
	$("#signupForm1 input:not(:submit)").addClass("ui-widget-content");
	$("#signupForm2 input:not(:submit)").addClass("ui-widget-content");
	$("#signupForm3 input:not(:submit)").addClass("ui-widget-content");
	
	
	
});