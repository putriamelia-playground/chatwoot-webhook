FROM php:8.2-cli

RUN apt-get update && apt-get install -y cron curl

WORKDIR /app

COPY . /app

RUN echo "* * * * * php /app/check.php >> /var/log/cron.log 2>&1" > /etc/cron.d/webhook-cron \
    && chmod 0644 /etc/cron.d/webhook-cron \
    && crontab /etc/cron.d/webhook-cron

CMD ["sh", "-c", "cron && php -S 0.0.0.0:8000 -t /app"]