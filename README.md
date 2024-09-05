# levelhard-legacy

### CREATE DOCKER MACHINE
```batch
docker build -t levelhard-legacy .
```

### RUN DOCKER MACHINE
```batch
docker run -d -p 8080:80 --name levelhard-running-app levelhard-legacy
```
