## Mars Clock Microservice

A microservice comes with symfony 4 to convert Earth Date to Mars Sol Date(MSD) and Martian Coordinated Time (MTC)

### Installation
Add microservice hostname to `/etc/hosts`
```
127.0.0.1 mars-clock.service
```

Start docker
```
docker-compose up -d
```

Navigate to `http://mars-clock.service`