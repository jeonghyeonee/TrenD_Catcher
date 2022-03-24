# 셀레니움 설치

# 필요 모듈 임포트
import requests
from bs4 import BeautifulSoup
from selenium import webdriver as wd
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time
import re
import pandas as pd
import numpy as np
import urllib
from datetime import datetime
from selenium.webdriver.chrome.service import Service
from urllib3.util import url
from webdriver_manager.chrome import ChromeDriverManager
import pandas as pd
import numpy as np

import selenium
from selenium import webdriver

from bs4 import BeautifulSoup as bs
from urllib.request import urlopen, Request
from urllib.parse import quote_plus

import time
from tqdm import tqdm_notebook
import warnings

warnings.filterwarnings('ignore')


url = 'http://www.instagram.com'

'''
driver.get("https://www.instagram.com/accounts/login/")
time.sleep(2)



# 로그인
id_box = driver.find_element_by_css_selector("#loginForm > div > div:nth-child(1) > div > label > input")
password_box = driver.find_element_by_css_selector("#loginForm > div > div:nth-child(2) > div > label > input")
login_button = driver.find_element_by_css_selector('#loginForm > div > div:nth-child(3) > button')

act = ActionChains(driver)

act.send_keys_to_element(id_box,'01062759974').send_keys_to_element(password_box,'1q0p2w9o~').click(login_button).perform()
time.sleep(3)

# 3.내 피드로 이동하기
# 3-1. 팝업 클릭하기
first_popup = driver.find_element_by_css_selector('#react-root > div > div > section > main > div > div > div > div > button')
first_popup.click()
time.sleep(2)
'''


def instagram_login(id, pw):
    driver.get(url)
    driver.implicitly_wait(5)
    driver.find_element_by_name('username').send_keys(id)  # id 입력
    elem_pw = driver.find_element_by_name('password')  # pw 입력
    elem_pw.send_keys(pw)
    elem_pw.submit()

    driver.implicitly_wait(5)  # 파싱될 때까지 5초 기다림 (미리 완료되면 waiting 종료됨)
    driver.find_element_by_class_name('cmbtv').click()  # 비밀번호 저장하지 않음


    driver.implicitly_wait(5)
    driver.find_element_by_css_selector('div.RnEpo.Yx5HN > div > div > div > div.mt3GC > button.aOOlW.HoLwm').click()  # 알림설정 무시

def set_chrome_driver():
    chrome_options = webdriver.ChromeOptions()
    driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=chrome_options)
    return driver


driver = set_chrome_driver()
driver.set_window_size(414, 900)
url = 'http://www.instagram.com'
instagram_login("01062759974", "1q0p2w9o~")

keyword = "오징어게임"
hash_url = "https://www.instagram.com/explore/tags/{}/".format(keyword) # 해시태그 url
# dataframe 만들기(tags 컬럼(t1은 최대 20개까지로...))
insta_df = pd.DataFrame("", index=np.arange(1,9400), columns=["account","date", "t1", "t2", "t3", "t4", "t5", "t6", "t7", "t8", "t9", "t10" , "t11", "t12", "t13", "t14", "t15", "t16", "t17", "t18", "t19", "t20"])
instagram_account =[]
instagram_tags = []
instagram_tag_dates = []

driver.get(hash_url)
time.sleep(3)

# 맨 왼쪽 상단 첫 게시물 클릭
driver.find_element_by_css_selector('div.v1Nh3.kIKUG._bz0w').click()
time.sleep(3)

# 데이터 기록, 다음 게시물로 클릭
for i in range(9400):
    try: # account 데이터 기록
        account_data = driver.find_element_by_css_selector('a.sqdOP.yWX7d._8A5w5.ZIAjV')
        account_text = account_data.text
        # 날짜 기록
        date = driver.find_element_by_css_selector("time.FH9sR.Nzb55").text# 날짜 선택

        # 날짜 데이터가 시간, 일, 분 단위이면 0주로 변환
        if date.find('시간') != -1 or date.find('일') != -1 or date.find('분') != -1:
            date_text = '0주'
        else:
            date_text = date

        # 해쉬태그 데이터 기록
        data = driver.find_element_by_css_selector('.C7I1f.X7jCj')
        tag_raw = data.text
        tag = re.findall('#[A-Za-z0-9가-힣]+', tag_raw)
        tag = ''.join(tag).replace("#"," ") # "#" 제거
        tag_data = tag.split()
    except:
        tag_data = "error"
        date_text = "error"
    try: # 최대 50초까지 기다렸다가, > 모양 클릭하여 다음 게시물로 넘어가기
        WebDriverWait(driver,50).until(EC.presence_of_element_located((By.CSS_SELECTOR, 'a._65Bje.coreSpriteRightPaginationArrow')))
        driver.find_element_by_css_selector('a._65Bje.coreSpriteRightPaginationArrow').click()
    except:
        driver.close()
    time.sleep(5)
    if (i+1)%50 == 0 : print('{}, {}번째 게시물 탐색 완료'.format(time.strftime('%c', time.localtime(time.time())), i+1))
    # dataframe 저장
    insta_df.iloc[i, 0] = account_text
    insta_df.iloc[i, 1] = date_text
    for j in range(17):
        try:
            insta_df.iloc[i,j+2] = tag_data[j]
        except :
            break

# 결과값 저장
insta_df.to_excel("D:///instagram/////results.xlsx")
