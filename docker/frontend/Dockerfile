# Stage 1: Build
FROM node:20-alpine as build-stage

# Set working directory
WORKDIR /frontend

# Copy package.json and package-lock.json
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy all files to the container
COPY . .

# Build the Nuxt 3 application
RUN npm run build

# Stage 2: Production
FROM node:20-alpine as production-stage

# Set working directory
WORKDIR /frontend

# Copy only necessary files from build stage
COPY --from=build-stage /frontend/.output /frontend/.output
COPY --from=build-stage /frontend/node_modules /frontend/node_modules
COPY --from=build-stage /frontend/package.json /frontend/package.json

# Install PM2 to manage the process
RUN npm install pm2 -g

# Expose the application port
EXPOSE 3000

# Start the application
CMD ["pm2-runtime", ".output/server/index.mjs"]