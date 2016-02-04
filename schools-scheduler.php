<?php
require_once(ROOTDIR . 'calendar.php');

function sinetiks_schools_scheduler () {
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-calendar.css" rel="stylesheet" />
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/bootstrap.min.css" rel="stylesheet" />
<div class="wrap">
<h2>Schools</h2>
<?php
if(isset($_GET['day'])){
?>
  <form>
    <div class="form-group">
      <label for="">Lekcja</label>
      <input type="email" class="form-control" id="lesson" placeholder="Email">
    </div>
    <div class="form-group">
      <label for="">Nauczyciel</label>
      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
      <label for="">Klasa</label>
      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>  
    <button type="submit" class="btn btn-default">Submit</button>
  </form>  

    <table class="table">
        <thead>
            <tr>
                <th>Godzina lekcyjna</th><th>lekcja</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>1 8:00-8:45</td></tr>
            <tr><td>2 9:00-9:45</td></tr>
            <tr><td>3</td></tr>
            <tr><td>4</td></tr>
            <tr><td>5</td></tr>
            <tr><td>6</td></tr>
            <tr><td>7</td></tr>
        </tbody>
    </table>
<?php

}else{

    $calendar = new Calendar();
    echo $calendar->show();
}
?>
</div>
<?php
}