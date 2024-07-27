<!DOCTYPE html>
<html>
<head>
    <title>CityEase - Sign up</title>
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
    <div class="signup-box">
        <div class="greeting">
            <h1>Create your account</h1>
            <p>All fields are required, you cannot proceed to the next step if incomplete</p>
        </div>

        <div class="status-bar">
            <div class="status-icon">
                <img src="../assets/step1-inprog.png" alt="step 1 in progress" class="icon" id="step1-icon"> 
                <span id="step1-status">Step 1: In Progress</span>
            </div>
            <div class="status-line"></div>
            <div class="status-icon">
                <img src="../assets/step2-inprog.png" alt="step 2" class="icon" id="step2-icon">
                <span id="step2-status">Step 2: Not Started</span>
            </div>
        </div>

        <div id="step-1" class="step active">
            <div class="credentials">
                <h3>Log in Details</h3>
                <div class="row">
                    <div class="form-group">
                        <label>Role</label>
                        <div class="role-options">
                            <input type="radio" id="user" name="role" value="user" required>
                            <label for="user">User</label>
                            <input type="radio" id="admin" name="role" value="admin" required>
                            <label for="admin">Admin</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required>
                    </div>
                </div>
                <button type="button" id="next-btn" onclick="nextStep(2)" disabled>Next</button>
            </div>
        </div>

        <div id="step-2" class="step">
            <form id="signup-form">
                <h3>Personal Information</h3>
                <div class="row">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="suffix">Suffix</label>
                        <select id="suffix" name="suffix">
                            <option value="" selected>None</option>
                            <option value="Jr.">Jr.</option>
                            <option value="Sr.">Sr.</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <select id="sex" name="sex" required>
                            <option value="" selected>Select</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="civil_status">Civil Status</label>
                        <select id="civil_status" name="civil_status" required>
                            <option value="" selected>Select</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="widowed">Widowed</option>
                            <option value="divorced">Divorced</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="region">Region</label>
                        <input type="text" id="region" name="region" required>
                    </div>
                    <div class="form-group">
                        <label for="province">Province</label>
                        <input type="text" id="province" name="province" required>
                    </div>
                    <div class="form-group">
                        <label for="municipality">Municipality</label>
                        <input type="text" id="municipality" name="municipality" required>
                    </div>
                </div>
                <button type="button" onclick="prevStep(1)">Previous</button>
                <button type="submit" id="signup-btn" disabled>Sign Up</button>
            </form>
        </div>
    </div>

    <script>
        function nextStep(step) {
            if (validateStep1()) {
                document.querySelectorAll('.step').forEach(function(el) {
                    el.classList.remove('active');
                });
                document.getElementById('step-' + step).classList.add('active');
                updateStatusBar(step);
            } else {
                alert("All fields are required and passwords must match.");
            }
        }

        function prevStep(step) {
            document.querySelectorAll('.step').forEach(function(el) {
                el.classList.remove('active');
            });
            document.getElementById('step-' + step).classList.add('active');
            updateStatusBar(step);
        }

        function updateStatusBar(step) {
            if (step === 2) {
                document.getElementById('step1-icon').src = '../assets/step1-done.png';
                document.getElementById('step2-icon').src = '../assets/step2-inprog.png';
                document.getElementById('step1-status').textContent = 'Step 1: Completed';
                document.getElementById('step2-status').textContent = 'Step 2: In Progress';
            } else {
                document.getElementById('step1-icon').src = '../assets/step1-inprog.png';
                document.getElementById('step2-icon').src = '../assets/step2.png';
                document.getElementById('step1-status').textContent = 'Step 1: In Progress';
                document.getElementById('step2-status').textContent = 'Step 2: Not Started';
            }
        }

        function validateStep1() {
            const role = document.querySelector('input[name="role"]:checked');
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            return role && email && password && confirmPassword && (password === confirmPassword);
        }

        function enableNextButton() {
            const nextButton = document.getElementById('next-btn');
            nextButton.disabled = !validateStep1();
        }

        function enableSignupButton() {
            const form = document.getElementById('signup-form');
            const isValid = form.checkValidity();
            document.getElementById('signup-btn').disabled = !isValid;
        }

        document.querySelectorAll('#step-1 input').forEach(function(input) {
            input.addEventListener('input', enableNextButton);
        });

        document.querySelectorAll('#step-2 input, #step-2 select').forEach(function(input) {
            input.addEventListener('input', enableSignupButton);
        });
    </script>
</body>
</html>