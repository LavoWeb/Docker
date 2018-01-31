# Example
## SSH Server
```
docker run -d -P --name test_sshd rastasheep/ubuntu-sshd:14.04
```
```
docker port test_sshd 22
```
> 0.0.0.0:32768

## Ansistrano configuration
### Files
_host_
```
docker.local ansible_ssh_user=root ansible_ssh_pass=root ansible_ssh_port=32768
```

_deploy.yml_
```
    ---
    - name: Deploy example app to my-server.com
      hosts: all
      vars:
        ansistrano_deploy_from: "{{ playbook_dir }}"
        ansistrano_deploy_to: "/tmp/my-app.com"
        ansistrano_keep_releases: 3
        ansistrano_deploy_via: copy
      roles:
        - { role: carlosbuenosvinos.ansistrano-deploy }
```

_docker-compose.yml_
```
version: '3'
services:
  ansistrano:
    image: "lavoweb/ansistrano"
    volumes:
      - "./host:/var/host"
      - "./deploy.yml:/var/deploy.yml"
    extra_hosts:
      - "docker.local:192.168.99.100"
```
### Run
```
docker-compose up -d
```
### Deploy
```
ansible-playbook -i /var/host /var/deploy.yml

```