<!doctype html>
<html lang="en">

<head>
    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css" href="../slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="../slick/slick-theme.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"/>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/sponsors.css"/>

    <!--  Paper Dashboard core CSS    -->
	  <link href="../assets/css/paper-dashboard.css" rel="stylesheet" media="screen"/>

</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-12">
    <div class="single-item-rtl">
      <?php
        //This text file contains rudimentary image metadata (image name, sponsor name)
        $txt_file    = file_get_contents('../slick/sponsor_imgs.txt');
    
        //image directory
        $dir = "../slick/sponsor_imgs";

        //Split the file at each line
        $rows        = explode("\n", $txt_file);
        array_shift($rows);
        $sponsors = array();
        $sponsor_site = array();

        //Within each line:
        foreach($rows as $row => $data)
        {
          //Split line at delimiter '^'
          $row_data = explode('^', $data);
          //And spit out the image (located at $row_data[0] with sponsor data (located at $row_data[1])
          echo "<div class='slick-slide'>
                  <div class='inner'>
                <div><img class='img-responsive' src='../slick/sponsor_imgs/$row_data[0]' title=\"$row_data[1]\"></div>
                  </div>
                </div>";
          array_push($sponsors, $row_data[1]);
          array_push($sponsor_site, $row_data[2]);
        }
        ?>
    </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="../slick/slick.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
      var allRows = $('[class^=table-row-]');
      var currCount = 2;

      var MIN_COUNT_CONTAINER = allRows[0].classList.item(0);
      var MIN_COUNT = MIN_COUNT_CONTAINER.substring(MIN_COUNT_CONTAINER.length - 1);

      var MAX_COUNT_CONTAINER = allRows[allRows.length - 1].classList.item(0);
      var MAX_COUNT = MAX_COUNT_CONTAINER.substring(MAX_COUNT_CONTAINER.length - 1);

      for (var i = 0; i < allRows.length; i++) {
        if (allRows[i].classList.contains('table-row-' + currCount)) {
          allRows[i].classList.add('hidden');
        }
      }

      currCount = 1;

      $('li.previous').on('click', function() {

        if (currCount > MIN_COUNT) {
          currCount -= 1;

          for (var i = 0; i < allRows.length; i++) {
            if (!(allRows[i].classList.contains('hidden'))) {
              allRows[i].classList.add('hidden');
            }
          }

          var activeRows = $('.table-row-' + currCount);

          for (var i = 0; i < activeRows.length; i++) {
            activeRows[i].classList.remove('hidden');
          }
        }
      });

      $('li.next').on('click', function() {
        if (currCount < MAX_COUNT) {
          currCount += 1;

          for (var i = 0; i < allRows.length; i++) {
            if (!(allRows[i].classList.contains('hidden'))) {
              allRows[i].classList.add('hidden');
            }
          }

          var activeRows = $('.table-row-' + currCount);
        
          for (var i = 0; i < activeRows.length; i++) {
            activeRows[i].classList.remove('hidden');
          }
        }
      });

      $('.single-item-rtl').slick({
        speed: 5000,
        autoplay: true,
        autoplaySpeed: 0,
        centerMode: true,
        cssEase: 'linear',
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: true,
        infinite: true,
        initialSlide: 1,
        arrows: false,
        buttons: false,

         responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              infinite: true,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });
})
</script>

<div class="container">      
<!-- <div class ="card"> -->
<div class="row">
  <div class="col-md-12 col-xs-12">
  <div class="head"> 
  <h3>We are very grateful for the following individuals and organizations who have contributed their time, energy and efforts to support our chapter.</h3>         
  <div class="table-responsive">
    <table class="table table-striped">
  <!--     <thead>
        <tr>
          <th><h6>Company Name</h6></th>
          <th><h6>Sponsor Site</h6></th>
        </tr>
      </thead> -->
      <tbody>
        <?php
        $counter = 0;
        $delimiter = 1;
        for($i = 0; $i < sizeof($sponsors); $i++){
          echo "<tr class='table-row-$delimiter'>
          <td>" . $sponsors[$i] . "</td>
          <td><a href='$sponsor_site[$i]' target='_blank'>Visit Sponsor</a></td>
          </tr>";

          $counter += 1;
          if ($counter % 10 === 0) {
            $delimiter += 1;
          }
        }
        ?>
        <!--<tr>
          <td>Apple</td>
          <td><a href="https://www.apple.com" target="_blank">Visit Sponsor</a></td>
        </tr>
        <tr>
          <td>Kutztown University</td>
          <td><a href="https://www.kutztown.edu" target="_blank">Visit Sponsor</a></td>
        </tr>-->
      </tbody>
    </table>
  </div>

  <nav aria-label="...">
  <ul class="pager">
    <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Previous</a></li>
    <li class="next"><a href="#">Next <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>
  </div>
  </div>
</div>
</div>

</body>
</html>