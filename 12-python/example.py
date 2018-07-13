#! /usr/bin/python
print("Content-type: text/html\n")

print("Hello world!");

age = 19;
print("I am " + str(19) + " years old.")

print("Casting string to perform math: " + str(int("5") * 9))

fullname = "Sujan Kandeepan"
print("Substring of my name: " + fullname[9:13])

list = ["Sujan", 1, "Janan", 2, "Sujatha", 3, "Kandeepan", 4]
print(list[0:4])

tuple = ("Sujan", 1, "Janan", 2, "Sujatha", 3, "Kandeepan", 4)
print(tuple[4:8])

dict = {"father": "Kandeepan",
        "mother": "Sujatha",
        "elder-son": "Sujan",
        "younger-son": "Janan"}
print(dict.keys())
print(dict.values())

for i in range(6, 11):
    print(i)

for food in ["pizza", "chocolate", "ice cream"]:
    print("I like eating " + food)

x = 6
while x <= 10:
    print(x)
    x += 1

for key, value in {"Sujan": 19, "Janan": 14, "Sujatha": 51, "Kandeepan": 54}.items():
    print(key + " is " + str(value))

if "Sujan" == "Janan" or 3 < 4:
    print("Fascinating...")

numPrimes = 0
next = 2
while numPrimes < 50:
    prime = True
    for factor in range(2, next):
        if next % factor == 0:
            prime = False
    if prime:
        print(next)
        numPrimes += 1
    next += 1

def sayHello(name):
    return "Hello " + name + "!"
print(sayHello("Sujan"))

def greatestCommonFactor(num1, num2):
    gcf = 1
    for i in range(2, min(num1, num2) + 1):
        if num1 % i == 0 and num2 % i == 0 and i > gcf:
            gcf = i
    return gcf
print(greatestCommonFactor(18, 24))

a = 5
b = 6
def add():
    a = 10
    return a + b;
print(add())
print("a = " + str(a))
