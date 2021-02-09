# Evaluation
This is the deposit for the evaluations

# Installation and configuration
Simply clone and open the config.json to change the path. I am aware a config.json is totally not secured especially not present in the git ignore, but for the sake of the clarity and speed of work, I've proceeded this way this time.

#Explanations
For this test, I've decided to concentrate my efforts on the declaration and the constructs of the classes. The operations for modifying the data after creation was not made, especially for the validation part.

I've decided to avoid at most possible the creation of exception classes with the children of ElectronicItem. That is why there is a method name canBeExtra(). Based on my experience, exception cases tend to cause unforeseen problems and can complicate their treatment.

When creating a new item, the system will try to validate its data. If there is a problem, the server will return a PHP error with an error coded as an int of 4 bits (value from 0 to 15). Bit informations are coded from right to left by the following method:

1: invalid price (ie not numeric or less than 0)

2: invalid type (ie not in the list. Should never be triggered but better be safe than sorry)

3: invalid wired type (by default it is wired or not. Should never being triggered)

4: extras are invalids (ie number of extras are too big)

There's no other validation made and the operations update, delete are not done.

The sorting and getting the list of items by type is working. The price takes  into account the price of the item as well as the price of its extras if present.

If possible, I would like to have your comments and impressions on this work. The whole thing took me about 3 hours, of which I spent about two hours analyzing your prerequisites. Once the structure was imagined and tested, the coding was quite fast.