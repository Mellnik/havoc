#!/bin/bash

if [ -f nohup.out ] ; then
rm nohup.out
echo "Deleting nohup.out"
fi

if [ -f server_log.txt ] ; then
rm server_log.txt
echo "Deleting Server log"
fi

if [ -f mysql_log.txt ] ; then
rm mysql_log.txt
echo "Deleting MySQL log"
fi

if [ -f scriptfiles/cmdlog.txt ] ; then
rm scriptfiles/cmdlog.txt
echo "Deleting Command log"
fi

if [ -f scriptfiles/chatlog.txt ] ; then
rm scriptfiles//chatlog.txt
echo "Deleting Chat log"
fi
