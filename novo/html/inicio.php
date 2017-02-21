<style>
    #thid{
        width: 60PX
    }
    #thEntrada{
        width: 100PX
    }
</style>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <!--<button class="btn btn-default btn-sm" data-toggle="modal" data-target="#GrupoNovoEditar" style="float: right">Novo</button>-->
                <h4 >Inicio Lista de Grupos</h4>
                <table id="listaInicio" class="table table-hover table-striped" ></table>
            </div>
        </div>
        <div class="col-lg-6">

        </div>
            <div class="row" >
                <div class="modal fade" id="InicioNovoEditar">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 id="titulo" class="modal-title">Novo Cadastro</h4>
                        </div>
                        <div class="modal-body form-inline">
                            <div class="form-group" style="width: 527px;">
                                <label for="gnome">Nome Pax</label>
                                <input type="text" class="form-control" id="gnome" placeholder="Digitar nome do Responsavel do Grupo">
                            </div>
                            <div class="form-group" style="width: 60px;">
                                <label for="gquantidade">Quant.</label>
                                <input type="text" class="form-control" id="gquantidade" placeholder="Quant de Pessoas">
                            </div>
                            <div class="form-group" style="width: 150px;">
                                <label for="gguia">Guia</label>
                                <input class="form-control" id="gguia" placeholder="Selecionar Um Guia" >
                            </div>
                            <div class="form-group" style="width: 100px;">
                                <label for="gvoo">Voo</label>
                                <input class="form-control" id="gvoo" placeholder="Nome do Voo" >
                            </div>
                            <div class="form-group" style="width: 100px;">
                                <label for="gdata">Data Voo</label>
                                <input class="form-control" id="gdata" placeholder="Data de Chegada" >
                            </div>
                            <div class="form-group" style="width: 100px;">
                                <label for="ghorario">Horario Voo</label>
                                <input class="form-control" id="ghorario" placeholder="Horario da Chegada" >
                            </div>
                            <div class="form-group" style="width: 527px;">
                                <label for="gnomehotel">Hotel</label>
                                <input class="form-control" id="gnomehotel" placeholder="Entrada no Hotel" >
                            </div>
                            <div class="form-group" style="width: 130px;">
                                <label for="gentradahotel">Entrada Hotel</label>
                                <input class="form-control" id="gentradahotel" placeholder="Entrada no Hotel" >
                            </div>
                            <div class="form-group" style="width: 130px;">
                                <label for="gsaidahotel">Saida Hotel</label>
                                <input class="form-control" id="gsaidahotel" placeholder="Saida do Hotel" >
                            </div>
                            <div class="form-group" style="width: 527px">
                                <label for="gdescricaoreserva">Obs.: Reserva Hotel</label>
                                <textarea class="form-control" id="gdescricaoreserva" placeholder="Detalhes da Reserva no Hotel" style="resize: none;"></textarea>
                            </div>
                            <div class="form-group" style="width: 527px">
                                <label for="gprogramacao">Roteiro</label>
                                <textarea class="form-control" id="gprogramacao" placeholder="Roteiro do Grupo" style="resize: none;"></textarea>
                            </div>
                            <input type="hidden" id="grupoId">
                        </div>
                        <div class="modal-footer">
                            <button id="iSalvar" type="button" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancela</button>
                        </div>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
                  
                <div class="modal fade" id="infoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Menssagem</h4>
                            </div>
                        <div id="infoText" class="modal-body"></div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">fechar</button>
                        </div>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
                
                <!--<button type="submit" id="hSalvar" class="btn btn-default">Salvar</button>-->
                
            </div>
        </div>
    </div>
<script>
    loadjscssfile('js/jsInicio.js?nocache=1','js');
    
    $('#InicioNovoEditar').on('hidden.bs.modal', function () {
        $('#titulo').text('Novo Cadastro');
        $('#InicioNovoEditar input,textarea').each(function(){
            $(this).val('');
            jsInicio.mask();
        });
    });
    $('#InicioNovoEditar').on('shown.bs.modal', function () {
        $("#gnome").focus();
    });
    $('#infoModal').on('hidden.bs.modal', function () {
       //loadContent('#conteudo','html/cadastro/hotel.html?v=2');
    });
  
</script>