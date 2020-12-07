# CPE327-Project
## Active Recruitment Registration System KMUTT

1. Install Docker<br/>
$ apt update <br/>
$ apt install -y docker.io <br/>
$ apt install -y docker-compose <br/>

2. Make Directory for deployment<br/>
$ mkdir /public && cd /public <br/>

3. Clone GitHub repository <br/>
$ git clone https://github.com/waranatcpe/CPE327-Project<br/>

4. Access repository<br/>
$ cd /public/CPE327-Project<br/>

5. Check deployment file <br/>
$ ls ./deployment.sh<br/>

6. Deployment<br/>
$ sh ./deployment.sh<br/>
if error occurred about permission. You can run this command `chmod +x ./deployment.sh` and run this command again `./deployment.sh` <br/>

7. Create environment file for laravel<br/>
$ cp ./envfile ./src/.env<br/>

8. Open website<br/>
http://<your-ipAddress>:8888<br/>
