FROM jwilder/nginx-proxy

RUN apt-get update
RUN apt-get install nano -y
RUN apt-get install openssl -y

RUN echo "upstream php-upstream { server storefront_php:9000; }" > /etc/nginx/conf.d/upstream.conf

CMD ["nginx", "-g", "daemon off;"]
