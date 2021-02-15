<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Contact us!</title>
    <link href="https://fonts.googleapis.com/css2?family=Fahkwang:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
</head>

<body>


    <div class="container-contact z-depth-1">

        <div class="contact-left row ml-2 mt-4">

            <div>

                <h3 class="font-weight-bold">Redet Tacheles mit uns!</h3>

                <p class="text-muted">Huhu, jetzt seid ihr dran! <br> Wie gefällt euch unsere Seite? <br> Was brennt euch unter den Nägeln? <br><br>Was auch immer: lasst es uns wissen! </p>

                <p><span class="font-weight-bold mr-2">Email:</span><a href="">feedback@fitmithanno.fun</a></p>

            </div>

            <form action="createMessage.php" method="POST">

                <div>




                    <div class="row">


                        <div class="col-md-6">


                            <div class="md-form md-outline mb-0">
                                <input type="text" name="vorname" class="form-control">
                                <label for="vorname">Vorname</label>
                            </div>

                        </div>

                        <div class="col-md-6">


                            <div class="md-form md-outline mb-0">
                                <input type="text" name="nachname" class="form-control">
                                <label for="nachname">Nachname</label>
                            </div>

                        </div>


                    </div>


                    <div class="md-form md-outline mt-3">
                        <input type="email" name="email" class="form-control">
                        <label for="email">E-mail</label>
                    </div>
                    <br>


                    <div class="md-form md-outline">
                        <input type="text" name="subject" class="form-control">
                        <label for="subject">Worum gehts?</label>
                    </div>
                    <br>


                    <div class="md-form md-outline mb-3">
                        <textarea name="message" class="md-textarea form-control" rows="3"></textarea>
                        <label for="message">Leg los - die Zeilen gehören dir!</label>
                    </div>

                    <button type="submit" class="btn btn-block ml-0 mb-4 " style="background-color: black; color: rgb(255, 196, 0);font-weight: bold;">Senden<i class=" fa fa-paper-plane ml-2" "></i></button>

                    <br>

                </div>
              

            </div>
       
</form>

     

        <div class = " contact-right">
                            <img class="roman" src="./images/vector_rudi_kontakt_bw.svg" alt="Rudi beim Briefeempfangen">
                </div>


        </div>


</body>

</html>