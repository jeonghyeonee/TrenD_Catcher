import snscrape.modules.twitter as sntwitter
import pandas as pd

# Below are two ways of scraping using the Python Wrapper.
# Comment or uncomment as you need. If you currently run the script as is it will scrape both queries
# then output two different csv files.

# Query by username
# Setting variables to be used below
maxTweets = 1000

# Creating list to append tweet data to
tweets_list1 = []
scrape = sntwitter.TwitterSearchScraper('오징어게임 since:2021-10-01 until:2021-12-04').get_items()
# Using TwitterSearchScraper to scrape data
for i,tweet in enumerate(scrape):
    print(i,tweet,tweet.lang)
    if tweet.lang =="ko":
        
        if i>maxTweets:
            break
        tweets_list1.append([tweet.date, tweet.id, tweet.content, tweet.user.username])
    else:
        continue

# Creating a dataframe from the tweets list above
tweets_df1 = pd.DataFrame(tweets_list1, columns=['Datetime', 'Tweet Id', 'Text', 'Username'])

# Display first 5 entries from dataframe
# tweets_df1.head()

# Export dataframe into a CSV
tweets_df1.to_csv('squid-tweets.csv', sep=',', index=False)
test= pd.read_csv('squid-tweets.csv',nrows=10)
print(test)
