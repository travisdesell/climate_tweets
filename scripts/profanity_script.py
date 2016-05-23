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

def get_words():
	if not words:
		load_words()
	return words

def contains_profanity(words, input_text):
	result = False
	tweet_text = [x for x in input_text.split()]
	for cuss in words:
		if cuss in tweet_text:
			print cuss
			result = True
	return result

def load_words(wordlist=None):
	global words
	if not wordlist:
		f=open('bad_words.txt', 'r')
		wordlist = f.readlines()
		wordlist = [w.strip() for w in wordlist if w]
	words = wordlist

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Use all the SQL you like
cur.execute("SELECT * FROM climate_tweets")
tweet_tuple = cur.fetchall();
#lines = None
#words = None
#_ROOT = os.path.abspath(os.path.dirname(__file__))
for tweet in tweet_tuple:
	text = tweet[3]
	tweetID = tweet[1]
	load_words()
	get_words()

	if contains_profanity(words, text):
		cur.execute("UPDATE climate_tweets SET prof = %s WHERE tweet_id = %s", (1, tweetID))
		print(tweetID, 'profane')
	else:
		cur.execute("UPDATE climate_tweets SET prof = %s WHERE tweet_id = %s", (0, tweetID))
 		#print(text, 'not profane')


db.close()
