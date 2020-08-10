<!DOCTYPE html>
<html>
    <head>
        <?php require_once DIR_ROOT . 'common/head.php'; ?>
        <title>Inscritos no IV Congresso</title>
    </head>
    <body>
        <?php require_once DIR_ROOT . 'common/header.php'; ?>
        <main class="container">
			<h1 style="margin: -7px 0 14px" class="titulos text-center form-group">Inscritos</h1>
			<!-- TESTE -->
			<div class="container">
				<div class="row">
					<div class="col card card-body shadow border-dark">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a href="#geral" class="nav-link active" data-toggle="tab" role="tab" aria-selected="true">
									Inscrição Geral
								</a>
							</li>
							<li class="nav-item">
								<a href="#evento" class="nav-link" data-toggle="tab" role="tab" aria-selected="false">
									Inscrição Evento
								</a>
							</li>
						</ul>
						<div class="tab-content" style="padding-top: 2vh">
							<div class="tab-pane fade show active" id="geral" role="tabpanel">
								<table class="text-center table table-responsive-md table-bordered dataTable">
									<thead class="thead-dark">
										<tr>
											<th class="align-middle">Nome</th>
											<th class="align-middle">E-mail</th>
											<th class="align-middle">Celular</th>
											<th class="align-middle">Evento</th>
											<th class="align-middle">Status</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($usuarios as $usuario) { ?>
											<tr>	
												<td>
													<?php echo $usuario->get_nome(); ?>
												</td>
												<td>
													<?php echo $usuario->get_email(); ?>
												</td>
												<td>
													<?php echo $usuario->get_celular(); ?>
												</td>
												<td>
													<?php /*foreach($users_eve as $user_eve){
														if($user_eve->get_usr_id() == $usuario->get_usr_id()){
															echo $user_eve->get_eve_status(True);
														}
													}*/
														for($i = 0; $i < $qtd_users_eve; $i++){
															if($users_eve[$i]->get_usr_id() == $usuario->get_usr_id()){
																echo $users_eve[$i]->get_eve_status(true);
																break;
															} 
														}
														if($i == $qtd_users_eve){
															echo "Não inscrito";
														}
													?>
												</td>
												<td>
													<?php echo $usuario->get_usr_status(true); ?>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade show" id="evento" role="tabpanel">
								<table class="text-center table table-responsive-md table-bordered dataTable">
									<thead class="thead-dark">
										<tr>
											<th class="align-middle">Nome</th>
											<th class="align-middle">E-mail</th>
											<th class="align-middle">Celular</th>
											<th class="align-middle">Categoria</th>
											<th class="align-middle">Alojamento</th>
											<th class="align-middle">Status (PAG)</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($users_eve as $user_eve) { 
											foreach($usuarios as $usuario){
												if($usuario->get_usr_id() == $user_eve->get_usr_id()){
													$email = $usuario->get_email();
													$celular = $usuario->get_celular();
												}
											} ?>
											<tr>	
												<td>
													<?php echo $user_eve->get_nome_social(); ?>
												</td>
												<td>
													<?php echo $email; ?>
												</td>
												<td>
													<?php echo $celular; ?>
												</td>
												<td>
													<?php echo $user_eve->get_categoria(true); ?>
												</td>
												<td>
													<?php echo $user_eve->get_alojamento(true); ?>
												</td>
												<td>
													<?php echo $user_eve->get_eve_status(true); ?>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<?php require_once DIR_ROOT . 'common/script.php'; ?>
	</body>
</html>