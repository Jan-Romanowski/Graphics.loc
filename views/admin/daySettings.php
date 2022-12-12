<?php include(ROOT . '/views/fragments/header.php'); ?>

<body>
	<div class='container-fluid mt-xs-5 mt-md-3 mx-auto px-1' style='min-height: 100vh'>
		<div class="container-fluid mt-5 pt-5 pt-sm-0 mt-sm-0 mx-auto row g-1 justify-content-center">
			<div class="container col-sm-12 col-md-11 col-lg-10 pt-3 row justify-content-around gx-0">
                <nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/view/">Grafik dla firmy</a></li>
						<li class="breadcrumb-item active" aria-current="page">Ustawienia dnia</li>
					</ol>
				</nav>


                <h3 class="text-center mb-3">
                    <?php echo ComFunc::translateDate($date); ?>
                </h3>

                <div class="col-sm-5">
                    <div class="row">
                        <h5 class="text-center mb-3">
                            Lista chętnych
                        </h5>
                    </div>
                    <div class="row">
                        <table class="table table-striped table-hover" id="first">

                            <tr class="table-dark">
                                <td>
                                    Pracownik
                                </td>
                                <td class="text-center">
									Stanowisko
                                </td>
                                <td class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Od tej godziny może zacząć pracę">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                </td>
                                <td class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Do tej godziny może pracować">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                    </svg>
                                </td>
                                <td class="text-center">
                       
                                </td>
                            </tr>

                            <?php foreach ($dayUsersList as $dayUsersItem): ?>

                                <?php 
                                    
                                    if(Graphic::isGrafikTransferred($dayUsersItem['user'], $dayUsersItem['date'])){
                                        continue;
                                    }
                                    ?>
                                

                                <tr class="line" id="<?php echo $dayUsersItem['id']; ?>" onclick="select(this);">
                                    <td class="name">
                                        <?php echo $dayUsersItem['name']." ".$dayUsersItem['surname']; ?>
                                    </td>
                                    <td class="position">
                                        <?php echo $dayUsersItem['position']; ?>
                                    </td>
                                    <td class="time_from text-center">
                                        <?php echo $dayUsersItem['time_from']; ?>
                                    </td>
                                    <td class="time_to text-center">
                                        <?php echo $dayUsersItem['time_to']; ?>
                                    </td>
                                    <td>
                                    <!-- Transfer button-->
                                    
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $dayUsersItem['id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                        </svg>
                                        </button>

                                        <!-- Modal window -->
                                        <div class="modal fade" id="exampleModal<?php echo $dayUsersItem['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form class="container" method="post" action="/admin/transferDayFromUserToFirm/<?php echo $dayUsersItem['id']; ?>">
                            
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $dayUsersItem['name']." ".$dayUsersItem['surname']." - ".$dayUsersItem['position']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                            </div>
                                            <div class="modal-body">
                                            <label for="time_from" class="form-label">Start pracy</label>
                                                <select class="form-select mb-3" name="time_from" id="time_from" aria-label="Godziny pracy (Od)">
                                                    <option hidden value="<?php echo $dayUsersItem['time_from']; ?>" selected><?php echo $dayUsersItem['time_from']; ?></option>
                                                        <?php
                                                        
                                                            $time_from = (int) substr($dayUsersItem['time_from'], 0, 2);
                                                            $time_to = (int) substr($dayUsersItem['time_to'], 0, 2);

                                                            if($time_from<$time_to){
                                                                for($i=$time_from; $i<=$time_to; $i++){
                                                                    if($i<9){
                                                                    $time = '0'.$i;
                                                                    }
                                                                    else{
                                                                        $time = $i;
                                                                    }
                                                                    echo "<option value='".$time.":00'>".$time.":00</option>";
                                                                }
                                                            }
                                
                                                        ?>
                                                </select>

                                                <label for="time_to" class="form-label">Koniec pracy</label>
                                                <select class="form-select mb-3" name="time_to" id="time_to" aria-label="Godziny pracy (Do)">
                                                    <option hidden value="<?php echo $dayUsersItem['time_to']; ?>" selected><?php echo $dayUsersItem['time_to']; ?></option>
                                                        <?php
                                                        
                                                            $time_from = (int) substr($dayUsersItem['time_from'], 0, 2);
                                                            $time_to = (int) substr($dayUsersItem['time_to'], 0, 2);

                                                            if($time_from<$time_to){
                                                                for($i=$time_from; $i<=$time_to; $i++){
                                                                    if($i<9){
                                                                    $time = '0'.$i;
                                                                    }
                                                                    else{
                                                                        $time = $i;
                                                                    }
                                                                    echo "<option value='".$time.":00'>".$time.":00</option>";
                                                                }
                                                            }
                                
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Zatwierdź</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                            </div>
                                            </form>
                                            </div>
                                            
                                        </div>
                                        </div>
                                    </td>
                                </tr>

                             <?php endforeach; ?>
                        </table>
                    </div>
                </div>


                <div class="col-sm-5">
                    <div class="row">
                        <h5 class="text-center mb-3">
                            Lista zatwierdzonych
                        </h5>
                    </div>
                    <div class="row">
                        <table class="table table-striped table-hover" id="second">

                        <tr class="table-dark">
                                <td>
                                    Pracownik
                                </td>
                                <td class="text-center">
									Stanowisko
                                </td>
                                <td class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Od tej godziny może zacząć pracę">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                </td>
                                <td class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Do tej godziny może pracować">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                    </svg>
                                </td>
                                <td class="text-center">
                       
                                </td>
                            </tr>

                            <?php foreach ($dayFirmList as $dayFirmItem): ?>

                            <tr class="line" id="<?php echo $dayFirmItem['id']; ?>" onclick="select(this);">
                                <td class="name">
                                    <?php echo $dayFirmItem['name']." ".$dayFirmItem['surname']; ?>
                                </td>
                                <td class="position text-center">
                                    <?php echo $dayFirmItem['position']; ?>
                                </td>
                                <td class="time_from text-center">
                                    <?php echo $dayFirmItem['time_from']; ?>
                                </td>
                                <td class="time_to text-center">
                                    <?php echo $dayFirmItem['time_to']; ?>
                                </td>
                                <td class="text-center">
                                    <a class = "btn btn-danger" href="/admin/deleteDayForUserFromFirmGraphic/<?php echo $dayFirmItem['user']."/".$dayFirmItem['date']; ?>">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-x" viewBox="0 0 16 16">
                                    <path d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708z"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                    </svg>

                                    </a>
                                </td>

                            <tr>

                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>

			</div>
		</div>
	</div>
    </body>
<?php include(ROOT . '/views/fragments/footer.php');
