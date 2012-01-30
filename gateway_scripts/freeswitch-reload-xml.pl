#!/usr/bin/perl

use strict;
use warnings;
use DBI;
$|=1;

my $dbh = DBI->connect('DBI:mysql:viking;host=viking_webserver_private_ip', 'viking', 'V1k1ng') || die "Could not connect to database: $DBI::errstr";
my $result;
my $command="";
my $data="";

system("wget --quiet http://viking_webserver_private_ip/fsxml/sofia.conf.php --output-document=freeswitch_pathconf/autoload_configs/sofia.conf.xml") == 0 or die "Couldn't get sofia.conf.xml!";
system("wget --quiet http://viking_webserver_private_ip/fsxml/distributor.conf.php --output-document=freeswitch_pathconf/autoload_configs/distributor.conf.xml") == 0 or die "Couldn't get distributor.conf.xml!";
system("wget --quiet http://viking_webserver_private_ip/fsxml/dialplan.conf.php --output-document=freeswitch_pathconf/dialplan/default.conf.xml") == 0 or die "Couldn't get Dialplan!";

$command = "freeswitch_pathbin/fs_cli --host=viking_host_private_ip --port=8021 --password=viking_freeswitch_password -x 'reload mod_sofia'";
system($command) == 0 or die "Couldn't reload mod_sofia!"; 

$command = "freeswitch_pathbin/fs_cli --host=viking_host_private_ip --port=8021 --password=viking_freeswitch_password -x 'reload mod_distributor'";
system($command) == 0 or die "Couldn't reload mod_distributor!";
 
$command = "freeswitch_pathbin/fs_cli --host=viking_host_private_ip --port=8021 --password=viking_freeswitch_password -x 'reloadxml'";
system($command) == 0 or die "Couldn't reload mod_distributor!";
 
exit 0;

