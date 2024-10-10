# Étape 1: Construction de l'application
FROM node:20 as build-stage

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm build && npm generate

# Étape 2: Création de l'image de production
FROM nginx:alpine as production-stage

RUN rm -rf /usr/share/nginx/html/*

COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

COPY --from=build-stage /app/.output /usr/share/nginx/html

EXPOSE 3000

CMD ["nginx", "-g", "daemon off;"]