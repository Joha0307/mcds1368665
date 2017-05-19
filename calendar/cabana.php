<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <!-- Latest compiled and minified CSS -->

        <script type="text/javascript" src="js/jquery-3.1.1/jquery-3.1.1.min.js"></script>

        <script src="js/bootstrap/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script src="js/jquery-ui/jquery-ui.js"></script>

        <link rel="stylesheet" href="css/jquery-ui/jquery.ui.css">
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->



        <script type="text/javascript">


           


            function insertar() {


                var nombre = $("#nombre").val();
                var capacidad = $("#capacidad").val();


                $.ajax({type: "POST",
                    url: "http://localhost/calendar/funciones.php",
                    data: ({nombre: nombre, capacidad:capacidad, method: "insertar"}),
                    cache: false,
                    dataType: "text",
                    success: function (data) {

                        listar();
                    }

                });


            }

            function cargar(id) {

                $.ajax({type: "POST",
                    url: "http://localhost/calendar/funciones.php",
                    cache: false,
                    dataType: "text",
                    data: {id: id, method: "cargar"},
                    success: function (data) {

                        var info = data.split(",");

                        $("#id").val(info["0"]);
                        $("#nombre").val(info["1"]);
                        $("#capacidad").val(info["2"]);
                        $("#disponibilidad").val(info["3"]);




                        document.getElementById("insert").style.display = 'none';
                        document.getElementById("edit").style.display = 'inline';

                    }
                });
            }

            function listar() {

                $.ajax({
                    type: 'post',
                    async: false,
                    url: "http://localhost/calendar/funciones.php",
                    data: {method: "listar"},
                    success: function (data) {
                        document.getElementById("tabla").innerHTML = data;
                    }
                });
            }




            function editar() {


                var id = $("#id").val();
                var nombre = $("#nombre").val();
                var capacidad = $("#capacidad").val();



                $.ajax({type: "POST",
                    url: "http://localhost/calendar/funciones.php",
                    data: ({id: id, nombre: nombre, capacidad:capacidad, method: "editar"}),
                    cache: false,
                    dataType: "text",
                    success: function (data) {
                        listar();
                    }

                });

            }

            function eliminar(id) {

                $.ajax({type: "POST",
                    url: "http://localhost/calendar/funciones.php",
                    cache: false,
                    dataType: "text",
                    data: {id: id, method: "eliminar"},
                    success: function (data) {
                        listar();

                    }
                });
            }

            






        </script>



    </head>


    <body onload="listar()">
        <div class="container">




            <div class="page-header">




                <div class="form-group page-header"  name="registro">
                    <form method="POST" name="form">


                        <input type="text" id="id" name="id" style="display: none"><br>

                        <label for="nombre" >Nombre:</label>
                        <input type="text" placeholder="nombre" id="nombre" name="nombre" class="form-control" ><br>

<label for="capacidad" >capacidad:</label>
                        <input type="number" placeholder="capacidad" id="capacidad" name="capacidad" class="form-control" ><br>



                        <input type="submit" onclick="insertar()" value="Insertar" name="insert" id="insert" class="form-control" style="background-color: #015D52; color: white">
                        <input type="submit" onclick="editar()" value="Editar" name="edit" id="edit" class="form-control" style="background-color: #015D52; color: white; display: none">
                        


                    </form>
                </div>


                <div id="tabla" name="tabla">


                </div>



            </div>      
            

        </div>



    </body>
</html>