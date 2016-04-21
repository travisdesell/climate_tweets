#python - program sorts through tweets in database and labels whether contains profanity or not

    ('SELECT * FROM climate_tweets')
    #tweets = point.fetchall()#select text, lang detect
    tweet_tuple = point.fetchall()
    #fetchmany(size=num!) selects rows and returns as list of tuples!! returns empty list once rows are all gone
"""real program starts"""
#variables
lines = None
words = None
_ROOT = os.path.abspath(os.path.dirname(__file__))

#gets path
#def get_data(path):
#    return os.path.join(_ROOT, 'data', path)

"""Gets wordlist. If wordlist is not loaded, calls load_words to cache list"""
def get_words():
    if not words:
        load_words()
    return words

"""Checks the input_text for any profanity and returns True if it does.
Otherwise, returns False.
"""
def contains_profanity(words, input_text):
    result = False
    tweet_text = [x for x in input_text.split()]
    for cuss in words:
	if cuss in tweet_text:
            print cuss
            result = True
    return result

""" Loads and caches the profanity word list. Input file (if provided)
should be a flat text file with one profanity entry per line.
"""
def load_words(wordlist=None):
    global words
    if not wordlist:
        # no wordlist was provided, load the wordlist from the local store
        f = open('profanitylist.txt', 'r')
        wordlist = f.readlines()
        wordlist = [w.strip() for w in wordlist if w]
    words = wordlist
   

#main code - uses functions to verify profanity
for tweet in tweet_tuple:
    text = tweet[3]
    tweetID = tweet[1]
    get_words()
  
    if contains_profanity(words, text):
        point.execute("UPDATE climate_tweets SET prof = %s WHERE tweet_id = %s", (1, tweetID))
	print(tweetID, 'profane')      	
    else:
        point.execute("UPDATE climate_tweets SET prof = %s WHERE tweet_id = %s", (0, tweetID)) 
        print(tweetID, 'not profane')

point.close()
database.close()
  
