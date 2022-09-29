<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title> Resultados Encuestas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font: 15px Montserrat, sans-serif;
      line-height: 1.8;
      color: black;
    }
    
    table{
      padding: 10px;
      width: 30%;
    }
  </style>
</head>
<body>


  <h1>Resultados de la Encuesta </h1>
  <div>
    <div style="float:left;">
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

          var data = google.visualization.arrayToDataTable([
            ['Gaseosas', 'Votos'],
            <?php
              //variables de coneccion    
              $servername="localhost";
              $username="root";
              $password="";
              $dbname="bdencuesta1";

              //crear coneccion
              $conn=new mysqli($servername,$username,$password,$dbname);

              //check coneccion
              if ($conn->connect_error){
                  die("Coneccion fallada".$conn->connect_error);      }

              //consulta
              $querysql='SELECT opcion,cantidad FROM tableencuesta';
              $result=$conn->query($querysql);

              if($result->num_rows>0){
                  while ($row=$result->fetch_assoc()){
                      echo "['";
                      echo $row["opcion"]."',";
                      echo $row["cantidad"]."],";
                  }
                  echo "]);";
              } else {
                      echo "0 resultados";
              }

              //cerrar coneccion

              $conn->close();

            ?>


          var options = {
            title: 'Estadistica de Encuesta de Preferencia de Bebida Gaseosa'
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
        }
      </script>

      <div id="piechart" style="width: 500px; height: 400px;"></div>         
      
    </div>                


           <?php
                //variables de coneccion    
                $servername="localhost";
                $username="root";
                $password="";
                $dbname="bdencuesta1";

                //crear coneccion
                $conn=new mysqli($servername,$username,$password,$dbname);

                //check coneccion

                if ($conn->connect_error){
                    die("Coneccion fallada".$conn->connect_error);

                }

                //consulta

                $querysql='SELECT id,opcion,cantidad FROM tableencuesta';
                $result=$conn->query($querysql);

                $querysql2='SELECT SUM(cantidad) AS TOTAL FROM tableencuesta';
                $result2=$conn->query($querysql2);

                if($result->num_rows>0){
                    echo "<h3> Tabla de Resultado </h3>";
                    echo "<table border=1>";
                    echo "<tr> <td> id </td>  <td> Opcion </td>    <td> Cantidad Encuestados </td> </tr>  ";
                    while ($row=$result->fetch_assoc()){
                        echo "<tr> <td>";
                        echo $row["id"]." </td> ";
                        echo "<td>".$row["opcion"]."</td>";
                        echo "<td>".$row["cantidad"]."</td> </tr>";
                    }
                    echo "</table>";
                } else {
                        echo "0 resultados";
                }

                if($result2->num_rows>0){
                  echo "<h3 style='color:darkred'> Total Encuestados: ";
                   while ($row=$result2->fetch_assoc()){
                      echo $row["TOTAL"];
                  }
                  echo " </h3>";
              } else {
                      echo "0 resultados";
              }

                //cerrar coneccion

                $conn->close();
                
                ?>
  </div>

  <div>
         <br> <br>
      <h3> <a href="index.html"> Volver a la Encuesta</a>  </h3>        
  </div>


</body>
</html>

