import requests
from requests_oauthlib import OAuth1

auth = OAuth1("cff204ff62824b6e87b4944db2a90298", "746ba7f966d8476e926c4f2bc5b4a37b")
endpoint = "https://api.thenounproject.com/v2/icon/1"

response = requests.get(endpoint, auth=auth)

print("Request Headers .... ") 
for key, value in response.request.headers.items():
    print(f"{key} : {value}")
print("\nResponse Content")
print(response.content)
