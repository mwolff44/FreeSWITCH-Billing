#!/usr/bin/perl
use DBI;
use strict;
use Digest::MD5 qw(md5_hex);

sub Reload();
sub ReloadDone;
sub CheckSum();

my $table_checksum = 0;
my $old_table_checksum = 0;
open LOG,">>","/home/david/reload_check.log";

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
        system("/home/david/freeswitch_reload_config.pl");
	system("/home/david/freeswitch-reload-xml.pl");
}


sub CheckSum(){

     my $dbh = DBI->connect('DBI:mysql:viking;host=192.168.168.2', 'username', 'password') || die "Could not connect to database: $DBI::errstr";
     my $sth = $dbh->prepare("select reload from ws_settings;") or die "Couldn't prepare statement: " . $dbh->errstr;
     $sth->execute();
     my $checksum;
     while (my @data = $sth->fetchrow_array()) {
          $checksum = $data[0];
     }
     return $checksum;

}

sub ReloadDone{

     my $dbh = DBI->connect('DBI:mysql:viking;host=192.168.168.2', 'username', 'password') || die "Could not connect to database: $DBI::errstr";
     my $sth = $dbh->prepare("update ws_settings set reload = 'NO';") or die "Couldn't prepare statement: " . $dbh->errstr;
     $sth->execute();
}
