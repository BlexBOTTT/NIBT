import datetime
import random

def generate_time_logs(sort_times=True, overtime_chance_percent=10, overtime_minutes_range=(1, 10)):
    time_in_lines = ["Time-in first-time: (random)"]
    time_out_lines = ["\nTime-out second-time: (random)"]
    date_lines = ["\ndate"]

    # Date range
    start_date = datetime.date(2025, 1, 13)
    end_date = datetime.date(2025, 1, 13)
    delta = datetime.timedelta(days=1)
    current_date = start_date

    while current_date <= end_date:
        time_ins = []
        time_outs = []
        dates = []

        # Generate 10 logs
        for _ in range(10):
            # Generate time-in
            time_in_base = datetime.datetime.strptime("16:35:00", "%H:%M:%S")
            time_in_max = datetime.datetime.strptime("17:05:00", "%H:%M:%S")
            if random.randint(1, 100) <= overtime_chance_percent:
                overtime_minutes = random.randint(*overtime_minutes_range)
                time_in_max += datetime.timedelta(minutes=overtime_minutes)
            diff_in = int((time_in_max - time_in_base).total_seconds())
            time_in = time_in_base + datetime.timedelta(seconds=random.randint(0, diff_in))
            time_ins.append(time_in)

            # Generate time-out
            time_out_base = datetime.datetime.strptime("21:11:00", "%H:%M:%S")
            time_out_max = datetime.datetime.strptime("22:00:00", "%H:%M:%S")
            if random.randint(1, 100) <= overtime_chance_percent:
                overtime_minutes = random.randint(*overtime_minutes_range)
                time_out_max += datetime.timedelta(minutes=overtime_minutes)
            diff_out = int((time_out_max - time_out_base).total_seconds())
            time_out = time_out_base + datetime.timedelta(seconds=random.randint(0, diff_out))
            time_outs.append(time_out)

            # Append date (same date for both time-in and out)
            dates.append(f"{current_date.month}/{current_date.day}/{current_date.year}")

        # Sort if needed
        if sort_times:
            time_ins.sort()
            time_outs.sort()

        for t_in in time_ins:
            time_in_lines.append(f"{current_date.month}/{current_date.day}/{current_date.year} {t_in.strftime('%H:%M:%S')}")
        for t_out in time_outs:
            time_out_lines.append(f"{current_date.month}/{current_date.day}/{current_date.year} {t_out.strftime('%H:%M:%S')}")
        for date in dates:
            date_lines.append(date)

        current_date += delta

    return "\n".join(time_in_lines) + "\n" + "\n".join(time_out_lines) + "\n" + "\n".join(date_lines)

# ▶️ Example usage
output = generate_time_logs(
    sort_times=False,              # Set True or False depending on preference
    overtime_chance_percent=14,
    overtime_minutes_range=(1, 14)
)

print(output)
