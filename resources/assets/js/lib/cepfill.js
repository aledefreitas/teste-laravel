/**
 * TESTE DE LARAVEL
 * CIATÉCNICA
 *
 * @author      Alexandre de Freitas Caetano <https://github.com/aledefreitas>
 */
'use strict';

/**
 * Construtor do CepFill
 * Recebe o elemento do formulário que irá completar o endereço com o CEP
 *
 * @var     {DOMElement}        element
 *
 * @return {void}
 */
function CepFill(element) {
    this._element = element;
    this._keystroke_timeout = null;

    $(this._element).find('input[name=cep]').on("keyup", this._onChange.bind(this));
}

/**
 * Intervalo de tempo do key up do usuário no campo de cep até fazer um fetch na API
 *
 * @var {int}
 * @private
 */
var KEYSTROKE_TIMEOUT = 200;

/**
 * Handler para o evento de change do input de CEP
 *
 * @return {void}
 */
CepFill.prototype._onChange = function() {
    clearTimeout(this._keystroke_timeout);

    this._keystroke_timeout = setTimeout(function() {
        this.fetch($(this._element).find('input[name=cep]').val()).then(function(data) {
            this.fill(data);
        }.bind(this)).catch(function(err) {
            this.fill({
                'logradouro': '',
                'complemento': '',
                'bairro': '',
                'cidade': '',
                'uf': ''
            });

            alert(err);
        }.bind(this));
    }.bind(this), KEYSTROKE_TIMEOUT);
};

/**
 * Preenche os campos com os dados do CEP
 *
 * @var     {object}        data
 *
 * @return {void}
 */
CepFill.prototype.fill = function(data) {
    var Form = $(this._element);

    Form.find('input[name=logradouro]').val(data.logradouro);
    Form.find('input[name=complemento]').val(data.complemento);
    Form.find('input[name=bairro]').val(data.bairro);
    Form.find('input[name=cidade]').val(data.localidade);
    Form.find('input[name=uf]').val(data.uf);

};

/**
 * Faz um fetch na API do ViaCEP para recuperar os dados de endereço
 *
 * @var     {int}       cep
 *
 * @return {null|Promise}    Que dá fulfill com os dados, ou rejeita com erro
 */
CepFill.prototype.fetch = function(cep) {
    if(!cep || (new RegExp(/(\d{8})/)).test(cep) === false)
        return;

    return new Promise(function(resolve, reject) {
        $.ajax({
            'url': 'https://viacep.com.br/ws/'+cep+'/json/',
            'type': 'get',
            'dataType': 'json',
            'success': function(response) {
                if(response.erro === true) {
                    reject("CEP Inválido");
                }

                resolve(response);
            },
            'error': function(err) {
                reject(err);
            }
        });
    });
};

module.exports = CepFill;
