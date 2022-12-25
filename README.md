This repo works only for backend, frontend is still non functional and needs to be developed. This Repo has been archieved. No issues or support will be provided.


Instruction to RUn

chmod +x deploy/startup.sh
docker-compose up -d
 Use docker ps to get the name of the existing container.
Use the command docker exec -it <container name> /bin/bash to get a bash shell in the container.
Generically, use docker exec -it <container name> <command> to execute whatever command you specify in the container.
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
