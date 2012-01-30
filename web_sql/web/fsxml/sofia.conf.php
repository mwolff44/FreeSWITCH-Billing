<?php

require "../webint/conexion.inc";

echo "
     <configuration name=\"sofia.conf\" description=\"sofia Endpoint\">
     
       <global_settings>
         <param name=\"log-level\" value=\"0\"/>
         <!-- <param name=\"auto-restart\" value=\"false\"/> -->
         <param name=\"debug-presence\" value=\"0\"/>
       </global_settings>


            <profiles>
";

$resultado_profiles = mysql_query("select service_ip, service_port, service_type from ws_settings") or die("La consulta ha fallado;: " . mysql_error());
while($linea_profile=mysql_fetch_row($resultado_profiles)){

     echo "     
                 <profile name=\"$linea_profile[2]\">
                      <!-- http://wiki.freeswitch.org/wiki/Sofia_Configuration_Files --> 
                      <!-- This profile is only for outbound registrations to providers -->
                      <gateways>
                    
          ";
          
               $resultado = mysql_query("select symbol, sip_ip, out_prefix, sip_username, sip_pwd from ws_providers order by symbol") or die("La consulta ha fallado;: " . mysql_error());
               while($linea=mysql_fetch_row($resultado)){
                    echo "
                         <gateway name=\"$linea[0]\">
                              <param name=\"realm\" value=\"$linea[1]\"/>
                              <param name=\"username\" value=\"$linea[3]\"/>
                              <param name=\"password\" value=\"$linea[4]\"/>
                              <param name=\"register\" value=\"false\"/>
                              <param name=\"retry-seconds\" value=\"30\"/>
                              <param name=\"caller-id-in-from\" value=\"true\"/>
                         </gateway>
                    ";
               }
          
          echo "          
                      </gateways>
                    
                      <aliases>
                        <!-- 
                        <alias name=\"outbound\"/>
                        <alias name=\"nat\"/>
                        -->
                      </aliases>
                    
                      <domains>
                        <domain name=\"all\" alias=\"false\" parse=\"true\"/>
                      </domains>
                    
                      <settings>
                        <param name=\"debug\" value=\"0\"/>
                    	<!-- If you want FreeSWITCH to shutdown if this profile fails to load, uncomment the next line. -->
                    	<!-- <param name=\"shutdown-on-fail\" value=\"true\"/> -->
                        <param name=\"sip-trace\" value=\"no\"/>
                        <param name=\"rfc2833-pt\" value=\"101\"/>
                        <param name=\"sip-port\" value=\"$linea_profile[1]\"/>
                    <!--    <param name=\"sip-port\" value=\"5061\"/>                         -->
                        <param name=\"dialplan\" value=\"XML\"/> 
                        <param name=\"context\" value=\"$linea_profile[2]\"/>
                        <param name=\"dtmf-duration\" value=\"2000\"/>
                        <param name=\"inbound-codec-prefs\" value=\"\$\${global_codec_prefs}\"/>
                        <param name=\"outbound-codec-prefs\" value=\"\$\${outbound_codec_prefs}\"/>
                        <param name=\"hold-music\" value=\"\$\${hold_music}\"/>
                        <param name=\"rtp-timer-name\" value=\"soft\"/>
                        <!--<param name=\"enable-100rel\" value=\"true\"/>-->
                        <!-- This could be set to \"passive\" -->
                        <param name=\"local-network-acl\" value=\"localnet.auto\"/>
                        <param name=\"manage-presence\" value=\"false\"/>
                    
                        <!-- used to share presence info across sofia profiles 
                    	 manage-presence needs to be set to passive on this profile
                    	 if you want it to behave as if it were the internal profile 
                    	 for presence.
                        -->
                        <!-- Name of the db to use for this profile -->
                        <!--<param name=\"dbname\" value=\"share_presence\"/>-->
                        <!--<param name=\"presence-hosts\" value=\"\$\${domain}\"/>-->
                        <!--<param name=\"force-register-domain\" value=\"\$\${domain}\"/>-->
                        <!--all inbound reg will stored in the db using this domain -->
                        <!--<param name=\"force-register-db-domain\" value=\"\$\${domain}\"/>-->
                        <!-- ************************************************* -->
                    
                        <!--<param name=\"aggressive-nat-detection\" value=\"true\"/>-->
                        <param name=\"inbound-codec-negotiation\" value=\"generous\"/>
                        <param name=\"nonce-ttl\" value=\"60\"/>
                        <param name=\"auth-calls\" value=\"false\"/>
                        <!--
                    	DO NOT USE HOSTNAMES, ONLY IP ADDRESSES IN THESE SETTINGS!
                        -->
                        <param name=\"rtp-ip\" value=\"$linea_profile[0]\"/>
                        <param name=\"sip-ip\" value=\"$linea_profile[0]\"/>
                        <param name=\"ext-rtp-ip\" value=\"auto-nat\"/>
                        <param name=\"ext-sip-ip\" value=\"auto-nat\"/>
                        <param name=\"rtp-timeout-sec\" value=\"3600\"/>
                        <param name=\"rtp-hold-timeout-sec\" value=\"1800\"/>
                        <!--<param name=\"enable-3pcc\" value=\"true\"/>-->
                    
                        <!-- TLS: disabled by default, set to \"true\" to enable -->
                        <param name=\"tls\" value=\"\$\${external_ssl_enable}\"/>
                        <!-- additional bind parameters for TLS -->
                        <param name=\"tls-bind-params\" value=\"transport=tls\"/>
                        <!-- Port to listen on for TLS requests. (5081 will be used if unspecified) -->
                        <param name=\"tls-sip-port\" value=\"\$\${external_tls_port}\"/>
                        <!-- Location of the agent.pem and cafile.pem ssl certificates (needed for TLS server) -->
                        <param name=\"tls-cert-dir\" value=\"\$\${external_ssl_dir}\"/>
                        <!-- TLS version (\"sslv23\" (default), \"tlsv1\"). NOTE: Phones may not work with TLSv1 -->
                        <param name=\"tls-version\" value=\"\$\${sip_tls_version}\"/>
                    
                      </settings>
                    </profile>
";

}

echo "     
       </profiles>
     
     </configuration>

";

?>

