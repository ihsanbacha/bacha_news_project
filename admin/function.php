<?php

///////////// take function for pagination control
$pagination_control= function($page,$total_pages){

       //// for previous page
    if ($page >1) {
        
        echo'<li><a href="'.$_SERVER['PHP_SELF'].'?page=' . ($page - 1) . '">prev</a></li>';

        }

        //////////// for page control 
        if($total_pages>5){
        //////////// we are required 3   loop for pagination control ////
////////// 1 loop for render previous four record or page or left side record
if ($page > 4) {
    for ($i = $page - 4; $i < $page; $i++) {
      echo  '<li class=""><a href="'.$_SERVER['PHP_SELF'].'?page=' . $i . '">' . $i . '</a></li>';
    }
  }
    ///////////////////// 2 loop for printed first 5 pages
    if ($page < 5) {
        for ($i = 1; $i <= 5; $i++) {
            if ($i == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            echo  '<li class="' . $active . '"><a href="'.$_SERVER['PHP_SELF'].'?page=' . $i . '">' . $i . '</a></li>';
        }
    }
    /////// 3 loop in if else statment  cut 5 pages from total_pages
    elseif ($page >= 5) {
        for ($i = $page; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            echo  '<li class="' . $active . '"><a href="'.$_SERVER['PHP_SELF'].'?page=' . $i . '">' . $i . '</a></li>';
            if ($i >= ($page + 4)) {
                break;
            }
        }
    }
  }
  elseif($total_pages<5){
      
    for ($i=1; $i <=$total_pages ; $i++) { 

        if ($i == $page) {
            $active = "active";
          } else {
            $active = "";
          }
          echo  '<li class="' . $active . '"><a href="'.$_SERVER['PHP_SELF'].'?page=' . $i . '">' . $i . '</a></li>';
        //  if($page>2){
        //   break;
        //  }      
    }

  }

    ///////// page control end


        ///////////// next page
    if ($page < $total_pages) {
        
     echo'<li><a href="'.$_SERVER['PHP_SELF'].'?page=' . ($page + 1) . '">NEXT</a></li>';
      }
};
///// pagination control function end

//////  lets find offset value
$offset="";
$total_pages = "";
$limit = 3;
if (isset($_GET['page'])) {
  $pages = $_GET['page'];
  $page = $pages;
} else {
  $page = 1;
}
$offset .= ($page - 1) * $limit;

?>