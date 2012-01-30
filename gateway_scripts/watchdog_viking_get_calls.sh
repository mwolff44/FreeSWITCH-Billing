#!/bin/bash

FSPID=`ps -ef | grep viking_get_calls.pl | grep -v grep | wc -l`
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
COMMAND=$DIR"/viking_get_calls.pl"

if [ $FSPID -gt 0 ];
then
        echo "Process is running..."
else
        echo "We should start the process..."
        exec nohup $COMMAND &
fi

exit
