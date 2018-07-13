#! /usr/bin/python
print("Content-type: text/html\n")

import cgi
import random

form = cgi.FieldStorage()

# if "name" in form:
#     print form.getvalue("name");
# else:
#     print("No name provided")

reds = 0
whites = 0

if "guess" in form:
    guess = form.getvalue("guess")
else:
    guess = ""

if "answer" in form:
    answer = form.getvalue("answer")
else:
    answer = ""
    for i in range(4):
        answer += str(random.randint(0, 9))

if "guesses" in form:
    guesses = int(form.getvalue("guesses")) + 1
    for index, digit in enumerate(guess):
        if digit == answer[index]:
            reds += 1
        else:
            for answerDigit in answer:
                if answerDigit == digit:
                    whites += 1
                    break
else:
    guesses = 0

if guesses == 0:
    message = "I've chosen a 4-digit number. Can you guess it?"
elif reds == 4:
    message = "Well done! You got it in " + str(guesses) + " guesses!" \
         + "<a href=''>Play again!</a>"
else:
    message = "You have " + str(reds) + " correct digits in the right place and " \
        + str(whites) + " correct digits in the wrong place.<br>" \
        + "You have made " + str(guesses) + " guesses."

print("<h1>Mastermind</h1>")
print("<p>" + message + "</p>")
if (reds < 4):
    print("<form method='post'>")
    print("<input type='text' name='guess' value='" + guess + "'>")
    print("<input type='hidden' name='answer' value='" + answer + "'>")
    print("<input type='hidden' name='guesses' value='" + str(guesses) + "'>")
    print("<input type='submit' value='Guess!'>")
    print("</form>")
