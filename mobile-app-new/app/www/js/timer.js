// Time, in seconds, of the current run.
var time = 0;
// Time in hours:minutes:seconds format.
var formatted = "";
// Status of counting; while 1 keeps counting up, while 0 pauses counter.
var counting = 0;

// Starts timer
function timer() { 
    // Converts variable 'time' into hours:minutes:seconds format.
    var hours = Math.floor(time / 3600);
    var minutes = Math.floor((time - hours * 3600) / 60);
    var seconds = time - (hours * 3600) - (minutes * 60);

    // Adds a leading 0 to numbers that are only 1 digit.
    if(hours < 10) {hours = "0"+hours;}
    if(minutes < 10) {minutes = "0"+minutes;}
    if(seconds < 10) {seconds = "0"+seconds;}

    //Updates the formatted time value.
    formatted = hours + ":" + minutes + ":" + seconds;

    if(counting){
        // Updates the onscreen timer.
        $('#runtime').html(formatted);
        // Get Location once every ten seconds
        if(time % 10 === 0) {
            getLocation();
        }
        // Increments time when function is run
        time++;
        setTimeout('timer()', 1000);
    }
}

// Toogles the timer and and off.
function pauseToggle() {
    if(counting){
        // Renames button to 'Resume' and pauses timer
        $('#pausetrack').html('Resume');
        pauseTimer();
    } else {
        // Renames button to 'Pause' and resumes timer
        $('#pausetrack').html('Pause');
        setTimeout('resumeTimer()', 1000);
    }
}

// Redirects once the session is complete
function startFinish() {
    if(sessionstarted == 0){
        sessionstarted = 1;
        // Rename Button
        $('#stoptrack').html('Done');
        // Begin the Session Timer and Step counter
        resumeTimer();    
    } else {
        sessionstarted = 0;
        pauseTimer();
        navigator.accelerometer.clearWatch(stepwatch);

        $("#trackbuttons").slideUp(500);
        $("#welldone").slideDown(500);
        $("#sharestats").slideDown(0);
        //postSessionData();
    }
}

// Sets counting to 0 so the timer stops
function pauseTimer() {
    counting = 0;
    navigator.accelerometer.clearWatch(stepwatch);
}

// Sets counting to 1 and begins the timer once again.
function resumeTimer() {
    counting = 1;
    timer();
    countSteps();
}

function postSessionData(){
    
}