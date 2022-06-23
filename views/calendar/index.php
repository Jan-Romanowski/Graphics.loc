<?php include(ROOT . '/views/fragments/header.php'); ?>

    <style>

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
            background-color: #49a64a;
            transform: scale(1.07);
            transition: all 0.8s;
        }

        .table-item-selected{
            padding: 35px !important;
            cursor: pointer;
            background-color: #49a64a !important;
        }
        .table-item-selected:hover{
            background-color: #f08f11 !important;
            transform: scale(1.07);
            transition: all 0.8s;
        }

    </style>

	<div class='container-fluid mt-xs-5 mt-md-3 mx-auto px-1' style='min-height: 100vh'>
		<div class="container-fluid mt-5 pt-5 pt-sm-0 mt-sm-0 mx-auto row g-1 justify-content-center">
			<div class="container col-sm-12 col-md-10 col-lg-8 pt-3 row g-1">

				<table class="table table-dark border-1">

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

                        $today = getdate();

                        $month = $today['mon'];
                        $year = $today['year'];
                        $countDays = date('t');

                        $mass = array();

                        for($i=1; $i<=$countDays; $i++) {
                            $n = date("w", mktime(0,0,0, $month, $i, $year));
                            $mass[$i]['dayOfWeek'] = $n;
                            $mass[$i]['StringData'] = $i.' '.ComFunc::getMonth($month);
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


                                    if(!Graphic::isDayExist($mass[$day]['fullDate'])){
                                    ?>
                                    <td class="table-item col border-1" data-bs-toggle="modal" data-bs-target="#modal<?php echo $day; ?>">
                                        <?php echo $day; ?>
                                    </td>

                                    <!-- Модальное окно -->
                                    <div class="modal fade" id="modal<?php echo $day; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?php echo $day; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="/calendar/addUserDay/" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel<?php echo $day; ?>"><?php echo ComFunc::getDay($mass[$day]['dayOfWeek']); ?> - <?php echo $mass[$day]['StringData']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input hidden name="date" type="text" value="<?php echo $mass[$day]['fullDate']; ?>">
                                                        <p><?php echo $mass[$day]['fullDate']; ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-outline-success">Zapisz</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                  <?php } else{ ?>


                                        <td class="table-item-selected col border-1" data-bs-toggle="modal" data-bs-target="#modal<?php echo $day; ?>">
                                            <?php echo $day; ?>
                                        </td>

                                        <!-- Модальное окно -->
                                        <div class="modal fade" id="modal<?php echo $day; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?php echo $day; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="/calendar/addUserDay/" method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel<?php echo $day; ?>">Заголовок модального окна</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input hidden name="date" type="text" value="<?php echo $mass[$day]['fullDate']; ?>">
                                                            <p><?php echo $mass[$day]['StringData']; ?></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Zapisz</button>
                                                            <a href="/calendar/clear/<?php echo $mass[$day]['fullDate']; ?>/" class="btn btn-outline-danger">Wyczyść dzień</a>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>



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
