// Sidebar Toggle
// const sidebar = document.getElementById("sidebar");
const mainContent = document.getElementById("mainContent");
const menuToggle = document.getElementById("menuToggle");

menuToggle.addEventListener("click", () => {
    sidebar.classList.toggle("mobile-open");
});

// // Investment Trends Chart
// const trendsCtx = document.getElementById("trendsChart").getContext("2d");
// const trendsChart = new Chart(trendsCtx, {
//   type: "line",
//   data: {
//     labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
//     datasets: [
//       {
//         label: "Investments",
//         data: [125000, 135000, 142000, 148000, 156000, 162000, 168000],
//         borderColor: "#6366f1",
//         backgroundColor: "rgba(99, 102, 241, 0.1)",
//         borderWidth: 3,
//         fill: true,
//         tension: 0.4,
//       },
//       {
//         label: "Profits Paid",
//         data: [1250, 1350, 1420, 1480, 1560, 1620, 1680],
//         borderColor: "#10b981",
//         backgroundColor: "rgba(16, 185, 129, 0.1)",
//         borderWidth: 3,
//         fill: true,
//         tension: 0.4,
//       },
//     ],
//   },
//   options: {
//     responsive: true,
//     maintainAspectRatio: true,
//     plugins: {
//       legend: {
//         display: true,
//         position: "top",
//         labels: {
//           color: "#f1f5f9",
//           padding: 15,
//           font: { size: 12 },
//         },
//       },
//       tooltip: {
//         backgroundColor: "#1e293b",
//         titleColor: "#f1f5f9",
//         bodyColor: "#f1f5f9",
//         borderColor: "#334155",
//         borderWidth: 1,
//         padding: 12,
//       },
//     },
//     scales: {
//       y: {
//         beginAtZero: true,
//         grid: {
//           color: "#334155",
//           drawBorder: false,
//         },
//         ticks: {
//           color: "#94a3b8",
//           callback: function (value) {
//             return "$" + value / 1000 + "K";
//           },
//         },
//       },
//       x: {
//         grid: { display: false },
//         ticks: { color: "#94a3b8" },
//       },
//     },
//   },
// });

// // Status Chart
// const statusCtx = document.getElementById("statusChart").getContext("2d");
// const statusChart = new Chart(statusCtx, {
//   type: "doughnut",
//   data: {
//     labels: ["Active", "Pending", "Completed", "Rejected"],
//     datasets: [
//       {
//         data: [62, 15, 18, 5],
//         backgroundColor: ["#10b981", "#f59e0b", "#6366f1", "#ef4444"],
//         borderWidth: 0,
//         hoverOffset: 10,
//       },
//     ],
//   },
//   options: {
//     responsive: true,
//     maintainAspectRatio: true,
//     plugins: {
//       legend: {
//         position: "bottom",
//         labels: {
//           color: "#f1f5f9",
//           padding: 15,
//           font: { size: 12 },
//         },
//       },
//       tooltip: {
//         backgroundColor: "#1e293b",
//         titleColor: "#f1f5f9",
//         bodyColor: "#f1f5f9",
//         borderColor: "#334155",
//         borderWidth: 1,
//         padding: 12,
//         callbacks: {
//           label: function (context) {
//             return context.label + ": " + context.parsed + "%";
//           },
//         },
//       },
//     },
//   },
// });

// Chart Filter Buttons
document.querySelectorAll(".filter-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
        document
            .querySelectorAll(".filter-btn")
            .forEach((b) => b.classList.remove("active"));
        this.classList.add("active");
    });
});

// View Receipt Function
function viewReceipt(src) {
    document.getElementById("receiptFullImage").src = src;
    const modal = new bootstrap.Modal(document.getElementById("receiptModal"));
    modal.show();
}

// Approve Investment Function
function approveInvestment(user, amount) {
    if (confirm(`Approve investment of ${amount} for ${user}?`)) {
        alert(`Investment of ${amount} for ${user} has been approved!`);
        // Here you would make an API call to approve the investment
    }
}

// Reject Investment Function
function rejectInvestment(user, amount) {
    if (confirm(`Reject investment of ${amount} for ${user}?`)) {
        const reason = prompt("Please provide a reason for rejection:");
        if (reason) {
            alert(
                `Investment of ${amount} for ${user} has been rejected.\nReason: ${reason}`
            );
            // Here you would make an API call to reject the investment
        }
    }
}
const WEB3FORMS_API_KEY = "300696b5-f2b7-4b81-9260-fcd8ce1d7906"; // TODO: Move to backend proxy for security
// Table Search
document
    .querySelector(".search-box input")
    .addEventListener("input", function (e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll("tbody tr");

        rows.forEach((row) => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? "" : "none";
        });
    });
