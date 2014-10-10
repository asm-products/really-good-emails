FROM ubuntu:14.04
RUN apt-get update -qq && apt-get install -y build-essential nodejs npm git curl postgresql libpq-dev
RUN mkdir -p /really-good-emails
 
# Install rbenv
RUN git clone https://github.com/sstephenson/rbenv.git /usr/local/rbenv
RUN echo '# rbenv setup' > /etc/profile.d/rbenv.sh
RUN echo 'export RBENV_ROOT=/usr/local/rbenv' >> /etc/profile.d/rbenv.sh
RUN echo 'export PATH="$RBENV_ROOT/bin:$PATH"' >> /etc/profile.d/rbenv.sh
RUN echo 'eval "$(rbenv init -)"' >> /etc/profile.d/rbenv.sh
RUN chmod +x /etc/profile.d/rbenv.sh
 
# install ruby-build
RUN mkdir /usr/local/rbenv/plugins
RUN git clone https://github.com/sstephenson/ruby-build.git /usr/local/rbenv/plugins/ruby-build
 
ENV RBENV_ROOT /usr/local/rbenv
ENV PATH $RBENV_ROOT/bin:$RBENV_ROOT/shims:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
 
RUN rbenv install 2.1.2
RUN bash -l -c 'rbenv global 2.1.2; gem install bundler; rbenv rehash'
 
WORKDIR /really-good-emails
 
ADD Gemfile Gemfile
ADD Gemfile.lock Gemfile.lock
RUN ruby -v
RUN bundle install
 
ADD . /really-good-emails
