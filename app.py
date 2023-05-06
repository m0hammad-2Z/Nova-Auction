from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time
import mysql.connector
import random
chrome_options = Options()
chrome_options.add_experimental_option("detach", True)
try:
    mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="12345678",
    database="nova_auction"
)
except:
    exit(-1)
print(mydb)

path = "C:\\Users\\ABNNI\\Desktop\\chromedriver_win32\\chromedriver.exe"
driver = webdriver.Chrome(path, chrome_options=chrome_options)
f = open("links.txt", "r")
count = 0
for x in f:
    try:
        print("---------------------- "+str(count)+" ------------------------")
        count +=1
        driver.get(x)
        title = driver.title.split("-")[0]
        dataTable = driver.find_element(By.CLASS_NAME ,"cluGaS")
        try:
            user_name = driver.find_element(By.CLASS_NAME,"jVZABK").find_elements(By.CLASS_NAME,"font-18")[0].text
        except:
            user_name = "null null"
        price = driver.find_element(By.CLASS_NAME,"ctLAcG").text
        make = dataTable.find_elements(By.CLASS_NAME,"blackColor")[0].text
        model = dataTable.find_elements(By.CLASS_NAME,"blackColor")[1].text
        yearOfMake = dataTable.find_elements(By.CLASS_NAME,"blackColor")[2].text
        desc = driver.find_element(By.CLASS_NAME,"hPmFhL").find_elements(By.CLASS_NAME,"inline")[0].text
        img = driver.find_element(By.CLASS_NAME,"image-gallery-image").get_attribute('src')
        color = dataTable.find_elements(By.CLASS_NAME,"blackColor")[6].text
        trans = dataTable.find_elements(By.CLASS_NAME,"blackColor")[4].text
        fuel = dataTable.find_elements(By.CLASS_NAME,"blackColor")[5].text
        condition =  dataTable.find_elements(By.CLASS_NAME,"blackColor")[7].text
        city = dataTable.find_elements(By.CLASS_NAME,"blackColor")[15].text
        try:
            price = price.split(",")[0]+""+price.split(",")[1].split(" ")[0]
        except:
            continue
        inter= driver.find_elements(By.CLASS_NAME,"kVUoSh")[0].find_element(By.CLASS_NAME,"width-75").text
        mycursor = mydb.cursor()
        sql_user = "insert into user_info values(default,'"+user_name.split(" ")[0].replace('\'',"")+"','"+user_name.split(" ")[1].replace('\'',"")+"',"+"'email@random.random','password','0791234567','User',default)"
        sql_cars = "insert into cars values(default ,%s,%s,%s,%s,%s,%s,%s,%s)"
        sql_item = "insert into items values(default,%s,%s,%s,%s,%s,%s,%s)"
        sql_cars_vals = (make,model,yearOfMake,color,inter,trans,condition,fuel)
        
        mycursor.execute(sql_user)
        user_id = mycursor.lastrowid
        

        mycursor.execute(sql_cars,sql_cars_vals)
        car_id = mycursor.lastrowid

        sql_item_vals = (title,desc,img,price,user_id,car_id,city)

        mycursor.execute(sql_item,sql_item_vals)
        mydb.commit()
        print(title + " Done")
    except:
        continue
driver.quit()

print("Every thing is shitting good !")