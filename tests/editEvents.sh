#!/bin/bash

#curl -X PUT -d "{\"dt_admission\": \"2016-07-07\", \"receiver_id\": \"1\", \"name\":\"Marcos Baladay\", \"bl_active\": \"y\", \"receiver_bl_active\": \"y\"}" https://sendmail-upd-marcosdalte.c9users.io/willer/api/employees/2
curl -X PUT -d "{\"dt_event\": \"2016-07-07\"}" https://sendmail-upd-marcosdalte.c9users.io/willer/api/events/2
echo