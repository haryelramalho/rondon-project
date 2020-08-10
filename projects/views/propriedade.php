<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Propriedade • Rondon</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
            <h1 style="margin: -7px 0 14px" class="titulos text-center">Detalhes da Propriedade</h1>
            <div class="row">
                <div class="col card card-body shadow form-group bg-dark text-white">
                    <h5>
                        Endereço: <?php echo $endereco; ?>
                    </h5>
                    <h5>
                        Complemento: <?php echo $complemento; ?>
                    </h5>
                    <h5>
                        Proprietário: <?php echo $proprietario; ?>
                    </h5>
                    <h5>
                        Email: <?php echo $email; ?>
                    </h5>
                    <h5>
                        Celular: <?php echo $celular; ?>
                    </h5>
                    <h5>
                        Diária: R$ <?php echo $diaria; ?>
                    </h5>
                    <h5>
                        Descrição: <?php echo $descricao; ?>
                    </h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button type="button" class="btn btn-dark btn-lg form-group " data-toggle="modal"
                            data-target="#modal-imagens">
                        Imagens da Propriedade
                    </button>
                </div>
            </div>
            <div id="modal-imagens" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="<?php echo $dir . DIRECTORY_SEPARATOR . $fotos[2]; ?>"
                                             class="d-block w-100 img-thumbnail" alt="<?php echo $fotos[2]; ?>">
                                    </div>
                                    <?php for ($i = 3; $i < $qtd_fotos; $i++) { ?>
                                        <div class="carousel-item">
                                            <img src="<?php echo $dir . DIRECTORY_SEPARATOR . $fotos[$i]; ?>"
                                                 class="d-block w-100 img-thumbnail" alt="<?php echo $fotos[$i]; ?>">
                                        </div>
                                    <?php 
                                } ?>
                                </div>
                                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Próximo</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <?php require_once DIR_ROOT . 'common/script.php'; ?>
        <script>
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                items: 1,
                loop: true,
                margin: 0,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true
            });
        </script>
    </body>
</html>