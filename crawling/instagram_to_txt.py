import keyword

from bs4 import BeautifulSoup
import re
import requests
from datetime import datetime

header = {
'accept': '*/*',
'accept-encoding': 'gzip, deflate, br',
'accept-language': 'ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7',
'cookie': 'mid=Yjgc6QALAAHXaXlbS6NviXr3LHjN; ig_did=A34F1249-318F-4FB1-A81E-34B1C7F372E4; ig_nrcb=1; csrftoken=TKrPRN6tbZNh6ZBS1yR0QbUCtmaEuIYI; ds_user_id=12525289769; sessionid=12525289769%3AFxot4JrANfUfbd%3A23; shbid="11478\05412525289769\0541679380741:01f7867af3f55878da88090490861eb85190393b0c341fd27d204841e432b150ea4f99d0"; shbts="1647844741\05412525289769\0541679380741:01f7a71e4809fcf18fce07efbaf7f7a94e7b8f5182d2e1269a31fa705ca95cf62cfa50e4"; rur="EAG\05412525289769\0541679381536:01f78ed05b09a44322a24599cbf2e8f69c5504994484c258754726fcc4f680abb1b424da"',
'referer': 'https://www.instagram.com/explore/tags/%EC%98%A4%EC%A7%95%EC%96%B4%EA%B2%8C%EC%9E%84/',
'sec-ch-ua': '" Not A;Brand";v="99", "Chromium";v="99", "Google Chrome";v="99"',
'sec-ch-ua-mobile': '?0',
'sec-ch-ua-platform': "Windows",
'sec-fetch-dest': 'empty',
'sec-fetch-mode': 'cors',
'sec-fetch-site': 'same-origin',
'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.74 Safari/537.36',
'x-asbd-id': '198387',
'x-ig-app-id': '936619743392459',
'x-ig-www-claim': 'hmac.AR2T8zrsruvLQUlYKcfLAjqX1XM3fcz68NR1LzM9vC-Dwo7L',
'x-requested-with':'XMLHttpRequest'
}



from pprint import pprint
# pprint(res)

# res.keys()
# print(res['data'].keys())
# print(res['data']['media_count'])
# print(res['data']['profile_pic_url'])
# print(res['data']['recent'])
# print(res['data']['recent'].keys())
# print(res['data']['recent']['next_page'])
# print(res['data']['recent']['next_max_id'])
# print(res['data']['recent']['next_media_ids'])

# res['data']['recent']['sections']

def delrn(text):

    return text.lstrip().rstrip().replace("\n","").replace("\r","")

###
dataList = []
URL = 'https://www.instagram.com/explore/tags/%EC%98%A4%EC%A7%95%EC%96%B4%EA%B2%8C%EC%9E%84/?__a=1&__d=dis'
while(True):
    res = requests.get(URL,headers=header)
    res=res.json()
    if 'next_page' not in res['data']['recent'].keys() or int(res['data']['recent']['next_page']) == 0:
        break

    max_id = res['data']['recent']['next_max_id']

    for n in res['data']['recent']['sections']:
        for m in ((n['layout_content']['medias'])):
            m = m['media']
            data = {}
            data['keyword'] = '오징어게임'
            data['pagePk'] = m['code']
            data['URL'] = 'https://www.instagram.com/p/'+ data['pagePk']+"/"
            try:
                data['DatePublished'] = datetime.fromtimestamp(m['caption']['created_at'])
            except: continue
            data['Content'] = delrn(m['caption']['text'])
            try:
                data['reply'] = (m['comment_count'])
                data['replyList'] = (m['comments'])
            except:
                data['reply'] = 0
                data['replyList'] = []
            data['like'] = (m['like_count'])
            data['pk'] = str(m['pk'])
            data['user_full_name'] = (m['user']['full_name'])
            data['user_pk'] = str(m['user']['pk'])
            data['user_name'] = (m['user']['username'])
            data['user_profile'] = (m['user']['profile_pic_url'])
            dataList.append(data)

    URL = 'https://www.instagram.com/explore/tags/'+keyword+'/?__a=1&max_id='+max_id


print(dataList)
