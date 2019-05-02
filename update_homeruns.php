<?php
print_r($_SERVER['QUERY_STRING']);
print "<br />";
print $_GET['month'];
print "<br />";
print $_GET['day'];
print "<br />";
print $_GET['year'];
?>
<!--
<option value="January"<?=$row['month'] == 'January' ? ' selected="selected"' : '';?>>January</option>
-->
<form action="update_homeruns_process.php" method="post">

  <select name="months">
      <?php
      $months = array('01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
          /*foreach ($months as $num => $name) {
              printf('<option value="%u">%s</option>', $num, $name);
          }*/
          foreach ($months as $key => $val) {
              //print $key . " => " . $val . "</br>";
              print '<option value="'.$key.'">'.$val.'</option>';              
          } 
      ?>
  </select>



  <select name="days">
  <?php
    for ($i = 1; $i < 32; $i++) {
      print '<option value="' . str_pad($i, 2, 0, STR_PAD_LEFT) . '">' . str_pad($i, 2, 0, STR_PAD_LEFT) . '</option>';
    }
  ?>
  </select>



  <select name="years">
  <?php


  $startyear = date("Y");
  $endyear = date("Y") + 2;
    for ($i = $startyear; $i < $endyear + 1; $i++) {
      print '<option value="' . $i . '">' . $i . '</option>';
    }
  ?>
  </select>


  <input type="submit">

</form>
