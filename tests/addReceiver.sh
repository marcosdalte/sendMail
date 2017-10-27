#!/bin/bash

#Example CURL datapost
#curl -X POST -d "name=marcos+r+dalte&email=mail${RANDOM}4%40.com&birthday=1980-09-26" https://sendmail-upd-marcosdalte.c9users.io/willer/api/receivers
curl -X POST -d "{\"name\": \"John Doe edit\", \"email\": \"editmail${RANDOM}.com\", \"birthday\": \"1970-01-01\"}" https://sendmail-upd-marcosdalte.c9users.io/willer/api/receivers
echo