#!/bin/bash

curl -X PUT -d "{\"name\": \"John Doe\", \"email\": \"mail${RANDOM}.com\", \"birthday\": \"1970-01-01\"}" https://sendmail-upd-marcosdalte.c9users.io/willer/backend/receiver/add
echo