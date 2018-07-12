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
