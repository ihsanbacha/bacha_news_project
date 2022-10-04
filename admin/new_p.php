<?php 
include "config.php";
?>
<table width="200" border="1" class="tbl_news_content" id="results">

          <tbody>
            <tr>
            </tr>
            <?php
                $i=0;
                $no=0;
                $hal = $_GET['hal'];
                if(!isset($_GET['hal']))
                {
                    $page = 1;
                }
                else
                {
                    $page = $_GET['hal'];
                }

                $max_show = 2;// this is the option that how many items do you want to show each page

                $from     = (($page * $max_show) - $max_show);
                $query_banner = "SELECT * FROM users
                                 ORDER BY `user_id` DESC
                                LIMIT {$from},{$max_show}" or die(mysqli_error($conn));
                                $query1=mysqli_query($conn,$query_banner);
                    while($show=mysqli_fetch_array($query1))
                    { 
                        $no++;
                        if(($no%2)==0)
                            $color = '#f2f2f2'; 
                        else
                            $color = '#f9f9f9';
            ?>
                      <tr class="rows" bgcolor="<?php echo $color; ?>">
                        <td class="no_content"><?php echo $no; ?></td>
                        <td class="banner_content"><?php echo $show['example']; ?></td>
                        <td class="action_content"></td>
                       </tr>
            <?php 
                }
            ?>      
          </tbody>  
        </table>
    </div><!-- end of table_content -->
        <div id="pagination">
            <?php
                $total_results = "SELECT COUNT(*) as Num FROM users"; 
                $query2=mysqli_query($conn,$total_results);

                $total_pages = ceil($total_results / $max_show); 

                echo "<center>"; 

                if($hal > 1){ 
                    $prev = ($page - 1); 
                    echo "<a href=$_SERVER[PHP_SELF]?hal=$prev>← Previous </a> "; 
                } 

                for($i = 1; $i <= $total_pages; $i++){ 
                    if(($hal) == $i){ 
                        echo "$i "; 
                    } else { 
                        echo "<a href=$_SERVER[PHP_SELF]?hal=$i>$i</a> "; 
                } 
                }
        // Build Next Link 
                if($hal < $total_pages){ 
                    $next = ($page + 1); 
                    echo "<a href=$_SERVER[PHP_SELF]?hal=$next>Next →</a>"; 
                } 
                echo "</center>"; 
        ?>
    </div><!-- end of pagination -->