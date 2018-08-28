# the instruction is https://dev-ops-notes.ru/cloud/docker-%D0%B7%D0%B0%D0%BF%D1%83%D1%81%D0%BA-1000-%D0%BA%D0%BE%D0%BD%D1%82%D0%B5%D0%B9%D0%BD%D0%B5%D1%80%D0%BE%D0%B2-%D0%B2-swarm-%D0%BA%D0%BB%D0%B0%D1%81%D1%82%D0%B5%D1%80%D0%B5-%D0%B2-%D0%BE%D0%B1/
echo "installs:"
docker-machine ls
echo "status claster:"
docker node ls
echo "run services:"
docker service create \
  --replicas 3 \
  --network swarm-scale-test-net \
  --update-parallelism 3 \
  --name api \
  -p 9001:80 \
  -v "./api:/app" \
  -e ES_HOST=http://geocode1.essch.ru:9200 \
  mattrayner/lamp:latest-1604-php7
echo "numbers running services:"
docker service ls
echo "test 1000 https, 12 treads:"
docker run --net=swarm-scale-test-net --rm williamyeh/wrk --threads 12 --connections 1000 --duration 30s \
 http://geocode1.essch.ru/index.php?query=%D0%98%D0%B2%D0%B0%D0%BD%D0%BE%D0%B2%D0%BA%D0%B0

