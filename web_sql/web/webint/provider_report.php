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
<?
     if(!isset($_POST['provider'])){
?>
<table width=400px>
     <tr>
          <td>
               Provider:
          </td>
          <td>
               <select id=provider name=provider>
               <?php
                    // Check username and password agains the database.

                    $sqldatetime = "select symbol, name from ws_providers order by name;";
                    $resultado = mysql_query($sqldatetime) or die("La consulta ha fallado;: " . mysql_error());
                    
                    #	GET DATA SO THAT I CAN SHOW %/TOTAL FOR EACH CUSTOMER
                    while($linea=mysql_fetch_row($resultado)){                    	
                    	echo "<option value='" . $linea[0] . "'>" . $linea[1] . "</option>\n";
                    }
               ?>
               </select>
          </td>
     </tr>
     <tr>
          <td>
               Date from:
          </td>
          <td>
               <script>
                    DateInput('orderdate', true, 'YYYY-MM-DD')
               </script>
          </td>
     </tr>
     <tr>
          <td>
               Date to:
          </td>
          <td>
               <script>
                    DateInput('orderdate2', true, 'YYYY-MM-DD')
               </script>
          </td>
     </tr>
     <tr>
          <td>
               <input type="submit" value="Ejecutar">
          </td>
          <td>
          </td>
     </tr>
</table>

<?

     }else{
#          echo "I will now execute the report with the following info: " . $_POST['customer'] . ", from " . $_POST['orderdate'] . " to: " . $_POST['orderdate2'] . "<br>";
          $resultado = mysql_query("select gw_symbol, cost_areacode, cost_description, cost_cost, sum(billsec/60) as minutes, sum(call_total_rate) as venta, sum(call_total_cost) as coste from cdr where gw_symbol = '" . $_POST['provider'] . "' and datetime_start between '" . $_POST['orderdate'] . " 00:00:00' and '" . $_POST['orderdate2'] . " 23:59:59' group by gw_symbol, cost_areacode, cost_description, cost_cost order by gw_symbol, cost_areacode, cost_description, cost_cost ;") or die("La consulta ha fallado;: " . mysql_error());

          echo "<table cellspacing='0' cellpadding='0'>\n";
          echo "<tr bgcolor='green'>\n"; 
          echo "     <th width='200px' align='left' >Gateway</th>\n";
          echo "     <th width='100px' align='left' >Areacode</th>\n";
          echo "     <th width='200px' align='left' >Description</th>\n";
          echo "     <th width='100px' align='right'>Cost</th>\n";
          echo "     <th width='100px' align='right'>Minutes</th>\n";
          echo "     <th width='200px' align='right'>Total Sale</th>\n";
          echo "     <th width='200px' align='right'>Total Cost</th>\n";
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
               echo "</tr>\n"; 
          }
          echo "</table>\n";
     }
?>
</form>
</Body>
</html>
