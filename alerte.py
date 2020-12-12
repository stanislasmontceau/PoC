
# coding: utf-8
import smtplib
from email.MIMEMultipart import MIMEMultipart
from email.MIMEText import MIMEText

#on récupère le niveau d'eau
csv_hum = open ( 'humidity_data.csv', "r")
lines_hum = csv_hum.readlines()
csv_hum.close()
last_line_hum = lines_hum [len (lines_hum) -1] #chaine de caracteres
list_hum = last_line_hum.split(',') #on convertie en liste

humidity=int(list_hum[1]) #quantité d'eau

#on récupère le niveau d'eau
csv_water = open ( 'humidity_data.csv', "r")
lines_water = csv_water.readlines()
csv_water.close()
last_line_water = lines_water [len (lines_water) -1] #chaine de caractères 
list_water = last_line_water.split(',') #on convertie en liste

water=int(list_water[1]) #quantité d'eau

if humidity < 50 : #si l'humidité est trop baisse
	msg = MIMEMultipart()
	msg['From'] = 'bardetmarie2@gmail.com'
	msg['To'] = 'pocpocpoc2020@gmail.com'
	msg['Subject'] = 'Alerte système d arrosage' 
	message = 'Alerte : Le taux d humidité du mur est anormalement bas.'	
	msg.attach(MIMEText(message))
	mailserver = smtplib.SMTP('smtp.gmail.com', 587)
	mailserver.ehlo()
	mailserver.starttls()
	mailserver.ehlo()
	mailserver.login('bardetmarie2@gmail.com', 'Marie0804')
	mailserver.sendmail('bardetmarie2@gmail.com', 'bardetmarie2@gmail.com', msg.as_string())
	mailserver.quit()

if water == 0 : #si le reservoir est vide 
        msg = MIMEMultipart()
        msg['From'] = 'bardetmarie2@gmail.com'
        msg['To'] = 'pocpocpoc2020@gmail.com'
        msg['Subject'] = 'Alerte système d arrosage'
        message = 'Le réservoir d eau est vide.'
        msg.attach(MIMEText(message))
        mailserver = smtplib.SMTP('smtp.gmail.com', 587)
        mailserver.ehlo()
        mailserver.starttls()
        mailserver.ehlo()
        mailserver.login('bardetmarie2@gmail.com', 'Marie0804')
        mailserver.sendmail('bardetmarie2@gmail.com', 'bardetmarie2@gmail.com', msg.as_string())
        mailserver.quit()

