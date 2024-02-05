<?php

require("connexionbdd.php");

// Récupérez les valeurs de la première table
$query1 = "SELECT * FROM evenement";
$result1 = $baserestau->query($query1);

if ($result1) {
  $row1 = $result1->fetch(PDO::FETCH_ASSOC);
}

// Récupérez les valeurs de la deuxième table
$query2 = "SELECT * FROM information WHERE id = 1";
$result2 = $baserestau->query($query2);

if ($result2) {
  $row2 = $result2->fetch(PDO::FETCH_ASSOC);
}

$query3 = "SELECT * FROM information WHERE id = 1";
$result3 = $baserestau->query($query3);

if ($result3) {
  $row3 = $result3->fetch(PDO::FETCH_ASSOC);
}

$result = $baserestau->query("SELECT * FROM menu");

// Initialisez un tableau pour stocker les éléments du menu
$menuItems = array();

// Vérifiez si la requête a réussi
if ($result) {
  // Parcourez les résultats de la requête
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // Ajoutez les informations de l'élément du menu au tableau
    $menuItems[] = $row;
  }
} else {
  // Affichez un message d'erreur si la requête a échoué
  echo "Erreur lors de la récupération des données : " . $baserestau->errorInfo()[2];
}

// N'oubliez pas de libérer les ressources après avoir terminé
$result->closeCursor();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $row3['nom']; ?></title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Satisfy|Bree+Serif|Candal|PT+Sans">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- =======================================================
    Theme Name: Delicious
    Theme URL: https://bootstrapmade.com/delicious-free-restaurant-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
  <!-- Inclure jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Inclure Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>


  <style>
    /* Style pour les filtres */
    #menu-flters {
      text-align: center;
      margin-bottom: 20px;
    }

    #menu-flters a {
      margin-right: 10px;
      padding: 5px 10px;

      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .menu-item {
      display: none;
      width: 200px;
      padding: 10px;
      margin: 5px;
      border: 1px solid #ddd;
      border-radius: 5px;
      text-align: center;
    }
  </style>


</head>

<body>
  <!--banner-->
  <section id="banner">
    <div class="bg-color">
      <header id="header">
        <div class="container">
          <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#about">About</a>
            <a href="#event">Event</a>
            <a href="#menu-list">Menu</a>
            <a href="#contact">Book a table</a>
          </div>
          <!-- Use any element to open the sidenav -->
          <span onclick="openNav()" class="pull-right menu-icon">☰</span>
        </div>
      </header>
      <div class="container">
        <div class="row">
          <div class="inner text-center">
            <h1 class="logo-name"><?php echo $row3['nom']; ?></h1>
            <h2><?php echo $row3['phraseaccroche']; ?></h2>
            <p>Specialized in <?php echo $row3['specialite']; ?> Cuisine!!</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / banner -->
  <!--about-->
  <!-- <section id="about" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center marb-35">
          <h1 class="header-h">Delicious Journey</h1>
          <p class="header-p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
            <br>nibh euismod tincidunt ut laoreet dolore magna aliquam.
          </p>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="col-md-6 col-sm-6">
            <div class="about-info">
              <h2 class="heading">vel illum qui dolorem eum</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero impedit inventore culpa vero accusamus
                in nostrum dignissimos modi, molestiae. Autem iusto esse necessitatibus ex corporis earum quaerat
                voluptates quibusdam dicta!</p>
              <div class="details-list">
                <ul>
                  <li><i class="fa fa-check"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                  <li><i class="fa fa-check"></i>Quisque finibus eu lorem quis elementum</li>
                  <li><i class="fa fa-check"></i>Vivamus accumsan porttitor justo sed </li>
                  <li><i class="fa fa-check"></i>Curabitur at massa id tortor fermentum luctus</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6">
            <img src="img/res01.jpg" alt="" class="img-responsive">
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>
  </section> -->
  <!--/about-->
  <!-- event -->
  <section id="event">
    <div class="bg-color" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 text-center" style="padding:60px;">
            <h1 class="header-h">Up Coming events</h1>
            <p class="header-p">Decorations 100% complete here</p>
          </div>
          <div class="col-md-12" style="padding-bottom:60px;">
            <div class="item active left">
              <div class="col-md-6 col-sm-6 left-images">
                <img src="img/res02.jpg" class="img-responsive">
              </div>
              <div class="col-md-6 col-sm-6 details-text">
                <div class="content-holder">
                  <h2><?php echo $row1['titre']; ?></h2>
                  <p><?php echo $row1['description']; ?></p>
                  <address>
                    <strong>Place: </strong>
                    <?php echo $row1['place']; ?>
                    <br>
                    <strong>Time: </strong>
                    <?php echo $row1['heur']; ?>
                  </address>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ event -->

  <!-- menu -->
  <section id="menu-list" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center marb-35">
          <h1 class="header-h">Menu List</h1>
          <p class="header-p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
            <br>nibh euismod tincidunt ut laoreet dolore magna aliquam.
          </p>
        </div>

        <div class="col-md-12  text-center" id="menu-flters">
          <ul>
            <li><a class="filter active" data-filter=".menu-restaurant">Show All</a></li>
            <li><a class="filter" data-filter=".breakfast">Breakfast</a></li>
            <li><a class="filter" data-filter=".lunch">Lunch</a></li>
            <li><a class="filter" data-filter=".dinner">Dinner</a></li>
          </ul>
        </div>

        <div id="menu-wrapper">
          <?php
          // Parcourez le tableau des éléments du menu
          foreach ($menuItems as $menuItem) {
            $categoryClass = strtolower($menuItem['categorie']);
          ?>
            <div class="<?php echo $categoryClass; ?> menu-restaurant">
              <span class="clearfix">
                <a class="menu-title" href="#" data-meal-img="assets/img/restaurant/rib.jpg"><?php echo $menuItem['Nom']; ?></a>
                <span style="left: 166px; right: 44px;" class="menu-line"></span>
                <span class="menu-price"><?php echo '$' . $menuItem['prix']; ?></span>
              </span>
              <span class="menu-subtitle"><?php echo $menuItem['descriptionn']; ?></span>
            </div>
          <?php
          }
          ?>
        </div>
        <script>
          $(document).ready(function() {
            // Afficher tous les éléments par défaut
            $('.menu-restaurant').show();

            // Filtrer les éléments lorsque le lien est cliqué
            $('#menu-flters a').click(function() {
              $('#menu-flters a').removeClass('active');
              $(this).addClass('active');

              var category = $(this).data('filter');

              // Afficher les éléments de la catégorie sélectionnée et masquer les autres
              if (category === '*') {
                $('.menu-restaurant').show();
              } else {
                $('.menu-restaurant').hide();
                $(category).show();
              }

              return false;
            });
          });
        </script>

      </div>
    </div>
  </section>
  <!--/ menu -->
  <!-- contact -->
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1 class="header-h">Book Your table</h1>
          <p class="header-p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
            <br>nibh euismod tincidunt ut laoreet dolore magna aliquam.
          </p>
        </div>
      </div>
      <div class="row msg-row">
        <div class="col-md-4 col-sm-4 mr-15">
          <div class="media-2">
            <div class="media-left">
              <div class="contact-phone bg-1 text-center"><span class="phone-in-talk fa fa-phone"></span></div>
            </div>
            <div class="media-body">
              <h4 class="dark-blue regular">Phone Numbers</h4>
              <p class="light-blue regular alt-p"><?php echo $row3['phonenumber']; ?> - <span class="contacts-sp">Phone Booking</span></p>
            </div>
          </div>
          <div class="media-2">
            <div class="media-left">
              <div class="contact-email bg-14 text-center"><span class="hour-icon fa fa-clock-o"></span></div>
            </div>
            <div class="media-body">
              <h4 class="dark-blue regular">Opening Hours</h4>
              <p class="light-blue regular alt-p"> Monday to Friday <?php echo $row3['heureouverture']; ?> -<?php echo $row3['heurefermeture']; ?></p>

            </div>
          </div>
        </div>
        <div class="col-md-8 col-sm-8">
          <form action="" method="post" role="form" class="contactForm">
            <div id="sendmessage">Your booking request has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <div class="col-md-6 col-sm-6 contact-form pad-form">
              <div class="form-group label-floating is-empty">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>

            </div>
            <div class="col-md-6 col-sm-6 contact-form">
              <div class="form-group">
                <input type="date" class="form-control label-floating is-empty" name="date" id="date" placeholder="Date" data-rule="required" data-msg="This field is required" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 contact-form pad-form">
              <div class="form-group">
                <input type="email" class="form-control label-floating is-empty" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 contact-form">
              <div class="form-group">
                <input type="time" class="form-control label-floating is-empty" name="time" id="time" placeholder="Time" data-rule="required" data-msg="This field is required" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 contact-form">
              <div class="form-group">
                <input type="text" class="form-control label-floating is-empty" name="phone" id="phone" placeholder="Phone" data-rule="required" data-msg="This field is required" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 contact-form">
              <div class="form-group">
                <input type="text" class="form-control label-floating is-empty" name="people" id="people" placeholder="People" data-rule="required" data-msg="This field is required" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="col-md-12 contact-form">
              <div class="form-group label-floating is-empty">
                <textarea class="form-control" name="message" rows="5" rows="3" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validation"></div>
              </div>

            </div>
            <div class="col-md-12 btnpad">
              <div class="contacts-btn-pad">
                <button class="contacts-btn">Book Table</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- / contact -->
  <!-- footer -->
  <footer class="footer text-center">
    <div class="footer-top">
      <div class="row">
        <div class="col-md-offset-3 col-md-6 text-center">
          <div class="widget">
            <h4 class="widget-title">Delicious</h4>
            <address><?php echo $row3['adresse']; ?></address>
            <div class="social-list">

              <a href="<?php echo $row3['fblink']; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </div>
            <p class="copyright clear-float">
              © Delicious Theme. All Rights Reserved
            <div class="credits">
              <!--
                  All the links in the footer should remain intact.
                  You can delete the links only if you purchased the pro version.
                  Licensing information: https://bootstrapmade.com/license/
                  Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Delicious
                -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->



</body>

</html>