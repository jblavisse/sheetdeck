FROM node:lts as builder

WORKDIR /frontend

COPY . .

RUN npm run build

# Nuxt 3 production
FROM node:lts

WORKDIR /frontend

COPY --from=builder /frontend/.output  /frontend/.output

ENV NITRO_PORT=3000

EXPOSE 3000

CMD [ "node", ".output/server/index.mjs" ]