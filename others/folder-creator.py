import os

# Paste your list of names here
names = """
Ampan, Jhomiles
Arellano, Jamila Veña
Aurellana, Joice Anne Caraboto
Aurellana, Justine Golloso
Belga, Morina Bandoquillo
Carillo, Shaira
Casilan, Shamaryah Delos Santos
Catolico, Paula Bianca Cabatic
Dandan, Hanni Dizon
De Guzman, Richter Czarley Maninang
Dela Cruz, Jovy Metrillo
Diaz, Diovelyn Catamora
Dugayo Jr., Roderick Rosen 
Eusebio, Marko Louise
Eusebio, Pauline Mae Magsisi
Gagatam, Althea
Garcia, Daisy Mae Torralba
Geroca, Erica Perit
Gomez, Gerald Suson
Legaspi, Ruzzel John Madlang-awa
Padilla, Margarette 
Perdigon, Stephen Nicos Saparam
Ruiz, Reisha Ysabel Tan
Samson, Jonessa Astorga
Singalawa, Gracello Symon Saupan
"""

# Split the names by line
folder_names = [line.strip() for line in names.strip().splitlines() if line.strip()]

# Create folders
for folder_name in folder_names:
    try:
        os.makedirs(folder_name)
        print(f"Created folder: {folder_name}")
    except FileExistsError:
        print(f"Folder already exists: {folder_name}")
    except Exception as e:
        print(f"Error creating folder '{folder_name}': {e}")