# def find_common_letters(word1, word2):
#     # Convert both words to sets and find the intersection
#     common_letters = set(word1) & set(word2)
#     return common_letters

# # Take input from the user
# word1 = input("Enter the first word: ")
# word2 = input("Enter the second word: ")

# # Find and display the common letters
# common = find_common_letters(word1, word2)
# print(f"Common letters: {common}")



word1 = input("Enter the first word: ")
word2 = input("Enter the second word: ")
word3 = ""

for i in range(len(word1)):
    for j in range(len(word2)):
        if word1[i] == word2[j]:
            word3 = word3 + word1[i]
            break

print(word3)