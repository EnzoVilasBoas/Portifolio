$(document).ready(function() {
	console.log('A paciência é um dos elementos chave para o sucesso.');
    var BASE = "https://www.enzovilasboas.com.br/painel"
    
    //
    //CARGOS
    //
    
        /**
         * Retorna questionario de exclusão do cargo
         */
        $('body').on('click', '.A_PergExcluirCargo', function () {
            var cargo = $(this).attr('data-cargo');
            $.post(BASE + '/cargos/excluir/verf/api', { cargo: cargo }, function (info) {
                if (info) {
                    console.log(info);
                    $('.A_cargoModal').html(info);
                    $('.A_cargoModal'+cargo).modal('show');
                }
            });
            return false;
        });

        /**
         * Confirma a exclusão do cargo
         */
        $('body').on('click', '.A_excluirCargo', function () {
            var cargo = $(this).attr('data-cargo');
            $.post(BASE + '/cargos/excluir/api', { cargo: cargo }, function (info) {
                if (info) {
                    console.log(info);
                    $('.A_cargoMsg').html(info);
                    $('#A_cargo'+cargo).fadeOut('fast');
                }
            });
            return false;
        });

        /**
         * Remove acesso ao cargo
         */
        $('body').on('click', '.A_removAcesso', function () {
            var acesso = $(this).attr('data-acesso');
            $.post(BASE + '/cargos/acesso/api', { acesso: acesso }, function (info) {
                if (info) {
                    console.log(info);
                    $('.A_cargoMsg').html(info);
                    $('#A_perm'+acesso).fadeOut('fast');
                }
            });
            return false;
        });
    
    //
    //
    //

    //
    //USUARIOS
    //

        //Verificação da quantidade de digitos para cadastro da senha
        $('body').on('keyup','#InputSenhaUm',function(){
            var campoTexto = $("#InputSenhaUm").val();
            var caracteresDigitados = campoTexto.length;

            if (caracteresDigitados < 8) {
                $("#AlertSenhaUm").removeClass("text-green");
                $("#InputSenhaUm").removeClass("is-valid");
                $("#AlertSenhaUm").addClass("text-danger");
                $("#InputSenhaUm").addClass("is-invalid");
            } else {
                $("#AlertSenhaUm").removeClass("text-danger");
                $("#InputSenhaUm").removeClass("is-invalid");
                $("#AlertSenhaUm").addClass("text-green");
                $("#InputSenhaUm").addClass("is-valid");
            }
        });

        //Verificação da senha
        $('body').on('keyup','#InputSenhaDois',function(){
            var campoTexto1 = $("#InputSenhaUm").val();
            var campoTexto2 = $("#InputSenhaDois").val();

            if (campoTexto1 === campoTexto2) {
                $("#AlertSenhaDois").removeClass("text-danger");
                $("#InputSenhaDois").removeClass("is-invalid");
                $("#AlertSenhaDois").addClass("text-green");
                $("#InputSenhaDois").addClass("is-valid");
            } else {
                $("#AlertSenhaDois").removeClass("text-green");
                $("#InputSenhaDois").removeClass("is-valid");
                $("#AlertSenhaDois").addClass("text-danger");
                $("#InputSenhaDois").addClass("is-invalid");
            }
        });
    
    //
    //
    //
});