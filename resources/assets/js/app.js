/**
 * TESTE DE LARAVEL
 * CIATÉCNICA
 *
 * @author      Alexandre de Freitas Caetano <https://github.com/aledefreitas>
 */
'use strict';

require('./bootstrap');

var Masking = require("./lib/masking");
var CepFill = require("./lib/cepfill");

/**
 * Construtor para o LaravelTeste
 *
 * @return {void}
 */
function LaravelTeste() {
    var self = this;

    window.addEventListener("DOMContentLoaded", function(event) {
        Masking.init();
        self.startCepListener($("#pf form")[0]);
        self.startCepListener($("#pj form")[0]);
    });
};

/**
 * Inicia o listener para auto-preencher os dados de endereço de acordo com o CEP
 *
 * @return {void}
 */
LaravelTeste.prototype.startCepListener = function(element) {
    return new CepFill(element);
};

module.exports = new LaravelTeste();
