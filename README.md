# Quantox task

To run project please follow this guide

1) install docker with docker compose 
   * Docker installation guide: [link](https://docs.docker.com/engine/install/)
   * Docker compose installation guide: [link](https://docs.docker.com/compose/install/)
2) Run `docker compose -f .infrastructure/docker-compose.yml up -d`
3) Run `docker exec -it quantox-app composer dump-autoload`
4) Run to migrate `docker exec -i quantox-mysql mysql -u root -p123456 school < migration.sql`
5) Check [http://localhost](http://localhost)