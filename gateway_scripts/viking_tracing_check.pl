#!/usr/bin/perl

use strict;
use warnings;
use DBI;
use Cwd 'abs_path';
my $script = abs_path($0);
my ($path) = $script =~ /^.*\//g;

$|=1;

my $dbh = DBI->connect('DBI:mysql:viking;host=viking_webserver_private_ip', 'viking', 'V1k1ng') || die "Could not connect to database: $DBI::errstr";
my $sth_trace = $dbh->prepare("Select running_trace, remote_host, service_ip, dialed_number from ws_settings;");
my $result;
my $pid;
my $running_trace=0;

while(1){

     $sth_trace->execute();
     $result = $sth_trace->fetchrow_hashref();
     
     if($result->{running_trace} eq "YES" && $running_trace==0){
          print "I will start a trace\n";
          $running_trace=1;
          my $command = "nohup " . $path . "viking_sip_trace.pl &";
          system($command);
     }
     
     print "sleeping...\n";
     sleep 10;

     $sth_trace->execute();
     $result = $sth_trace->fetchrow_hashref();

     if($result->{running_trace} eq "NO" && $running_trace==1 ){
          print "I've been asked to stop\n";
          my $command_trace = "kill -KILL `ps -eo pid -o cmd | grep '" . $path . "viking_sip_trace.pl\\|contains\\|dumpcap' | grep -v grep | awk '{print \$1}'`"; 
          $result = system($command_trace);
          $running_trace=0;
     }
}
