import numpy as np
import pandas as pd
from pandas import DataFrame
import word2word
import nltk
import re
from konlpy.tag import Okt # 빠르고 비교적 정확
# mecab = Mecab()

# 필요한 패키지와 라이브러리를 가져온다

import matplotlib as mpl
import matplotlib.pyplot as plt
import matplotlib.font_manager as fm

# 그래프에서 마이너스 폰트 깨지는 문제에 대한 대처
mpl.rcParams['axes.unicode_minus'] = False


# print([(f.name, f.fname) for f in fm.fontManager.ttflist if 'Nanum' in f.name])
plt.rcParams["font.family"] = 'NanumBarunpen'
plt.rcParams["font.size"] = 5


def make_top_word_graph(text, top):
    topWord = text.vocab().most_common(top)  # top n word
    count = 20  # top word on graph
    xlist = [a[0] for a in topWord[:count]]
    ylist = [a[1] for a in topWord[:count]]
    plt.figure(0)
    plt.xlabel('Word')
    plt.xticks(rotation=70)  # x축 라벨 회전
    plt.ylabel('Count')
    plt.title('keyword' + ' TOP ' + str(count) + ' WORD')
    plt.ylim([10, 10000])  # y축 범위 (최대값을 기준으로 동일하게 설정하기 위함)
    plt.plot(xlist, ylist,'k+')
    colors = ['darkslategray','darkslategray','darkslategrey','darkslategrey','teal','teal',\
              'darkcyan','cadetblue','cadetblue','darkturquoise','darkturquoise','lightseagreen',\
              'lightseagreen','mediumturquoise','mediumturquoise','cyan','cyan','aqua','aqua','turquoise']
    plt.bar(xlist,ylist,color=colors)
    plt.savefig('top-word-graph-parasite.png', dpi=400)
    # make text file
    make_top_file(topWord)

def make_top_file(list):  # make txt file
    with open("keyword-" + 'top-word.txt', 'wt', encoding='utf-8') as f:
        for l in list:
            f.write(l[0] + "/" + str(l[1]) + "\n")
    return 0

# def term_frequency(doc): # 감성분석
#     return [doc.count(word) for word in selected_words]

df= pd.read_csv('user-tweets_2.csv')
df_text =df.iloc[:,[2]] # text 열만 불러옴 type : DataFrame
list_text = np.array(df_text.values).flatten().tolist() # df를 list 로 변환 type : list
result= ' '.join(s for s in list_text) # 타입 : string 하나의 문자열로 만들어 형태소 분석하기 위해
tokens = Okt().nouns(result) # 형태소 분석 리스트
new_tokens=[]
for i in tokens:
 if len(i) >= 3 :
    new_tokens.append(i)
text = nltk.Text(new_tokens)
# 중복을 제외한 토큰의 개수
# text = list(set(text.tokens)) # 중복 제거
make_top_word_graph(text, 100)