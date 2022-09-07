<?php include(ROOT . '/views/fragments/header.php'); ?>


    <style>

        .selected{
            padding: 10px;
            background-color: #a48bf8;
        }

        td{
            padding: 8px;
        }

        .line{
            cursor: pointer;
        }

    </style>

    <script>

    function select(line){

        let elements = document.getElementsByClassName("line");

        for (let i=0; i<elements.length; i++){
            elements[i].classList.remove("selected");
            elements[i].id = '';
        }

        line.id = "selected";
        line.classList.add("selected");
    }

    function leftToRight(){

        let element = document.getElementById("selected").cloneNode(true);
        let destination = document.getElementById("second");

        destination.appendChild(element);

        document.getElementById("selected").remove();

    }

    function rightToLeft(){

        let element = document.getElementById("selected").cloneNode(true);
        let destination = document.getElementById("first");
        let source = document.getElementById("second");

        element.id = 'new';
        destination.appendChild(element);

        document.getElementById("selected").remove();

    }





    </script>

	<div class='container-fluid mt-xs-5 mt-md-3 mx-auto px-1' style='min-height: 100vh'>
		<div class="container-fluid mt-5 pt-5 pt-sm-0 mt-sm-0 mx-auto row g-1 justify-content-center">
			<div class="container col-sm-12 col-md-11 col-lg-10 pt-3 row justify-content-around gx-0">

                <h3 class="text-center mb-3">
                    <?php echo $date; ?>
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
									Imię
                                </td>
                                <td>
									Nazwisko
                                </td>
                                <td>
									Stanowisko
                                </td>
                                <td>
									Godziny pracy (Od)
                                </td>
                                <td>
                                    Godziny pracy (Do)
                                </td>
                            </tr>

                            <?php foreach ($dayList as $dayItem): ?>

                                <tr class="line" id="<?php echo $dayItem['id']; ?>" onclick="select(this);">
                                    <td class="name">
                                        <?php echo $dayItem['name']; ?>
                                    </td>
                                    <td class="surname">
                                        <?php echo $dayItem['surname']; ?>
                                    </td>
                                    <td class="position">
                                        <?php echo $dayItem['position']; ?>
                                    </td>
                                    <td class="time_from">
                                        <?php echo $dayItem['time_from']; ?>
                                    </td>
                                    <td class="time_to">
                                        <?php echo $dayItem['time_to']; ?>
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

                            <tr class="table-dark line">
                                <td class="name">
                                    Imię
                                </td>
                                <td class="surname">
                                    Nazwisko
                                </td>
                                <td class="position">
                                    Stanowisko
                                </td>
                                <td class="time_from">
                                    Godziny pracy (Od)
                                </td>
                                <td class="time_to">
                                    Godziny pracy (Do)
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>

                <div class="col-sm-12 text-center mt-5">
                    <button
                            type="button"
                            class="btn btn-outline-dark"
                            onclick="rightToLeft();"
                    >
                        <-
                    </button>
                    <button
                            type="button"
                            class="btn btn-outline-dark"
                            onclick="leftToRight();"
                    >
                        ->
                    </button>
                </div>





                <div class="col-sm-5">
                    <ul class="list-group">
                        <?php foreach ($dayList as $dayItem): ?>
                            <li class="list-group-item"><?php echo $dayItem['name'].' '.$dayItem['surname'].' | '.$dayItem['position']. ' | ' .$dayItem['time_from']. ' - ' .$dayItem['time_to']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-sm-5">
                    <ul class="list-group">
                        <li class="list-group-item">Активный элемент</li>
                        <li class="list-group-item">Второй элемент</li>
                        <li class="list-group-item">Третий элемент</li>
                        <li class="list-group-item">Четвертый элемент</li>
                        <li class="list-group-item">И пятый</li>
                    </ul>
                </div>




			</div>
		</div>
	</div>

<?php include(ROOT . '/views/fragments/footer.php');
