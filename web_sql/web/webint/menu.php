<?PHP

require "conexion.inc";
require "checklogin.inc";

?>
<HTML>
	<TITLE>
		Viking Management Platform
	</TITLE>
	<head>

		<link rel="stylesheet" href="menu.css">
		<script language="JavaScript" src="menu.js"></script>
		<script language="JavaScript" src="menu_items.js"></script>
		<script language="JavaScript" src="menu_tpl.js"></script>

		<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE"><META HTTP-EQUIV="Expires" CONTENT="-1">
		<!-- some header data -->
		<link rel="stylesheet" href="menu.css">
		<link rel="stylesheet" href="style.css">
                                             
<style>
	a:visited { text-decoration: none; color: #ffff00 }
	a:link { text-decoration: none; color: #ffff00 }
	a:visited:hover { bgcolor: 'Black'; color: #ffff00; }
	a:link:hover { bgcolor: 'Black'; color: #ffff00; }
	body {
		font-family: Georgia, "Times New Roman",
		Tahoma, Times, serif;
		color: purple;
		//background-color: #660033
	}

	 //tr { background-color: #660033}
	.initial { background-color: #8A0808; color:#8A0808 }
	.normal { background-color: #1C2D67 }
	.highlight { background-color: #3399FF }

</style>
<script language="javascript">
	function hideall(){
		/////////////////////////
		tbl = document.getElementById('admin');
		var len = tbl.rows.length;

		for(i=0 ; i< len; i++){
			var vStyle;
			tbl.rows[i].style.display = "none";
		 }

		/////////////////////////
		tbl = document.getElementById('reporting');
		var len = tbl.rows.length;

		for(i=0 ; i< len; i++){
			var vStyle;
			tbl.rows[i].style.display = "none";
		 }

		/////////////////////////
		tbl = document.getElementById('other');
		var len = tbl.rows.length;

		for(i=0 ; i< len; i++){
			var vStyle;
			tbl.rows[i].style.display = "none";
		 }

	}

	function hide(elemento){

		tbl = document.getElementById(elemento);
		var len = tbl.rows.length;

		for(i=0 ; i< len; i++){
			var vStyle;
			if(tbl.rows[i].style.display=='none'){
				tbl.rows[i].style.display = "";
			}else{
				tbl.rows[i].style.display = "none";
			}
		 }
	}

</script>


</head>
<body style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: xx-small;"  leftmargin="0" bgcolor="#1C2D67">

<form id='Formulario' name='Formulario'>
	<table width=180px id=global name=global>

          <!---------------------------------->
          <!--           Administración     -->
          <!---------------------------------->

		<tr>
		     <td>
		    	   <hr>
			</td>
		</tr>
		<tr onClick="javascript:hideall(); hide('admin');" >
		     <td bgcolor="#33CC00">
		    	   <font face="Verdana" color="black" size="4">Provisioning</font>
			</td>
		</tr>
		<tr>
		     <td>
		    	   <hr>
			</td>
		</tr>
		<tr><td>
			<table id=admin name=admin width=100% style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: xx-small;">

				<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('cust').click()">
                         <td nowrap="nowrap">
                              <a id=myaccount href="cust.php" target="Frame3">Customers</a>
                         </td>
                    </tr>

				<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('prov').click()">
                         <td nowrap="nowrap">
                              <a id=myaccount href="prov.php" target="Frame3">Providers</a>
                         </td>
                    </tr>
<tr><td><hr></td></tr>
				<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('newrate').click()">
                         <td nowrap="nowrap">
                              <a id=newrate href="create_ratetable.php" target="Frame3">Create rate table</a>
                         </td>
                    </tr>
				<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('newcost').click()">
                         <td nowrap="nowrap">
                              <a id=newrate href="rateupload.php" target="Frame3">Import rate/route table</a>
                         </td>
                    </tr>
<tr><td><hr></td></tr>
				<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('newcost').click()">
                         <td nowrap="nowrap">
                              <a id=newrate href="create_costtable.php" target="Frame3">Create cost table</a>
                         </td>
                    </tr>

				<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('newcost').click()">
                         <td nowrap="nowrap">
                              <a id=newrate href="costupload.php" target="Frame3">Import cost table</a>
                         </td>
                    </tr>
<tr><td><hr></td></tr>
				<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('routes').click()">
                         <td nowrap="nowrap">
                              <a id=routes href="routes.php" target="Frame3">Route table</a>
                         </td>
                    </tr>
				<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('trace').click()">
                         <td nowrap="nowrap">
                              <a id=routes href="sip_trace.php" target="Frame3">SIP Traces</a>
                         </td>
                    </tr>
		<tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('calls').click()">
                         <td nowrap="nowrap">
                              <a id=routes href="online_calls.php" target="Frame3">Current Calls</a>
                         </td>
                    </tr>

			</table>
		</td></tr>
 
          <!---------------------------------->
          <!--            Reporting           -->
          <!---------------------------------->

		<tr>
		     <td>
		    	   <hr>
			</td>
		</tr>
		<tr onClick="javascript:hideall(); hide('reporting');" >
		     <td bgcolor="#33CC00">
			    <font face="Verdana" color="black" size="4">Reporting</font>
			</td>
		</tr>
		<tr>
		     <td>
		    	   <hr>
			</td>
		</tr>

		<tr><td>
			<table id=reporting name=reporting width=100% style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: xx-small;">

				<tr style="display: none;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('outgoing_view').click()">
                         <td nowrap="nowrap">
                              <a id=customer_report href="customer_report.php" target="Frame3">By Customer</a>
                         </td>
                    </tr>

				<tr style="display: none;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('outgoing_view').click()">
                         <td nowrap="nowrap">
                              <a id=provider_report href="provider_report.php" target="Frame3">By Provider</a>
                         </td>
                    </tr>

				<tr style="display: none;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('outgoing_view').click()">
                         <td nowrap="nowrap">
                              <a id=financial_report href="financial_report.php" target="Frame3">Sale vs Cost</a>
                         </td>
                    </tr>


				<tr style="display: none;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('outgoing_view').click()">
                         <td nowrap="nowrap">
                              <a id=asr href="custom_asr.php" target="Frame3">ASR</a>
                         </td>
                    </tr>

			</table>
		</td></tr>


          <!---------------------------------->
          <!--            OTHER             -->
          <!---------------------------------->

		<tr>
		     <td>
		    	   <hr>
			</td>
		</tr>
		<tr onClick="javascript:hideall(); hide('other');" >
		     <td bgcolor="#33CC00">
			    <font face="Verdana" color="black" size="4">Others</font>
			</td>
		</tr>
		<tr>
		     <td>
		    	   <hr>
			</td>
		</tr>

		<tr><td>
			<table id=other name=other width=100% style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: xx-small;">

				<tr style="display: none;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('outgoing_view').click()">
                         <td nowrap="nowrap">
                              <a id=users href="users.php" target="Frame3">User Management</a>
                         </td>
                    </tr>

				<tr style="display: none;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('cdrexport').click()">
                         <td nowrap="nowrap">
                              <a id=users href="cdrexport.php" target="Frame3">CDR Export</a>
                         </td>
                    </tr>


				<tr style="display: none;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" onClick="document.getElementById('outgoing_view').click()">
                         <td nowrap="nowrap">
                              <a id=users href="settings.php" target="Frame3">General Configuration</a>
                         </td>
                    </tr>

			</table>
		</td></tr>

		<tr>
		     <td>
		    	   <hr>
			</td>
		</tr>
	</table>
</form>


</body>
</html>
