<?php include(ROOT . '/views/fragments/header.php'); ?>

	<style>
      .anim{
          cursor: pointer;
      }
      .anim:hover{
          transform: scale(1.1);
          transition: all 0.8s;
      }
	</style>

	<div class='container-fluid mt-xs-5 mt-md-3 mx-auto px-1' style='min-height: 100vh'>
		<div class="container-fluid mt-5 pt-5 pt-sm-0 mt-sm-0 mx-auto row justify-content-center">
			<div class="container-fluid col-12 col-md-10 col-lg-8 col-xl-8">
				<h1 class="text-center mb-5">Zarządzanie stroną</h1>
				<div class="row justify-content-center">

					<div class="container col-sm-12 col-md-6 col-lg-4 p-3">
						<div class="card anim shadow rounded" style="height: 8rem;" onclick=document.location="/admin/userListShow/">
							<div class="card-body text-center">
								<br>
								Użytkownicy
							</div>
						</div>
					</div>

					<div class="container col-sm-12 col-md-6 col-lg-4 p-3">
						<div class="card anim shadow rounded" style="height: 8rem;" onclick=document.location="/queries/">
							<div class="card-body text-center">
								<br>
								Wnioski
                                <span class="badge mx-1 bg-danger"><?php if (Queries::getCountQueries()) echo Queries::getCountQueries(); ?></span>
							</div>
						</div>
					</div>

					<div class="container col-sm-12 col-md-6 col-lg-4 p-3">
						<div class="card anim shadow rounded" style="height: 8rem;" onclick=document.location="/gallery/index/">
							<div class="card-body text-center">
								<br>
								Ustawienia Systemu
							</div>
						</div>
					</div>

                    <div class="container col-sm-12 col-md-6 col-lg-4 p-3">
                        <div class="card anim shadow rounded" style="height: 8rem;" onclick=document.location="/admin/view/">
                            <div class="card-body text-center">
                                <br>
                                Grafik dla firmy
                            </div>
                        </div>
                    </div>

                    <div class="container col-sm-12 col-md-6 col-lg-4 p-3">
                        <div class="card anim shadow rounded" style="height: 8rem;" onclick=document.location="//">
                            <div class="card-body text-center">
                                <br>
                                Stanowiska
                            </div>
                        </div>
                    </div>

				</div>
			</div>
		</div>
	</div>


<?php include(ROOT . '/views/fragments/footer.php');
