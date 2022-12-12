<?php include(ROOT . '/views/fragments/header.php'); ?>

	<div class='container-fluid mt-xs-5 mt-md-3 mx-auto px-1' style='min-height: 100vh'>
		<div class="container-fluid mt-5 pt-5 pt-sm-0 mt-sm-0 mx-auto row justify-content-center">
			<div class="container col-sm-12 col-md-10 col-lg-8 pt-3 row">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/index/">Zarządzanie</a></li>
						<li class="breadcrumb-item active" aria-current="page">Wnioski</li>
					</ol>
				</nav>
			</div>
			<div class="container-fluid col-sm-12 col-md-10 col-lg-8 mb-3">
				<h2 class="text-center mb-3 mt-3">Wnioski o rejestrację</h2>
				<div class="container-fluid justify-content-center row">
					<?php
					if (Queries::getCountQueries() == 0) {
						?>
						<h3 class="text-center mb-3">Nie ma wniosków</h3>

						<?php
					}
					foreach ($queriesList as $queriesListItem):
						?>

						<div class="col-xl-6 col-lg-10 col-md-12 col-sm-12">
							<div class="card m-3">
								<h5 class="card-header bg-dark" style="color: white">Wniosek</h5>
								<div class="card-body bg-light">
									<h5 class="card-title"><?php echo $queriesListItem["name"] . ' ' . $queriesListItem["surname"]; ?></h5>
									<h6 class="card-text ">Email: <?php echo $queriesListItem["email"]; ?></h6>
									<h6 class="card-text ">Data: <?php echo $queriesListItem["regist_date"]; ?></h6>
									<div class="container text-center mt-4">
										<button type="button" class="btn btn-outline-success m-1" data-bs-toggle="modal"
														data-bs-target="#staticBackdrop<?php echo $queriesListItem["id"]; ?>">
											Akceptować
										</button>
										<div class="modal fade"
												 id="staticBackdrop<?php echo $queriesListItem["id"]; ?>"
												 data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
												 aria-labelledby="staticBackdropLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<form action="/queries/transferQuery/<?php echo $queriesListItem["id"]; ?>"
																method="post">
														<div class="modal-header">
															<h5 class="modal-title" id="staticBackdropLabel">Wniosek o
																rejestracje
																- <?php echo $queriesListItem["name"] . ' ' . $queriesListItem["surname"]; ?></h5>
															<button type="button" class="btn-close"
																			data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<input type="text" name="ac_type" value = "user"/>
														<div class="modal-body">
															Stanowisko
															<div class="text-center mt-3">
																<select class="form-select mb-3" name="position" aria-label=".form-select-lg example">
																	<option selected hidden value="user">Wybierz stanowisko</option>
																	<?php 
																	foreach($positionsList as $positionItem){
																		echo "<option value=".$positionItem['id'].">".$positionItem['position']."</option>";
																	}
																	?>
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-outline-success w-25">
																Udostępnić
															</button>
															<button type="button" class="btn btn-outline-secondary w-25"
																			data-bs-dismiss="modal">Confij
															</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										<!-- Button trigger modal -->
										<button type="button" class="btn btn-outline-danger m-1" data-bs-toggle="modal"
														data-bs-target="#exampleModal<?php echo $queriesListItem["id"]; ?>">
											Usunąć
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
													 fill="currentColor" class="bi bi-trash-fill"
													 viewBox="0 0 16 16">
												<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
											</svg>
										</button>
										<!-- Modal -->
										<div class="modal fade"
												 id="exampleModal<?php echo $queriesListItem["id"]; ?>" tabindex="-1"
												 aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Napewno chcesz
															usunąć ten wniosek ?</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal"
																		aria-label="Close"></button>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-outline-danger w-25"
																		onclick=document.location="/queries/deleteQuery/<?php echo $queriesListItem["id"]; ?>">
															Tak
														</button>
														<button type="button" class="btn btn-outline-success w-25"
																		data-bs-dismiss="modal">
															Nie
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
					endforeach;
					?>
				</div>
			</div>
		</div>
	</div>


<?php include(ROOT . '/views/fragments/footer.php');
