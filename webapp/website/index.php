<?php
require_once "propertyCard.php";
require_once "tenancyCard.php";
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Property Manager</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="dashboard.css" rel="stylesheet">
</head>
<body>
 <nav class="navbar navbar-dark navbar-fixed-top bg-inverse">
     <a class="navbar-brand" href="#">
         <i class="fa fa-home"></i> Propman
     </a>
      <form class="pull-xs-left">
          <input type="text" class="form-control search-bar" placeholder="Search...">
      </form>
      <div class="pull-xs-right navbar-icon-set">
          <a class="btn btn-default navbar-icon search-icon" href="#"><i class="fa fa-search"></i></a>
          <a class="btn btn-default navbar-icon" href="#"><i class="fa fa-plus"></i></a>
          <a class="btn btn-default navbar-icon" href="#"><i class="fa fa-user"></i></a>
          <a class="btn btn-default navbar-icon" href="#"><i class="fa fa-bell"></i></a>
      </div>
 </nav>

<div class="container-fluid main">
     <h1>Dashboard cards</h1>
 </div>

 <!-- Bootstrap core JavaScript
    ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
 <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>