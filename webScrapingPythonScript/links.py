from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
chrome_options = Options()
chrome_options.add_experimental_option("detach", True)
path = "C:\\Users\\ABNNI\\Desktop\\chromedriver_win32\\chromedriver.exe"
driver = webdriver.Chrome(path, chrome_options=chrome_options)
f = open("links.txt", "a")
for page in range(50,0,-1):
    try:
        driver.get(("https://jo.opensooq.com/en/amman/cars/cars-for-sale?page="+str(page)))
        dives = driver.find_elements(By.CLASS_NAME,"mb-32")
        for counter in range (0, 30 , 1):
            link = dives[counter].find_element(By.CLASS_NAME,"blackColor").get_attribute('href')
            f.write(link+"\n")
    except:
        f.close()
        driver.quit()
        exit(-1)
f.close()
driver.quit()
exit(-1)