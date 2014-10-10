## Really Good Emails
Improve your product emails by seeing what other teams are sending, and get the resources you need to improve your own product emails.

### Tech Stack
- Ruby 2.1.2
- Rails 4.1.6
- PostgreSQL

We use Docker to make it easier for new contributors to get the app running on their machine.

###Setup Guide for OSX
- Install [boot2docker](https://docs.docker.com/installation/mac/#installation)
- Download the boot2docker ISO with [VirtualBox guest additions](http://static.dockerfiles.io/boot2docker-v1.2.0-virtualbox-guest-additions-v4.3.14.iso).
```bash
cd ~/.boot2docker
mv boot2docker.iso boot2docker.iso.orig
curl http://static.dockerfiles.io/boot2docker-v1.2.0-virtualbox-guest-additions-v4.3.14.iso > boot2docker.iso
boot2docker init
```
- Enable host filesystem sharing. This makes your /Users partition accessible to the boot2docker Virtual Machine.
```bash
 VBoxManage sharedfolder add boot2docker-vm --name home --hostpath /Users --automount
 boot2docker up
 ```
If you see a message saying &"To connect the Docker client to the Docker daemon, please set:
    export DOCKER_HOST=tcp://XXX.XXX.XXX.XXX:XXXX"*, copy the export command and execute it.
    `export DOCKER_HOST=tcp://XXX.XXX.XXX.XXX:XXXX`

- [Install Fig](http://www.fig.sh/install.html)
- Run `fig build` to build the images.
- Create and migrate the database.
<br>`fig run web rake db:create db:migrate`
- Start the server
<br>`fig up`
- Map the server to localhost for access at localhost:3000
<br>`boot2docker ssh -L3000:localhost:3000`

###Running the app
- `boot2docker up`
- `fig up`
- `boot2docker ssh -L3000:localhost:3000`

