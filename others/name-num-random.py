import pandas as pd

# --------------------------
# OPTIONS
# --------------------------
RANDOMIZE_ORDER = False      # True = shuffle, False = sort A–Z by FIRSTNAME
SHOW_NUMBERS = False         # True = print numbers
SHOW_MIDDLE = False          # True = include middle name
MIDDLE_POSITION = "after_first"   # "after_first", "before_last", "last_format"
# --------------------------

# Read the Excel file
df = pd.read_excel("C:\\xampp\\htdocs\\nibt\\others\\LN-FN-MI.xlsx")

# Clean column names
df.columns = df.columns.str.strip()

# RANDOMIZE or SORT
if RANDOMIZE_ORDER:
    df_processed = df.sample(frac=1).reset_index(drop=True)
else:
    df_processed = df.sort_values(by="FIRSTNAME").reset_index(drop=True)
 
# Prepare name parts
first = df_processed["FIRSTNAME"].fillna("")
middle = df_processed["MIDDLENAME"].fillna("")
last = df_processed["LASTNAME"].fillna("")

# Build FULLNAME depending on options
if SHOW_MIDDLE:
    if MIDDLE_POSITION == "after_first":
        # First Middle Last
        df_processed["FULLNAME"] = first + " " + middle + " " + last

    elif MIDDLE_POSITION == "before_last":
        # First Last Middle
        df_processed["FULLNAME"] = first + " " + last + " " + middle

    elif MIDDLE_POSITION == "last_format":
        # Last, First Middle
        df_processed["FULLNAME"] = last + ", " + first + " " + middle

else:
    # No middle name shown
    if MIDDLE_POSITION == "last_format":
        df_processed["FULLNAME"] = last + ", " + first
    else:
        df_processed["FULLNAME"] = first + " " + last

# Clean up spaces
df_processed["FULLNAME"] = (
    df_processed["FULLNAME"]
    .str.replace(r"\s+", " ", regex=True)
    .str.strip()
)

# Clean MOBILE column only if showing numbers
if SHOW_NUMBERS and "MOBILE" in df_processed.columns:
    df_processed["MOBILE"] = (
        df_processed["MOBILE"].astype(str).apply(lambda x: f"'0{x[-10:]}")
    )

# --------------------------
# OUTPUT
# --------------------------
print("\nNAMES:\n")
for name in df_processed["FULLNAME"]:
    print(name)

if SHOW_NUMBERS:
    print("\nNUMBERS:\n")
    for num in df_processed["MOBILE"]:
        print(num)
