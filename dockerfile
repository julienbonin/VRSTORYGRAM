FROM mattrayner/lamp:latest-1604-php7

SHELL ["/bin/bash", "-c"]

COPY sshd_config /tmp/sshd_config.in

COPY vr /var/www/html/

RUN echo "installing" \
    && apt update \
    && apt -y install vim apt-utils wget openssh-server libpng-dev mysql-client dialog \
    && cat /tmp/sshd_config.in > /etc/ssh/sshd_config \
    && echo "/usr/sbin/service ssh start" >> /run.sh \
    && echo "root:Docker!" | chpasswd \
    && chown -R www-data:staff /var/www 

ENV PHP_UPLOAD_MAX_FILESIZE 2048M
ENV PHP_POST_MAX_SIZE 2048M

EXPOSE 80 2222
