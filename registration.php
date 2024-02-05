<?php
include_once 'templates/header.php';
?>

<div class="container">
    <div class="tabs">
        <div class="tab" id="registrationTab" onclick="showForm('registrationForm')">Patient Registration</div>
        <div class="tab" id="appointmentTab" onclick="showForm('appointmentForm')">Appointment Form</div>
        <div class="tab" id="doctordetailsTab" onclick="showForm('doctordetailsForm')">Doctor Details</div>
    </div>
    
        <form id="registrationForm" class="form">
          <h2>Patient Registration</h2>
          <label for="fullName">Full Name:</label>
          <input type="text" id="fullName" name="fullName" required>
    
          <label for="dob">Date of Birth:</label>
          <input type="date" id="dob" name="dob" onchange="calculateAge()" required>
    
          <label for="age">Age:</label>
          <input type="text" id="age" name="age" readonly>
    
          <label for="gender">Gender:</label>
          <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
    
          <label for="bloodType">Blood Type:</label>
          <select id="bloodType" name="bloodType" onchange="checkBloodType()" required>
              <option value="" disabled selected>Select Blood Type</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="AB">AB</option>
              <option value="O">O</option>
              <option value="other">Other</option>
          </select>
          
          <div id="otherBloodType" style="display: none;">
              <label for="otherBloodTypeText">Specify Blood Type:</label>
              <input type="text" id="otherBloodTypeText" name="otherBloodTypeText" placeholder="Enter Blood Type">
          </div>
          <button type="button" onclick="nextForm('registration')">Next</button>
        </form>
    
        <form id="appointmentForm" class="form" style="display: none;">
            <h2>Appointment Form</h2>
            <label for="appointmentDate">Appointment Date:</label>
            <input type="date" id="appointmentDate" name="appointmentDate" required>
          
            <label for="appointmentTime">Appointment Time:</label>
            <input type="time" id="appointmentTime" name="appointmentTime" required disabled>
          
            <button type="button" onclick="nextForm('appointment')">Next</button>
        </form>
        
        <script>
            document.getElementById('appointmentDate').addEventListener('change', function () {
              const appointmentDate = document.getElementById('appointmentDate').value;
              const appointmentTimeInput = document.getElementById('appointmentTime');
          
              // Enable appointmentTime input only if a date is entered
              appointmentTimeInput.disabled = !appointmentDate;
            });
          
            function submitAppointment() {
              const appointmentDate = document.getElementById('appointmentDate').value;
              const appointmentTime = document.getElementById('appointmentTime').value;
          
              console.log('Appointment Information:');
              console.log('Appointment Date:', appointmentDate);
              console.log('Appointment Time:', appointmentTime);
              alert('Appointment submitted successfully!');
            }
          </script>
       

        <form id="doctordetailsForm" class="form" style="display: none;">
          <h2>Doctor Details Form</h2>
          <label for="doctor'sName">Doctor's Name:</label>
          <input type="text" id="doctorName" name="doctorName" required>

          <label for="specialization">Specialization:</label>
          <input type="text" id="specialization" name="specialization" required>

          <button type="button" onclick="validateDoctorDetails()">Submit</button>
        </form>
      </div>
      <script>
    function showForm(formId) {
        const registrationForm = document.getElementById('registrationForm');
        const appointmentForm = document.getElementById('appointmentForm');
        const registrationTab = document.getElementById('registrationTab');
        const appointmentTab = document.getElementById('appointmentTab');
        const doctordetailsForm = document.getElementById('doctordetailsForm');
        const doctordetailsTab = document.getElementById('doctordetailsTab');

        if (formId === 'registrationForm') {
            registrationForm.style.display = 'flex';
            appointmentForm.style.display = 'none';
            doctordetailsForm.style.display = 'none';
            registrationTab.style.backgroundColor = '#4caf50';
            appointmentTab.style.backgroundColor = '';
            doctordetailsTab.style.backgroundColor = '';

        } else if (formId === 'appointmentForm') {
            registrationForm.style.display = 'none';
            appointmentForm.style.display = 'flex';
            doctordetailsForm.style.display = 'none';
            appointmentTab.style.backgroundColor = '#4caf50';
            registrationTab.style.backgroundColor = '';
            doctordetailsTab.style.backgroundColor = '';

        } else if (formId === 'doctordetailsForm') {
            registrationForm.style.display = 'none';
            appointmentForm.style.display = 'none';
            doctordetailsForm.style.display = 'flex';
            appointmentTab.style.backgroundColor = '';
            registrationTab.style.backgroundColor = '';
            doctordetailsTab.style.backgroundColor = '#4caf50';
        }
    }


  
  function calculateAge() {
    const dob = document.getElementById('dob').value;
    const today = new Date();
    const birthDate = new Date(dob);
    let age = today.getFullYear() - birthDate.getFullYear();

    // Check if the birthday hasn't occurred yet this year
    if (
        today.getMonth() < birthDate.getMonth() ||
        (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())
    ) {
        age--;
        if (age < 0) {
            age = 0; // Set age to 0 if calculated age is negative
        }
    }

    // Validate that age is 14 or above
    if (age < 14) {
        alert('Age must be 14 or above.');
        document.getElementById('dob').value = ''; // Clear the date of birth field
        document.getElementById('age').value = ''; // Set the age field to empty
        return; // Stop further processing
    }

    document.getElementById('age').value = age;
}

document.getElementById('dob').addEventListener('change', calculateAge);


  function checkBloodType() {
    var bloodTypeDropdown = document.getElementById("bloodType");
    var otherBloodTypeDiv = document.getElementById("otherBloodType");
    var otherBloodTypeText = document.getElementById("otherBloodTypeText");
  
    if (bloodTypeDropdown.value === "other") {
        otherBloodTypeDiv.style.display = "block";
        otherBloodTypeText.required = true;
    } else {
        otherBloodTypeDiv.style.display = "none";
        otherBloodTypeText.required = false;
    }
  }
  function checkBloodType() {
    var bloodTypeDropdown = document.getElementById("bloodType");
    var otherBloodTypeDiv = document.getElementById("otherBloodType");
    var otherBloodTypeText = document.getElementById("otherBloodTypeText");
  
    if (bloodTypeDropdown.value === "other") {
        otherBloodTypeDiv.style.display = "block";
        otherBloodTypeText.required = true;
    } else {
        otherBloodTypeDiv.style.display = "none";
        otherBloodTypeText.required = false;
    }
    
  }

  function nextForm(formType) {
    const registrationForm = document.getElementById('registrationForm');
    const appointmentForm = document.getElementById('appointmentForm');
    const doctorDetailsForm = document.getElementById('doctordetailsForm');

    // Validate before transitioning to the next form
    if (formType === 'registration') {
        // Validate the Registration Form
        const fullName = document.getElementById('fullName').value;
        const dob = document.getElementById('dob').value;
        const age = document.getElementById('age').value;
        const gender = document.getElementById('gender').value;
        const bloodType = document.getElementById('bloodType').value;

        if (fullName.trim() === '' || dob.trim() === '' || age.trim() === '' || gender.trim() === '' || bloodType.trim() === '') {
            alert('Please fill in all fields in the Registration Form.');
            return;
        }

        // Transition from Registration Form to Appointment Form
        registrationForm.style.display = 'none';
        appointmentForm.style.display = 'flex';
    } else if (formType === 'appointment') {
        // Validate the Appointment Form (if needed)
        const appointmentDate = document.getElementById('appointmentDate').value;
        const appointmentTime = document.getElementById('appointmentTime').value;

        if (appointmentDate.trim() === '' || appointmentTime.trim() === '') {
            alert('Please fill in all fields in the Appointment Form.');
            return;
        }

        // Transition from Appointment Form to Doctor Details Form
        appointmentForm.style.display = 'none';
        doctorDetailsForm.style.display = 'flex';
    }
    // Add any specific logic or validations needed for each form transition
}


function validateDoctorDetails() {
    const doctorName = document.getElementById('doctorName').value;
    const specialization = document.getElementById('specialization').value;

    if (doctorName && specialization) {
        alert('Doctor details submitted successfully!');
        document.getElementById('doctordetailsForm').reset();
        document.getElementById('doctordetailsForm').style.display = 'none';
        document.getElementById('registrationForm').style.display = 'block';
    } else {
        alert('Please fill in both fields.');
    }
}

            </script>
      <?php
include_once 'templates/footer.php';
?>
