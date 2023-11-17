import os
import schedule
import time

def commit_and_push():
    os.system('git add .')
    os.system('git commit -m "Automatic commit"')
    os.system('git push origin main')
schedule.every(30).minutes.do(commit_and_push)

while True:
    schedule.run_pending()
    time.sleep(1)