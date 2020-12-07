
## Active-Recruitment Registration System KMUTT
CPE327 | Software Engineering Project <br/>
<b>DEMO : https://admission.kmutt.me</b><br/>

``` If you use Docker Desktop in windows you can start at step 2 ```

| Requirement | Value |
| :---: | :---: |
| Operating System | Ubuntu 20.04 |
| vCPUs | >= 2 cores |
| RAM | >= 2 GB |
| Storage Disk | >= 10GB |

1. Install Docker<br/>
$ `sudo apt update` <br/>
$ `sudo apt install -y docker.io` <br/>
$ `sudo apt install -y docker-compose` <br/>

2. Make Directory for deployment<br/>
$ `mkdir /public && cd /public` <br/>
if you use Docker Desktop in windows. You must set your own path. Ex `mkdir C://[your_path]` and `cd [yourpath]`

3. Clone GitHub repository <br/>
$ `git clone https://github.com/waranatcpe/CPE327-Project`<br/>

4. Access repository<br/>
$ `cd /public/CPE327-Project`<br/>

5. Check deployment file <br/>
$ `ls ./deployment.sh`<br/>

6. Deployment<br/>
$ `sudo sh ./deployment.sh`<br/>
if error occurred about permission. You can run this command `chmod +x ./deployment.sh` and run this command again `./deployment.sh` <br/>

7. Open website<br/>
http://localhost:8888 or http://ipAddr:8888<br/>

## User for Test
- `Admin`<br/>
   Username : <i>admin</i> <br/>
   Password : <i>Admin@2020</i> <br/>

- `Student`<br/>
   You can register on register page<br/>

- `Department`<br/>
   You can register on register page and then use admin user for change role to department at menu `จัดการผู้ใช้งาน` and then set department to user for view information at menu `จัดการภาควิชา` before sign-in with Department role

## Reverse Proxy with nginx and SSL Certificate 
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
   http://your-domainName<br/>
   
### SSL Certification
- Installing Certbot <br/>
   $ `sudo apt install certbot python3-certbot-nginx` <br/>
- Obtaining an SSL Certificate<br/>
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

- And then go to web site with SSL Certificate <br/>
   https://[your-domainName.com]
   
   
   
`waranat.stk@mail.kmutt.ac.th`
