```
docker run -d -P --name test_sshd rastasheep/ubuntu-sshd:14.04
```
```
docker port test_sshd 22
```
> 0.0.0.0:32768

_host_
```
docker.local ansible_ssh_user=root ansible_ssh_pass=root ansible_ssh_port=32768
```

_deploy.yml _
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