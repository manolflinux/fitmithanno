<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Fahkwang:wght@200&display=swap" rel="stylesheet">
</head>

<body>


    <!-- Footer -->
    <footer class="page-footer py-1 text-white">

        <!-- Footer Elements -->
        <div class="container-footer">
            <div class="row">
                <div class="col-md-4 footer-left">
                    <ul class="list-unstyled d-flex justify-content-start mb-0 mt-2">
                        <li>
                            <h6>(c) manu&orsi 2021</h6>
                        </li>
                    </ul>

                </div>


                <div class="col-md-4">
                    <ul class=" links list-unstyled d-flex justify-content-center mb-0 mt-2 ">
                        <li>

                            <?php
                            if (
                                (substr($_SERVER['REQUEST_URI'], -8) == 'home.php') ||
                                (substr($_SERVER['REQUEST_URI'], -8) == 'ndex.php') ||
                                (substr($_SERVER['REQUEST_URI'], -8) == 'team.php') ||
                                (substr($_SERVER['REQUEST_URI'], -8) == 'tact.php') ||
                                (substr($_SERVER['REQUEST_URI'], -8) == 'ssum.php')
                            ) {

                                echo " <a class='mx-3' role='button' href='impressum.php'>impressum</a> ";
                            } else {
                                echo " <a class='mx-3' role='button' href='../impressum.php'>impressum</a> ";
                            }


                            ?>

                        </li>


                    </ul>
                </div>


                <div class="col-md-4 footer-right">
                    <ul class="list-unstyled d-flex justify-content-end mb-0 mt-2">

                        <li>
                            <a class="mx-3" role="button" href="https://www.instagram.com/elf.hanno/" target="_blank" style="color:white"><i class="fa fa-instagram"></i></a>
                        </li>


                    </ul>
                </div>
            </div>

        </div>


    </footer>


</body>

</html>