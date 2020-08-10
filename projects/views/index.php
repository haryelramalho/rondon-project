<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>IV • Congresso Rondon 2019</title>
    </head>
    <body>

        <?php
        $home = true;
        require_once DIR_ROOT . 'common/header.php';
        ?>

        <img src="assets/images/congresso-rondon-banner.png" width="100%"
             style="margin-top: -3vh;" alt="Logo Rondon" id="home">

        <div class="container">

            <!----------------------- Seção Notícias ---------------------------->
            <h1 class="text-center titulos">Notícias</h1>
            <div class="row justify-content-center">
                <div class="col-md-6 slider-cr">
                    <br/>
                    <div id="carouselNoticia" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselNoticia" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselNoticia" data-slide-to="1"></li>
                            <li data-target="#carouselNoticia" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a href="noticias.php" target="_blank">
                                    <img class="d-block w-100" src="assets/images/noticias.png" alt="Banner de noticias congresso rondon">
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="noticias.php#submissao2" target="_blank">
                                    <img class="d-block w-100" src="assets/images/subm2.png" alt="Banner submissões 2">
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="noticias.php#conc_foto" target="_blank">
                                    <img class="d-block w-100" src="assets/images/conc_foto.png" alt="Banner concurso de fotografia">
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="noticias.php#submissao" target="_blank">
                                    <img class="d-block w-100" src="assets/images/subm.png" alt="Banner submissões">
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="noticias.php#hospedagem" target="_blank">
                                    <img class="d-block w-100" src="assets/images/hospedagem-banner.png" alt="Banner Hospedagem">
                                </a>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselNoticia" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselNoticia" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </div>
                </div>
            </div>
            <!------------------------------------------------------------------->

            <!----------------------- Seção o evento ---------------------------->
            <h1 class="text-center titulos">O evento</h1>
            <div class="row justify-content-center" style="margin-top: 3vh;">
                <div class="col-10">
                    <p class="lead">
                        O IV Congresso Nacional do Projeto Rondon acontece de 25 a 28 de setembro de 2019, em Ilhéus/BA,  e visa congregar, além de professores e alunos rondonistas, todos os interessados em conhecer e partilhar as ações do Projeto Rondon e de outras ações de extensão universitária que tenham afinidade com seus temas e metodologia.
                        O tema desse ano, “Cidadania e Sustentabilidade”, se refere aos objetivos gerais do Projeto Rondon, que são: a) contribuir para o desenvolvimento e o fortalecimento da cidadania do estudante universitário; e b) contribuir  com  o  desenvolvimento  sustentável,  o  bem-estar  social  e  a  qualidade  de  vida  nas comunidades carentes, usando as habilidades universitárias.
                        Esse tema também se identifica com a vocação da UESC, universidade anfitriã do evento, privilegiadamente localizada no coração da Mata Atlântica, num dos conjuntos de maior beleza natural do país. Além das palestras e rodas de conversa, haverá comunicações científicas e premiações (artigos, causos e fotografias). 
                        A UESC está situada na Rodovia Jorge Amado, a 16 km do centro de Ilhéus. Sua história umbilicalmente ligada à sorte da lavoura cacaueira, responsável, em grande parte, pela sua preservação. De uma perspectiva física, a UESC situa-se num dos conjuntos naturais de maior beleza do país. E, de uma perspectiva histórica, em sua área de atuação deu-se o descobrimento do país pelos portugueses. A UESC se localiza numa área privilegiada historicamente, na biosfera do Descobrimento - o berço do Brasil. Ilhéus e Itabuna, municípios dessa grande região cacaueira, têm uma história de lutas em seus primórdios, profundamente marcadas pela implantação da cultura do cacau, o “fruto de ouro”.<br><br>

                        Então, o que está esperando? Venha compartilhar suas experiências com a gente!
                    </p>
                </div>
            </div>
            <!------------------------------------------------------------------->

            <!---------------------- Seção Conheça o Projeto Rondon --------------------------->
            <h1 class="text-center titulos">Conheça o Projeto Rondon</h1>
            <div class="row justify-content-center">
                <div class="col-11">
                    <div class="row">
                        <div style="margin-top: 3vh;" class="col-md-5">
                            <iframe class="video col-12" src="https://www.youtube.com/embed/F7zlxJZArNo" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div style="margin-top: 3vh;" class="col-md-7">
                            <h3 class="text-center">O que é o Projeto Rondon?</h3>
                            <br/>
                            <p>
                                O Projeto Rondon é uma ação interministerial do Governo Federal realizada em coordenação com os Governos Estadual e Municipal que, em parceria com as Instituições de Ensino Superior, reconhecidas pelo Ministério da Educação, visa a somar esforços com as lideranças comunitárias e com a população, a fim de contribuir com o desenvolvimento local sustentável e na construção e promoção da cidadania. O Projeto é coordenado pelo Ministério da Defesa, e conduzido em estreita parceria com outros ministérios e também a Secretaria de Governo da Presidência da República.
                            </p>
                            <button type="button" class="btn btn-outline-dark" id="exib_m" data-toggle="collapse" data-target="#exib" aria-expanded="false" aria-controls="exib">Exibir mais</button>
                        </div>
                    </div>
                    <div class="row collapse" id="exib">
                        <div class="col-md-12">
                            <p class="secnd-texto-collapse">
                                O Projeto Rondon prioriza, desenvolver ações que tragam benefícios permanentes para as comunidades, principalmente as relacionadas com, a melhoria do bem estar social e a capacitação da gestão pública. Busca, ainda, consolidar no universitário brasileiro o sentido de responsabilidade social, coletiva, em prol da cidadania, do desenvolvimento e da defesa dos interesses nacionais, contribuindo na sua formação acadêmica e proporcionando-lhe o conhecimento da realidade brasileira. Suas regiões prioritárias de atuação são aquelas que apresentam baixo Índice de Desenvolvimento Humano (IDH) e exclusão social, bem como áreas isoladas do território nacional que necessitem de maior aporte de bens e serviços. Por essa razão, a Diretriz Estratégica do Projeto Rondon prioriza as regiões norte e nordeste do país.
                                <br>Conheça mais sobre o Projeto Rondon clicando <a href="https://projetorondon.defesa.gov.br/" target="_blank">AQUI.</a>
                            </p>
                        </div>
                    </div>
                    <div style="margin-top: 3vh;" class="row">
                        <div class="col-md-6">
                            <h3 class="text-center"></h3>
                            <div class="row">
                                <h5><b>Objetivos Gerais</b></h5>
                                <ul>
                                    <li>Contribuir  com  o  desenvolvimento  sustentável,  o  bem-estar  social  e  a  qualidade  de  vida  nas comunidades carentes, usando as habilidades universitárias.</li>
                                    <li>Contribuir para o desenvolvimento e o fortalecimento da cidadania do estudante universitário.</li>
                                </ul>
                            </div>
                            <div class="row">
                                <h5><b>Objetivos específicos</b></h5>
                                <ul>
                                    <li>Proporcionar ao estudante universitário conhecimento de aspectos peculiares da realidade brasileira.</li>
                                    <li>Contribuir  com  o  fortalecimento  das  políticas  públicas,  atendendo  às  necessidades  específicas  das comunidades selecionadas.</li>
                                    <li>Desenvolver  no  estudante  universitário  sentimentos  de  responsabilidade  social,  espírito  crítico  e patriotismo.</li>
                                    <li>Contribuir  para  o  intercâmbio  de  conhecimentos  entre  as  instituições  de  ensino  superior,  governos locais e lideranças comunitárias.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 slider-cr">
                            <!--<h3 class="text-center im">Imagens</h3>-->
                            <br/>
                            <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselIndicators" data-slide-to="2"></li>
                                    <li data-target="#carouselIndicators" data-slide-to="3"></li>
                                    <li data-target="#carouselIndicators" data-slide-to="4"></li>
                                    <li data-target="#carouselIndicators" data-slide-to="5"></li>
                                    <li data-target="#carouselIndicators" data-slide-to="6"></li>
                                    <li data-target="#carouselIndicators" data-slide-to="7"></li>
                                </ol>

                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="assets/images/slider/foto1.png" alt="Imagens de congressos e missoes anteriores 1">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="assets/images/slider/foto2.png" alt="Imagens de congressos e missoes anteriores 2">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="assets/images/slider/foto3.png" alt="Imagens de congressos e missoes anteriores 3">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="assets/images/slider/foto4.png" alt="Imagens de congressos e missoes anteriores 4">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="assets/images/slider/foto5.png" alt="Imagens de congressos e missoes anteriores 5">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="assets/images/slider/foto6.png" alt="Imagens de congressos e missoes anteriores 6">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="assets/images/slider/foto7.png" alt="Imagens de congressos e missoes anteriores 7">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="assets/images/slider/foto8.png" alt="Imagens de congressos e missoes anteriores 8">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Próximo</span>
                                </a>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
            <!------------------------------------------------------------------------->

            <!----------------------- Seção Programação ----------------------- 
            <h1 class="text-center titulos" id="prog">Programação</h1>
            <div class="row justify-content-center" style="margin-top: 3vh;">
                <div class="col-auto">
                    <a href="assets/arquivos/RondonProgramacao.pdf" target="_blank"
                       class="btn btn-outline-dark">
                        Clique aqui para ver a Programação.
                    </a>
                </div>
            </div>-->
            <!-------------------------------------------------------------------->

            <!------------------------- Seção Inscrição ------------------------------>
            <h1 id="inscricoes" class="text-center titulos">Inscrições</h1>
            <div style="margin-top: 3vh;" class="row justify-content-center">
                <div class="col-10">
                    <div class="row">
                        <div class="col">
                            <p class="lead">
                                As inscrições iniciam no dia 01/03 e serão
                                efetivadas mediante confirmação de pagamento.
                                A taxa varia conforme categoria e data da 
                                solicitação. Confira a tabela:
                            </p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <table class="table table-bordered table-responsive-sm table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Valores</th>
                                        <!--<th>De 01/03 a 31/08/2019</th>
                                        <th>De 31/08 a 25/09/2019</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Professor</th>
                                        <td>R$ 150,00</td>
                                        <!--<td>R$ 200,00</td>-->
                                    </tr>
                                    <tr>
                                        <th>Aluno da graduação</th>
                                        <td>R$ 30,00</td>
                                        <!--<td>R$ 50,00</td>-->
                                    </tr>
                                    <tr>
                                        <th>Aluno da pós-graduação</th>
                                        <td>R$ 100,00</td>
                                        <!--<td>R$ 150,00</td>-->
                                    </tr>
                                    <tr>
                                        <th>Outros</th>
                                        <td>R$ 150,00</td>
                                        <!--<td>R$ 200,00</td>-->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p class="lead">
                        Há também taxas opcionais referentes a participação
                        no jantar e na festa de encerramento. Em breve os
                        preços serão definidos.
                    </p>
                    <p style="margin-top: 3vh; text-align: justify;" class="lead">
                        Também deve-se ficar atento quanto às seguintes regras:
                    </p>
                    <div class="row justify-content-center">
                        <div class="btn-group form-group">
                            <button class="btn btn-dark" type="button" data-regra='1'
                                    data-toggle='modal' data-target='#modal-regras'>
                                Desistências
                            </button>
                            <button class="btn btn-dark" type="button" data-regra='2'
                                    data-toggle='modal' data-target='#modal-regras'>
                                Substituições
                            </button>
                            <button class="btn btn-dark" type="button" data-regra='3'
                                    data-toggle='modal' data-target='#modal-regras'>
                                Grupos
                            </button>
                        </div>
                    </div>
                    <p class="lead">
                        A página de inscrição estará disponível no painel
                        de usuário. Para se tornar um usuário
                        <a href="inscricao.php">clique aqui</a>. Além
                        informar alguns dados pessoais, você definirá uma
                        senha de acesso a ser utilizada no
                        <a href="login.php">login</a>.
                    </p>
                </div>
            </div>
            <!------------------------------------------------------------------------>

            <!------------------------- Seção Hospedagem ------------------------------>
            <h1 id="hospedagem" class="text-center titulos">Hospedagem</h1>
            <div class="row justify-content-center" style="margin-top: 3vh;">
                <div class="col-10">
                    <p class="lead">
                        O site permitirá o cadastro de imóveis passíveis de locação para
                        aqueles que desejam participar do evento e moram em cidades
                        distantes de Ilhéus. As etapas são mostradas a seguir:
                    </p>
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="list-group" role="tablist">
                                <a class="list-group-item list-group-item-action
                                   list-group-item-dark active"
                                   data-toggle="list" href="#etapa-1" role="tab">
                                    <div class="text-center lead">
                                        <strong>1ª etapa</strong>
                                    </div>
                                </a>
                                <a class="list-group-item list-group-item-action
                                   list-group-item-dark" data-toggle="list"
                                   href="#etapa-2" role="tab">
                                    <div class="text-center lead">
                                        <strong>2ª etapa</strong>

                                    </div>
                                </a>
                                <a class="list-group-item list-group-item-action
                                   list-group-item-dark" data-toggle="list"
                                   href="#etapa-3" role="tab">
                                    <div class="text-center lead">
                                        <strong>3ª etapa</strong>

                                    </div>
                                </a>
                                <a class="list-group-item list-group-item-action
                                   list-group-item-dark" data-toggle="list"
                                   href="#etapa-4" role="tab">
                                    <div class="text-center lead">
                                        <strong>4ª etapa</strong>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="tab-content">
                                <div class="tab-pane fade show active"
                                     id="etapa-1" role="tabpanel" aria-labelledby="etapa-1">
                                    <p class="lead" style="margin-top: 9vh;">
                                        O proprietário ou responsável pelo
                                        imóvel fornecerá informações de contato,
                                        endereço, fotos e o preço inicial;
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="etapa-2" role="tabpanel">
                                    <p class="lead" style="margin-top: 12vh;">
                                        A comissão organizadora avaliará a
                                        proposta e decidirá por sua aprovação;
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="etapa-3" role="tabpanel">
                                    <p class="lead" style="margin-top: 8vh;">
                                        Quando aprovada, a proposta ficará disponível
                                        como mais uma opção de locação para as pessoas
                                        que se inscreveram no evento;
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="etapa-4" role="tabpanel">
                                    <p class="lead" style="margin-top: 12vh;">
                                        A pessoa interessada entra em contato e inicia
                                        uma negociação.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="lead" style="margin-top: 3vh;">
                        O site não intermediará a negociação, pois ambas
                        as partes interessadas tratarão disso diretamente. Portanto, um eventual
                        pagamento não será realizado através deste site!
                    </p>
                    <p class="lead">
                        A página de cadastro de propostas de locação está
                        disponível no painel de usuário. Para se tornar um usuário
                        <a href="inscricao.php">clique aqui</a>. Além
                        informar alguns dados pessoais, você definirá uma
                        senha de acesso a ser utilizada no
                        <a href="login.php">login</a>.
                    </p>
                    <p class="lead">
                        No painel de usuário também é possível cadastrar
                        novas propostas, cancelà-las, informar quais imóveis
                        já foram alugados, bem como verificar o resultado
                        da avaliação das propostas submetidas.
                    </p>
                </div>
            </div>
            <!------------------------------------------------------------------------->

            <!---------------------- Seção Localização --------------------------->
            <h1 class="text-center titulos">Localização</h1>
            <div class="row justify-content-center" style="margin-top: 3vh;">
                <iframe class="col-10" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3857.484892013533!2d-39.17441068578763!3d-14.798019689676973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x739a818ecf672d9%3A0xa2fa69b5171b4521!2sUniversidade+Estadual+de+Santa+Cruz!5e0!3m2!1spt-BR!2sus!4v1545147549272"
                        width="100%" height="450" frameborder="0" style="border:0" allowfullscreen>
                </iframe>
            </div>
            <!-------------------------------------------------------------------->

            <!----------------------- Seção Apoio/Promoção ------------------------------>
            <div class="row">
                <div class="col-md-6">
                    <h1 class="text-center titulos" id="apoio">
                        Apoio
                    </h1>
                    <div class="text-center">
                        <img src="assets/images/logo_uesc_brasao.png" width="220" height="310" class="rounded" alt="Brasão UESC">
                    </div>   
                </div>
                <div class="col-md-6">
                    <h1 class="text-center titulos" id="promocao">
                        Realização
                    </h1>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="owl-carousel owl-theme">
                                <div class="">
                                    <img src="assets/images/logo-patria-amada-brasil_vertical_cores.svg" width="150" height="260" class="rounded" alt="Governo Federal">
                                </div>
                                <div class="">
                                    <img src="assets/images/logo_ministerio_da_defesa_md.svg" width="200" height="300" class="rounded img-responsive" alt="Ministério da Defesa">
                                </div>
                                <div class="">
                                    <img src="assets/images/logo-congresso-rondon.svg" width="100" height="260" class="rounded" alt="Projeto Rondon">                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-------------------------------------------------------------------->

            <!----------------------- Seção Contato ------------------------------>
            <div class="row">
                <div class="col-md-6">
                    <h1 class="text-center titulos" id="contato">
                        Contato
                    </h1>
                    <div class="container">
                        <form method="post" class="col-12 form" novalidate>
                            <div class="form-group">
                                <input 
                                    type="text" class="form-control" 
                                    name="nome" placeholder="Nome" required
                                    pattern="([a-zA-Z]|[ ]|ã|â|á|é|ê|ó|ô|í|Á|Ô|É|Ó|Í|ç){5,255}">
                                <div class="invalid-feedback">
                                    Informe um nome válido!
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="exemplo@exemplo.com" required
                                       pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$">
                                <div class="invalid-feedback">
                                    Informe um e-mail válido!
                                </div>
                            </div>   
                            <div class="form-group"> 
                                <select class="custom-select" name="assunto">
                                    <option>Dúvidas</option>
                                    <option>Reclamações</option>
                                    <option>Problemas Técnicos</option>
                                </select>
                            </div>
                            <div class="form-group">   
                                <textarea class="form-control" name="mensagem" rows="3" placeholder="Mensagem..."
                                          required minlength="5" maxlength="550"></textarea>
                                <div class="invalid-feedback">
                                    Informe a mensagem!
                                </div>
                            </div>
                            <div class="row justify-content-center justify-content-md-end">
                                <div class="col-auto">
                                    <button name="submit" type="submit" id="submit" value="0" class="btn btn-outline-dark">
                                        <i class="fas fa-location-arrow"></i>
                                        Enviar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>   
                </div>
                <div class="col-md-6">
                    <h1 class="text-center titulos" id="patrocinadores">
                        Patrocinadores
                    </h1>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="owl-carousel owl-theme">
                                <div class="">
                                    <img src="assets/images/logo-meira.jpeg" width="100" height="260" class="rounded" alt="Meira Supermercados">                            
                                </div>
                                <div class="">
                                    <img src="assets/images/avatim-logo.png" width="100" height="260" class="rounded" alt="Meira Supermercados">                            
                                </div>
                                <div class="">
                                    <img src="assets/images/logo-gas.jpg" width="100" height="260" class="rounded" alt="Meira Supermercados">                            
                                </div>
                                <div class="">
                                    <img src="assets/images/logo-mar-aberto.jpeg" width="100" height="260" class="rounded" alt="Meira Supermercados">                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                    </div>
                </div>
            </div>
            <!-------------------------------------------------------------------->

        </div>

        <div class="modal fade" id="modal-regras" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION["email_enviado"])) { ?>

            <div class="modal fade" id="modal-email-contato" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="alert alert-<?php echo ($_SESSION["email_enviado"]) ? 'success' : 'danger'; ?>"
                                 role="alert">
                                <h4 class="alert-heading">
                                    <?php
                                    echo ($_SESSION["email_enviado"]) ?
                                            'Mensagem enviada com suceso!' :
                                            'Mensagem não enviada!';
                                    ?>
                                </h4>
                                <hr/>
                                <p class="lead">
                                    <?php
                                    echo ($_SESSION["email_enviado"]) ?
                                            'Em breve entraremos em contato.' :
                                            'OPS! Tente novamente.';
                                    ?>
                                </p>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-auto">
                                    <button type="button" class="btn btn-outline-<?php echo ($_SESSION["email_enviado"]) ? 'success' : 'danger'; ?>"
                                            data-dismiss="modal">
                                        <i class="fas fa-times"> Ok</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>

        <div class="collapse" id="regra-1">
            <p class="lead">
                Até uma semana antes do evento,
                há a possibilidade de o usuário
                inscrito registrar uma eventual desistência
                de participação. Nesse caso, a
                pessoa informará os dados de sua conta
                bancária para que receba uma restituição
                de 50% do valor pago.
            </p>
        </div>
        <div class="collapse" id="regra-2">
            <p class="lead">
                Durante o período de inscrição
                podem ocorrer substituições
                entre pessoas de mesma categoria.
                Caso uma pessoa efetive sua inscrição
                no evento dentro do primeiro prazo
                definido na tabela de preços e, por qualquer
                motivo, decida ser substituído dentro do
                segundo prazo, aquele que entrar no lugar
                pagará uma taxa adicional correpondente a 
                diferença de preços.
            </p>
        </div>
        <div class="collapse" id="regra-3">
            <p class="lead">
                Há a possibilidade de formação de grupos para
                inscrição no evento com o intuito de
                receberem descontos no preço total.
                Os grupos podem ser mistos (constituídos por pessoas
                de categorias diferentes) e formados por, no mínimo, 10
                integrantes. Um participante do grupo será o responsável
                pelo pagamento total correspondente a soma dos preços
                individuais, descontados 10%.
            </p>
        </div>

        <?php
        require_once DIR_ROOT . 'common/modal-erro-validacao.php';
        require_once DIR_ROOT . 'common/footer.php';
        require_once DIR_ROOT . 'common/script.php';
        ?>

        <?php if (isset($_SESSION["email_enviado"])) { ?>
            <script>
                $(document).ready(function () {
                    $("#modal-email-contato").modal();
                });
            </script>
            <?php
            unset($_SESSION["email_enviado"]);
        }
        ?>

        <script type="text/javascript">
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top - 80}, 1000);
            });
            $('#modal-regras').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var regra = button.data('regra'); // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                modal.find('.modal-title').text(button.html());
                modal.find('.modal-body').html($("#regra-" + regra).html());
            });
            (function () {
                'use strict';
                window.addEventListener('load', function () {
                    // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
                    var forms = document.getElementsByClassName('form');
                    // Faz um loop neles e evita o envio
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener('submit', function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                                $("#modal-erro").modal({
                                    backdrop: 'static'
                                });
                            } else {
                                $("#submit").attr('disabled', 'true');
                                $("#submit").html("Aguarde ...");
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
            $('.owl-carousel').owlCarousel({
                items: 1,
                loop: true,
                margin: 0,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true
            });

            $('#quartabt').click(function () {
                if (!$('#quarta').hasClass('show'))
                {
                    $('#quinta').removeClass('show');
                    $('#sexta').removeClass('show');
                }
            });

            $('#quintabt').click(function () {
                if (!$('#quinta').hasClass('show'))
                {
                    $('#quarta').removeClass('show');
                    $('#sexta').removeClass('show');
                }
            });

            $('#sextabt').click(function () {
                if (!$('#sexta').hasClass('show'))
                {
                    $('#quarta').removeClass('show');
                    $('#quinta').removeClass('show');
                }
            });

        </script>
    </body>
</html>
