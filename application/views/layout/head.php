<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Industries Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Oxygen:400,700" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url() ?>assets/templates/home/css/animate.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/templates/home/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/templates/home/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/templates/home/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/templates/home/fonts/fontawesome/css/font-awesome.min.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/templates/home/css/style.css">

  </head>
  <body>

  <style>
  
     /* Customize the label (the label-cont) */
    .label-cont {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 14px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default checkbox */
    .label-cont input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .label-cont:hover input ~ .checkmark {
      background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .label-cont input:checked ~ .checkmark {
      background-color: #ff8000;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the checkmark when checked */
    .label-cont input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the checkmark/indicator */
    .label-cont .checkmark:after {
      left: 8px;
      top: 3px;
      width: 9px;
      height: 15px;
      border: solid white;
      border-width: 0 5px 5px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    } 
  
  </style>