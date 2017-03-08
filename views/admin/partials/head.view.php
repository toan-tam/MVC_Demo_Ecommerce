<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title><?=isset($title) ? $title : "ITPSoft Shopping online";?></title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
          name="viewport" />
    <link rel="stylesheet" href="views/css/font-awesome.min.css" />
    <link rel="stylesheet" href="views/css/app.css" />
    <style>
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td{
            border-color: #ccc;;
        }
        .table > tbody + tbody{
            border-color: #ccc;;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?=route()?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">BH</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">Quản lý bán hàng</span>
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
        </a>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="sidebar_QLMenu">
                    <a href="<?=route()?>">
                        <i class="fa fa-home"></i>
                        <span>Trở về trang chủ</span>
                    </a>
                </li>

                <li class="sidebar_QLDatHang">
                    <a href="<?=route("admin.orders", "index", "admin")?>">
                        <i class="fa fa-phone"></i>
                        <span>Quản lý Đặt hàng</span>
                    </a>
                </li>

                <li class="sidebar_QLMenu">
                    <a href="<?=route("menus", "index", "admin")?>">
                        <i class="fa fa-list"></i>
                        <span>Quản lý Menu</span>
                    </a>
                </li>
                <li class="sidebar_QLLoaiMenu">
                    <a href="<?=route("menu_types", "index", "admin")?>">
                        <i class="fa fa-list"></i>
                        <span>Quản lý Loại menu</span>
                    </a>
                </li>

                <li class="sidebar_QLSanPham">
                    <a href="<?=route("products", "index", "admin")?>">
                        <i class="fa fa-list"></i>
                        <span>Quản lý Sản phẩm</span>
                    </a>
                </li>

                <!--<li class="sidebar_QLNhomNguoiDung">
                    <a href="<?/*=route("roles", "index", "admin")*/?>">
                        <i class="fa fa-users"></i>
                        <span>Quản lý Nhóm người dùng</span>
                    </a>
                </li>
                <li class="sidebar_QLNguoiDung">
                    <a href="<?/*=route("users", "index", "admin")*/?>">
                        <i class="fa fa-user-plus"></i>
                        <span>Quản lý Người dùng</span>
                    </a>
                </li>-->


                <li class="sidebar_DoiMatKhau">
                    <a href="<?=route("admin", "showChangePasswordForm", "admin")?>">
                        <i class="fa fa-edit"></i>
                        <span>Đổi mật khẩu</span>
                    </a>
                </li>

                <li>
                    <a href="<?=route("auth", "logout")?>">
                        <i class="fa fa-edit"></i>
                        <span>Thoát</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div id="content" runat="server" style="min-height: 600px; padding: 5px; background-color: #fff;">
<?php require "views/partials/message.view.php";?>