#!/usr/bin/perl
use DBI;
use strict;
use Digest::MD5 qw(md5_hex);
use Cwd 'abs_path';
my $script = abs_path($0);
my ($path) = $script =~ /^.*\//g;

sub Reload();
sub ReloadDone;
sub CheckSum();

my $table_checksum = 0;
my $old_table_checksum = 0;
open LOG,">>",$path . "reload_check.log";

select(LOG); $| = 1; # make unbuffered
select(STDOUT); $| = 1; # make unbuffered

while(1){

     print LOG "Checking... \n";
     $table_checksum = CheckSum();
     print LOG "Reload requested: $table_checksum \n";

     if($table_checksum eq "YES" ){
	  print LOG "Reloading...\n";
          Reload();
     }
     ReloadDone();


     sleep 10;
}

exit 0;




sub Reload(){
     system($path . "freeswitch_reload_config.pl");
     system($path . "freeswitch-reload-xml.pl");
}


sub CheckSum(){

     my $dbh = DBI->connect('DBI:mysql:viking;host=viking_webserver_private_ip', 'viking', 'V1k1ng') || die "Could not connect to database: $DBI::errstr";
     my $sth = $dbh->prepare("select reload from ws_settings;") or die "Couldn't prepare statement: " . $dbh->errstr;
     $sth->execute();
     my $checksum;
     while (my @data = $sth->fetchrow_array()) {
          $checksum = $data[0];
     }
     return $checksum;

}

sub ReloadDone{

     my $dbh = DBI->connect('DBI:mysql:viking;host=viking_webserver_private_ip', 'viking', 'V1k1ng') || die "Could not connect to database: $DBI::errstr";
     my $sth = $dbh->prepare("update ws_settings set reload = 'NO';") or die "Couldn't prepare statement: " . $dbh->errstr;
     $sth->execute();
}
