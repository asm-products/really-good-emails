== README

* Ruby 2.1.3
* Rails 4.1.6

- gem install librarian-chef
- run `librarian-chef install` to grab required cookbooks
- run `vagrant up`

**installing extra dependencies**
- `vagrant ssh`
- `gem install bundler`
- `rbenv rehash`
- `sudo apt-get install nodejs`

**starting the app for the first time**
- `vagrant ssh`
- `cd ../../vagrant`
- `rake db:create`
- `rake db:migrate`
- `rails s`

