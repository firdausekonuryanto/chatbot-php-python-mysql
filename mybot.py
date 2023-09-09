import nltk
nltk.download('punkt')
nltk.download('stopwords')
nltk.download('wordnet')
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
from nltk.stem import WordNetLemmatizer
import string
import sys

import mysql.connector

try:
    # Establish a connection to the MySQL database
    db_connection = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="php_chatbot"
    )

    # Create a cursor object to interact with the database
    cursor = db_connection.cursor()

    # Execute a SQL query to fetch FAQs from the database
    cursor.execute("SELECT * FROM chatbot")

    # Fetch all the rows as dictionaries
    faqs = [{"id":row[0], "questions": row[1], "answer": row[2]} for row in cursor.fetchall()]

    # Preprocess user input
    def preprocess(text):
        # Tokenize text
        tokens = word_tokenize(text.lower())
        
        # Remove stopwords and punctuation
        stop_words = set(stopwords.words("english"))
        tokens = [word for word in tokens if word not in stop_words and word not in string.punctuation]
        
        # Lemmatize words
        lemmatizer = WordNetLemmatizer()
        tokens = [lemmatizer.lemmatize(word) for word in tokens]
        
        return tokens

    # Get user input from command-line argument
    if len(sys.argv) > 1:
        user_input = " ".join(sys.argv[1:])
    else:
        user_input = ""

    # Preprocess user input
    user_input_tokens = preprocess(user_input)

    # Match user input to FAQs
    max_similarity = 0
    best_match = None

    for faq in faqs:
        faq_tokens = preprocess(faq["questions"])
        similarity = len(set(user_input_tokens).intersection(faq_tokens)) / len(user_input_tokens)
        if similarity > max_similarity:
            max_similarity = similarity
            best_match = faq

    if max_similarity > 0:
        response = best_match["answer"]
        response_id = best_match["id"]
    else:
        # If no exact match is found, find the closest matching question
        closest_match = None
        closest_similarity = 0
        
        for faq in faqs:
            faq_tokens = preprocess(faq["questions"])
            similarity = len(set(user_input_tokens).intersection(faq_tokens)) / len(user_input_tokens)
            if similarity > closest_similarity:
                closest_similarity = similarity
                closest_match = faq

        if closest_similarity > 0:
            response = closest_match["answer"]
            response_id = closest_match["id"]
        else:
            response = "I'm sorry, I don't have an answer for that question."

    # print(response)
    print(response_id)

except mysql.connector.Error as e:
    print(f"Error: {e}")

finally:
    # Close the database connection
    if 'db_connection' in locals() or 'db_connection' in globals():
        db_connection.close()
