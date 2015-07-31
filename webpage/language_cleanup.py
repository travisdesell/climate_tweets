#!python :)
from langdetect import detect
import mySQLdb as mdb
import MySQLdb.cursors

database = mdb.connect(host= , user="tdesell", passwd= , db="csg", cursorclass = MySQLdb.cursors.DictCursor)
cleaner = database.cursor() #can specify cursorclass parameter

cleaner.execute("SELECT * FROM climate_tweets")
tweets = cleaner.fetchall()#select text, lang detect

for tweet in tweets:
    text = tweet['text']
    result = detect(text)
    if result == tweet['lang']
	continue
    else:
	tweet['lang'] = result
	#reassign to table
	continue

*curse.execute("INSERT INTO climate_tweets SET user_id = $user_id, tweet_id = $tweet_id, insert_time = ...")



curse.close()
db.close()
