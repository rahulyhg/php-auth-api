# https://hub.docker.com/r/mattrayner/lamp/#using-the-image

# Start container with app and mysql content
# (no dockerfile needed) 
# (with port 3306 exposed)
docker run -i -t -p "80:80" -p 3306:3306 -v ${PWD}/rest-api:/app -v ${PWD}/mysql:/var/lib/mysql mattrayner/lamp:latest-1404-php7

# DB
# user: admin
# pass: SWx2JHcyvxse

# Get docker container id: 
docker ps 
# STOP 
docker stop CONTAINER_ID