<?PHP

function displayLogin() {
header("WWW-Authenticate: Basic realm=\"Viking Management Platform\"");
header("HTTP/1.0 401 Unauthorized");
echo "<h2>Authentication Failure</h2>";
echo "La contrase�a que ha introducido no es v�lida. Refresque la p�gina e int�ntelo de nuevo.";
exit;
}

require "conexion.inc";
require "checklogin.inc";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
        <meta http-equiv="refresh" content="10">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15">
	<title>Llamadas Actuales</title>
	<link rel="stylesheet" href="pages_style.css">
</head>
<body>
<h3>Llamadas actuales</h3>
<?php

/*
 * IMPORTANT NOTE: This generated file contains only a subset of huge amount
 * of options that can be used with phpMyEdit. To get information about all
 * features offered by phpMyEdit, check official documentation. It is available
 * online and also for download on phpMyEdit project management page:
 *
 * http://platon.sk/projects/main_page.php?project_id=5
 *
 * This file was generated by:
 *
 *                    phpMyEdit version: 5.7.1
 *       phpMyEdit.class.php core class: 1.204
 *            phpMyEditSetup.php script: 1.50
 *              generating setup script: 1.50
 */

// MySQL host name, user name, password, database, and table
$opts['hn'] = 'localhost';
$opts['un'] = 'viking';
$opts['pw'] = 'V1k1ng';
$opts['db'] = 'viking';
$opts['tb'] = 'channels';

// Name of field which is the unique key
$opts['key'] = 'id';

// Type of key field (int/real/string/date etc.)
$opts['key_type'] = 'int';

// Sorting field(s)
$opts['sort_field'] = array('id');

// Number of records to display on the screen
// Value of -1 lists all records in a table
$opts['inc'] = 60;

// Options you wish to give the users
// A - add,  C - change, P - copy, V - view, D - delete,
// F - filter, I - initial sort suppressed
$opts['options'] = 'VF';

// Number of lines to display on multiple selection filters
$opts['multiple'] = '4';

// Navigation style: B - buttons (default), T - text links, G - graphic links
// Buttons position: U - up, D - down (default)
$opts['navigation'] = 'DB';

// Display special page elements
$opts['display'] = array(
	'form'  => true,
	'query' => true,
	'sort'  => true,
	'time'  => true,
	'tabs'  => true
);

// Set default prefixes for variables
$opts['js']['prefix']               = 'PME_js_';
$opts['dhtml']['prefix']            = 'PME_dhtml_';
$opts['cgi']['prefix']['operation'] = 'PME_op_';
$opts['cgi']['prefix']['sys']       = 'PME_sys_';
$opts['cgi']['prefix']['data']      = 'PME_data_';

/* Get the user's default language and use it if possible or you can
   specify particular one you want to use. Refer to official documentation
   for list of available languages. */
$opts['language'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '-UTF8';

/* Table-level filter capability. If set, it is included in the WHERE clause
   of any generated SELECT statement in SQL query. This gives you ability to
   work only with subset of data from table.

$opts['filters'] = "column1 like '%11%' AND column2<17";
$opts['filters'] = "section_id = 9";
$opts['filters'] = "PMEtable0.sessions_count > 200";
*/

/* Field definitions
   
Fields will be displayed left to right on the screen in the order in which they
appear in generated list. Here are some most used field options documented.

['name'] is the title used for column headings, etc.;
['maxlen'] maximum length to display add/edit/search input boxes
['trimlen'] maximum length of string content to display in row listing
['width'] is an optional display width specification for the column
          e.g.  ['width'] = '100px';
['mask'] a string that is used by sprintf() to format field output
['sort'] true or false; means the users may sort the display on this column
['strip_tags'] true or false; whether to strip tags from content
['nowrap'] true or false; whether this field should get a NOWRAP
['select'] T - text, N - numeric, D - drop-down, M - multiple selection
['options'] optional parameter to control whether a field is displayed
  L - list, F - filter, A - add, C - change, P - copy, D - delete, V - view
            Another flags are:
            R - indicates that a field is read only
            W - indicates that a field is a password field
            H - indicates that a field is to be hidden and marked as hidden
['URL'] is used to make a field 'clickable' in the display
        e.g.: 'mailto:$value', 'http://$value' or '$page?stuff';
['URLtarget']  HTML target link specification (for example: _blank)
['textarea']['rows'] and/or ['textarea']['cols']
  specifies a textarea is to be used to give multi-line input
  e.g. ['textarea']['rows'] = 5; ['textarea']['cols'] = 10
['values'] restricts user input to the specified constants,
           e.g. ['values'] = array('A','B','C') or ['values'] = range(1,99)
['values']['table'] and ['values']['column'] restricts user input
  to the values found in the specified column of another table
['values']['description'] = 'desc_column'
  The optional ['values']['description'] field allows the value(s) displayed
  to the user to be different to those in the ['values']['column'] field.
  This is useful for giving more meaning to column values. Multiple
  descriptions fields are also possible. Check documentation for this.
*/

$opts['fdd']['id'] = array(
  'name'     => 'ID',
  'select'   => 'T',
  'options'  => 'AVCPDRH', // auto increment
  'maxlen'   => 11,
  'default'  => '0',
  'sort'     => true
);
$opts['fdd']['uuid'] = array(
  'name'     => 'Uuid',
  'options'  => 'H',
  'select'   => 'T',
  'maxlen'   => 256,
  'sort'     => true
);
$opts['fdd']['direction'] = array(
  'name'     => 'Direction',
  'select'   => 'T',
  'options'  => 'H',
  'maxlen'   => 32,
  'sort'     => true
);
$opts['fdd']['created'] = array(
  'name'     => 'Created',
  'select'   => 'T',
  'maxlen'   => 128,
  'sort'     => true
);
$opts['fdd']['created_epoch'] = array(
  'name'     => 'Created epoch',
  'select'   => 'T',
  'options'  => 'H',
  'maxlen'   => 11,
  'sort'     => true
);
$opts['fdd']['name'] = array(
  'name'     => 'Name',
  'select'   => 'T',
  'maxlen'   => 1024,
  'options'  => 'H',
  'sort'     => true
);
$opts['fdd']['state'] = array(
  'name'     => 'State',
  'select'   => 'T',
  'maxlen'   => 64,
  'sort'     => true
);
$opts['fdd']['cid_name'] = array(
  'name'     => 'Cid name',
  'options'  => 'H',
  'select'   => 'T',
  'maxlen'   => 1024,
  'sort'     => true
);
$opts['fdd']['cid_num'] = array(
  'name'     => 'Cid num',
  'select'   => 'T',
  'maxlen'   => 256,
  'sort'     => true
);
$opts['fdd']['ip_addr'] = array(
  'name'     => 'Ip addr',
  'select'   => 'T',
  'maxlen'   => 256,
  'sort'     => true
);
$opts['fdd']['dest'] = array(
  'name'     => 'Dest',
  'select'   => 'T',
  'maxlen'   => 1024,
  'sort'     => true
);
$opts['fdd']['application'] = array(
  'name'     => 'Application',
  'options'  => 'H',
  'select'   => 'T',
  'maxlen'   => 128,
  'sort'     => true
);
$opts['fdd']['application_data'] = array(
  'name'     => 'Application data',
  'select'   => 'T',
  'options'  => 'H',
  'maxlen'   => 4096,
  'sort'     => true
);
$opts['fdd']['dialplan'] = array(
  'name'     => 'Dialplan',
  'select'   => 'T',
  'options'  => 'H',
  'maxlen'   => 128,
  'sort'     => true
);
$opts['fdd']['context'] = array(
  'name'     => 'Context',
  'select'   => 'T',
  'maxlen'   => 128,
  'sort'     => true
);
$opts['fdd']['read_codec'] = array(
  'name'     => 'Read codec',
  'select'   => 'T',
  'maxlen'   => 128,
  'sort'     => true
);
$opts['fdd']['read_rate'] = array(
  'name'     => 'Read rate',
  'select'   => 'T',
  'options'  => 'H',
  'maxlen'   => 32,
  'sort'     => true
);
$opts['fdd']['read_bit_rate'] = array(
  'name'     => 'Read bit rate',
  'select'   => 'T',
  'options'  => 'H',
  'maxlen'   => 32,
  'sort'     => true
);
$opts['fdd']['write_codec'] = array(
  'name'     => 'Write codec',
  'select'   => 'T',
  'maxlen'   => 128,
  'sort'     => true
);
$opts['fdd']['write_rate'] = array(
  'name'     => 'Write rate',
  'select'   => 'T',
  'options'  => 'H',
  'maxlen'   => 32,
  'sort'     => true
);
$opts['fdd']['write_bit_rate'] = array(
  'name'     => 'Write bit rate',
  'select'   => 'T',
  'options'  => 'H',
  'maxlen'   => 32,
  'sort'     => true
);
$opts['fdd']['secure'] = array(
  'name'     => 'Secure',
  'select'   => 'T',
  'maxlen'   => 32,
  'options'  => 'H',
  'sort'     => true
);
$opts['fdd']['hostname'] = array(
  'name'     => 'Hostname',
  'select'   => 'T',
  'options'  => 'H',
  'maxlen'   => 256,
  'sort'     => true
);
$opts['fdd']['presence_id'] = array(
  'name'     => 'Presence ID',
  'select'   => 'T',
  'options'  => 'H',
  'maxlen'   => 4096,
  'sort'     => true
);
$opts['fdd']['presence_data'] = array(
  'name'     => 'Presence data',
  'select'   => 'T',
  'options'  => 'H',
  'maxlen'   => 4096,
  'sort'     => true
);
$opts['fdd']['callstate'] = array(
  'name'     => 'Callstate',
  'select'   => 'T',
  'maxlen'   => 45,
  'sort'     => true
);
$opts['fdd']['callee_name'] = array(
  'name'     => 'Callee name',
  'options'  => 'H',
  'select'   => 'T',
  'maxlen'   => 256,
  'sort'     => true
);
$opts['fdd']['callee_num'] = array(
  'name'     => 'Callee num',
  'select'   => 'T',
  'maxlen'   => 256,
  'sort'     => true
);
$opts['fdd']['callee_direction'] = array(
  'name'     => 'Callee direction',
  'select'   => 'T',
  'maxlen'   => 256,
  'sort'     => true
);
$opts['fdd']['call_uuid'] = array(
  'name'     => 'Call uuid',
  'options'  => 'H',
  'select'   => 'T',
  'maxlen'   => 45,
  'sort'     => true
);

// Now important call to phpMyEdit
require_once 'phpmyedit/phpMyEdit.class.php';
new phpMyEdit($opts);

?>


</body>
</html>
