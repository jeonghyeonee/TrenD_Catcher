'''
#twitter api token

API key = 746BMTB14vXuhtOwNJkqJEndX
API Secret Key = CnvarVtG86bhlpZAF4nJ6ZaoS2qzZTIPod1Mc16qQt1LqStfq5
Bearer Token = AAAAAAAAAAAAAAAAAAAAAHyhPwEAAAAALKrI0h1Ct2Cz2Zupaym%2FlW4xd6U%3D1m5Gemz9PsV2bba7CA0Pn2A2R3SpZgzGS41EMhDW63zD2Bzvz6

Access Token = 1396063468004909056-JBMoHsUFWui92bkXCAAU115EiRQTZc
Access Token Secret = 33Di06BOxvTCXTJs5CWunAIA0Ubre01ikwqSKlwtA5OXR
'''

# 넷플릭스 영화 순위 크롤링

# 비영어권 영화
from numpy import empty
import requests
from bs4 import BeautifulSoup

headers = {'User-Agent' : 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36'}
data = requests.get('https://top10.netflix.com/films-non-english',headers=headers) # 넷플릭스 전 세계 순위 링크
soup = BeautifulSoup(data.text, 'html.parser')
movies = soup.select("#weekly-lists > div > div.px-3 > div > div.list-table > div > table > tbody > tr")
#weekly-lists > div > div.px-3 > div > div.list-table > div > table > tbody > tr:nth-child(1)
ranking = 1;
movie_name_list = []
for movie in movies:
  movie_name = movie.select_one("td.pb-2.font-600.text-sm.xs\:text-base.sm\:text-lg.leading-tight")
  movie_name_convert = str(movie_name.text)
  movie_name_convert= movie_name_convert.replace(" ","")
  movie_name_convert= movie_name_convert.replace(",","")
  lst = [i for i in movie_name_convert]
  data = ":"
  if data in lst:
    idx = lst.index(data)
    del lst[idx:]
  movie_name_convert="".join(lst)
  movie_name_list.append(movie_name_convert)
  movie_hours_viewed = movie.select_one("td.pb-2.text-right.overflow-visible.sm\:block.text-sm.xs\:text-base.sm\:text-lg.xs\:flex.flex-col.items-end.md\:flex-row.md\:items-center.justify-end.leading-tight > span")
  if movie_name is not None:
    ranking = movie.select_one("td.pb-2.opacity-60.pr-2.sm\:pr-5.w-48px.sm\:w-64px.text-left.sm\:text-center.hidden.sm\:table-cell")
    print(ranking.text, movie_name.text, movie_hours_viewed.text)
print(movie_name_list)

# 비영어권 드라마
import requests
from bs4 import BeautifulSoup

headers = {'User-Agent' : 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36'}
data = requests.get('https://top10.netflix.com/tv-non-english',headers=headers) # 넷플릭스 전 세계 순위 링크
soup = BeautifulSoup(data.text, 'html.parser')
dramas = soup.select("#weekly-lists > div > div.px-3 > div > div.list-table > div > table > tbody > tr")
#weekly-lists > div > div.px-3 > div > div.list-table > div > table > tbody > tr:nth-child(1)
ranking = 1;
drama_name_list = []
for drama in dramas:
  drama_name = drama.select_one("td.pb-2.font-600.text-sm.xs\:text-base.sm\:text-lg.leading-tight")
  drama_name_convert = str(drama_name.text)
  drama_name_convert= drama_name_convert.replace(" ","")
  drama_name_convert= drama_name_convert.replace(",","")
  lst = [i for i in drama_name_convert]
  data = ":"
  if data in lst:
    idx = lst.index(data)
    del lst[idx:]
  drama_name_convert="".join(lst)
  drama_name_list.append(drama_name_convert)
  drama_name_list.append(drama_name_convert)
  #weekly-lists > div > div.px-3 > div > div.list-table > div > table > tbody > tr:nth-child(1) > td.pb-2.text-right.overflow-visible.sm\:block.text-sm.xs\:text-base.sm\:text-lg.xs\:flex.flex-col.items-end.md\:flex-row.md\:items-center.justify-end.leading-tight.pt-2
  drama_hours_viewed = drama.select_one("td.pb-2.text-right.overflow-visible.sm\:block.text-sm.xs\:text-base.sm\:text-lg.xs\:flex.flex-col.items-end.md\:flex-row.md\:items-center.justify-end.leading-tight > span")
  if drama_name is not None:
    ranking = drama.select_one("td.pb-2.opacity-60.pr-2.sm\:pr-5.w-48px.sm\:w-64px.text-left.sm\:text-center.hidden.sm\:table-cell")
    print(ranking.text, drama_name.text, drama_hours_viewed.text)
print(drama_name_list)



# 트위터 크롤링

import snscrape.modules.twitter as sntwitter
import pandas as pd
# import os

# Below are two ways of scraping using the Python Wrapper.
# Comment or uncomment as you need. If you currently run the script as is it will scrape both queries
# then output two different csv files.

# Query by username
# Setting variables to be used below
maxTweets = 180000

# Creating list to append tweet data to
for i in range(0,20,2):
    # init list and dataframe
    tweets_list1 = []
    tweets_df1 = pd.DataFrame()

    # get data from netflix drama list
    hash = drama_name_list[i]
    print(hash)
    query = hash
    # print(query)
    
    scrape = sntwitter.TwitterSearchScraper(drama_name_list[i]+' since:2020-01-01 until:2022-03-28').get_items()
    # scrape = sntwitter.TwitterSearchScraper('그해우리는 since:2021-12-06 until:2022-03-27').get_items()    #의미 X -> 배우이름만 출력
    # scrape = sntwitter.TwitterSearchScraper('from:오징어게임 since:2021-10-01 until:2021-12-04').get_items()    # 달고나
    # scrape = sntwitter.TwitterSearchScraper('기생충 since:2019-05-30 until:2020-12-31').get_items()    # 채끝 짜파구리
    # scrape = sntwitter.TwitterSearchScraper('영화 극학직업 since:2019-01-23 until:2021-12-31').get_items()    # 수원왕갈비통닭 -> 출력 X

    # print(type(scrape))
    # Using TwitterSearchScraper to scrape data
    for j,tweet in enumerate(scrape):
        print(j,tweet,tweet.lang)
        if j>=maxTweets:
            break
        tweets_list1.append([tweet.date, tweet.id, tweet.content, tweet.user.username])


    # Creating a dataframe from the tweets list above
    print(tweets_list1)
    print(len(tweets_list1))
    tweets_df1 = pd.DataFrame(tweets_list1, columns=['Datetime', 'Tweet Id','Text', 'Username'])

    # Display first 5 entries from dataframe
    # tweets_df1.head()

    name = "user-tweets-{}".format(query)
    tweets_df1.to_csv('{}.csv'.format(name), sep=',', index=False)
    print("create csv file")


    # my_path = "C:/Users/yjyj0/PycharmProjects/DBproject"
    # f_name = "/tweets"
    # for n in drama_name_list :
    #   os.mkdir(my_path + f_name + str(n))
    #
    # Export dataframe into a CSV file
    #   tweets_df1.to_csv('user-tweets.csv', sep=',', index=False)
    #   test= pd.read_csv('user-tweets.csv', nrows=10)
    #   print(test)
    #   n += 1

