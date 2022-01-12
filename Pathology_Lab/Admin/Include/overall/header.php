<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<?php include "Include/head.php"?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php include "Include/header.php"?>

    <?php include "Include/aside.php"?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $page_title;?>
                <small><?php echo $page_sub_title;?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><?php echo $page_sub_title;?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
