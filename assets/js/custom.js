$(function() {

    // Atribui evento e função para limpeza dos campos
    $('#busca').on('input', limpaCampos);

    // Dispara o Autocomplete a partir do segundo caracter
    $("#busca").autocomplete({
            minLength: 2,
            source: function(request, response) {
                $.ajax({
                    url: "../consultar/consulta.php",
                    dataType: "json",
                    data: {
                        acao: 'autocomplete',
                        parametro: $('#busca').val()
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            focus: function(event, ui) {
                $("#busca").val(ui.item.nome_completo);
                carregarDados();
                return false;
            },
            select: function(event, ui) {
                $("#busca").val(ui.item.nome_completo);
                return false;
            }
        })
        .autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<a><b>ID Passagem: </b>" + item.id_passagem + "<br><b>Nome Completo: </b>" + item.nome_completo + " - <b> Localizador: </b>" + item.localizador + "</a><br>")
                .appendTo(ul);
        };

    // Função para carregar os dados da consulta nos respectivos campos
    function carregarDados() {
        var busca = $('#busca').val();

        if (busca != "" && busca.length >= 2) {
            $.ajax({
                url: "../consultar/consulta.php",
                dataType: "json",
                data: {
                    acao: 'consulta',
                    parametro: $('#busca').val()
                },
                success: function(data) {
                    $('#id_passagem').val(data[].id_passagem);
                    $('#nome_completo').val(data[].nome_completo);
                    $('#localizador').val(data[].localizador);
                    $('#origem').val(data[].origem);
                    $('#destino').val(data[].destino);
                    $('#data_ida').val(data[].data_ida);
                    $('#data_retorno').val(data[].data_retorno);
                    $('#tarifa_voucher').val(data[].tarifa_voucher);
                    $('#taxas_voucher').val(data[].taxas_voucher);
                }
            });
        }
    }

    // Função para limpar os campos caso a busca esteja vazia
    function limpaCampos() {
        var busca = $('#busca').val();

        if (busca == "") {
            $('#id_passagem').val('');
            $('#nome_completo').val('')
            $('#localizador').val('');
            $('#origem').val('');
            $('#destino').val('');
            $('#data_ida').val('');
            $('#data_retorno').val('')
            $('#tarifa_voucher').val('')
            $('#taxas_voucher').val('')
        }
    }
});