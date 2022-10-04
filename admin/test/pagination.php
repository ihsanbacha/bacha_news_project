
<?php
///// 1 connection include /////
include "config.php";
//////// 2 this first query is just to get the total count of rows //////////
$select1="SELECT COUNT(id) from users where approved ='1'";
$query=mysqli_query($conn,$select1);
$row=mysqli_fetch_row($query);

////////3 here we have the total row count //////////
$rows=$row[0];
/////// 4 this is the number of results we want displayed per page //////
$page_rows=10; 
////// 5 this tells us the page number of our last page ///////
$last = ceil($rows/$page_rows);
////// 6 this make sure $last cannot be less than 1 ///////
if($last<1){
    $last=1;
}
///// 7 establish the $page_num variable //////
$page_num= 1;
///// 8 get page_num from url vars if it is present, else its is =1 /////////
if(isset($_GET['pn'])){
    $page_num = preg_replace('#[^0-9]#', '' , $_GET['pn']);

}
//// 9 this make s sure the page number isn't below 1 , or more than our $last page //////

if ($page_num < 1){
    $page_num =1 ;

}
else if($page_num>$last){
$page_num= $last;
}
///// 10 this sets the range of rows to query for the chosen $page_num //////
$limit = 'LIMIT' .($page_num - 1) * $page_rows .',' .$page_rows;
/// 11 this is your query agian ti is for grabbing just one page worth of rows by applying $limit //////
$select2="SELECT COUNT(id) from users where approved ='1' order by user_id desc $limit";
$query2=mysqli_query($conn,$select2);
//// 12 this shows the user what page they are on, and the total number of page /////
$text_line1 = "users (<b>$rows</b>)";
$text_line2= "page <b>$page_num</b> of <b>$last</b>";
//// 13 establishment the $page_ctrl varible/////
$page_ctrl = '';
////14 if there is more than 1 page worth of results ////
if($last !=1){
    // 15 first we check if we are on page one. if we are then we don't need a link
    // to the previous page or the first page  so we do nothing . if we aren't the we
    //generate links to the first page, and to the previous page.
    if($page_num>1){
        $previous = $page_num -1;
        $page_ctrl.='<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">previous</a> &nbsp; &nbsp;';

        ///// 16 render clickable number links that should appear on the left of the target page number
    for($i = $page_num-4; $i<$page_num; $i++){
    if($i >0){
        $page_ctrl.='<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; &nbsp;'; 
    }

    }

    }
    /// 17 render the target page number, but without it being link
    $page_ctrl .=''.$page_num.'&nbsp;';
     ///// 18 render clickable number links that should appear on the right of the target page number
     for ($i=$page_num; $i <=$last ; $i++) { 
        $page_ctrl.='<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; &nbsp;'; 
        if($i >=$page_num+4){
            break;
        }
    }
    // this does the same as above only checking if we are on the last page,
    // and then genrating the "next"
    if($page_num !=$last){
        $next=$page_num+1;
        $page_ctrl.='<a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">next</a> &nbsp; &nbsp;'; 

    }
     }


    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>