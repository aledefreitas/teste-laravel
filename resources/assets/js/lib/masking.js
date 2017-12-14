/**
 * TESTE DE LARAVEL
 * CIATÉCNICA
 *
 * @author      Alexandre de Freitas Caetano <https://github.com/aledefreitas>
 */
'use strict';

require('jquery-mask-plugin');

var exports = module.exports || {};

exports.init = function() {
    $(".cpf").mask("000.000.000-00");
    $(".cnpj").mask("00.000.000/0000-00");
    $(".birthdate").mask("00/00/0000");
    $("input[name=cep]").mask("00000000");
};
