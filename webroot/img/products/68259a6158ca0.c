#include <stdio.h>

// Function prototypes
int add(int a, int b, int c);
int subtract(int a, int b, int c);
int multiply(int a, int b, int c);
int modulus(int a, int b, int c);

int main() {
    int num1, num2, num3;
    
    // Read the three integer values from the user input
    printf("Enter three integers: ");
    scanf("%d %d %d", &num1, &num2, &num3);
    
    // Perform the maths operations and display results
    printf("Addition: %d\n", add(num1, num2, num3));
    printf("Subtraction: %d\n", subtract(num1, num2, num3));
    printf("Multiplication: %d\n", multiply(num1, num2, num3));
    printf("Modulus: %d\n", modulus(num1, num2, num3));
    
    return 0;
}

// Function to add three integers
int add(int a, int b, int c) {
    return a + b + c;
}

// Function to subtract the second and third integers from the first
int subtract(int a, int b, int c) {
    return a - b - c;
}

// Function to multiply the three integers
int multiply(int a, int b, int c) {
    return a * b * c;
}

// Function to compute the modulus of the first integer by the second and third
int modulus(int a, int b, int c) {
    // Handle division by zero
    if (b == 0 || c == 0) {
        printf("Error: Division by zero in modulus operation.\n");
        return -1; // Return an error value
    }
    return a % b % c;
}