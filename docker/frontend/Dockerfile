# Étape 1: Construction de l'application
FROM node:20 as build-stage

WORKDIR /frontend

RUN npm install

COPY ./frontend /frontend

RUN npm run build

# Étape 2: Création de l'image de production
FROM node:20 as prod-stage

WORKDIR /frontend

COPY --from=build-stage /frontend/.output /frontend/.output
COPY --from=build-stage /frontend/node_modules /frontend/node_modules
COPY --from=build-stage /frontend/package*.json ./

EXPOSE 3000

CMD [ "node", ".output/server/index.mjs" ]