<?php include(ROOT . '/views/fragments/header.php'); ?>

	<style>

      .today{
          border-style: solid;
          border-color: #f08f11;
      }

      .table-item-disabled{
          padding: 35px !important;
          cursor: not-allowed;
      }

      .table-header{
          padding-left: 35px !important;
          padding-top: 12px !important;
          padding-bottom: 12px !important;
          cursor: pointer;
      }
      .table-item{
          padding: 35px !important;
          cursor: pointer;
      }
      .table-item:hover{
          //background-color: #49a64a;
          transform: scale(1.07);
          transition: all 0.8s;
      }

      .table-item-selected{
          padding: 35px !important;
          cursor: pointer;
          background-color: #f0562b !important;
      }
      .table-item-selected:hover{
          background-color: #f0a82b !important;
          transform: scale(1.07);
          transition: all 0.8s;
      }

	  .table-item-ready{
		  padding: 35px !important;
          cursor: pointer;
          background-color: #179BFF !important;
	  }

	  .table-item-ready:hover{
		  background-color: #179BFF !important;
          transform: scale(1.07);
          transition: all 0.8s;
	  }


	</style>

	<div class='container-fluid mt-xs-5 mt-md-3 mx-auto px-1' style='min-height: 100vh'>
		<div class="container-fluid mt-5 pt-5 pt-sm-0 mt-sm-0 mx-auto row g-1 justify-content-center">
			<div class="container col-sm-12 col-md-10 col-lg-8 pt-3 row g-1">

				<?php

				$today = getdate();

				if(isset($monthX) && isset($yearX)){
					$month = $monthX;
					$year = $yearX;
				}
				else{
					$month = $today['mon'];
					$year = $today['year'];
				}

				$countDays = date('t', mktime(0, 0, 0, $month, 1, $year));;

				$title = ComFunc::getMonth($month) . " " . $year;

				$nextYear = $year;
				$previousYear = $year;

				if($month == 1){
					$previousMonth = 12;
					$nextMonth = 2;

					$previousYear = $year - 1;
					$nextYear = $year;
				}
				else{
					$previousMonth = $month - 1;
				}

				if($month == 12){
					$previousMonth = 11;
					$nextMonth = 1;

					$previousYear = $year;
					$nextYear = $year + 1;
				}
				else{
					$nextMonth = $month + 1;
				}

				?>

				<h4 class="text-center">
					<a class="mx-5"
						 style="font-size: 80%"
						 href="/admin/switchMonth/<?php echo $previousMonth; ?>/<?php echo $previousYear; ?>/"
					>
						<- Poprzedni miesiąc
					</a>
					<?php echo $title; ?>
					<a class="mx-5"
						 style="font-size: 80%"
						 href="/admin/switchMonth/<?php echo $nextMonth; ?>/<?php echo $nextYear; ?>/"
					>
						Następny miesiąc ->
					</a>
				</h4>

				<table class="table table-dark border-1 gx-0">

					<tr class="row col-12 justify-content-evenly">
						<td class="table-header col border-1">Pn</td>
						<td class="table-header col border-1">Wt</td>
						<td class="table-header col border-1">Śr</td>
						<td class="table-header col border-1">Cz</td>
						<td class="table-header col border-1">Pt</td>
						<td class="table-header col border-1">Sb</td>
						<td class="table-header col border-1">Nd</td>
					</tr>

					<?php

					$mass = array();

					for($i=1; $i<=$countDays; $i++) {
						$n = date("w", mktime(0,0,0, $month, $i, $year));
						$mass[$i]['dayOfWeek'] = $n;
						$mass[$i]['StringData'] = $i.' '.ComFunc::getMonthA($month);
						$mass[$i]['fullDate'] = date("Y-m-d", mktime(0,0,0, $month, $i, $year));
					}

					$day = 1;
					for($i = 0; $i < 6; $i++){ ?>
						<tr class="row col-12 justify-content-evenly">
							<?php for($j = 0; $j < 7; $j++){
								if($day> $countDays && $j == 0) {
									break;
								}
								if($day > $countDays){
									?>
									<td class="table-item-disabled col border-1"> - </td>
									<?php
								}
								else{
									if(($j == 0 && $mass[$day]['dayOfWeek'] == 1) ||
										($j == 1 && $mass[$day]['dayOfWeek'] == 2) ||
										($j == 2 && $mass[$day]['dayOfWeek'] == 3) ||
										($j == 3 && $mass[$day]['dayOfWeek'] == 4) ||
										($j == 4 && $mass[$day]['dayOfWeek'] == 5) ||
										($j == 5 && $mass[$day]['dayOfWeek'] == 6) ||
										($j == 6 && $mass[$day]['dayOfWeek'] == 0)) {

										$specialType = "";


										if(ComFunc::isThisToday($day, $month, $year)){
											$specialType = "today";
										}

										if(!Graphic::isDayExistForAll($mass[$day]['fullDate'])){

											?>
											<td class="table-item col border-1 <?php echo $specialType; ?>">
												<?php echo $day; ?>
											</td>

										<?php } else{ ?>

											<?php 
												
												if(Graphic::isDayReady($mass[$day]['fullDate'])){ 
													$className = "table-item-ready";
												}else{
													$className = "table-item-selected";
												}
											
												?>

											<td class="<?php echo $className; ?> col border-1 <?php echo $specialType; ?>" onclick=document.location="/admin/daySettings/<?php echo $mass[$day]['fullDate']; ?>">
                                                <?php echo $day; ?>

												<?php
												
												if(Graphic::isDayReady($mass[$day]['fullDate'])){ ?>
						
													
												<?php }else{ ?>
													<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
														<?php echo '('.Graphic::isDayExistForAll($mass[$day]['fullDate']).') Nieprzydizeleni'; ?>
														<span class="visually-hidden">Pracownicy chętni do pracyw ten dzień.</span>
                                                	</span>
												<?php }
											
												?>
                                           
                                            </td>
                                    <?php } 
										$day++;
									}
									else{
										?>
										<td class="table-item-disabled col border-1"> - </td>
										<?php
									}
									?>
								<?php }
							}
							?>
						</tr> <?php
					}
					?>
					<form action="">

					</form>

				</table>

			</div>
		</div>
	</div>





<?php include(ROOT . '/views/fragments/footer.php');
