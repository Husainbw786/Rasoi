<?php 
  
  error_log('at index php root page');
  error_reporting(0);
  require_once 'Controller/starting_controller.php';
  
  new StartingController();

 ?>

