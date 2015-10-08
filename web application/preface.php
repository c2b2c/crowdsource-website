<html>
  <head>
  </head>
  <body>
  <?php
        require_once("common.php");
        $sql="select ＊ from article_post natural join post_on natural join project";  
        $result = mysql_query($conn, $sql);
        $table = "<table>";
        if($result&&mysql_num_rows($result) > 0){
        while($row = mysql_fetch_array($result) ) {
                //$table.='<tr>';
                //$summary.='<td align="center">'.$row['summary'].'</td>';
                //$catogory.='<td align="center">'.$row['catogory'].'</td>';
                //$title.='<td align="center">'.$row['title'].'</td>';
                //$image.='<td align="center">'.$row['image'].'</td>';
                //$table.="</tr>";
                $summary.='<td align="center">'.$row['summary'].'</td>';
                $catogory.='<td align="center">'.$row['catogory'].'</td>';
                $title.='<td align="center">'.$row['title'].'</td>';
                $image.='<td align="center">'.$row['image'].'</td>';

        }}else {
            $table.= '<tr><td colspan="3" align="center">没有用户被找到</td></tr>';
        }
       $table.='</table>';

    echo $table;
?>

  </body>
</html>