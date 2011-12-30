<?php

require "../webint/conexion.inc";


echo "
";

$resultado_profiles = mysql_query("select service_ip, service_port, service_type from ws_settings") or die("La consulta ha fallado;: " . mysql_error());
while($linea_profile=mysql_fetch_row($resultado_profiles)){
     echo "
          <context name=\"$linea_profile[2]\">
          
               <extension name=\"unloop\">
                    <condition field=\"\$\${unroll_loops}\" expression=\"^true$\"/>
                    <condition field=\"\$\${sip_looped_call}\" expression=\"^true$\">
                         <action application=\"deflect\" data=\"\$\${destination_number}\"/>
                    </condition>
               </extension>
               
               <extension name=\"outside_call\" continue=\"true\">
                    <condition>
                         <action application=\"set\" data=\"outside_call=true\"/>
                    </condition>
               </extension>
               
               <extension name=\"hangup\">
                    <condition field=\"destination_number\" expression=\"^(hangup)\$\">
                         <action application=\"hangup\"/>
                    </condition>
               </extension>
               
               
               <!-- START OF PREFIX STRIPPING -->
";

     $resultado_prefix = mysql_query("select ws_customer_sig_ip, ws_customer_prefix from ws_customers where ws_customer_prefix is not null group by ws_customer_sig_ip, ws_customer_prefix order by ws_customer_sig_ip, ws_customer_prefix;") or die("La consulta ha fallado;: " . mysql_error());
     while($linea_prefix=mysql_fetch_row($resultado_prefix)){
          $cnt++;
          $ip = str_replace(".","\.",$linea_prefix[0]);
          echo "
               <extension name=\"remove_prefix_$cnt\" continue=\"true\">
                    <condition field=\"network_addr\" expression=\"^$ip\$\"/>
                    <condition field=\"destination_number\" expression=\"^$linea_prefix[1](\d+)\$\">
                              <action application=\"log\" data=\"Removing leading digits\"/>
                              <action application=\"set\" data=\"destination_number=\$1\"/>
                    </condition>
               </extension>
               
          ";
     }
echo "
               <!-- STOP OF PREFIX STRIPPING -->

               <extension name=\"wholesale\">
                    <condition field=\"destination_number\" expression=\"^.*\$\">
                         <action application=\"info\"/>
                         <action application=\"set\" data=\"hangup_after_bridge=true\"/>
                         <action application=\"lua\" data=\"/usr/local/freeswitch/scripts/script_wholesale.lua\"/>
                    </condition>
               </extension>
          
          
          </context>
     ";
}


?>

