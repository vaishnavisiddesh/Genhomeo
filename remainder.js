let reminderInterval;

// Function to start reminders automatically
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

// Function to stop reminders
function stopReminder() {
    clearInterval(reminderInterval);
    reminderInterval = null;
    localStorage.removeItem('hydrationReminderActive');
    document.getElementById("status").textContent = "Hydration reminders are off.";
    document.getElementById("status").style.color = "red";
}

// Automatically start reminders when the page loads if they are active
if (localStorage.getItem('hydrationReminderActive') === 'true') {
    startReminder();
} else {
    document.getElementById("status").textContent = "Hydration reminders are off.";
    document.getElementById("status").style.color = "red";
}