# Really Good Emails

## A Showcase of the Best Product Emails

This is a product being built by the Assembly community. You can help push this idea forward by visiting [https://assembly.com/really-good-emails](https://assembly.com/really-good-emails).

---
###Setup Guide
*We are using Docker containers to make it easier to keep development environments consistent*
- [Install Boot2Docker](http://boot2docker.io/)
- Run Boot2Docker
  - $ `boot2docker init`
  - $ `boot2docker start`
  - $ `$(boot2docker shellinit)`
  - To persist the environment variables across shell sessions, you can add `$(boot2docker shellinit)` to your `~/.bashrc` file
- [Install Fig](http://www.fig.sh/install.html)
  - `curl -L https://github.com/docker/fig/releases/download/1.0.0/fig-`uname -s`-`uname -m` > /usr/local/bin/fig; chmod +x /usr/local/bin/fig`
- Build the Docker containers
  - $ `fig build`
- Run the app
  - $ `fig up`
- Migrate the database
  - Do this in another terminal window
    - `fig run web rake db:create`
- Access the app locally
  - Run `boot2docker ip` to get the ip address of the Docker daemon
  - View the app at `IP_ADDRESS:3000`

####Development notes
- If you modify the `Gemfile` or the `Dockerfile` you will need to run `fig build` to rebuild the container.
- Fork and clone the project `git clone git@github.com:{{GITHUB USERNAME}}/really-good-emails.git`
  - Send pull requests with contributions
- If you get an error in building; try removing the `Gemfile.lock` and trying `fig build; fig up` again

---
### How Assembly Works

Assembly products are like open-source and made with contributions from the community. Assembly handles the boring stuff like hosting, support, financing, legal, etc. Once the product launches we collect the revenue and split the profits amongst the contributors.

Visit [https://assembly.com](https://assembly.com) to learn more.

