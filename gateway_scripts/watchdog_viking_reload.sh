#!/bin/bash

FSPID=`ps -ef | grep viking_reload.pl | grep -v grep | wc -l`
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
COMMAND=$DIR"/viking_reload.pl"

if [ $FSPID -gt 0 ]; then
	echo "Process is running..."
else
	echo "We should start the process..."
        exec nohup $COMMAND &
fi

exit

