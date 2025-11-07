import pandas as pd

# Read the Excel file
df = pd.read_excel("C:\\xampp\\htdocs\\nibt\\others\\LN-FN-MI.xlsx")

# Clean column names
df.columns = df.columns.str.strip()

# Shuffle the rows (keeps names & numbers paired)
df_shuffled = df.sample(frac=1, random_state=None).reset_index(drop=True)

# Combine into FULLNAME (Last, First Middle)
df_shuffled["FULLNAME"] = (
    df_shuffled["LASTNAME"].fillna('') + ", " +
    df_shuffled["FIRSTNAME"].fillna('') + " " +
    df_shuffled["MIDDLENAME"].fillna('')
)

# Clean spaces
df_shuffled["FULLNAME"] = df_shuffled["FULLNAME"].str.replace(r"\s+", " ", regex=True).str.strip()

# Add '0 in front of mobile numbers (assuming column is 'MOBILE')
df_shuffled["MOBILE"] = df_shuffled["MOBILE"].astype(str).apply(lambda x: f"'0{x[-10:]}")

# Print names list
print("\nNAMES:\n")
for name in df_shuffled["FULLNAME"]:
    print(name)

# Print numbers list
print("\nNUMBERS:\n")
for number in df_shuffled["MOBILE"]:
    print(number)
