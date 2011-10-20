<?PHP

require "conexion.inc";
require "checklogin.inc";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15">
	<title>Report by provider</title>
	<link rel="stylesheet" href="pages_style.css">
</head>
<script language="javascript">
     function setdata(){
          tbl = document.getElementById('includedata').value;
          if(document.getElementById('includedata').value=="include"){
               document.getElementById('includedata').value="";
          }else{
               document.getElementById('includedata').value="include";
          }
     }


</script>

<script type="text/javascript" src="calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/
</script>
<body>
<h3>Report by provider</h3>
<form action="provider_report.php" method="post">
<table width=400px>
<?
          $resultado = mysql_query("
               select
                   customer_symbol,
                   sum(if(billsec>0,1,0)) as connect,    
                   count(*) as total_calls,
                   sum(billsec/60) as minutes,
                   sum(call_total_rate) as venta,
                   sum(call_total_cost) as coste,
                   sum(call_total_rate) - sum(call_total_cost) as beneficio,
                   (sum(if(billsec>0,1,0)) / count(*)) * 100 as asr,
                   (sum(billsec/60) / sum(if(billsec>0,1,0))) as call_avg
               from 
                   cdr
               where
                   datetime_start like date_format( now(), '%Y-%m-%d %')
               group by
                   customer_symbol
               order by 
                   customer_symbol
          ") or die("La consulta ha fallado;: " . mysql_error());

          echo "<table cellspacing='0' cellpadding='0'>\n";
          echo "<tr bgcolor='green'>\n"; 
          echo "     <th width='200px' align='left' >Customer</th>\n";
          echo "     <th width='100px' align='left' >Connected</th>\n";
          echo "     <th width='200px' align='left' >Attempts</th>\n";
          echo "     <th width='100px' align='right'>Minutes</th>\n";
          echo "     <th width='100px' align='right'>Sale</th>\n";
          echo "     <th width='200px' align='right'>Cost</th>\n";
          echo "     <th width='200px' align='right'>Gross Margin</th>\n";
          echo "     <th width='200px' align='right'>ASR</th>\n";
          echo "     <th width='200px' align='right'>ACD</th>\n";
          echo "</tr>\n"; 
          while($linea=mysql_fetch_row($resultado)){
               echo "<tr bgcolor='white' style=\"color:black\">\n"; 
               echo "     <td align='left' > $linea[0] </td>\n";
               echo "     <td align='left' > $linea[1] </td>\n";
               echo "     <td align='left' > $linea[2] </td>\n";
               echo "     <td align='right'> $linea[3] </td>\n";
               echo "     <td align='right'> $linea[4] </td>\n";
               echo "     <td align='right'> $linea[5] </td>\n";
               echo "     <td align='right'> $linea[6] </td>\n";
               echo "     <td align='right'> $linea[7] </td>\n";
               echo "     <td align='right'> $linea[8] </td>\n";
               echo "</tr>\n"; 
          }
          echo "</table>\n";
?>
</form>
</Body>
</html>
