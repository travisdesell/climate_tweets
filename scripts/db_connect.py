#!/usr/bin/python
import MySQLdb

#from "../../db_info/csg_database.py" import db_name, db_user, db_host, db_pass
from "../../db_info/csg_database.py"

print "connecting to database '%s' with user '%s' on host '%s' using password '%s'" % (db_name, db_user, db_host, db_pass)

db = MySQLdb.connect(host=db_host,    # your host, usually localhost
                     user=db_user,         # your username
                     passwd=db_pass,  # your password
                     db=db_name)        # name of the data base

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Use all the SQL you like
cur.execute("SELECT * FROM climate_tweets LIMIT 10")

# print all the first cell of all the rows
for row in cur.fetchall():
    for val in row:
        print val,
    print "\n"

db.close()
