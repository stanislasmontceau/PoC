  <!doctype html>
<html lang="fr">
<head>
  <meta http-equiv="refresh" content="10">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Cache-control" content="private" />
  <title>PocPocPoc</title>
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/footer.css">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap" rel="stylesheet">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css”>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="dygraph.js"></script>
<link rel="stylesheet" src="dygraph.css" />
 <script>
    $(function(){
    $('#sphaigne').on('click',function(){$.post( "gpio.php?plant=sphaigne");
          });
    $('#cactus').on('click',function(){$.post( "gpio.php?plant=cactus");
          });
    });
 </script>


</head>
<body>
<!-- define our logo -->
    <?php include('nav.php'); ?>

<!-- the background image -->
    <div class="imgtop">
      <!-- <img src="https://i.imgur.com/ODax3Pw.jpg"></img> -->
      <img src="http://www.environmental-watch.com/wp-content/uploads/2013/09/shutterstock_82951156.jpg"></img>
      <div class="imgTexte">
        <!-- the titles -->
        <h1>PocPocPoc</h1>
        <h4>The future of watering</h4>
        <div class="boutonBas">
          <a href="#milieu">
            <ion-icon name="arrow-dropdown-circle"></ion-icon>
          </a>
        </div>
      </div>
    </div>

    <div id="milieu">
      <p>On this webpage, you are able to choose the type of plants of your green facade, read the humidity data collect of it and the orders we sent. </p>
      <div class="icones">
        <div class="icone1">
          <ion-icon name="leaf"></ion-icon>
         <!--  buttons  -->
          <p>In this part, you are able to choose the type of plants of your green facade               </p>
          <p>Choose your plant : </p>
          <style>
      body {
      font-size: 10%;
      background: #00abb7;
      }
      .container {
      padding: 50px;
      }
      button,
      button::after {
      -webkit-transition: all 0.3s;
      -moz-transition: all 0.3s;
      -o-transition: all 0.3s;
      transition: all 0.3s;
      }
      button {
      background: none;
      border: 3px solid #fff;
      border-radius: 5px;
      color: #fff;
      display: block;
      font-size: 1em;
      font-weight: bold;
      margin: 5px auto;
      padding: 0.1em 0.1em;
      position: relative;
      text-transform: uppercase;
      }
      button::before,
      button::after {
      background: #fff;
      content: '';
      position: absolute;
      z-index: -1;
      }
      button:hover {
      color: #298A08;
      }
      .button1::after {
      height: 0;
      left: 0;
      top: 0;
      width: 100%;
      }
      .button1:hover:after {
      height: 100%;
      }
      .button2::after {
      height: 100%;
      left: 0;
      top: 0;
      width: 0;
      }
      .button2:hover:after {
      width: 100%;
      }
      .button3::after {
      height: 0;
      left: 50%;
      top: 50%;
      width: 0;
      }
      .button3:hover:after {
      height: 100%;
      left: 0;
      top: 0;
      width: 100%;
      }
    </style>
    <div class="container-fluid">
  <button type="bouton" id="sphaigne" class="button1">Sphaigne</button>
  <p></p>
  <button type="button" id="cactus" class="button2">Cactus</button>
  </div>
        </div>

        
              </div>

    

   

    <div id="contact">

<!-- graphs  -->

<div class="icone2">
          <ion-icon name="color-fill"></ion-icon>
<!--           <ion-icon name="analytics"></ion-icon>
 -->          <p> Here the user will find the humidity data collected by the sensor : </p>
          <div id="graphdiv2"
            style="width:500px; height:300px;"></div>
          <script type="text/javascript">
            g2 = new Dygraph(
              document.getElementById("graphdiv2"),
              "humidity_data.csv", // path to CSV file
              {}          // options
            );
          </script>


<ion-icon name="color-fill"></ion-icon>
<!--           <ion-icon name="analytics"></ion-icon>
 -->          <p> Here the user will find the level of water data collected by the sensor : </p>
          <div id="graphdiv3"
            style="width:500px; height:300px;"></div>
          <script type="text/javascript">
            g3 = new Dygraph(
              document.getElementById("graphdiv3"),
              "waterlevel_data.csv", // path to CSV file
              {}          // options
            );
          </script>
                </div>



                  <div class="icone3">
                    <ion-icon name="flash"></ion-icon>
<!--                     <ion-icon name="exit"></ion-icon>
                         <ion-icon name="git-branch"></ion-icon>
 -->                    <p> In the  following graph, the three values are set for different orders : 0 —> No action necessary 1 
                            —> Watering action activated 2 —>  Increase water level </p>
                    <div id="graphdiv4"
                    style="width:500px; height:300px;"></div>
                  <script type="text/javascript">
                    g4 = new Dygraph(
                      document.getElementById("graphdiv4"),
                      "order.csv", // path to CSV file
                      {}          // options
                    );
                  </script>
                  </div>
                </div>


<!-- contact information -->

      <h3>Contact</h3>
      <div class="rs"><!-- réseaux sociaux -->

        <div class="fb">
          <a href="https://www.facebook.com/InfiniteMeasuresFr" target = "_blank"><ion-icon name="logo-facebook"></ion-icon></a>
          <p>InfiniteMeasuresFr</p>
        </div>

        <div class="email">
          <a href="mailto.infinitemeasuresfr@gmail.com" target = "_blank"><ion-icon name="mail"></ion-icon></a>
          <p> pocpocpoc2020@gmail.com</p>
        </div>

        <div class="insta">
          <a href="https://www.instagram.com/infinite_measures/" target = "_blank"><ion-icon name="logo-instagram"></ion-icon></a>
          <p>infinite_measures</p>
        </div>

      </div>

    </div>

  <!-- our contact information (social networks and mail).  -->

    <?php include('footer.php'); ?>

  <script src="js/script.js"></script>
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>
</html>
