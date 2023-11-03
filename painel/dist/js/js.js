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
});