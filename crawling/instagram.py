from selenium import webdriver
from selenium.webdriver.chrome.service import Service
import driver

import time
import pandas as pd

s = Service('chromedriver.exe')
driver = webdriver.Chrome(service=s)
driver.get('https://www.instagram.com/accounts/login/')


instagram_id="write your id"
instagram_pw="write your password"

_id = driver.find_element_by_name('username')
_id.send_keys(instagram_id)
time.sleep(2)

_password = driver.find_element_by_name('password')
_password.send_keys(instagram_pw)
time.sleep(2)

login_button = driver.find_element_by_css_selector('.sqdOP.L3NKy.y3zKF').click()
time.sleep(5) # 로그인 버튼 누르기

driver.find_element_by_css_selector('.sqdOP.yWX7d.y3zKF').click()
time.sleep(3) # 로그인 저장 나중에

driver.find_element_by_css_selector('.aOOlW.HoLwm').click()
time.sleep(3) # 설정 나중에


_keyword = '오징어게임' # 검색할 키워드
driver.get('https://www.instagram.com/explore/tags/' + _keyword + '/')
# #
# driver.find_element_by_css_selector('div.v1Nh3.kIKUG._bz0w').click() #첫번째 게시물 열기
# time.sleep(5)
