FROM jwilder/nginx-proxy

RUN apt-get update --fix-missing
RUN apt-get install curl gpgv ca-certificates lsb-release debian-archive-keyring -y
RUN curl https://nginx.org/keys/nginx_signing.key | gpg --dearmor | tee /usr/share/keyrings/nginx-archive-keyring.gpg >/dev/null
RUN echo "deb [signed-by=/usr/share/keyrings/nginx-archive-keyring.gpg] http://nginx.org/packages/ubuntu `lsb_release -cs` nginx" | tee /etc/apt/sources.list.d/nginx.list

RUN apt-get install nginx-module-njs -y
RUN apt-get install nano -y
RUN apt-get install openssl -y

CMD ["nginx", "-g", "daemon off;"]
