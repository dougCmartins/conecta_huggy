# Usa a imagem do Node.js para build
FROM node:18-alpine AS build-stage
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Usa o Nginx para servir os arquivos
FROM nginx:alpine
COPY --from=build-stage /app/dist /usr/share/nginx/html

# Garante que o nginx.conf está sendo copiado corretamente
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
