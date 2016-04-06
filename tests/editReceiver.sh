#!/bin/bash

curl -X PUT -d "{\"name\": \"John Edit\", \"email\": \"edit${RANDOM}.com\", \"birthday\": \"2016-01-01\", \"bl_active\": \"y\"}" https://sendmail-upd-marcosdalte.c9users.io/willer/api/receivers/13
echo
