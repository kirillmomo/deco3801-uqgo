var osversion = getOSVersion();

// Get the OS version of the device
function getOSVersion() {
    return intel.xdk.device.osversion;   
}

// Make changes based on the version of the application.
function makeVersionChanges() {
    // 1 character osversion means device is apple
    if(osversion.length === 1) {
        $(".listtab").addClass("topspaceios");
        console.log("OS Version Apple");
    } else {
        $(".listtab").addClass("topspaceandroid");
        console.log("OS Version Android");
    }
}

// Log the user out
function logout() {
    intel.xdk.cache.removeCookie("userid");
    window.location = "login.html";
}

// Redirects to logout if the user isn't logged in 
function logoutRedirect() {
    var loggedin = intel.xdk.cache.getCookie("userid");
    if(loggedin === undefined){
        window.location = "login.html";
    }
}

makeVersionChanges();