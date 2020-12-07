
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
$ `apt update` <br/>
$ `apt install -y docker.io` <br/>
$ `apt install -y docker-compose` <br/>

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
$ `sh ./deployment.sh`<br/>
if error occurred about permission. You can run this command `chmod +x ./deployment.sh` and run this command again `./deployment.sh` <br/>

7. Open website<br/>
http://localhost:8888 or http://ipAddr:8888<br/>

## User for Test
- `Admin`<br/>
   Username : admin <br/>
   Password : Admin@2020 <br/>

- `Student`<br/>
   You can register on register page<br/>

- `Department`<br/>
   You can register on register page and then use admin user for change role to department

## Reverse Proxy with nginx
- if you want to publish to port 80 you can install nginx for publish<br/>
   $ `apt install -y nginx` <br/>
- Change virtualhost file and use reverse proxy<br/>
   $ `nano /etc/nginx/sites-available/default `<br/>
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
   $ `nginx -t && nginx -s reload` <br/>
- Open website<br/>
   http://your-domainName<br/>

