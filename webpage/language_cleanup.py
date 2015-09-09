#!python :)
#from config import Config - safer for connecting?

import mysql.connector
from mysql.connector import errorcode

import langdetect
from langdetect import detect

#import MySQLdb.cursors
#config = {} can also connect using dictionary of arguments/passwords **configi

try:
    database = mysql.connector.connect(host = 'localhost', user='tdesell', passwd= 'TDBoinc12', db='csg', user_pure = True) # cursorclass = MySQLdb.cursors.DictCursor)
except mysql.connector.Error as err:
    if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
        print('Something is wrong with your user name or password')
    elif err.errno == errorcode.ER_BAD_DB_EERROR:
        print('Database does not exist')
    else:
        print(err)
    else:
        database.close()

cleaner = database.cursor() #can specify cursorclass parameter

try:
    cleaner.execute('SELECT * FROM climate_tweets')
    #tweets = cleaner.fetchall()#select text, lang detect
    #tweets = cleaner.fetchmany()
    #fetchmany(size=num!) selects batch of rows and returns as list of tuples!! returns empty list once rows are all gone

except mysql.connector.Error as err:
    print('Failed accessing database: {} '.format(err))
    exit(1)

for tweet in tweets:
    text = tweet['lang']
    realLang = detect(text)

    if realLang == text:
        print ('same lang!')
        continue

    else:
        print ('not same :(')
        query = 'REPLACE INTO climate_tweets SET language = '%s' WHERE text = '%s' ' %(realLang, text)
        cleaner.execute(query)
        continue

cleaner.close()
database.close()

