import urllib.request
import re

url = 'https://maps.app.goo.gl/t5yQ2WQuSXwbEUbA6'
req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
try:
    response = urllib.request.urlopen(req)
    # The actual map URL is usually what it redirects to
    real_url = response.geturl()
    print("Redirected URL:", real_url)
    
    html = response.read().decode('utf-8')
    match = re.search(r'content="([^"]+)" itemprop="name"', html)
    if match:
        print("Name:", match.group(1))
    
    desc_match = re.search(r'content="([^"]+)" itemprop="description"', html)
    if desc_match:
        print("Description:", desc_match.group(1))
except Exception as e:
    print("Error:", e)
