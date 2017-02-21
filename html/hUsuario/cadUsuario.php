<style>
    input{text-transform: uppercase;}
    textarea{text-transform: uppercase;}
    
</style>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="row">
                <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#UsuNovoEditar" style="float: right">Novo</button>
                <h4 >Lista de Usuario</h4>
                <table id="listaUsu" class="table table-hover table-striped" ></table>
            </div>
        </div>
        <div class="col-lg-6">

        </div>
            <div class="row" >
                <div class="modal fade" id="UsuNovoEditar">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 id="titulo" class="modal-title">Novo Cadastro</h4>
                        </div>
                        <div class="modal-body form-inline">
                            <div class="col-lg-12 col-xs-12" >
                                <label for="usu_nome">Nome</label>
                                <input type="text" class="form-control" id="usu_nome" placeholder="Digitar nome">
                            </div>
                            <div class="col-lg-12 col-xs-12" >
                                <label for="usu_login">Login</label>
                                <input type="text" class="form-control" id="usu_login" placeholder="Digitar login do Sistema">
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <label for="usu_senha">Senha</label>
                                <input onKeyUp="jUsuario.validarSenha('usu_senha', 'usu_confirma', 'resultadoCadastro');" type="password" class="form-control" id="usu_senha" placeholder="*********" autocomplete="off">
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <label for="usu_confirma">Confirmar senha</label>
                                <input onKeyUp="jUsuario.validarSenha('usu_senha', 'usu_confirma', 'resultadoCadastro');" type="password" class="form-control" id="usu_confirma" placeholder="*********" autocomplete="off">
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <label ><p id="resultadoCadastro" style="font-weight: bold;">&nbsp;</p></label>
                            </div>
                            <input type="hidden" id="usu_id">
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button id="usu_Salvar" type="button" class="btn btn-primary">Salvar</button>
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
    loadjscssfile('js/usuario/jUsuario.js?nocache=1','js');
</script>
