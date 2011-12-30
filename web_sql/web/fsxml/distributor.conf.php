<?php

require "../webint/conexion.inc";

echo "
";

$resultado_profiles = mysql_query("select service_ip, service_port, service_type from ws_settings") or die("La consulta ha fallado;: " . mysql_error());
while($linea_profile=mysql_fetch_row($resultado_profiles)){

echo " 
     <configuration name=\"distributor.conf\" description=\"Distributor Configuration\">
       <lists>
         <!-- every 10 calls to test you will get foo1 once and foo2 9 times...yes NINE TIMES! -->
         <!-- this is not the same as 100 with 10 and 90 that would do foo1 10 times in a row then foo2 90 times in a row -->
";

     $resultado = mysql_query("select route_name, route_gw_1_symbol, route_gw_1_weight, route_gw_2_symbol, route_gw_2_weight, route_gw_3_symbol, route_gw_3_weight, route_gw_4_symbol, route_gw_4_weight, route_gw_5_symbol, route_gw_5_weight, route_gw_1_weight+route_gw_2_weight+route_gw_3_weight+route_gw_4_weight+route_gw_5_weight as total_weight from ws_routes") or die("La consulta ha fallado;: " . mysql_error());
     while($linea=mysql_fetch_row($resultado)){
          echo "             <list name=\"$linea[0]\" total-weight=\"$linea[11]\">\n";
          if( $linea[1]>''  ){ echo "                <node name=\"$linea[1]/\" weight=\"$linea[2]\"/>\n"; }
          if( $linea[3]>''  ){ echo "                <node name=\"$linea[3]/\" weight=\"$linea[4]\"/>\n"; }
          if( $linea[5]>''  ){ echo "                <node name=\"$linea[5]/\" weight=\"$linea[6]\"/>\n"; }
          if( $linea[7]>''  ){ echo "                <node name=\"$linea[7]/\" weight=\"$linea[8]\"/>\n"; }
          if( $linea[9]>''  ){ echo "                <node name=\"$linea[9]/\" weight=\"$linea[10]\"/>\n"; }
          echo "            </list>\n";
     }

echo "
       </lists>
     </configuration>
";
}

?>

