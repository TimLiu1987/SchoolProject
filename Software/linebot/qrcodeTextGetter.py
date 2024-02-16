from ctypes.wintypes import tagPOINT
import re
from sys import implementation
import cv2
import requests
from bs4 import BeautifulSoup
from bs4 import element
from bs4 import NavigableString
from  urllib.request import urlopen

url = 'https://3dda-2001-b400-e28c-5b38-3848-a407-ada8-795.jp.ngrok.io/linebot/scanner.php'

html=urlopen(url).read().decode('utf-8')
soup=BeautifulSoup(html,'html.parser')
text=soup.find("div",{"id":"outputMessage"})
print(text)



