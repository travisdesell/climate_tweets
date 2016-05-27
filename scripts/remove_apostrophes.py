#!/usr/bin/python
import MySQLdb
import os
import random
import re

from csg_database import db_name, db_user, db_host, db_pass

print "connecting to database '%s' with user '%s' on host '%s' using password '%s'" % (db_name, db_user, db_host, db_pass)

db = MySQLdb.connect(host=db_host,    # your host, usually localhost
                     user=db_user,         # your username
                     passwd=db_pass,  # your password
                     db=db_name)        # name of the data base
cur = db.cursor()

# Use all the SQL you like
cur.execute("SELECT * FROM climate_tweets")
tweet_tuple = cur.fetchall();
#lines = None
#words = None
#_ROOT = os.path.abspath(os.path.dirname(__file__))
for tweet in tweet_tuple:
	text = tweet[3]

	if contains_symbol(words, text):

db.close()
