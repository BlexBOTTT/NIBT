import datetime
import random

def formatted_random_time_output():
    first_times = []
    date_repeats = []
    second_times = []
    third_times = []

    for _ in range(25):  # Loop 28 times
        # Editable date
        date_str = "2/28/2025"
        # 
        # Generate first time (4:30:00 PM - 4:40:00 PM, 2% chance up to 5:00:00 PM)
        base_time = datetime.datetime.strptime("21:02:00", "%H:%M:%S")
        max_time = datetime.datetime.strptime("21:15:00", "%H:%M:%S")
        extra_time = datetime.datetime.strptime("22:00:00", "%H:%M:%S")

        if random.random() < 0.08:  # 5% chance to go beyond 4:40:00 PM
            time_diff = (extra_time - base_time).seconds
        else:
            time_diff = (max_time - base_time).seconds

        random_seconds = random.randint(0, time_diff)
        first_time = base_time + datetime.timedelta(seconds=random_seconds)

        # Generate second time (6:##:00 AM - 8:##:00 AM, 1% chance beyond 8:00:00 AM)
        morning_base = datetime.datetime.strptime("16:31:00", "%H:%M:%S")
        morning_max = datetime.datetime.strptime("17:00:00", "%H:%M:%S")
        extra_morning = datetime.datetime.strptime("17:20:00", "%H:%M:%S")

        if random.random() < 0.08:  # 8% chance to go beyond time-in
            morning_diff = (extra_morning - morning_base).seconds
        else:
            morning_diff = (morning_max - morning_base).seconds

        morning_seconds = random.randint(0, morning_diff)
        second_time = morning_base + datetime.timedelta(seconds=morning_seconds)
        second_time = second_time.replace(second=0)  # Ensure "00" seconds

        # Third time (copy first time but seconds always "00", remove date)
        third_time = first_time.replace(second=0)

        # Store results
        first_times.append(f"{date_str} {first_time.strftime('%I:%M:%S %p')}")
        date_repeats.append(date_str)  # Repeat date 28 times
        second_times.append(f"{second_time.strftime('%I:%M:%S %p')}")
        third_times.append(f"{third_time.strftime('%I:%M:%S %p')}")

    return "\n".join(first_times) + "\n\n" + "\n".join(date_repeats) + "\n\n" + "\n".join(second_times) + "\n\n" + "\n".join(third_times)

# Run and print output
formatted_output = formatted_random_time_output()
print(formatted_output)
