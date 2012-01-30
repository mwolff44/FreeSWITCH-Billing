#!/usr/bin/perl

use strict;
use warnings;
use DBI;
$|=1;

my $dbh = DBI->connect('DBI:mysql:viking;host=viking_webserver_private_ip', 'viking', 'V1k1ng') || die "Could not connect to database: $DBI::errstr";
my $result;
my $command="";
my $data="";



my $sth_trace = $dbh->prepare("select service_type from ws_settings;");
$sth_trace->execute();
while($result = $sth_trace->fetchrow_hashref()){
     print "PROFILE: " . $result->{service_type} . "\n";
     my $sth_gateways = $dbh->prepare("select symbol, sip_ip, out_prefix, sip_username, sip_pwd from ws_providers order by symbol");
     $sth_gateways->execute();
     while(my $gateways = $sth_gateways->fetchrow_hashref()){
          print "GATEWAY: " . $gateways->{symbol} . "  ->  api sofia profile " . $result->{service_type} . " killgw " . $gateways->{symbol} . "\n";

          $command = "freeswitch_pathbin/fs_cli --host=viking_host_private_ip --port=8021 --password=viking_freeswitch_password -x 'sofia profile " . $result->{service_type} . " killgw " . $gateways->{symbol} . "'";
          $data=`$command`;
          print "indata: $data\n";

          while($data =~ m/$gateways->{symbol}/){
               $command = "freeswitch_pathbin/fs_cli --host=viking_host_private_ip --port=8021 --password=viking_freeswitch_password -x 'sofia profile " . $result->{service_type} . " gwlist'";
               $data=`$command`;
               print "indata: $data\n";
          }
     }

     #$data = "Please wait";
     do{
          $command = "freeswitch_pathbin/fs_cli --host=viking_host_private_ip --port=8021 --password=viking_freeswitch_password -x 'sofia profile " . $result->{service_type} . " restart'";
          $data=`$command`;
          print "indata: $data\n";
          sleep 1;
     }while($data =~ /Please wait/)
}



exit 0;

