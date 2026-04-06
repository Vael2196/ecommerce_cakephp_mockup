#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/wait.h>

int main (int argc, char *argv[]){
    pid_t ProcessID;

    //Check to make sure correct number of arguments are provided
    if (argc != 2) {
        fprintf(stderr, "Usage: %s <filename>\n", argv[0]);
        exit(1);
    }

    //Fork Child process
    ProcessID = fork();

    //In case of error
    if (ProcessID < 0) {
        fprintf(stderr, "Fork was not succesful\n");
        exit(1);

    //Child Process
    } else if (ProcessID == 0 ) { 
        printf("Child process executing date command:\n");
        execlp("date", "date", NULL);
        return 1; 
    }
    else {
    //Parent Process
        wait(NULL);

        printf("\nParent Process Executing cat command on chosen file:\n");
        execlp("cat", "cat", argv[1], NULL);

        //If the above line returns, it must have failed
        fprintf(stderr, "execlp failed in parent process\n");
        exit(1);
    }

    return 0;


}
