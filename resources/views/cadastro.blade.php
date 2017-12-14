<?php
/**
 * TESTE DE LARAVEL
 * CIATÉCNICA
 *
 * @author      Alexandre de Freitas Caetano <https://github.com/aledefreitas>
 */
?>
@extends('layout')

@section('content')
    <h1>Teste de Laravel - CRUD Simples</h1>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <ul class="nav nav-pills nav-justified">
                <li class="active">
                    <a data-toggle='tab' href="#pf">Pessoa Física</a>
                </li>

                <li>
                    <a data-toggle='tab' href="#pj">Pessoa Jurídica</a>
                </li>
            </ul>
        </div>
    </div>

    @if (isset($error))
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="alert alert-danger">
                    <strong>ERRO!</strong> {{ $error }}
                </div>
            </div>
        </div>
    @endif

    @if (isset($success) && $success === true)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="alert alert-success">
                    <strong>Cadastro realizado com sucesso</strong>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="tab-content">
            <div id='pf' class="tab-pane fade in active">
                <form action="/cadastro_pessoa_fisica" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <span class="col-md-4">
                            <h3>CPF</h3>
                        </span>
                        <input type="text" name="documento" class="form-control cpf">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Data de Nascimento</h3>
                        </span>
                        <input type="text" name="nascimento" class="form-control birthdate">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Nome</h3>
                        </span>
                        <input type="text" name="nome" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Sobrenome</h3>
                        </span>
                        <input type="text" name="sobrenome" class="form-control" maxlength="15">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>CEP</h3>
                        </span>
                        <input type="text" name="cep" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Logradouro</h3>
                        </span>
                        <input type="text" name="logradouro" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Número</h3>
                        </span>
                        <input type="text" name="numero" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Complemento</h3>
                        </span>
                        <input type="text" name="complemento" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Bairro</h3>
                        </span>
                        <input type="text" name="bairro" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Cidade</h3>
                        </span>
                        <input type="text" name="cidade" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>UF</h3>
                        </span>
                        <input type="text" name="uf" class="form-control" maxlength="8">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary col-md-12" type="submit">
                            <h4>Enviar</h4>
                        </button>
                    </div>
                </form>
            </div>

            <div id='pj' class="tab-pane fade">
                <form action="/cadastro_pessoa_juridica" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <span class="col-md-4">
                            <h3>CNPJ</h3>
                        </span>
                        <input type="text" name="documento" class="form-control cnpj">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Razão Social</h3>
                        </span>
                        <input type="text" name="razao_social" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Nome Fantasia</h3>
                        </span>
                        <input type="text" name="fantasia" class="form-control" maxlength="15">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>CEP</h3>
                        </span>
                        <input type="text" name="cep" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Logradouro</h3>
                        </span>
                        <input type="text" name="logradouro" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Número</h3>
                        </span>
                        <input type="text" name="numero" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Complemento</h3>
                        </span>
                        <input type="text" name="complemento" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Bairro</h3>
                        </span>
                        <input type="text" name="bairro" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>Cidade</h3>
                        </span>
                        <input type="text" name="cidade" class="form-control">
                    </div>

                    <div class="form-group">
                        <span class="col-md-12">
                            <h3>UF</h3>
                        </span>
                        <input type="text" name="uf" class="form-control" maxlength="8">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary col-md-12" type="submit">
                            <h4>Enviar</h4>
                        </button>
                    </div>
            </div>
        </div>
    </div>
@endsection
