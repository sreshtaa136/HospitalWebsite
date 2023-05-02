// JS FUNCTIONS FOR BOOKING PAGE

// disables past dates in date picker
function setMinDate() {
    let today = new Date();
    let date = today.getDate();
    let month = today.getMonth() + 1; //January is 0 for js so need to add 1 to make it 1
    let year = today.getFullYear();
    if(date < 10) {
        date = '0'+ date;
    } 
    if(month < 10) {
        month = '0' + month;
    } 
    today = year + '-' + month + '-' + date;
    document.getElementById("date").setAttribute("min", today);
}

// converts pid to uppercase as user types
function capitalise() {
    document.getElementById("pid").value = document.getElementById("pid").value.toUpperCase();
}

// function to validate patient id input
function pidCheck() {

    let alphabets = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O",
                    "P","Q","R","S","T","U","V","W","X","Y","Z"];

    // checking pattern first 
    let pattern = false;
    let pid = document.getElementById("pid").value;
    if(pid.match(/^[A-Z][A-Z]([0-9]){1,}[A-Z]$/)) {
        pattern = true;
    }
    // checksum rule
    let checksum = false;
    if(pattern) {
        let dig_start_index = 2;
        let dig_length = pid.length - 3;
        let digit_string = pid.substr(dig_start_index, dig_length);
        let dig_array = digit_string.split("");
        let sum = 0;
        for (let i = 0; i < dig_array.length; i++) {
            sum += parseInt(dig_array[i]);
        }

        let remainder = sum % 26;
        let last_char = pid.slice(-1);
        let index = remainder - 1;
        if (remainder == 0) {
            index = 25;
        }
        if(alphabets[index] == last_char) {
            checksum = true;
        } 
    } 

    let pid_err = document.getElementById("pidError");
    if(!checksum) {
        pid_err.innerHTML = "Invalid Patient Id";
        pid_err.style = "font-weight:bold;color:red;margin-left:1em;"
    } else {
        pid_err.innerHTML = "";
    }
}

// displays advice according to user's input for reason 
function printAdvice() {
    let reason = document.getElementById("reason").value;
    switch(reason) {
        case "ChildhoodVaccinationShots":
            document.getElementById("advice").innerHTML = "Disclaimer: Multiple vaccines are normally administered in " + 
                                "combination and may cause the child to be sluggish or feverous for 24 – 48 hours afterwards.";
            break;
        case "InfluenzaShot":
            document.getElementById("advice").innerHTML = "Advice: The best time to get vaccinated is in April and May each year "+ 
                                "for optimal protection over the winter months.";
            break;
        case "CovidBoosterShot":
            document.getElementById("advice").innerHTML = "Advice: You are advised to have your third shot as soon as possible. "+
                                "If you are over the age of 30, you are advised to have your fourth shot to protect against new variant strains.";
            break;
        case "BloodTest":
            document.getElementById("advice").innerHTML = "Advice: Some tests require some fasting ahead of time. One of our staff "+ 
                                "members will advise you on this prior to your appointment.";
            break;
        case "":
            document.getElementById("advice").innerHTML = "";
            break;
    }
}

// checks if the pill-checkbox has at least one booking time selected
function checkTime(event) {
    let boxes_checked = document.querySelectorAll('input[name^=time]:checked').length;
    if(boxes_checked == 0) {
        window.alert("You MUST fill all the fields in the form in order to submit.");
        event.preventDefault();
    }            
}