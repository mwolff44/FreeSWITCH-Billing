#!/usr/bin/perl
use strict;
use Cwd 'abs_path';
use File::Copy;

my $script = abs_path($0);
my ($path) = $script =~ /^.*\//g;

my $dummy;
my $viking_host_private_ip;
my $viking_freeswitch_password;
my $viking_webserver_private_ip;
my $freeswitch_path;
my $webserver_root_path;
my $scripts_path;
my $viking_public_ip;

open(VARS,"< variables.conf");
while(my $in=<VARS>){
     chomp($in);
     ($dummy,$viking_host_private_ip) = split(/=/,$in) if $in =~ /viking_host_private_ip/;
     ($dummy,$viking_freeswitch_password) = split(/=/,$in) if $in =~ /viking_freeswitch_password/;
     ($dummy,$viking_webserver_private_ip) = split(/=/,$in) if $in =~ /viking_webserver_private_ip/;
     ($dummy,$freeswitch_path) = split(/=/,$in) if $in =~ /freeswitch_path/;
     ($dummy,$webserver_root_path) = split(/=/,$in) if $in =~ /webserver_root_path/;
     ($dummy,$scripts_path) = split(/=/,$in) if $in =~ /scripts_path/;
     ($dummy,$viking_public_ip) = split(/=/,$in) if $in =~ /viking_public_ip/;
}

#    SET VARIABLES IN FILES 

ReplaceVars($path . "gateway/conf/autoload_configs/console.conf.xml");
ReplaceVars($path . "gateway/conf/autoload_configs/event_socket.conf.xml");
ReplaceVars($path . "gateway/conf/autoload_configs/lua.conf.xml");
ReplaceVars($path . "gateway/conf/autoload_configs/modules.conf.xml");
ReplaceVars($path . "gateway/conf/autoload_configs/sofia.conf.xml");
ReplaceVars($path . "gateway/conf/autoload_configs/xml_cdr.conf.xml");
ReplaceVars($path . "gateway/conf/autoload_configs/xml_curl.conf.xml");
ReplaceVars($path . "gateway/conf/vars.xml");
ReplaceVars($path . "gateway/scripts/fs-cli");
ReplaceVars($path . "gateway/scripts/functions_wholesale.lua");
ReplaceVars($path . "gateway/scripts/script_wholesale.lua");
ReplaceVars($path . "gateway_scripts/freeswitch-reload-xml.pl");
ReplaceVars($path . "gateway_scripts/freeswitch_reload_config.pl");
ReplaceVars($path . "gateway_scripts/viking_get_calls.pl");
ReplaceVars($path . "gateway_scripts/viking_reload.pl");
ReplaceVars($path . "gateway_scripts/viking_sip_trace.pl");
ReplaceVars($path . "gateway_scripts/viking_tracing_check.pl");
ReplaceVars($path . "gateway_scripts/watchdog_viking_get_calls.sh");
ReplaceVars($path . "gateway_scripts/watchdog_viking_reload.sh");
ReplaceVars($path . "gateway_scripts/watchdog_viking_trace.sh");
ReplaceVars($path . "web_sql/web/cdrpost/post.php");
ReplaceVars($path . "web_sql/web/conexion.inc");
ReplaceVars($path . "web_sql/web/fsxml/dialplan.conf.php");
ReplaceVars($path . "web_sql/web/fsxml/distributor.conf.php");
ReplaceVars($path . "web_sql/web/fsxml/gateways.php");
ReplaceVars($path . "web_sql/web/fsxml/sofia.conf.php");
ReplaceVars($path . "web_sql/web/webint/archivos_php/rates.csv");
ReplaceVars($path . "web_sql/web/webint/asr_report.php");
ReplaceVars($path . "web_sql/web/webint/blank.php");
ReplaceVars($path . "web_sql/web/webint/calls.php");
ReplaceVars($path . "web_sql/web/webint/cdrexport.php");
ReplaceVars($path . "web_sql/web/webint/checklogin.inc");
ReplaceVars($path . "web_sql/web/webint/conexion.inc");
ReplaceVars($path . "web_sql/web/webint/costupload.php");
ReplaceVars($path . "web_sql/web/webint/create_costtable.php");
ReplaceVars($path . "web_sql/web/webint/create_ratetable.php");
ReplaceVars($path . "web_sql/web/webint/cust.php");
ReplaceVars($path . "web_sql/web/webint/customer_report.php");
ReplaceVars($path . "web_sql/web/webint/custom_asr.php");
ReplaceVars($path . "web_sql/web/webint/financial_report.php");
ReplaceVars($path . "web_sql/web/webint/index.php");
ReplaceVars($path . "web_sql/web/webint/menu.css");
ReplaceVars($path . "web_sql/web/webint/menu.php");
ReplaceVars($path . "web_sql/web/webint/next.gif");
ReplaceVars($path . "web_sql/web/webint/online_calls.php");
ReplaceVars($path . "web_sql/web/webint/pages_style.css");
ReplaceVars($path . "web_sql/web/webint/phpmyedit/extensions/phpMyEdit-mce-cal.class.php");
ReplaceVars($path . "web_sql/web/webint/phpmyedit/extensions/phpMyEdit-report.class.php");
ReplaceVars($path . "web_sql/web/webint/phpmyedit/extensions/phpMyEdit-slide.class.php");
ReplaceVars($path . "web_sql/web/webint/phpmyedit/phpMyEdit.class.php");
ReplaceVars($path . "web_sql/web/webint/phpmyedit/phpMyEditSetup.php");
ReplaceVars($path . "web_sql/web/webint/prov.php");
ReplaceVars($path . "web_sql/web/webint/provider_report.php");
ReplaceVars($path . "web_sql/web/webint/rateupload.php");
ReplaceVars($path . "web_sql/web/webint/routes.php");
ReplaceVars($path . "web_sql/web/webint/save_data.php");
ReplaceVars($path . "web_sql/web/webint/settings.php");
ReplaceVars($path . "web_sql/web/webint/sip_trace.php");
ReplaceVars($path . "web_sql/web/webint/top.php");
ReplaceVars($path . "web_sql/web/webint/users.php");
ReplaceVars($path . "web_sql/web/webint/viewcosts.php");
ReplaceVars($path . "web_sql/web/webint/viewrates.php");

#    CREATE MySQL

my $sql = "unzip " . $path . "web_sql/sql/viking.zip -d " . $path . "web_sql/sql/";
system($sql);
my $sql = "mysql -u viking -pV1k1ng < " . $path . "web_sql/sql/viking.sql";
system($sql);
system("echo 'insert webusers values (NULL,\"admin\",\"admin\",\"admin\",md5(\"admin\"));' | mysql -u viking -pV1k1ng viking");

my $settings_command = "echo 'insert ws_settings (id,service_ip,service_port,service_type) values (NULL,\"" . $viking_public_ip . "\",\"5060\",\"DEFAULT\" );' | mysql -u viking -pV1k1ng viking";
system($settings_command);

#    COPY FILES TO LOCATIONS - Web Server

my $web_copy = "cp -r " . $path . "web_sql/web/* " . $webserver_root_path;
system($web_copy); 

#    COPY FILES TO LOCATIONS - Freeswitch

my $scripts_copy = "cp -r " . $path . "gateway/* " . $freeswitch_path;
print "copying scripts: $scripts_copy \n";
system($scripts_copy); 

#    COPY FILES TO LOCATIONS - Scripts

my $scripts_copy = "cp -r " . $path . "gateway_scripts/* " . $scripts_path;
print "copying scripts: $scripts_copy \n";
system($scripts_copy);

#    INITIALIZE XML CONFIG FILES

my $tmpcmd = "wget --quiet http://". $viking_webserver_private_ip. "/fsxml/sofia.conf.php --output-document=" .$freeswitch_path. "/conf/autoload_configs/sofia.conf.xml";
print "SOFIA: $tmpcmd\n";
system($tmpcmd) == 0 or die "Couldn't get sofia.conf.xml!";

my $tmpcmd = "wget --quiet http://". $viking_webserver_private_ip. "/fsxml/distributor.conf.php --output-document=" .$freeswitch_path. "/conf/autoload_configs/distributor.conf.xml";
print "DIST: $tmpcmd\n";
system($tmpcmd) == 0 or die "Couldn't get distributor.conf.xml!";

my $tmpcmd = "wget --quiet http://". $viking_webserver_private_ip. "/fsxml/dialplan.conf.php --output-document=" .$freeswitch_path. "/conf/dialplan/default.conf.xml";
print "DIALPLAN: $tmpcmd\n";
system($tmpcmd) == 0 or die "Couldn't get dialplan.conf.xml!";


exit;


sub ReplaceVars($){
     my $filename = shift;
     print "doing $filename\n";
     
     open(REPLACE, "cat $filename |");
     open(TMP,">",$filename.".tmp");
     while(my $tmp=<REPLACE>){
          $tmp =~ s/viking_host_private_ip/$viking_host_private_ip/;
          $tmp =~ s/viking_freeswitch_password/$viking_freeswitch_password/;
          $tmp =~ s/viking_webserver_private_ip/$viking_webserver_private_ip/;
          $tmp =~ s/freeswitch_path/$freeswitch_path/;
          $tmp =~ s/webserver_root_path/$webserver_root_path/;
          $tmp =~ s/viking_public_ip/$viking_public_ip/;
          print TMP $tmp;
     }
     close(REPLACE);
     close(TMP);
     my $move_command = "mv " . $filename . ".tmp " . $filename;
     system($move_command);
} 