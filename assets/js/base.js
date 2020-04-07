/***** MATERIALIZE *****/

// SideNav
document.addEventListener('DOMContentLoaded', function () {
    const elems = document.querySelectorAll('.sidenav');
    M.Sidenav.init(elems);
});

// Dropdown menu
document.addEventListener('DOMContentLoaded', function() {
    const elems = document.querySelectorAll('.dropdown-trigger');
    let instances = M.Dropdown.init(elems);
});

/***** INDEX *****/

// SPEECH RECOGNITION
const btn = document.getElementById('btnSearchInput');
const icon = document.getElementById('materialMicro');
const searchInput = document.getElementById('searchInput');

// If browser can run Speech Recognition
if ('webkitSpeechRecognition' in window) {
    // Declare webKitSpeechRecognition class
    const recognition = new webkitSpeechRecognition();
    // Define french language
    recognition.lang = 'fr-FR';

    // Use the interim Result
    recognition.continuous = false;
    recognition.interimResults = true;

    // Add event on the material icon 'micro'
    btn.addEventListener("click", function (event) {
        icon.style.color = 'red';
        event.preventDefault();
        // Start recognition
        recognition.start();
    });

    // Recover the transcript results
    recognition.onresult = function (event) {

        // Remove input value
        searchInput.value = '';

        // Recover the index
        let i = event.resultIndex - 1;
        // While i inferior to the results length
        while (++i < event.results.length) {
            // Recovery of parts of transcription
            let transcript = event.results[i][0].transcript;

            if (event.results[i].isFinal) {
                searchInput.value = transcript;
                icon.style.color = 'inherit';

                // Stop recognition
                recognition.stop();
            } else {
                // Add the new transcription with intermediates values
                searchInput.value = (document.getElementById('searchInput').value + transcript);
            }

        }

    }
} else {
    // If SpeechRecognition doesn't work in the browser, so hide him
    document.getElementById('speechBtn').style.display = 'none';
}