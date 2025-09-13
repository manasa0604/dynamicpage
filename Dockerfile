# Use Nginx to serve static website
FROM nginx:alpine
COPY . /usr/share/nginx/html
