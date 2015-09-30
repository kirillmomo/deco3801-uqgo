var steps = 0;
// Distance walked (based of average step distance)
var distance = 0;
// Accelerometer watchs settings
var options = { frequency: 100 };  // Update 20 times a second
// Acceleration watch object
var stepwatch;
// Previously return value of the acceleration function
var previousaccel = 9.81;
// Flag to indicate if the step counter has found a maximum
var maxfound = 0;
// Flag to indicate if the step counter has found a minimum
var minfound = 0;

// Processes acceleration data when the acceleration watcher succeeds in gather data.
function accSuccess(acceleration) {

    // Gets Graphable value from acceleration data.
    var accelvalue = Math.sqrt(acceleration.x * acceleration.x + acceleration.y * acceleration.y + acceleration.z * acceleration.z);
    //console.log("Accel: " + accelvalue + "  Previous: " +previousaccel);
    // Checks if graphs maximum is found.
    if(maxfound == 0){
        if(accelvalue < previousaccel -3){
            // Sets maxFound flag when a max is found
            maxfound = 1;
        }
    } else {
        if(accelvalue > previousaccel +3) {
            // Sets minFound flag when a max is found
            minfound = 1; 
        }
    }
    //console.log("MaxFound: " + maxfound + "  MinFound: " +minfound);
    // If the graph has passed on sequence increment the steps an reset the flags
    if( maxfound == 1 && minfound == 1){
        maxfound = 0;
        minfound = 0;
        incrementSteps();
    }
    // Sets previous acceleration value as the current value.
    previousaccel = accelvalue;
}

// Function that runs on accelerometer error.
function accError(){
    alert('Error');    
}

// Begin the step counting
function countSteps(){
    // Sets and accelerometer watcher.
    stepwatch = navigator.accelerometer.watchAcceleration(accSuccess, accError, options);
}

// Function that increments steps and distance
function incrementSteps() {
    steps++;
    // Increases distance by the average step distance.
    distance += 0.75;
    // Updates onscreen values
    $('#stepdisplay').html(steps);
    $('#distancedisplay').html(distance + "m");
    // Logs values
    console.log("steps: " + steps + "distance: " +distance);

}