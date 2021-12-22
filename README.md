## Live Stream Server

How to run?:

    1. Install docker 
    2. Install docker-compose
    3. Execute as root: 'docker-compose build'
    4. Execute as root: 'docker-compose up'

Choose your broadcast sofware:

    For example OBS:
    
    Go to settings -> Stream 

    Choose at Service   'Custom'
    Choose at Server    'rtmp://<localhost/ip>:1935/live
    Choose at Streamkey 'test?key=supersecret'

Open a browser search `http://<localhost/ip> to view your live stream!