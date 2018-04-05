```
cd Go/oc
docker build .
docker build -t lavoweb/oc:3.9.0 .
docker build -t lavoweb/oc:latest .
docker push lavoweb/oc
```