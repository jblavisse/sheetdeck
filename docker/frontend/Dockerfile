# Étape 1: Construction de l'application
FROM node:20 as build-stage

WORKDIR /frontend

COPY ./frontend/package*.json ./

RUN npm install

COPY ./frontend /frontend

RUN npm run build

# Étape 2: Création de l'image de production
FROM node:20-slim as prod-stage

WORKDIR /frontend

COPY --from=build-stage /frontend/.output /frontend/.output
COPY --from=build-stage /frontend/package*.json ./
RUN npm install --omit=dev

EXPOSE 3000

CMD [ "node", ".output/server/index.mjs" ]