<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hydration Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: linear-gradient(to right, #a8e063, #56ab2f);
            color: white;
            padding: 20px;
        }
        .reminder-box {
            background: #fff;
            color: #333;
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            width: 300px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .status {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Welcome to Your Hydration Reminder</h1>
    <div class="reminder-box">
        <p>We'll remind you to drink water throughout the day!</p>
        <p id="status" class="status"></p>
    </div>

    <script>
        let reminderInterval;

        // Automatically start reminders when the page loads
        function startReminder() {
            if (!localStorage.getItem('hydrationReminderActive')) {
                // Persist reminder status using localStorage
                localStorage.setItem('hydrationReminderActive', 'true');
            }
            document.getElementById("status").textContent = "Hydration reminders are active.";
            document.getElementById("status").style.color = "green";

            if (!reminderInterval) {
                reminderInterval = setInterval(() => {
                    alert("💧 Time to drink water! Stay hydrated!");
                }, 2000); // 1-hour interval (3600000 milliseconds)
            }
        }

        // Stop the reminder if needed
        function stopReminder() {
            clearInterval(reminderInterval);
            reminderInterval = null;
            localStorage.removeItem('hydrationReminderActive');
            document.getElementById("status").textContent = "Hydration reminders are off.";
            document.getElementById("status").style.color = "red";
        }

        // Start reminders automatically if they are active
        if (localStorage.getItem('hydrationReminderActive') === 'true') {
            startReminder();
        } else {
            document.getElementById("status").textContent = "Hydration reminders are off.";
            document.getElementById("status").style.color = "red";
        }
    </script>
</body>
</html>