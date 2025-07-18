<?php

error_reporting(E_ALL);

// BigDump ver. 0.36b from 2015-04-30
// Staggered import of an large MySQL Dump (like phpMyAdmin 2.x Dump)
// Even through the webservers with hard runtime limit and those in safe mode
// Works fine with latest Chrome, Internet Explorer and Firefox

// Author:       Alexey Ozerov (alexey at ozerov dot de) 
//               AJAX & CSV functionalities: Krzysiek Herod (kr81uni at wp dot pl) 
// Copyright:    GPL (C) 2003-2015
// More Infos:   http://www.ozerov.de/bigdump

// This program is free software; you can redistribute it and/or modify it under the
// terms of the GNU General Public License as published by the Free Software Foundation;
// either version 2 of the License, or (at your option) any later version.

// THIS SCRIPT IS PROVIDED AS IS, WITHOUT ANY WARRANTY OR GUARANTEE OF ANY KIND

// USAGE

// 1. Adjust the database configuration and charset in this file
// 2. Remove the old tables on the target database if your dump doesn't contain "DROP TABLE"
// 3. Create the working directory (e.g. dump) on your web server
// 4. Upload bigdump.php and your dump files (.sql, .gz) via FTP to the working directory
// 5. Run the bigdump.php from your browser via URL like http://www.yourdomain.com/dump/bigdump.php
// 6. BigDump can start the next import session automatically if you enable the JavaScript
// 7. Wait for the script to finish, do not close the browser window
// 8. IMPORTANT: Remove bigdump.php and your dump files from the web server

// If Timeout errors still occure you may need to adjust the $linepersession setting in this file

// LAST CHANGES

// *** Fix a typo in HTML code
// *** Change from mySQL to mySQLi

// Database configuration


$db_server   = 'localhost';
$db_name     = 'u273108828_revolution24tv';
$db_username = 'u273108828_revolution24tv';
$db_password = 'i[GX/pgx0d#T'; 

// Connection charset should be the same as the dump file charset (utf8, latin1, cp1251, koi8r etc.)
// See http://dev.mysql.com/doc/refman/5.0/en/charset-charsets.html for the full list
// Change this if you have problems with non-latin letters

$db_connection_charset = 'utf8';

// OPTIONAL SETTINGS 

$filename           = '';     // Specify the dump filename to suppress the file selection dialog
$ajax               = true;   // AJAX mode: import will be done without refreshing the website
$linespersession    = 3000;   // Lines to be executed per one import session
$delaypersession    = 0;      // You can specify a sleep time in milliseconds after each session
                              // Works only if JavaScript is activated. Use to reduce server overrun

// CSV related settings (only if you use a CSV dump)

$csv_insert_table   = '';     // Destination table for CSV files
$csv_preempty_table = false;  // true: delete all entries from table specified in $csv_insert_table before processing
$csv_delimiter      = ',';    // Field delimiter in CSV file
$csv_add_quotes     = true;   // If your CSV data already have quotes around each field set it to false
$csv_add_slashes    = true;   // If your CSV data already have slashes in front of ' and " set it to false

// Allowed comment markers: lines starting with these strings will be ignored by BigDump

$comment[]='#';                       // Standard comment lines are dropped by default
$comment[]='-- ';
$comment[]='DELIMITER';               // Ignore DELIMITER switch as it's not a valid SQL statement
// $comment[]='---';                  // Uncomment this line if using proprietary dump created by outdated mysqldump
// $comment[]='CREATE DATABASE';      // Uncomment this line if your dump contains create database queries in order to ignore them
$comment[]='/*!';                     // Or add your own string to leave out other proprietary things

// Pre-queries: SQL queries to be executed at the beginning of each import session

// $pre_query[]='SET foreign_key_checks = 0';
// $pre_query[]='Add additional queries if you want here';

// Default query delimiter: this character at the line end tells Bigdump where a SQL statement ends
// Can be changed by DELIMITER statement in the dump file (normally used when defining procedures/functions)

$delimiter = ';';

// String quotes character

$string_quotes = '\'';                  // Change to '"' if your dump file uses double qoutes for strings

// How many lines may be considered to be one query (except text lines)

$max_query_lines = 300;

// Where to put the upload files into (default: bigdump folder)

$upload_dir = dirname(__FILE__);

// *******************************************************************************************
// If not familiar with PHP please don't change anything below this line
// *******************************************************************************************

if ($ajax)
  ob_start();

define ('VERSION','0.36b');
define ('DATA_CHUNK_LENGTH',16384);  // How many chars are read per time
define ('TESTMODE',false);           // Set to true to process the file without actually accessing the database
define ('BIGDUMP_DIR',dirname(__FILE__));
define ('PLUGIN_DIR',BIGDUMP_DIR.'/plugins/');

header("Expires: Mon, 1 Dec 2003 01:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

@ini_set('auto_detect_line_endings', true);
@set_time_limit(0);

if (function_exists("date_default_timezone_set") && function_exists("date_default_timezone_get"))
  @date_default_timezone_set(@date_default_timezone_get());

// Clean and strip anything we don't want from user's input [0.27b]

foreach ($_REQUEST as $key => $val) 
{
  $val = preg_replace("/[^_A-Za-z0-9-\.&= ;\$]/i",'', $val);
  $_REQUEST[$key] = $val;
}

// Plugin handling is still EXPERIMENTAL and DISABLED
// Register plugins by including plugin_name.php from each ./plugins/plugin_name
/*
if (is_dir(PLUGIN_DIR)) 
{ if ($dh = opendir(PLUGIN_DIR)) 
	{
    while (($file = readdir($dh)) !== false) 
    { if (is_dir(PLUGIN_DIR.$file) && $file!='.' && $file!='..' && file_exists(PLUGIN_DIR.$file.'/'.$file.'.php'))
       include (PLUGIN_DIR.$file.'/'.$file.'.php');
    }
    closedir($dh);
  }
}
*/

do_action('header');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>BigDump ver. <?php echo (VERSION); ?></title>
<meta http-equiv="CONTENT-TYPE" content="text/html; charset=iso-8859-1"/>
<meta http-equiv="CONTENT-LANGUAGE" content="EN"/>

<meta http-equiv="Cache-Control" content="no-cache/"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Expires" content="-1"/>
<meta name="robots" content="noindex, nofollow">

<?php do_action('head_meta'); ?>

<style type="text/css">
<!--

body
{ background-color:#FFFFF0;
}

h1 
{ font-size:20px;
  line-height:24px;
  font-family:Arial,Helvetica,sans-serif;
  margin-top:5px;
  margin-bottom:5px;
}

p,td,th
{ font-size:14px;
  line-height:18px;
  font-family:Arial,Helvetica,sans-serif;
  margin-top:5px;
  margin-bottom:5px;
  text-align:justify;
  vertical-align:top;
}

p.centr
{ 
  text-align:center;
}

p.smlcentr
{ font-size:10px;
  line-height:14px;
  text-align:center;
}

p.error
{ color:#FF0000;
  font-weight:bold;
}

p.success
{ color:#00DD00;
  font-weight:bold;
}

p.successcentr
{ color:#00DD00;
  background-color:#DDDDFF;
  font-weight:bold;
  text-align:center;
}

td
{ background-color:#F8F8F8;
  text-align:left;
}

td.transparent
{ background-color:#FFFFF0;
}

th
{ font-weight:bold;
  color:#FFFFFF;
  background-color:#AAAAEE;
  text-align:left;
}

td.right
{ text-align:right;
}

form
{ margin-top:5px;
  margin-bottom:5px;
}

div.skin1
{
  border-color:#3333EE;
  border-width:5px;
  border-style:solid;
  background-color:#AAAAEE;
  text-align:center;
  vertical-align:middle;
  padding:3px;
  margin:1px;
}

td.bg3
{ background-color:#EEEE99;
  text-align:left;
  vertical-align:top;
  width:20%;
}

th.bg4
{ background-color:#EEAA55;
  text-align:left;
  vertical-align:top;
  width:20%;
}

td.bgpctbar
{ background-color:#EEEEAA;
  text-align:left;
  vertical-align:middle;
  width:80%;
}

<?php do_action('head_style'); ?>

-->
</style>

</head>

<body>

<center>

<table width="780" cellspacing="0" cellpadding="0">
<tr><td class="transparent">

<!-- <h1>BigDump: Staggered MySQL Dump Importer ver. <?php echo (VERSION); ?></h1> -->

<?php

function skin_open() 
{
  echo ('<div class="skin1">');
}

function skin_close() 
{
  echo ('</div>');
}

skin_open();
echo ('<h1>BigDump: Staggered MySQL Dump Importer v'.VERSION.'</h1>');
skin_close();

do_action('after_headline');

$error = false;
$file  = false;

// Check PHP version

if (!$error && !function_exists('version_compare'))
{ echo ("<p class=\"error\">PHP version 4.1.0 is required for BigDump to proceed. You have PHP ".phpversion()." installed. Sorry!</p>\n");
  $error=true;
}

// Check if mysql extension is available

if (!$error && !function_exists('mysqli_connect'))
{ echo ("<p class=\"error\">There is no mySQLi extension found in your PHP installation. You can use an older Bigdump version if your PHP supports mySQL extension.</p>\n");
  $error=true;
}

// Calculate PHP max upload size (handle settings like 10M or 100K)

if (!$error)
{ $upload_max_filesize=ini_get("upload_max_filesize");
  if (preg_match("/([0-9]+)K/i",$upload_max_filesize,$tempregs)) $upload_max_filesize=$tempregs[1]*1024;
  if (preg_match("/([0-9]+)M/i",$upload_max_filesize,$tempregs)) $upload_max_filesize=$tempregs[1]*1024*1024;
  if (preg_match("/([0-9]+)G/i",$upload_max_filesize,$tempregs)) $upload_max_filesize=$tempregs[1]*1024*1024*1024;
}

// Get the current directory
/*
if (isset($_SERVER["CGIA"]))
  $upload_dir=dirname($_SERVER["CGIA"]);
else if (isset($_SERVER["ORIG_PATH_TRANSLATED"]))
  $upload_dir=dirname($_SERVER["ORIG_PATH_TRANSLATED"]);
else if (isset($_SERVER["ORIG_SCRIPT_FILENAME"]))
  $upload_dir=dirname($_SERVER["ORIG_SCRIPT_FILENAME"]);
else if (isset($_SERVER["PATH_TRANSLATED"]))
  $upload_dir=dirname($_SERVER["PATH_TRANSLATED"]);
else 
  $upload_dir=dirname($_SERVER["SCRIPT_FILENAME"]);
*/
  
do_action ('script_runs');

// Handle file upload

if (!$error && isset($_REQUEST["uploadbutton"]))
{ if (is_uploaded_file($_FILES["dumpfile"]["tmp_name"]) && ($_FILES["dumpfile"]["error"])==0)
  { 
    $uploaded_filename=str_replace(" ","_",$_FILES["dumpfile"]["name"]);
    $uploaded_filename=preg_replace("/[^_A-Za-z0-9-\.]/i",'',$uploaded_filename);
    $uploaded_filepath=str_replace("\\","/",$upload_dir."/".$uploaded_filename);

    do_action('file_uploaded');

    if (file_exists($uploaded_filename))
    { echo ("<p class=\"error\">File $uploaded_filename already exist! Delete and upload again!</p>\n");
    }
    else if (!preg_match("/(\.(sql|gz|csv))$/i",$uploaded_filename))
    { echo ("<p class=\"error\">You may only upload .sql .gz or .csv files.</p>\n");
    }
    else if (!@move_uploaded_file($_FILES["dumpfile"]["tmp_name"],$uploaded_filepath))
    { echo ("<p class=\"error\">Error moving uploaded file ".$_FILES["dumpfile"]["tmp_name"]." to the $uploaded_filepath</p>\n");
      echo ("<p>Check the directory permissions for $upload_dir (must be 777)!</p>\n");
    }
    else
    { echo ("<p class=\"success\">Uploaded file saved as $uploaded_filename</p>\n");
    }
  }
  else
  { echo ("<p class=\"error\">Error uploading file ".$_FILES["dumpfile"]["name"]."</p>\n");
  }
}


// Handle file deletion (delete only in the current directory for security reasons)

if (!$error && isset($_REQUEST["delete"]) && $_REQUEST["delete"]!=basename($_SERVER["SCRIPT_FILENAME"]))
{ if (preg_match("/(\.(sql|gz|csv))$/i",$_REQUEST["delete"]) && @unlink($upload_dir.'/'.$_REQUEST["delete"])) 
    echo ("<p class=\"success\">".$_REQUEST["delete"]." was removed successfully</p>\n");
  else
    echo ("<p class=\"error\">Can't remove ".$_REQUEST["delete"]."</p>\n");
}

// Connect to the database, set charset and execute pre-queries

if (!$error && !TESTMODE)
{ $mysqli = new mysqli($db_server, $db_username, $db_password, $db_name);
  
  if (mysqli_connect_error()) 
  { echo ("<p class=\"error\">Database connection failed due to ".mysqli_connect_error()."</p>\n");
    echo ("<p>Edit the database settings in BigDump configuration, or contact your database provider.</p>\n");
    $error=true;
  }
  if (!$error && $db_connection_charset!=='')
    $mysqli->query("SET NAMES $db_connection_charset");

  if (!$error && isset ($pre_query) && sizeof ($pre_query)>0)
  { reset($pre_query);
    foreach ($pre_query as $pre_query_value)
    {	if (!$mysqli->query($pre_query_value))
    	{ echo ("<p class=\"error\">Error with pre-query.</p>\n");
      	echo ("<p>Query: ".trim(nl2br(htmlentities($pre_query_value)))."</p>\n");
      	echo ("<p>MySQL: ".$mysqli->error."</p>\n");
      	$error=true;
      	break;
     }
    }
  }
}
else
{ $dbconnection = false;
}

do_action('database_connected');

// DIAGNOSTIC
// echo("<h1>Checkpoint!</h1>");

// List uploaded files in multifile mode

if (!$error && !isset($_REQUEST["fn"]) && $filename=="")
{ if ($dirhandle = opendir($upload_dir)) 
  { 
    $files=array();
    while (false !== ($files[] = readdir($dirhandle)));
    closedir($dirhandle);
    $dirhead=false;

    if (sizeof($files)>0)
    { 
      sort($files);
      foreach ($files as $dirfile)
      { 
        if ($dirfile != "." && $dirfile != ".." && $dirfile!=basename($_SERVER["SCRIPT_FILENAME"]) && preg_match("/\.(sql|gz|csv)$/i",$dirfile))
        { if (!$dirhead)
          { echo ("<table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\">\n");
            echo ("<tr><th>Filename</th><th>Size</th><th>Date&amp;Time</th><th>Type</th><th>&nbsp;</th><th>&nbsp;</th>\n");
            $dirhead=true;
          }
          echo ("<tr><td>$dirfile</td><td class=\"right\">".filesize($upload_dir.'/'.$dirfile)."</td><td>".date ("Y-m-d H:i:s", filemtime($upload_dir.'/'.$dirfile))."</td>");

          if (preg_match("/\.sql$/i",$dirfile))
            echo ("<td>SQL</td>");
          elseif (preg_match("/\.gz$/i",$dirfile))
            echo ("<td>GZip</td>");
          elseif (preg_match("/\.csv$/i",$dirfile))
            echo ("<td>CSV</td>");
          else
            echo ("<td>Misc</td>");

          if ((preg_match("/\.gz$/i",$dirfile) && function_exists("gzopen")) || preg_match("/\.sql$/i",$dirfile) || preg_match("/\.csv$/i",$dirfile))
            echo ("<td><a href=\"".$_SERVER["PHP_SELF"]."?start=1&amp;fn=".urlencode($dirfile)."&amp;foffset=0&amp;totalqueries=0&amp;delimiter=".urlencode($delimiter)."\">Start Import</a> into $db_name at $db_server</td>\n <td><a href=\"".$_SERVER["PHP_SELF"]."?delete=".urlencode($dirfile)."\">Delete file</a></td></tr>\n");
// TODO: echo ("<td><a href=\"".$_SERVER["PHP_SELF"]."?start=1&amp;fn=".urlencode($dirfile)."&amp;foffset=0&amp;totalqueries=0&amp;delimiter=".urlencode($delimiter)."\">Start Import</a></td>\n <td><a href=\"".$_SERVER["PHP_SELF"]."?delete=".urlencode($dirfile)."\">Delete file</a></td></tr>\n");
          else
            echo ("<td>&nbsp;</td>\n <td>&nbsp;</td></tr>\n");
        }
      }
    }

    if ($dirhead) 
      echo ("</table>\n");
    else 
      echo ("<p>No uploaded SQL, GZ or CSV files found in the working directory</p>\n");
  }
  else
  { echo ("<p class=\"error\">Error listing directory $upload_dir</p>\n");
    $error=true;
  }
}


// Single file mode

if (!$error && !isset ($_REQUEST["fn"]) && $filename!="")
{ echo ("<p><a href=\"".$_SERVER["PHP_SELF"]."?start=1&amp;fn=".urlencode($filename)."&amp;foffset=0&amp;totalqueries=0\">Start Import</a> from $filename into $db_name at $db_server</p>\n");
}


// File Upload Form

if (!$error && !isset($_REQUEST["fn"]) && $filename=="")
{ 

// Test permissions on working directory

  do { $tempfilename=$upload_dir.'/'.time().".tmp"; } while (file_exists($tempfilename)); 
  if (!($tempfile=@fopen($tempfilename,"w")))
  { echo ("<p>Upload form disabled. Permissions for the working directory <i>$upload_dir</i> <b>must be set writable for the webserver</b> in order ");
    echo ("to upload files here. Alternatively you can upload your dump files via FTP.</p>\n");
  }
  else
  { fclose($tempfile);
    unlink ($tempfilename);
 
    echo ("<p>You can now upload your dump file up to $upload_max_filesize bytes (".round ($upload_max_filesize/1024/1024)." Mbytes)  ");
    echo ("directly from your browser to the server. Alternatively you can upload your dump files of any size via FTP.</p>\n");
?>
<form method="POST" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="$upload_max_filesize">
<p>Dump file: <input type="file" name="dumpfile" accept="*/*" size="60"></p>
<p><input type="submit" name="uploadbutton" value="Upload"></p>
</form>
<?php
  }
}

// Print the current mySQL connection charset

if (!$error && !TESTMODE && !isset($_REQUEST["fn"]))
{ 
  $result = $mysqli->query("SHOW VARIABLES LIKE 'character_set_connection';");
  if ($result) 
  { $row = $result->fetch_assoc();
    if ($row) 
    { $charset = $row['Value'];
      echo ("<p>Note: The current mySQL connection charset is <i>$charset</i>. Your dump file must be encoded in <i>$charset</i> in order to avoid problems with non-latin characters. You can change the connection charset using the \$db_connection_charset variable in bigdump.php</p>\n");
    }
    $result->free();
  }
}

// Open the file

if (!$error && isset($_REQUEST["start"]))
{ 

// Set current filename ($filename overrides $_REQUEST["fn"] if set)

  if ($filename!="")
    $curfilename=$filename;
  else if (isset($_REQUEST["fn"]))
    $curfilename=urldecode($_REQUEST["fn"]);
  else
    $curfilename="";

// Recognize GZip filename

  if (preg_match("/\.gz$/i",$curfilename)) 
    $gzipmode=true;
  else
    $gzipmode=false;

  if ((!$gzipmode && !$file=@fopen($upload_dir.'/'.$curfilename,"r")) || ($gzipmode && !$file=@gzopen($upload_dir.'/'.$curfilename,"r")))
  { echo ("<p class=\"error\">Can't open ".$curfilename." for import</p>\n");
    echo ("<p>Please, check that your dump file name contains only alphanumerical characters, and rename it accordingly, for example: $curfilename.".
           "<br>Or, specify \$filename in bigdump.php with the full filename. ".
           "<br>Or, you have to upload the $curfilename to the server first.</p>\n");
    $error=true;
  }

// Get the file size (can't do it fast on gzipped files, no idea how)

  else if ((!$gzipmode && @fseek($file, 0, SEEK_END)==0) || ($gzipmode && @gzseek($file, 0)==0))
  { if (!$gzipmode) $filesize = ftell($file);
    else $filesize = gztell($file);                   // Always zero, ignore
  }
  else
  { echo ("<p class=\"error\">I can't seek into $curfilename</p>\n");
    $error=true;
  }

// Stop if csv file is used, but $csv_insert_table is not set

  if (!$error && ($csv_insert_table == "") && (preg_match("/(\.csv)$/i",$curfilename)))
  { echo ("<p class=\"error\">You have to specify \$csv_insert_table when using a CSV file. </p>\n");
    $error=true;
  }
}


// *******************************************************************************************
// START IMPORT SESSION HERE
// *******************************************************************************************

if (!$error && isset($_REQUEST["start"]) && isset($_REQUEST["foffset"]) && preg_match("/(\.(sql|gz|csv))$/i",$curfilename))
{

  do_action('session_start');

// Check start and foffset are numeric values

  if (!is_numeric($_REQUEST["start"]) || !is_numeric($_REQUEST["foffset"]))
  { echo ("<p class=\"error\">UNEXPECTED: Non-numeric values for start and foffset</p>\n");
    $error=true;
  }
  else
  {	$_REQUEST["start"]   = floor($_REQUEST["start"]);
    $_REQUEST["foffset"] = floor($_REQUEST["foffset"]);
  }

// Set the current delimiter if defined

  if (isset($_REQUEST["delimiter"]))
    $delimiter = $_REQUEST["delimiter"];

// Empty CSV table if requested

  if (!$error && $_REQUEST["start"]==1 && $csv_insert_table != "" && $csv_preempty_table)
  { 
    $query = "DELETE FROM `$csv_insert_table`";
    if (!TESTMODE && !$mysqli->query(trim($query)))
    { echo ("<p class=\"error\">Error when deleting entries from $csv_insert_table.</p>\n");
      echo ("<p>Query: ".trim(nl2br(htmlentities($query)))."</p>\n");
      echo ("<p>MySQL: ".$mysqli->error."</p>\n");
      $error=true;
    }
  }
  
// Print start message

  if (!$error)
  { skin_open();
    if (TESTMODE) 
      echo ("<p class=\"centr\">TEST MODE ENABLED</p>\n");
    echo ("<p class=\"centr\">Processing file: <b>".$curfilename."</b></p>\n");
    echo ("<p class=\"smlcentr\">Starting from line: ".$_REQUEST["start"]."</p>\n");	
    skin_close();
  }

// Check $_REQUEST["foffset"] upon $filesize (can't do it on gzipped files)

  if (!$error && !$gzipmode && $_REQUEST["foffset"]>$filesize)
  { echo ("<p class=\"error\">UNEXPECTED: Can't set file pointer behind the end of file</p>\n");
    $error=true;
  }

// Set file pointer to $_REQUEST["foffset"]

  if (!$error && ((!$gzipmode && fseek($file, $_REQUEST["foffset"])!=0) || ($gzipmode && gzseek($file, $_REQUEST["foffset"])!=0)))
  { echo ("<p class=\"error\">UNEXPECTED: Can't set file pointer to offset: ".$_REQUEST["foffset"]."</p>\n");
    $error=true;
  }

// Start processing queries from $file

  if (!$error)
  { $query="";
    $queries=0;
    $totalqueries=$_REQUEST["totalqueries"];
    $linenumber=$_REQUEST["start"];
    $querylines=0;
    $inparents=false;

// Stay processing as long as the $linespersession is not reached or the query is still incomplete

    while ($linenumber<$_REQUEST["start"]+$linespersession || $query!="")
    {

// Read the whole next line

      $dumpline = "";
      while (!feof($file) && substr ($dumpline, -1) != "\n" && substr ($dumpline, -1) != "\r")
      { if (!$gzipmode)
          $dumpline .= fgets($file, DATA_CHUNK_LENGTH);
        else
          $dumpline .= gzgets($file, DATA_CHUNK_LENGTH);
      }
      if ($dumpline==="") break;

// Remove UTF8 Byte Order Mark at the file beginning if any

      if ($_REQUEST["foffset"]==0)
        $dumpline=preg_replace('|^\xEF\xBB\xBF|','',$dumpline);

// Create an SQL query from CSV line

      if (($csv_insert_table != "") && (preg_match("/(\.csv)$/i",$curfilename)))
      {
        if ($csv_add_slashes)
          $dumpline = addslashes($dumpline);
        $dumpline = explode($csv_delimiter,$dumpline);
        if ($csv_add_quotes)
          $dumpline = "'".implode("','",$dumpline)."'";
        else
          $dumpline = implode(",",$dumpline);
        $dumpline = 'INSERT INTO '.$csv_insert_table.' VALUES ('.$dumpline.');';
      }

// Handle DOS and Mac encoded linebreaks (I don't know if it really works on Win32 or Mac Servers)

      $dumpline=str_replace("\r\n", "\n", $dumpline);
      $dumpline=str_replace("\r", "\n", $dumpline);
            
// DIAGNOSTIC
// echo ("<p>Line $linenumber: $dumpline</p>\n");

// Recognize delimiter statement

      if (!$inparents && strpos ($dumpline, "DELIMITER ") === 0)
        $delimiter = str_replace ("DELIMITER ","",trim($dumpline));

// Skip comments and blank lines only if NOT in parents

      if (!$inparents)
      { $skipline=false;
        reset($comment);
        foreach ($comment as $comment_value)
        { 

// DIAGNOSTIC
//          echo ($comment_value);
          if (trim($dumpline)=="" || strpos (trim($dumpline), $comment_value) === 0)
          { $skipline=true;
            break;
          }
        }
        if ($skipline)
        { $linenumber++;

// DIAGNOSTIC
// echo ("<p>Comment line skipped</p>\n");

          continue;
        }
      }

// Remove double back-slashes from the dumpline prior to count the quotes ('\\' can only be within strings)
      
      $dumpline_deslashed = str_replace ("\\\\","",$dumpline);

// Count ' and \' (or " and \") in the dumpline to avoid query break within a text field ending by $delimiter

      $parents=substr_count ($dumpline_deslashed, $string_quotes)-substr_count ($dumpline_deslashed, "\\$string_quotes");
      if ($parents % 2 != 0)
        $inparents=!$inparents;

// Add the line to query

      $query .= $dumpline;

// Don't count the line if in parents (text fields may include unlimited linebreaks)
      
      if (!$inparents)
        $querylines++;
      
// Stop if query contains more lines as defined by $max_query_lines

      if ($querylines>$max_query_lines)
      {
        echo ("<p class=\"error\">Stopped at the line $linenumber. </p>");
        echo ("<p>At this place the current query includes more than ".$max_query_lines." dump lines. That can happen if your dump file was ");
        echo ("created by some tool which doesn't place a semicolon followed by a linebreak at the end of each query, or if your dump contains ");
        echo ("extended inserts or very long procedure definitions. Please read the <a href=\"http://www.ozerov.de/bigdump/usage/\">BigDump usage notes</a> ");
        echo ("for more infos. Ask for our support services ");
        echo ("in order to handle dump files containing extended inserts.</p>\n");
        $error=true;
        break;
      }

// Execute query if end of query detected ($delimiter as last character) AND NOT in parents

// DIAGNOSTIC
// echo ("<p>Regex: ".'/'.preg_quote($delimiter).'$/'."</p>\n");
// echo ("<p>In Parents: ".($inparents?"true":"false")."</p>\n");
// echo ("<p>Line: $dumpline</p>\n");

      if ((preg_match('/'.preg_quote($delimiter,'/').'$/',trim($dumpline)) || $delimiter=='') && !$inparents)
      { 

// Cut off delimiter of the end of the query

        $query = substr(trim($query),0,-1*strlen($delimiter));

// DIAGNOSTIC
// echo ("<p>Query: ".trim(nl2br(htmlentities($query)))."</p>\n");

        if (!TESTMODE && !$mysqli->query($query))
        { echo ("<p class=\"error\">Error at the line $linenumber: ". trim($dumpline)."</p>\n");
          echo ("<p>Query: ".trim(nl2br(htmlentities($query)))."</p>\n");
          echo ("<p>MySQL: ".$mysqli->error."</p>\n");
          $error=true;
          break;
        }
        $totalqueries++;
        $queries++;
        $query="";
        $querylines=0;
      }
      $linenumber++;
    }
  }

// Get the current file position

  if (!$error)
  { if (!$gzipmode) 
      $foffset = ftell($file);
    else
      $foffset = gztell($file);
    if (!$foffset)
    { echo ("<p class=\"error\">UNEXPECTED: Can't read the file pointer offset</p>\n");
      $error=true;
    }
  }

// Print statistics

skin_open();

// echo ("<p class=\"centr\"><b>Statistics</b></p>\n");

  if (!$error)
  { 
    $lines_this   = $linenumber-$_REQUEST["start"];
    $lines_done   = $linenumber-1;
    $lines_togo   = ' ? ';
    $lines_tota   = ' ? ';
    
    $queries_this = $queries;
    $queries_done = $totalqueries;
    $queries_togo = ' ? ';
    $queries_tota = ' ? ';

    $bytes_this   = $foffset-$_REQUEST["foffset"];
    $bytes_done   = $foffset;
    $kbytes_this  = round($bytes_this/1024,2);
    $kbytes_done  = round($bytes_done/1024,2);
    $mbytes_this  = round($kbytes_this/1024,2);
    $mbytes_done  = round($kbytes_done/1024,2);
   
    if (!$gzipmode)
    {
      $bytes_togo  = $filesize-$foffset;
      $bytes_tota  = $filesize;
      $kbytes_togo = round($bytes_togo/1024,2);
      $kbytes_tota = round($bytes_tota/1024,2);
      $mbytes_togo = round($kbytes_togo/1024,2);
      $mbytes_tota = round($kbytes_tota/1024,2);
      
      $pct_this   = ceil($bytes_this/$filesize*100);
      $pct_done   = ceil($foffset/$filesize*100);
      $pct_togo   = 100 - $pct_done;
      $pct_tota   = 100;

      if ($bytes_togo==0) 
      { $lines_togo   = '0'; 
        $lines_tota   = $linenumber-1; 
        $queries_togo = '0'; 
        $queries_tota = $totalqueries; 
      }

      $pct_bar    = "<div style=\"height:15px;width:$pct_done%;background-color:#000080;margin:0px;\"></div>";
    }
    else
    {
      $bytes_togo  = ' ? ';
      $bytes_tota  = ' ? ';
      $kbytes_togo = ' ? ';
      $kbytes_tota = ' ? ';
      $mbytes_togo = ' ? ';
      $mbytes_tota = ' ? ';
      
      $pct_this    = ' ? ';
      $pct_done    = ' ? ';
      $pct_togo    = ' ? ';
      $pct_tota    = 100;
      $pct_bar     = str_replace(' ','&nbsp;','<tt>[         Not available for gzipped files          ]</tt>');
    }
    
    echo ("
    <center>
    <table width=\"520\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\">
    <tr><th class=\"bg4\"> </th><th class=\"bg4\">Session</th><th class=\"bg4\">Done</th><th class=\"bg4\">To go</th><th class=\"bg4\">Total</th></tr>
    <tr><th class=\"bg4\">Lines</th><td class=\"bg3\">$lines_this</td><td class=\"bg3\">$lines_done</td><td class=\"bg3\">$lines_togo</td><td class=\"bg3\">$lines_tota</td></tr>
    <tr><th class=\"bg4\">Queries</th><td class=\"bg3\">$queries_this</td><td class=\"bg3\">$queries_done</td><td class=\"bg3\">$queries_togo</td><td class=\"bg3\">$queries_tota</td></tr>
    <tr><th class=\"bg4\">Bytes</th><td class=\"bg3\">$bytes_this</td><td class=\"bg3\">$bytes_done</td><td class=\"bg3\">$bytes_togo</td><td class=\"bg3\">$bytes_tota</td></tr>
    <tr><th class=\"bg4\">KB</th><td class=\"bg3\">$kbytes_this</td><td class=\"bg3\">$kbytes_done</td><td class=\"bg3\">$kbytes_togo</td><td class=\"bg3\">$kbytes_tota</td></tr>
    <tr><th class=\"bg4\">MB</th><td class=\"bg3\">$mbytes_this</td><td class=\"bg3\">$mbytes_done</td><td class=\"bg3\">$mbytes_togo</td><td class=\"bg3\">$mbytes_tota</td></tr>
    <tr><th class=\"bg4\">%</th><td class=\"bg3\">$pct_this</td><td class=\"bg3\">$pct_done</td><td class=\"bg3\">$pct_togo</td><td class=\"bg3\">$pct_tota</td></tr>
    <tr><th class=\"bg4\">% bar</th><td class=\"bgpctbar\" colspan=\"4\">$pct_bar</td></tr>
    </table>
    </center>
    \n");

// Finish message and restart the script

    if ($linenumber<$_REQUEST["start"]+$linespersession)
    { echo ("<p class=\"successcentr\">Congratulations: End of file reached, assuming OK</p>\n");
      echo ("<p class=\"successcentr\">IMPORTANT: REMOVE YOUR DUMP FILE and BIGDUMP SCRIPT FROM SERVER NOW!</p>\n");
      echo ("<p class=\"centr\">Thank you for using this tool! Please rate <a href=\"http://www.hotscripts.com/listing/bigdump/?RID=403\" target=\"_blank\">Bigdump at Hotscripts.com</a></p>\n");
      echo ("<p class=\"centr\">You can send me some bucks or euros as appreciation via PayPal. Thank you!</p>\n");
?>

<!-- Start Paypal donation code -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick" />
<input type="hidden" name="business" value="alexey@ozerov.de" />
<input type="hidden" name="item_name" value="BigDump Donation" />
<input type="hidden" name="no_shipping" value="1" />
<input type="hidden" name="no_note" value="0" />
<input type="hidden" name="tax" value="0" />
<input type="hidden" name="bn" value="PP-DonationsBF" />
<input type="hidden" name="lc" value="US" />
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
</form>
<!-- End Paypal donation code -->

<?php      
      do_action('script_finished');
      $error=true; // This is a semi-error telling the script is finished
    }
    else
    { if ($delaypersession!=0)
        echo ("<p class=\"centr\">Now I'm <b>waiting $delaypersession milliseconds</b> before starting next session...</p>\n");
      if (!$ajax) 
        echo ("<script language=\"JavaScript\" type=\"text/javascript\">window.setTimeout('location.href=\"".$_SERVER["PHP_SELF"]."?start=$linenumber&fn=".urlencode($curfilename)."&foffset=$foffset&totalqueries=$totalqueries&delimiter=".urlencode($delimiter)."\";',500+$delaypersession);</script>\n");

      echo ("<noscript>\n");
      echo ("<p class=\"centr\"><a href=\"".$_SERVER["PHP_SELF"]."?start=$linenumber&amp;fn=".urlencode($curfilename)."&amp;foffset=$foffset&amp;totalqueries=$totalqueries&amp;delimiter=".urlencode($delimiter)."\">Continue from the line $linenumber</a> (Enable JavaScript to do it automatically)</p>\n");
      echo ("</noscript>\n");
   
      echo ("<p class=\"centr\">Press <b><a href=\"".$_SERVER["PHP_SELF"]."\">STOP</a></b> to abort the import <b>OR WAIT!</b></p>\n");
    }
  }
  else 
    echo ("<p class=\"error\">Stopped on error</p>\n");

skin_close();

}

if ($error)
  echo ("<p class=\"centr\"><a href=\"".$_SERVER["PHP_SELF"]."\">Start from the beginning</a> (DROP the old tables before restarting)</p>\n");

if ($mysqli) $mysqli->close();
if ($file && !$gzipmode) fclose($file);
else if ($file && $gzipmode) gzclose($file);

?>

<p class="centr">&copy; 2003-2015 <a href="mailto:alexey@ozerov.de">Alexey Ozerov</a></p>

</td></tr></table>

</center>
<?php do_action('end_of_body'); ?>
</body>
</html>

<?php

// If error or finished put out the whole output from above and stop

if ($error) 
{
  $out1 = ob_get_contents();
  ob_end_clean();
  echo $out1;
  die;
}

// If Ajax enabled and in import progress creates responses  (XML response or script for the initial page)

if ($ajax && isset($_REQUEST['start']))
{
  if (isset($_REQUEST['ajaxrequest'])) 
  {	ob_end_clean();
	  create_xml_response();
	  die;
  } 
  else 
    create_ajax_script();	  
}

// Anyway put out the output from above

ob_flush();

// THE MAIN SCRIPT ENDS HERE

// *******************************************************************************************
// Plugin handling (EXPERIMENTAL)
// *******************************************************************************************

function do_action($tag)
{ global $plugin_actions;
  
  if (isset($plugin_actions[$tag]))
  { reset ($plugin_actions[$tag]);
    foreach ($plugin_actions[$tag] as $action)
      call_user_func_array($action, array());
  }
}

function add_action($tag, $function)
{
	global $plugin_actions;
	$plugin_actions[$tag][] = $function;
}

// *******************************************************************************************
// 				AJAX utilities
// *******************************************************************************************

function create_xml_response() 
{
  global $linenumber, $foffset, $totalqueries, $curfilename, $delimiter,
				 $lines_this, $lines_done, $lines_togo, $lines_tota,
				 $queries_this, $queries_done, $queries_togo, $queries_tota,
				 $bytes_this, $bytes_done, $bytes_togo, $bytes_tota,
				 $kbytes_this, $kbytes_done, $kbytes_togo, $kbytes_tota,
				 $mbytes_this, $mbytes_done, $mbytes_togo, $mbytes_tota,
				 $pct_this, $pct_done, $pct_togo, $pct_tota,$pct_bar;

	header('Content-Type: application/xml');
	header('Cache-Control: no-cache');
	
	echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
	echo "<root>";

// data - for calculations

	echo "<linenumber>$linenumber</linenumber>";
	echo "<foffset>$foffset</foffset>";
	echo "<fn>$curfilename</fn>";
	echo "<totalqueries>$totalqueries</totalqueries>";
	echo "<delimiter>$delimiter</delimiter>";

// results - for page update

	echo "<elem1>$lines_this</elem1>";
	echo "<elem2>$lines_done</elem2>";
	echo "<elem3>$lines_togo</elem3>";
	echo "<elem4>$lines_tota</elem4>";
	
	echo "<elem5>$queries_this</elem5>";
	echo "<elem6>$queries_done</elem6>";
	echo "<elem7>$queries_togo</elem7>";
	echo "<elem8>$queries_tota</elem8>";
	
	echo "<elem9>$bytes_this</elem9>";
	echo "<elem10>$bytes_done</elem10>";
	echo "<elem11>$bytes_togo</elem11>";
	echo "<elem12>$bytes_tota</elem12>";
			
	echo "<elem13>$kbytes_this</elem13>";
	echo "<elem14>$kbytes_done</elem14>";
	echo "<elem15>$kbytes_togo</elem15>";
	echo "<elem16>$kbytes_tota</elem16>";
	
	echo "<elem17>$mbytes_this</elem17>";
	echo "<elem18>$mbytes_done</elem18>";
	echo "<elem19>$mbytes_togo</elem19>";
	echo "<elem20>$mbytes_tota</elem20>";
	
	echo "<elem21>$pct_this</elem21>";
	echo "<elem22>$pct_done</elem22>";
	echo "<elem23>$pct_togo</elem23>";
	echo "<elem24>$pct_tota</elem24>";
	echo "<elem_bar>".htmlentities($pct_bar)."</elem_bar>";
				
	echo "</root>";		
}


function create_ajax_script() 
{
  global $linenumber, $foffset, $totalqueries, $delaypersession, $curfilename, $delimiter;
?>

	<script type="text/javascript" language="javascript">			

	// creates next action url (upload page, or XML response)
	function get_url(linenumber,fn,foffset,totalqueries,delimiter) {
		return "<?php echo $_SERVER['PHP_SELF'] ?>?start="+linenumber+"&fn="+fn+"&foffset="+foffset+"&totalqueries="+totalqueries+"&delimiter="+delimiter+"&ajaxrequest=true";
	}
	
	// extracts text from XML element (itemname must be unique)
	function get_xml_data(itemname,xmld) {
		return xmld.getElementsByTagName(itemname).item(0).firstChild.data;
	}
	
	function makeRequest(url) {
		http_request = false;
		if (window.XMLHttpRequest) { 
		// Mozilla etc.
			http_request = new XMLHttpRequest();
			if (http_request.overrideMimeType) {
				http_request.overrideMimeType("text/xml");
			}
		} else if (window.ActiveXObject) { 
		// IE
			try {
				http_request = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				try {
					http_request = new ActiveXObject("Microsoft.XMLHTTP");
				} catch(e) {}
			}
		}
		if (!http_request) {
				alert("Cannot create an XMLHTTP instance");
				return false;
		}
		http_request.onreadystatechange = server_response;
		http_request.open("GET", url, true);
		http_request.send(null);
	}
	
	function server_response() 
	{

	  // waiting for correct response
	  if (http_request.readyState != 4)
		return;

	  if (http_request.status != 200) 
	  {
	    alert("Page unavailable, or wrong url!")
	    return;
	  }
		
		// r = xml response
		var r = http_request.responseXML;
		
		//if received not XML but HTML with new page to show
		if (!r || r.getElementsByTagName('root').length == 0) 
		{	var text = http_request.responseText;
			document.open();
			document.write(text);		
			document.close();	
			return;		
		}
		
		// update "Starting from line: "
		document.getElementsByTagName('p').item(1).innerHTML = 
			"Starting from line: " + 
			   r.getElementsByTagName('linenumber').item(0).firstChild.nodeValue;
		
		// update table with new values
		for(i = 1; i <= 24; i++)
			document.getElementsByTagName('td').item(i).firstChild.data = get_xml_data('elem'+i,r);
		
		// update color bar
		document.getElementsByTagName('td').item(25).innerHTML = 
			r.getElementsByTagName('elem_bar').item(0).firstChild.nodeValue;
			 
		// action url (XML response)	 
		url_request =  get_url(
			get_xml_data('linenumber',r),
			get_xml_data('fn',r),
			get_xml_data('foffset',r),
			get_xml_data('totalqueries',r),
			get_xml_data('delimiter',r));
		
		// ask for XML response	
		window.setTimeout("makeRequest(url_request)",500+<?php echo $delaypersession; ?>);
	}

	// First Ajax request from initial page

	var http_request = false;
	var url_request =  get_url(<?php echo ($linenumber.',"'.urlencode($curfilename).'",'.$foffset.','.$totalqueries.',"'.urlencode($delimiter).'"') ;?>);
	window.setTimeout("makeRequest(url_request)",500+<?php echo $delaypersession; ?>);
	</script>

<?php
}

?>

