# base image
FROM node:16.2.0-alpine



COPY ./App/ /src

# set working directory
WORKDIR /src


# add `/app/node_modules/.bin` to $PATH
ENV PATH /src/node_modules/.bin:$PATH
RUN npm install


