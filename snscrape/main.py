'''
#twitter api token

API key = 746BMTB14vXuhtOwNJkqJEndX
API Secret Key = CnvarVtG86bhlpZAF4nJ6ZaoS2qzZTIPod1Mc16qQt1LqStfq5
Bearer Token = AAAAAAAAAAAAAAAAAAAAAHyhPwEAAAAALKrI0h1Ct2Cz2Zupaym%2FlW4xd6U%3D1m5Gemz9PsV2bba7CA0Pn2A2R3SpZgzGS41EMhDW63zD2Bzvz6

Access Token = 1396063468004909056-JBMoHsUFWui92bkXCAAU115EiRQTZc
Access Token Secret = 33Di06BOxvTCXTJs5CWunAIA0Ubre01ikwqSKlwtA5OXR
'''


import snscrape.modules.twitter as sntwitter
import pandas as pd

# Below are two ways of scraping using the Python Wrapper.
# Comment or uncomment as you need. If you currently run the script as is it will scrape both queries
# then output two different csv files.

# Query by username
# Setting variables to be used below
maxTweets = 500

# Creating list to append tweet data to
tweets_list1 = []
scrape = sntwitter.TwitterSearchScraper('squidgame since:2021-10-01 until:2021-12-04').get_items()
# Using TwitterSearchScraper to scrape data
for i,tweet in enumerate(scrape):
    print(i,tweet,tweet.lang)
    if i>maxTweets:
        break
    tweets_list1.append([tweet.date, tweet.id, tweet.content, tweet.user.username])

# Creating a dataframe from the tweets list above
tweets_df1 = pd.DataFrame(tweets_list1, columns=['Datetime', 'Tweet Id', 'Text', 'Username'])

# Display first 5 entries from dataframe
# tweets_df1.head()

# Export dataframe into a CSV
tweets_df1.to_csv('user-tweets.csv', sep=',', index=False)

test= pd.read_csv('user-tweets.csv',nrows=10)
print(test)
