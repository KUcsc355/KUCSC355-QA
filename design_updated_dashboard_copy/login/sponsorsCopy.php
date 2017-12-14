<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="../slick/slick-theme.css"/>
</head>
<body>

<div class="slide_content">
  <div class="variable-width">
  <?php
  //This text file contains rudimentary image metadata (image name, sponsor name)
  $txt_file    = file_get_contents('../slick/sponsor_imgs.txt');
  
  //image directory
  $dir = "../slick/sponsor_imgs";

  //Split the file at each line
  $rows        = explode("\n", $txt_file);
  array_shift($rows);

  //Within each line:
  $index=0;
  foreach($rows as $row => $data)
  {
    //Split line at delimiter '^'
    $row_data = explode('^', $data);
    //And spit out the image (located at $row_data[0] with sponsor data (located at $row_data[1])
    echo "<div index='$index' title=\"$row_data[1]\"><img src='../slick/sponsor_imgs/$row_data[0]'></div>";
    $index++;
  }
  ?>
  </div>
</div>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="../slick/slick.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
      $('.sponsors_slide').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: false
      });
    });

$('.variable-width').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 1,
  centerMode: true,
  variableWidth: true,
});

$('.responsive').slick({
  dots: true,
  infinite: false,
  autoplay: true,
  speed: 300,
  arrows: true,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

  </script>

</body>
</html>