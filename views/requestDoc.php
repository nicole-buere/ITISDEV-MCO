<!DOCTYPE html>
<html>
    <head>
        <title>Request Documents</title>
        <link rel="stylesheet" href="../css/forms.css">
    </head>
    <body>
        <div class="formContainer">
            <h1 class="formTitle">Request a Document</h1>
            <img src="../assets/logo-noname.png" alt="logo no name" class="logo">
            <form method="POST" action="payment.php">
                <table class="formTable">
                    <tr>
                        <td>
                            <div class="inputDiv">
                                <label for="reportType" class="formFieldLabel">Type:</label>
                                <select required class="reportType" name="reportType">
                                    <option hidden disabled selected value class="selectOption">Select an option</option>
                                    <option class="selectOption" value="barangayClearance">Barangay Clearance</option>
                                    <option class="selectOption" value="barangayID">Barangay ID</option>
                                    <option class="selectOption" value="barangayCertificateOfResidency">Barangay Certificate of Residency</option>
                                    <option class="selectOption" value="firstTimeJobseekerCertificate">First Time Jobseeker Certificate</option>
                                    <option class="selectOption" value="barangayBusinessPermit">Barangay Business Permit</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="inputDiv">
                                <label for="IDinput" class="formFieldLabel">Governemnt ID:</label>
                                <input required type="file" name="IDinput"></input>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="inputDiv">
                                <label for="contactNO" class="formFieldLabel">Contact Number</label>
                                <input required type="number" name="contactNO"></input>
                            </div>
                        </td>
                        <td>
                            <div class="inputDiv">
                                <label for="email" class="formFieldLabel">Email</label>
                                <input required type="email" name="email"></input>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="inputDiv">
                                <label for="region" class="formFieldLabel">Region:</label>
                                <select required class="region" name="region">
                                    <option hidden disabled selected value class="selectOption">Select a region</option>
                                    <option class="selectOption" value="ncr">National Capital Region (NCR)</option>
                                    <option class="selectOption" value="car">Cordillera Administrative Region (CAR)</option>
                                    <option class="selectOption" value="region1">Ilocos Region (Region I)</option>
                                    <option class="selectOption" value="region2">Cagayan Valley (Region II)</option>
                                    <option class="selectOption" value="region3">Central Luzon (Region III)</option>
                                    <option class="selectOption" value="region4a">Calabarzon (Region IV-A)</option>
                                    <option class="selectOption" value="region4b">Mimaropa (Region IV-B)</option>
                                    <option class="selectOption" value="region5">Bicol Region (Region V)</option>
                                    <option class="selectOption" value="region6">Western Visayas (Region VI)</option>
                                    <option class="selectOption" value="region7">Central Visayas (Region VII)</option>
                                    <option class="selectOption" value="region8">Eastern Visayas (Region VIII)</option>
                                    <option class="selectOption" value="region9">Zamboanga Peninsula (Region IX)</option>
                                    <option class="selectOption" value="region10">Northern Mindanao (Region X)</option>
                                    <option class="selectOption" value="region11">Davao Region (Region XI)</option>
                                    <option class="selectOption" value="region12">Soccsksargen (Region XII)</option>
                                    <option class="selectOption" value="caraga">Caraga (Region XIII)</option>
                                    <option class="selectOption" value="bar">Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="inputDiv">
                                <label for="province" class="formFieldLabel">Province:</label>
                                <select required class="province" name="province">
                                    <option hidden disabled selected value class="selectOption">Select an option</option>
                                    <option class="selectOption" value="sample1">Sample1</option>
                                    <option class="selectOption" value="sample2">Sample2</option>
                                    <option class="selectOption" value="sample3">Sample3</option>
                                    <option class="selectOption" value="sample4">Sample4</option>
                                    <option class="selectOption" value="sample5">Sample5</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="inputDiv">
                                <label for="municipality" class="formFieldLabel">Municipality:</label>
                                <select required class="municipality" name="municipality">
                                    <option hidden disabled selected value class="selectOption">Select an option</option>
                                    <option class="selectOption" value="sample1">Sample1</option>
                                    <option class="selectOption" value="sample2">Sample2</option>
                                    <option class="selectOption" value="sample3">Sample3</option>
                                    <option class="selectOption" value="sample4">Sample4</option>
                                    <option class="selectOption" value="sample5">Sample5</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>

                <input type="submit" class="submitButton" value="Proceed to Payment"></input>
            </form>
        </div>
    </body>
</html>