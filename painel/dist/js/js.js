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

        /**
         * Retorna questionario de exclusão do usuario
         */
        $('body').on('click', '.A_PergExcluirUsuario', function () {
            var user = $(this).attr('data-usuario');
            $.post(BASE + '/usuarios/excluir/verf/api', { user: user }, function (info) {
                if (info) {
                    $('.A_usuarioModal').html(info);
                    $('.A_usuarioModal'+user).modal('show');
                }
            });
            return false;
        });

        /**
         * Confirma a exclusão do usuario
         */
        $('body').on('click', '.A_excluirUsuario', function () {
            var user = $(this).attr('data-usuario');
            $.post(BASE + '/usuarios/excluir/api', { user: user }, function (info) {
                if (info) {
                    $('.A_usuarioMsg').html(info);
                    $('#A_usuario'+user).fadeOut('fast');
                }
            });
            return false;
        });


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

    //
    //Trabalhos
    //
        
        //Ampliar a imagem da galeria
        $('body').on('click', '.A_imagemAbrir', function () {
            var img = $(this).attr('data-img');
            $.post(BASE + '/trabalhos/galeria/abrir/api', { img: img }, function (info) {
                if (info) {
                    $('.A_galeriaModal').html(info);
                    $('.A_galeriaModal'+img).modal('show');
                }
            });
            return false;
        });

        //Excluir imagem da galeria
        $('body').on('click', '.A_excluirImagem', function () {
            var img = $(this).attr('data-img');
            $.post(BASE + '/trabalhos/galeria/excluir/api', { img: img }, function (info) {
                if (info) {
                    $('.A_galeriaMsg').html(info);
                    $('#A_imagem'+img).fadeOut('fast');

                }
            });
            return false;
        });

        //Questiona a exclusão do trabalho
            $('body').on('click', '.A_PergExcluirTrabalho', function () {
            var wk = $(this).attr('data-wk');
            $.post(BASE + '/trabalhos/excluir/verf/api', { wk: wk }, function (info) {
                if (info) {
                    $('.A_trabalhoModal').html(info);
                    $('.A_trabalhoModal'+wk).modal('show');

                }
            });
            return false;
        });

        //Questiona a exclusão do trabalho
        $('body').on('click', '.A_excluirTrabalho', function () {
            var wk = $(this).attr('data-wk');
            $.post(BASE + '/trabalhos/excluir/api', { wk: wk }, function (info) {
                if (info) {
                    $('.A_trabalhoMsg').html(info);
                    $('#A_trabalho'+wk).fadeOut('fast');

                }
            });
            return false;
        });
        
        //Função para ativação do summernote
        $('#TrabalhoDesc').summernote({
            placeholder: 'Descrição do projeto',
            tabsize: 2,
            height: 300
        });
    
    //
    //
    //
});