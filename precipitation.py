
# coding: utf-8
import requests
import csv
from datetime import datetime

params = {
  'access_key': '95028c4565a979f0797c0aabc527b3ea',
  'query': 'Paris'
}

api_result = requests.get('http://api.weatherstack.com/current', params)

api_response = api_result.json()

#we get the current precipitation
precip = api_response['current']['precip']

#we get the current date and time
now = datetime.now()
dt_string = now.strftime("%d/%m/%Y %H:%M:%S")

if precip == 0 : #s'il ne pleut pas
	c = csv.writer(open('meteo_database.csv', 'a'))
	c.writerow(["0",dt_string])
else : #s'il pleut
	c = csv.writer(open('meteo_database.csv', 'a'))
        c.writerow(["1",dt_string])
