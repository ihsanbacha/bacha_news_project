<?php
$pagination_control=function($total_pages,$page,$pid){

// for previous page
if($page>1){
    
    echo  '<li class=""><a href="'.$_SERVER['PHP_SELF'].'?pid='.$pid.'&page=' . ($page-1). '">Prev</a></li>'; 
}

if($total_pages>4){


    /// for if page >5 print prevoious 4 record
    if ($page>4) {
        for ($i=$page-4; $i <$page ; $i++) {
            if ($i == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            echo  '<li class="' . $active . '"><a href="'.$_SERVER['PHP_SELF'].'?pid='.$pid.'&page=' . $i . '">' . $i . '</a></li>';
        }
    }
    if ($page<5) {
        for ($i=1; $i <5 ; $i++) {
            if ($i == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            echo  '<li class="' . $active . '"><a href="'.$_SERVER['PHP_SELF'].'?pid='.$pid.'&page=' . $i . '">' . $i . '</a></li>';
        }
    }
    if ($page>=5) {
        for ($i=$page; $i <=$total_pages ; $i++) {
            if ($page>=($page+3)) {
                break;
            }
            if ($i == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            echo  '<li class="' . $active . '"><a href="'.$_SERVER['PHP_SELF'].'?pid='.$pid.'&page=' . $i . '">' . $i . '</a></li>';
            
        }
    }
}

elseif($total_pages<5){
/// for total pages
for ($i=1; $i <=$total_pages ; $i++) { 

    if ($i == $page) {
        $active = "active";
      } else {
        $active = "";
      }
     
echo  '<li class="' . $active . '"><a href="'.$_SERVER['PHP_SELF'].'?pid='.$pid.'&page=' . $i . '">' . $i . '</a></li>';
}
}
//// for next page
if($page<$total_pages){
echo  '<li class=""><a href="'.$_SERVER['PHP_SELF'].'?pid='.$pid.'& page=' . ($page+1). '">Next</a></li>'; 
}

};
/// let find offset and limit
$offset="";
$total_pages = "";
$limit = 3;
if (isset($_GET['page'])) {
  $pages = $_GET['page'];
  $page = $pages;
} else {
  $page = 1;
}
$offset = ($page - 1) * $limit;
?>