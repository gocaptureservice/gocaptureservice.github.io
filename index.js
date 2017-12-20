/**
 * Determine the mobile operating system.
 * This function returns one of 'iOS', 'Android', 'Windows Phone', or 'unknown'.
 *
 * @returns {String}
 */
function getMobileOperatingSystem() {
  var userAgent = navigator.userAgent || navigator.vendor || window.opera;

      // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) {
			document.getElementById("downloadLink").href = "https://play.google.com/store/apps/details?id=com.gocaptureapp&hl=en";
    }

    if (/android/i.test(userAgent)) {
			// https://play.google.com/store/apps/details?id=com.gocaptureapp&hl=en
			document.getElementById("downloadLink").href = "https://play.google.com/store/apps/details?id=com.gocaptureapp&hl=en";
    }

    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
			// https://itunes.apple.com/us/app/gocapture/id1160876840
			document.getElementById("downloadLink").href = "https://itunes.apple.com/us/app/gocapture/id1160876840";
    }

		if (/Chrome/.test(userAgent) && /Google Inc/.test(navigator.vendor)) {
			document.getElementById("downloadLink").href = "https://play.google.com/store/apps/details?id=com.gocaptureapp&hl=en";
		}

		document.getElementById("downloadLink").href = "https://play.google.com/store/apps/details?id=com.gocaptureapp&hl=en";
	}