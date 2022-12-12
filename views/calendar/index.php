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

    <script type="text/javascript">

        var selectedTimeTo = false;
        var selectedTimeFrom = false;

        $('#time_from').click(function() {
            $('#time_to').find('option').remove(); //удаление старых данных
        });


        // function test(Obj) {
        //     // var typ=(Obj.options[Obj.selectedIndex].innerHTML=='Деньги');
        //
        //     var os=Obj.parentNode.getElementsByTagName('select');
        //     var i;
        //     for (i=0; i<os.length; i++) {
        //         if (os[i]!=Obj) {
        //             os[i].disabled=typ;
        //         }
        //     };
        // };


    </script>

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
                       href="/calendar/switchMonth/<?php echo $previousMonth; ?>/<?php echo $previousYear; ?>/"
                    >
                        <- Poprzedni miesiąc
                    </a>
                  <?php echo $title; ?>
                    <a class="mx-5"
                       style="font-size: 80%"
                       href="/calendar/switchMonth/<?php echo $nextMonth; ?>/<?php echo $nextYear; ?>/"
                    >
                        Następny miesiąc ->
                    </a>
                </h4>

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

                                    if(!Graphic::isDayExistForUser($mass[$day]['fullDate'])){


                                        ?>
                                    <td class="table-item col border-1 <?php echo $specialType; ?>" data-bs-toggle="modal" data-bs-target="#modal<?php echo $day; ?>">
                                        <?php echo $day; ?>
                                    </td>

                                    <!-- Модальное окно -->
                                    <div class="modal fade" id="modal<?php echo $day; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?php echo $day; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="/calendar/addUserDay/<?php echo $month; ?>/<?php echo $year; ?>/" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel<?php echo $day; ?>"><?php echo ComFunc::getDay($mass[$day]['dayOfWeek']); ?> - <?php echo $mass[$day]['StringData']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                    <label for="time_from" class="form-label">Start pracy</label>
                                                        <select class="form-select mb-3" name="time_from" id="time_from" aria-label="Godziny pracy (Od)" onclick="changeTimeFrom()">
                                                            <option value="08:00" selected>Godziny pracy (Od)</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="13:00">13:00</option>
                                                            <option value="14:00">14:00</option>
                                                            <option value="15:00">15:00</option>
                                                            <option value="16:00">16:00</option>
                                                            <option value="17:00">17:00</option>
                                                            <option value="18:00">18:00</option>
                                                            <option value="19:00">19:00</option>
                                                            <option value="20:00">20:00</option>
                                                            <option value="21:00">21:00</option>
                                                        </select>

                                                        <label for="time_to" class="form-label">Koniec pracy</label>
                                                        <select class="form-select mb-3" name="time_to" id="time_to" aria-label="Godziny pracy (Do)">
                                                            <option value="21:00" selected>Godziny pracy (Do)</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="13:00">13:00</option>
                                                            <option value="14:00">14:00</option>
                                                            <option value="15:00">15:00</option>
                                                            <option value="16:00">16:00</option>
                                                            <option value="17:00">17:00</option>
                                                            <option value="18:00">18:00</option>
                                                            <option value="19:00">19:00</option>
                                                            <option value="20:00">20:00</option>
                                                            <option value="21:00">21:00</option>
                                                        </select>


                                                        <input hidden name="date" type="text" value="<?php echo $mass[$day]['fullDate']; ?>">
<!--                                                        <p>--><?php //echo $mass[$day]['fullDate']; ?><!--</p>-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-outline-success">Zapisz</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                  <?php } else{

                                        $dayInfo = array();
                                        $dayInfo = Graphic::getDayForUserByDate($mass[$day]['fullDate']);

                                        ?>

                                    <td class="table-item-selected col border-1 <?php echo $specialType; ?>" data-bs-toggle="modal" data-bs-target="#modal<?php echo $day; ?>">
                                        <?php echo $day; ?>
                                    </td>

                                    <!-- Модальное окно -->
                                    <div class="modal fade" id="modal<?php echo $day; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?php echo $day; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel<?php echo $day; ?>"><?php echo ComFunc::getDay($mass[$day]['dayOfWeek']); ?> - <?php echo $mass[$day]['StringData']; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input hidden name="date" type="text" value="<?php echo $mass[$day]['fullDate']; ?>">

                                                    <select class="form-select mb-3" disabled name="time_from" aria-label="Godziny pracy (Od)">
                                                        <option value="08:00:00" selected><?php echo $dayInfo[0]['time_from']; ?></option>
                                                    </select>

                                                    <select class="form-select mb-3" disabled name="time_to" aria-label="Godziny pracy (Do)">
                                                        <option value="21:00:00" selected><?php echo $dayInfo[1]['time_to']; ?></option>
                                                    </select>

                                                    <!--  <p>--><?php //echo $mass[$day]['StringData']; ?><!--</p>-->
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="/calendar/clear/<?php echo $mass[$day]['fullDate']; ?>/<?php echo $month; ?>/<?php echo $year; ?>/" class="btn btn-outline-danger">Wyczyść dzień</a>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                                </div>
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
