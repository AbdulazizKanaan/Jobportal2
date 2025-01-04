function handleApplication(button, action) {
  const row = button.closest("tr");
  const statusCell = row.querySelector("td:nth-child(3)");

  if (action === "approved") {
    statusCell.textContent = "Approved";
    statusCell.style.color = "green";
  } else if (action === "rejected") {
    statusCell.textContent = "Rejected";
    statusCell.style.color = "red";
  }

  // Disable buttons after decision
  row.querySelectorAll("button").forEach((btn) => (btn.disabled = true));
}
const applicationsList = document.getElementById("applications-list");
const form = document.getElementById("application-form");

// Add Application (Create)
form.addEventListener("submit", function (e) {
  e.preventDefault();
  const applicantName = document.getElementById("applicant-name").value;
  const jobTitle = document.getElementById("job-title").value;

  if (applicantName && jobTitle) {
    addApplicationRow(applicantName, jobTitle, "Pending");
    form.reset();
  }
});

function addApplicationRow(applicant, jobTitle, status) {
  const row = document.createElement("tr");

  row.innerHTML = `
    <td>${applicant}</td>
    <td>${jobTitle}</td>
    <td>${status}</td>
    <td>
      <button class="approve-btn" onclick="updateStatus(this, 'Approved')">Approve</button>
      <button class="reject-btn" onclick="updateStatus(this, 'Rejected')">Reject</button>
      <button onclick="editApplication(this)">Edit</button>
      <button onclick="deleteApplication(this)">Delete</button>
    </td>
  `;

  applicationsList.appendChild(row);
}

// Update Application Status
function updateStatus(button, newStatus) {
  const row = button.closest("tr");
  const statusCell = row.querySelector("td:nth-child(3)");
  statusCell.textContent = newStatus;
  statusCell.style.color = newStatus === "Approved" ? "green" : "red";
}

// Edit Application (Update)
function editApplication(button) {
  const row = button.closest("tr");
  const applicantCell = row.querySelector("td:nth-child(1)");
  const jobTitleCell = row.querySelector("td:nth-child(2)");

  const applicantName = prompt("Edit Applicant Name:", applicantCell.textContent);
  const jobTitle = prompt("Edit Job Title:", jobTitleCell.textContent);

  if (applicantName !== null && jobTitle !== null) {
    applicantCell.textContent = applicantName;
    jobTitleCell.textContent = jobTitle;
  }
}

// Delete Application
function deleteApplication(button) {
  const row = button.closest("tr");
  applicationsList.removeChild(row);
}
