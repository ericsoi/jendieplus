from difflib import get_close_matches
import pandas as pd
import csv
def closeMatches(patterns, word):
    print(get_close_matches(word, patterns))
  
# Driver program
if __name__ == "__main__":
    table_file = "tablenames.csv"
    df = pd.read_csv(table_file, delimiter=',')
    patterns = [item for elem in df.values.tolist() for item in elem]
    file = "kenya_intermediaries_gi.csv"
    closeMatches(patterns, file)