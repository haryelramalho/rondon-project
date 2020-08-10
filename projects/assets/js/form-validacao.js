/* BM inicio */

function cpf_validate(cpf) {

    var dig1 = 0, dig2 = 0;

    for (i = 0; i < 9; ++i) {
        dig1 += (cpf.charAt(i) * (10 - i));
    }

    dig1 %= 11;
    dig1 = 11 - dig1;
    
    if (dig1 > 9) {
        dig1 = 0;
    }

    if (dig1 != cpf.charAt(9)) {
        return false;
    }
    
    for (i = 0; i < 10; ++i) {
        dig2 += (cpf.charAt(i) * (11 - i));
    }

    dig2 %= 11;
    dig2 = 11 - dig2;
    
    if (dig2 > 9) {
        dig2 = 0;
    }

    if (dig2 != cpf.charAt(10)) {
        return false;
    }

    return true;
}

/* BM fim */

/* ariel  inicio*/

//parametro tipo deve ser "pdf" ou "msword"
function validar_arquivo(file_jquery, tipo) {

    var file_js = document.getElementById("arquivo_" + tipo);
    var feedback = $("#arquivo_" + tipo + "-feedback");
    var label = $("#arquivo_" + tipo + "-label");

    if (file_js.files.length === 0) {

        file_jquery.addClass("is-invalid");
        feedback.html("Um arquivo deve ser selecionado!");
        label.html("Selecione um arquivo");

        file_js.setCustomValidity("erro");

    } else {

        label.html(file_js.files[0].name);

        if (file_js.files[0].name.substring(file_js.files[0].name.lastIndexOf(".") + 1).toLowerCase() !== tipo) {

            file_jquery.addClass("is-invalid");
            feedback.html("Formato de arquivo inválido!");

            file_js.setCustomValidity("erro");

        } else if (file_js.files[0].size > parseInt($("#max-filesize").val()) * 1024 * 1024) {

            file_jquery.addClass("is-invalid");
            feedback.html("O tamanho do arquivo excede o limite máximo!");

            file_js.setCustomValidity("erro");

        } else {

            file_jquery.removeClass("is-invalid").addClass("is-valid");

            file_js.setCustomValidity("");
        }
    }
}

function file_validate(file_jquery, index) {

    var file_js = document.getElementById("foto" + index);
    var feedback = $("#foto" + index + "-feedback");
    var label = $("#foto" + index + "-label");

    if (file_js.files.length === 0) {

        file_jquery.addClass("is-invalid");
        feedback.html("Uma foto deve ser selecionada!");
        label.html("Selecione uma foto");

        file_js.setCustomValidity("erro");

    } else {

        label.html(file_js.files[0].name);

        if (file_js.files[0].type !== "image/png" &&
                file_js.files[0].type !== "image/jpeg") {

            file_jquery.addClass("is-invalid");
            feedback.html("Formato de foto inválido!");

            file_js.setCustomValidity("erro");

        } else if (file_js.files[0].size > parseInt($("#max-filesize").val()) * 1024 * 1024) {

            file_jquery.addClass("is-invalid");
            feedback.html("O tamanho da foto excede o limite máximo!");

            file_js.setCustomValidity("erro");

        } else {

            file_jquery.removeClass("is-invalid").addClass("is-valid");

            file_js.setCustomValidity("");
        }
    }
}

function limpa_formulário_cep() {

    $("#logradouro").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
    $("#complemento").val("");
    $("#numero").val("");
}

$(document).ready(function () {

    $("#nascimento").inputmask("date", {

        placeholder: '__/__/____',
        showMaskOnHover: false,
        clearIncomplete: true
    });

    $("#preco").inputmask("currency", {

        prefix: '',
        clearIncomplete: true,
        rightAlign: false,
        groupSeparator: '.',
        radixPoint: ','
    });
    
    $("#nota").inputmask("currency", {

        prefix: '',
        clearIncomplete: true,
        rightAlign: false,
        groupSeparator: '.',
        radixPoint: ',',
        min: 0,
        max: 10
    });

    $("#cpf").inputmask("999.999.999-99", {

        showMaskOnHover: false,
        clearIncomplete: true
    });

    $("#cep").inputmask("99999-999", {

        showMaskOnHover: false
    });

    $("#telefone").inputmask("(99) 9999-9999", {

        showMaskOnHover: false,
        clearIncomplete: true
    });

    $("#celular").inputmask("(99) 99999-9999", {

        showMaskOnHover: false,
        clearIncomplete: true
    });

    $("#senha1").on('input', function () {

        var input = document.getElementById("senha1");

        input.setCustomValidity("");

        if (input.checkValidity()) {

            $(this).removeClass("is-invalid").addClass("is-valid");

            if ($("#senha2").val() !== "") {

                if ($("#senha2").val() !== $("#senha1").val()) {

                    document.getElementById("senha2").setCustomValidity("erro");
                    $("#senha2-feedback").html("As senhas não correspondem!");
                    $("#senha2").removeClass("is-valid").addClass("is-invalid");

                } else {

                    document.getElementById("senha2").setCustomValidity("");
                    $("#senha2").removeClass("is-invalid").addClass("is-valid");
                }
            }

        } else {

            input.setCustomValidity("erro");
            $("#senha1").removeClass("is-valid").addClass("is-invalid");

            if ($("#senha2").val() !== "") {

                document.getElementById("senha2").setCustomValidity("erro");
                $("#senha2-feedback").html("");
                $("#senha2").removeClass("is-valid").addClass("is-invalid");
            }
        }
    });

    $("#senha2").on('input', function () {

        var input = document.getElementById("senha2");

        if (document.getElementById("senha1").validity.valid) {

            if ($("#senha2").val() !== $("#senha1").val()) {

                input.setCustomValidity("erro");
                $("#senha2-feedback").html("As senhas não correspondem!");
                $("#senha2").removeClass("is-valid").addClass("is-invalid");

            } else {

                input.setCustomValidity("");
                $("#senha2").removeClass("is-invalid").addClass("is-valid");
            }
        } else {

            input.setCustomValidity("erro");
            $("#senha2-feedback").html("");
            $("#senha2").removeClass("is-valid").addClass("is-invalid");
        }
    });

    $("#cpf").on('input', function () {

        var cpf = $(this).val();
        var valida_cpf = /^([0-9]{3}.){2}[0-9]{3}-[0-9]{2}$/;

        if (valida_cpf.test(cpf) && cpf_validate(cpf.replace(/\D/g, ''))) {

            $(this).removeClass('is-invalid').addClass('is-valid');
            document.getElementById('cpf').setCustomValidity('');
        } else {

            $(this).removeClass('is-valid').addClass('is-invalid');
            document.getElementById('cpf').setCustomValidity('erro');
        }
    });

    //Quando o campo cep perde o foco.
    $("#cep").on('input', function () {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep !== "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                $("#cep").removeClass("is-valid").addClass("is-invalid");
                $("#cep-feedback").html("Pesquisando ...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {

                        //Atualiza os campos com os valores da consulta.

                        if (dados.logradouro !== "") {

                            $("#logradouro").val(dados.logradouro);
                            $("#logradouro").prop("readonly", "true");

                        } else {
                            $("#logradouro").removeAttr("readonly");
                        }

                        if (dados.bairro !== "") {

                            $("#bairro").val(dados.bairro);
                            $("#bairro").prop("readonly", "true");

                        } else {
                            $("#bairro").removeAttr('readonly');
                        }

                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                        $("#complemento").val(dados.complemento);

                        $("#cep").removeClass("is-invalid").addClass("is-valid");

                        document.getElementById("cep").setCustomValidity("");

                        if (!$("#endereco").hasClass("show")) {
                            $("#exibir-endereco").click();
                        }

                    } else {

                        //CEP pesquisado não foi encontrado.
                        if ($("#endereco").hasClass("show")) {
                            $("#exibir-endereco").click();
                        }

                        limpa_formulário_cep();

                        $("#cep").removeClass("is-valid").addClass("is-invalid");
                        $("#cep-feedback").html("Cep pesquisado não foi encontrado!");

                        document.getElementById("cep").setCustomValidity("erro");
                    }
                });
            } else {
                //cep é inválido.
                if ($("#endereco").hasClass("show")) {
                    $("#exibir-endereco").click();
                }

                $("#cep").removeClass("is-valid").addClass("is-invalid");
                $("#cep-feedback").html("Formato de CEP inválido!");

                limpa_formulário_cep();
            }
        } else {

            //cep sem valor, limpa formulário.
            if ($("#endereco").hasClass("show")) {
                $("#exibir-endereco").click();
            }

            $("#cep").removeClass("is-valid").addClass("is-invalid");
            $("#cep-feedback").html("Um CEP deve ser informado!");

            limpa_formulário_cep();
        }
    });
});

/* ariel fim */
