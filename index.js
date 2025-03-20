const patientInputField = document.querySelector('input[name="pid"]'); // selecting the input that corresponds to the attribute of "pid"
const errorMessage = document.getElementById("invalid-login"); // selecting the element that has the ID of "invalid-login"
const timeSlotCheckboxes = document.querySelectorAll('.time-slot'); // Select all checkboxes with the class "time-slot"

patientInputField.addEventListener("input", function (event) {
    const inputValue = patientInputField.value.toUpperCase(); // Convert to uppercase

    console.log("Input value:", inputValue);

    fetch('tools.php?action=checkPattern&input=' + inputValue)
        .then(response => response.json())
        .then(data => {
            if (data.isValid) {
                console.log("Input value matches the regex pattern.");
                errorMessage.style.display = "none";
                patientInputField.style.border = "3px solid green";
                patientInputField.value = inputValue;
            } else {
                errorMessage.style.display = "block";
                console.log("Input value does not match the regex pattern.");
                patientInputField.style.border = "3px solid red";
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

patientInputField.addEventListener("input", function (event) {
    patientInputField.value = patientInputField.value.toUpperCase(); // Convert input to uppercase
});

document.addEventListener("DOMContentLoaded", function() {
    // Defining a reference to the advice textarea
    const adviceTextarea = document.getElementById("advice-textarea");

    // Defining a reference to the appointment reason selection field
    const appointmentReason = document.querySelector("select[name='reason']");

    // Dictionary containing predefined advice for each reason
    const adviceText = {
        "Childhood Vaccination Shots": "A disclaimer that multiple vaccines are normally administered in combination and may cause the child to be sluggish or feverous for 24 – 48 hours afterwards.",
        "Influenza Shot": "The best time to get vaccinated is in April and May each year for optimal protection over the winter months.",
        "Covid Booster Shot": "Advice that everyone should arrange to have their third shot as soon as possible and adults over the age of 30 should have their fourth shot to protect against new variant strains.",
        "Blood Test": "That some tests require some fasting ahead of time and that a staff member will advise them on this prior to the appointment."
    };

    // Add event listener to the dropdown field to detect changes
    appointmentReason.addEventListener("change", function() {
        // Clear the previous advice text in the field
        adviceTextarea.value = "";

        // Get the selected option value based on what has been selected
        const selectedOption = appointmentReason.value;

        // Use the selected reason to populate the advice field
        if (selectedOption in adviceText) {
            adviceTextarea.value = adviceText[selectedOption];
        }
    });
});

// Add a click event listener to each checkbox so only 1 is selected at a time
timeSlotCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('click', () => {
        // Uncheck all checkboxes
        timeSlotCheckboxes.forEach(cb => {
            if (cb !== checkbox) {
                cb.checked = false;
            }
        });
    });
});
