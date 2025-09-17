import datetime, random

# ⚙️ Configurations
CONFIG = {
    "date_start": (2025, 4, 1),
    "date_end":   (2025, 4, 1),
    "logs_per_day": 4,
    "time_in_range": ("6:19:00", "7:58:00"),
    "time_out_range": ("17:11:00", "18:04:00"),
    "overtime_chance": 5,           # % chance of extending max time
    "overtime_minutes": (1, 14),     # min-max minutes
    "sort_time_ins": True,
    "sort_time_outs": False
}

def rand_time(base_str, max_str, overtime=False):
    base, max_ = [datetime.datetime.strptime(t, "%H:%M:%S") for t in (base_str, max_str)]
    if overtime and random.randint(1,100) <= CONFIG["overtime_chance"]:
        max_ += datetime.timedelta(minutes=random.randint(*CONFIG["overtime_minutes"]))
    return base + datetime.timedelta(seconds=random.randint(0, int((max_-base).total_seconds())))

def generate_time_logs():
    start = datetime.date(*CONFIG["date_start"])
    end   = datetime.date(*CONFIG["date_end"])
    delta = datetime.timedelta(days=1)
    time_in_lines, time_out_lines, date_lines = [""], ["\n"], ["\n"]

    while start <= end:
        ins = [rand_time(*CONFIG["time_in_range"], True) for _ in range(CONFIG["logs_per_day"])]
        outs = [rand_time(*CONFIG["time_out_range"], True) for _ in range(CONFIG["logs_per_day"])]
        if CONFIG["sort_time_ins"]: ins.sort()
        if CONFIG["sort_time_outs"]: outs.sort()
        for t in ins:  time_in_lines.append(f"{start:%m/%d/%Y} {t:%H:%M:%S}")
        for t in outs: time_out_lines.append(f"{start:%m/%d/%Y} {t:%H:%M:%S}")
        date_lines.extend([f"{start:%m/%d/%Y}"]*CONFIG["logs_per_day"])
        start += delta

    return "\n".join(time_in_lines+time_out_lines+date_lines)

# ▶️ Example usage
print(generate_time_logs())