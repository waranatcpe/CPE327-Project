
## Active-Recruitment Registration System KMUTT
CPE327 | Software Engineering Project <br/>
<b>DEMO : https://admission.kmutt.me</b><br/>
<b>In use : https://aradmission.kmutt.ac.th</b><br/>

### Server/Virtual Machine Specification 
| No. | Requirement | Specification |
| :---: | :--- | ---: |
| 1. | Operating System | Ubuntu 18.04 or above |
| 2. | vCPUs | >= 2 cores|
| 3. | RAM | >= 2 GB |
| 4. | Storage Disk | >= 10GB |

- ``` If you use Docker Desktop in windows you can start at step 3 ```

1. <b>Install Docker</b><br/>
$ `sudo apt update` <br/>
$ `sudo apt install -y docker.io` <br/>
$ `sudo apt install -y docker-compose` <br/>

2. <b>Make Directory for deployment</b><br/>
$ `sudo mkdir /public && cd /public` <br/>
if you use Docker Desktop in windows. You must set your own path. Ex `mkdir C://{your_path}` and `cd {yourpath}`

3. <b>Clone GitHub repository </b><br/>
$ `sudo git clone https://github.com/waranatcpe/CPE327-Project`<br/>

4. <b>Access repository</b><br/>
$ `cd /public/CPE327-Project` or `cd {path}/CPE327-Project`<br/>

5. <b>Check deployment file </b><br/>
$ `ls ./deployment.sh` if exsits will show `deployment.sh`<br/> 

6. <b>Deployment</b><br/>
$ `sudo sh ./deployment.sh`<br/>
if error occurred about permission. You can run this command `chmod +x ./deployment.sh` and run this command again `./deployment.sh` <br/>
#### if you use Docker desktop in windows or error occurred you can deployment with manual way. 
- Follow this command `docker-compose up -d` 
- and then copy environment file for laravel `cp ./.env-example ./src/.env` 
- and then change owner for access file with `docker exec php chown -R laravel:laravel /var/www/html`  <br/>

7. <b>Open web site</b><br/>
http://localhost:8888 or http://{ipAddress}:8888<br/>

#### How to manage container with Docker
- <b>Stop all service</b><br/>
  $ `cd {path}/CPE327-Project` Go to path CPE327-Project that cloned<br/>
  $ `docker-compose down`<br/>
- <b>Start all service </b>(Deployment by step required)<br/>
  $ `docker-compose up -d`<br/>
- <b>Configure Container</b><br/>
  $ `docker exec -it {ContainerName} sh` <br/>

## Users for Test
- `Admin`<br/>
   Username : <i>admin</i> <br/>
   Password : <i>Admin@2020</i> <br/>

- `Student`<br/>
   You can register on register page<br/>

- `Department`<br/>
   You can register on register page and then use admin user for change role to department at menu `จัดการผู้ใช้งาน` and then set department to user for view information at menu `จัดการภาควิชา` before sign-in with Department role

## How to Deployment on Production 
### Reverse Proxy with nginx
- if you want to publish to port 80 you can install nginx for publish<br/>
   $ `sudo apt install -y nginx` <br/>
- Change virtualhost file and use reverse proxy<br/>
   $ `sudo nano /etc/nginx/sites-available/default `<br/>
- And then clean this file and use this config code instead<br/>
```
server { 
    server_name your-domainName.com; 
    location / { 
        proxy_pass http://localhost:8888; 
        proxy_set_header Host $host; 
        proxy_set_header X-Real-IP $remote_addr; 
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for; 
        proxy_set_header X-Forwarded-Proto $scheme; 
    } 
} 
```
- And reload nginx <br/>
   $ `sudo nginx -t && sudo nginx -s reload` <br/>
- Open website<br/>
   http://{your-domainName.com}<br/>
   
### SSL Certification
- <b>Installing Certbot</b> <br/>
   $ `sudo apt install certbot python3-certbot-nginx` <br/>
- <b>Obtaining an SSL Certificate</b><br/>
   $ `sudo certbot --nginx -d [your-domainName.com]`<br/>
This runs certbot with the --nginx plugin, using -d to specify the domain names we’d like the certificate to be valid for.<br/>
If this is your first time running certbot, you will be prompted to enter an email address and agree to the terms of service. After doing so, certbot will communicate with the Let’s Encrypt server, then run a challenge to verify that you control the domain you’re requesting a certificate for.<br/>
If that’s successful, certbot will ask how you’d like to configure your HTTPS settings.<br/>
```
Output
Please choose whether or not to redirect HTTP traffic to HTTPS, removing HTTP access.
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
1: No redirect - Make no further changes to the webserver configuration.
2: Redirect - Make all requests redirect to secure HTTPS access. Choose this for
new sites, or if you're confident your site works on HTTPS. You can undo this
change by editing your web server's configuration.
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
Select the appropriate number [1-2] then [enter] (press 'c' to cancel):
```
Select your choice then hit `ENTER.` The configuration will be updated, and Nginx will reload to pick up the new settings. `certbot` will wrap up with a message telling you the process was successful and where your certificates are stored:<br/>

- <b>And then go to web site with SSL Certificate</b> <br/>
   https://{your-domainName.com}
   

## Group Members
| No. | Name | Student ID | Email | Section |
| :---: | :--- | :---: | :--- | :---: |
| 1. | KAMIN PRAKOB | 61070501008 | kamin.pum555@mail.kmutt.ac.th | A |
| 2. | JIRAYU RUNGRUENG | 61070501012 | jirayu.star@mail.kmutt.ac.th | A |
| 3. | CHINNAGRIT BUTBUMRUNG | 61070501016 | chinnagrit.bt@mail.kmutt.ac.th | A |
| 4. | WARANAT SUTTIKARN | 61070501048 | waranat.stk@mail.kmutt.ac.th | B |

` Write up by WARANAT SUTTIKARN {Software Developer@Admissions and Recruitment Office KMUTT}`
