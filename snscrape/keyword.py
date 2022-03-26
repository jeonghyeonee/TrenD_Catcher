import numpy as np
import pandas as pd
from pandas import DataFrame
import word2word
import nltk
import matplotlib.pyplot as plt


def make_top_word_graph(result, top):
    tokens=result.split(" ")
    text = nltk.Text(tokens)  # nltk
    topWord = text.vocab().most_common(top)  # top n word
    count = 30  # top word on graph
    xlist = [a[0] for a in topWord[:count]]
    ylist = [a[1] for a in topWord[:count]]
    plt.figure(0)
    plt.xlabel('Word')
    plt.xticks(rotation=70)  # x축 라벨 회전
    plt.ylabel('Count')
    plt.title('keyword' + ' TOP ' + str(count) + ' WORD')
    plt.ylim([10, 700])  # y축 범위 (최대값을 기준으로 동일하게 설정하기 위함)
    plt.plot(xlist, ylist)
    plt.savefig('top-word-graph.png', dpi=400)  # make text file
    make_top_file(topWord)


def make_top_file(list):  # make txt file
    with open("keyword-" + 'top-word.txt', 'wt', encoding='utf-8') as f:
        for l in list:
            f.write(l[0] + "/" + str(l[1]) + "\n")
    return 0


df= pd.read_csv('user-tweets.csv')
df_text =df.iloc[:,[2]]
list_text = np.array(df_text.values).flatten().tolist() # df를 list 로 변환


df_list = []

# 데이터 전처리
for i in list_text:
    word = str(i).split(" ")
    for j in word:
        j_1 = j.replace(",","") # , 제거
        j_2 = j_1.replace(".","") # . 제거
        df_list.append(j_2)

result = ' '.join(s for s in df_list)

make_top_word_graph(result, 300)

# 대문자, 소문자 똑같이 인식
# 원소 비어있는 경우 에러 잡기