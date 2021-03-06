#!python :)
#This program runs through the tweets and verifies which language they are. If they are misclassified, the language detector resets their language in the database.
import mysql.connector
from mysql.connector import errorcode

import langdetect
from langdetect import detect

import MySQLdb.cursors

#try
database = mysql.connector.connect(host = "127.0.0.1", user="tdesell", passwd= "TDBoinc12", db="csg") # cursorclass = MySQLdb.cursors.DictCursor)
#except mysql.connector.Error as err:
   # if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
    #    print("Something is wrong with your user name or password")
    #if err.errno == errorcode.ER_BAD_DB_EERROR:
     #   print("Database does not exist")
      #  print(err)
  #  else:
   #     database.close()
#	print("Unsuccessful Connection")

cleaner = database.cursor() #can specify cursorclass parameter

cleaner.execute("SELECT * FROM climate_tweets")
#tweets = cleaner.fetchall()#select text, lang detect
tweets = cleaner.fetchmany()
#fetchmany(size=num!) selects batch of rows and returns as list of tuples!! returns empty list once rows are all gone

for tweet in tweets:
    text = tweet['lang']
    realLang = detect(text)
    if realLang == text:
	print 'same lang!'
	continue
	
    else:
	print 'not same :('
	query = "REPLACE INTO climate_tweets SET language = '%s' WHERE text = '%s' " %(realLang, text)
	cleaner.execute(query)
	continue

cleaner.close()
database.close()

