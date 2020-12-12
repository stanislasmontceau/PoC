# Import standard python modules and libraries needed to the program
import sys

from datetime import datetime

import csv

# This example uses the MQTTClient instead of the REST client
from Adafruit_IO import MQTTClient, Client

# Set to your Adafruit IO key.
ADAFRUIT_IO_KEY = 'aio_hwMO42kJcEhB0kpEUuXH7iGoP5vN'

# Set to your Adafruit IO username.
ADAFRUIT_IO_USERNAME = 'MarieBardet'

FEED_ID = 'water-level'
# Set to the ID of the feed to subscribe to for updates.

# Function to susbscribe to Adafruit
# In other words, we're going to collect the value from the feed we have set
def getvalue():
        try:
                aio = Client(ADAFRUIT_IO_USERNAME, ADAFRUIT_IO_KEY) # Connection to Adafruit
                data = aio.receive_next(FEED_ID) # Subscribe to the value
        except Exception as e:
                data = -1
        return data


# Function to send an order based on the value we're collecting
def orderhumidity():
        content_variable = open('waterlevel', "r") # Open to read the CSV we generate from the main
        file_lines = content_variable.readlines() # Read each line of the CSV
        content_variable.close() # Close the CSV file
        last_line = file_lines[len(file_lines)-1]
        l = last_line.split(',') # Convert into a list

        waterlevel = int(l[1]) # Convert the 2nd value of the list into an integer which correspond to the humidity

        order = 0 # If we don't take any action

        if waterlevel < 30 : # If we need to irrigate
                order = 1
        return order

# Function to publish in Adafruit
# In order words, we're going to send the order value to a new feed
def publish(order):
        aio = Client(ADAFRUIT_IO_USERNAME, ADAFRUIT_IO_KEY) # Connect to the client
        try:
                temp_feed = aio.feeds('order') # Set up the feed
        # If the feed doesn't exist, we create a new one
        except RequestError:
                temp_feed=Feed(name='order')
                temp_feed=aio.create_feed(temp_feed)

        aio.send('order',order) # Send the order value to Adafruit


        # We are going to create a new database (CSV) containing the order and its time
        # Collect the time
        now = datetime.now()
        dt_string = now.strftime("%d/%m/%Y %H:%M:%S") # Convert into a string

        c = csv.writer(open('order.csv', 'a'))
        c.writerow([order,dt_string]) # Writing in a line the order and its time


def main():
	# This two variables are going to be used in the waterlevel CSV
        data_level = 0 # water level data we're collecting from the feed water-level
        date_csv = 0 # time of when we're collecting the water level data

        while data_level != -1: # While there's still data to collect in the feed
                data_level = getvalue() # Collecting the value, which is a dictionnary
                if data_level != -1: # If there's still data
                        #print(data.value)
                        #print(data.created_at)
                        valeur = str(data_level.value) # Convert the water level value into a string
                        date_csv = data_level.created_at # Collecting the time of when the data is created in the feed
                        date_csv = datetime.strptime(date_csv, '%Y-%m-%dT%H:%M:%SZ') # Convert into a datetime, need this type to display the value in our graphic
                        c = csv.writer(open('humidity_data.csv', 'a')) # Open a CSV to write the data we're collecting
                        c.writerow([date_csv, valeur]) # Writing the water level value and its time creation

        ordre = orderhumidity() # Getting the order based on the last value we're reading
        #print(ordre)
        publish(ordre) # Publish the last order from the "ordre" function

if __name__ == "__main__":
        main()

