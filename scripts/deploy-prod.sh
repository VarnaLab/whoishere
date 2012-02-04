#!/bin/bash
# example: 
# /projects/camplight.net$ ./scripts/deploy-prod.sh <user> <server> <path>
user=$1
server=$2
target=$3
me=`dirname $0`
rsync -axvzco --exclude-from=$me/deploy-prod.exclude $me/../ $user@$server:$target