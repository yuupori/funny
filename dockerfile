FROM --platform=linux/amd64 node:16-alpine
FROM php:8.2-apache
COPY src/ /var/www/html/
