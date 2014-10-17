FROM ruby
RUN apt-get update -qq && apt-get install -y build-essential libpq-dev
RUN mkdir /really-good-emails
WORKDIR /really-good-emails
ADD Gemfile /really-good-emails/Gemfile
RUN bundle install
ADD . /really-good-emails


