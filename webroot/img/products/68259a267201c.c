#include <stdio.h>

int main() {
    char firstName[21]; // Extra space for the null terminator
    char lastName[21];  // Extra space for the null terminator

    // Asks the user for their first name
    printf("Enter your first name: ");
    scanf("%20s", firstName); // Reads 20 characters

    // Asks the user for their last name
    printf("Enter your last name: ");
    scanf("%20s", lastName); // Reads 20 characters

    // Print initials
    printf("Your initials are: %c%c\n", firstName[0], lastName[0]);

    return 0;
}
