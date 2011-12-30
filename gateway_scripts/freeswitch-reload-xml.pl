#!/usr/bin/perl

use strict;
use warnings;
use DBI;
$|=1;

my $dbh = DBI->connect('DBI:mysql:viking;host=192.168.168.2', 'username', 'password') || die "Could not connect to database: $DBI::errstr";
my $result;
my $command="";
my $data="";

system("wget --quiet http://192.168.168.2:88/fsxml/sofia.conf.php --output-document=/usr/local/freeswitch/conf/autoload_configs/sofia.conf.xml") == 0 or die "Couldn't get sofia.conf.xml!";
system("wget --quiet http://192.168.168.2:88/fsxml/distributor.conf.php --output-document=/usr/local/freeswitch/conf/autoload_configs/distributor.conf.xml") == 0 or die "Couldn't get distributor.conf.xml!";
system("wget --quiet http://192.168.168.2:88/fsxml/dialplan.conf.php --output-document=/usr/local/freeswitch/conf/dialplan/default.conf.xml") == 0 or die "Couldn't get Dialplan!";

$command = "/usr/local/freeswitch/bin/fs_cli --host=192.168.168.3 --port=8021 --password=M3ll4m0d4v1d -x 'reload mod_sofia'";
system($command) == 0 or die "Couldn't reload mod_sofia!"; 

$command = "/usr/local/freeswitch/bin/fs_cli --host=192.168.168.3 --port=8021 --password=M3ll4m0d4v1d -x 'reload mod_distributor'";
system($command) == 0 or die "Couldn't reload mod_distributor!";
 
$command = "/usr/local/freeswitch/bin/fs_cli --host=192.168.168.3 --port=8021 --password=M3ll4m0d4v1d -x 'reloadxml'";
system($command) == 0 or die "Couldn't reload mod_distributor!";
 
exit 0;

