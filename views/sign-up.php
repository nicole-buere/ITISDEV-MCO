<!-- this is the sign up page -->
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
        </div>

        <!-- sign up form -->
        <div class="credentials">
            <form>
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

                <!-- Additional rows -->
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

                <button type="submit">Sign Up</button>
            </form>
        </div>
    </div>
</body>
</html>