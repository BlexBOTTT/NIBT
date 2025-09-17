import pandas as pd

# Read the Excel file
df = pd.read_excel("LN-FN-MI.xlsx")

# Clean column names
df.columns = df.columns.str.strip()

# Sort by FIRSTNAME (A-Z)
df_sorted = df.sort_values(by="FIRSTNAME", ascending=True)

# Rearrange into: FIRSTNAME MIDDLENAME LASTNAME
df_sorted["FULLNAME"] = (
    df_sorted["FIRSTNAME"].fillna('') + " " +
    # df_sorted["MIDDLENAME"].fillna('') + " " +
    df_sorted["LASTNAME"].fillna('')
)

# Clean up spaces
df_sorted["FULLNAME"] = df_sorted["FULLNAME"].str.replace(r"\s+", " ", regex=True).str.strip()

# Print clean list (easy copy)
print("\nSorted names (First Middle Last):\n")
for name in df_sorted["FULLNAME"]:
    print(name)
