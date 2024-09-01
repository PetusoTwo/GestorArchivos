COPY . /app/.
RUN chmod +x /app/deploy.sh && /app/deploy.sh