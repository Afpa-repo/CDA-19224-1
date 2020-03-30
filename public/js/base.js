/***** MATERIALIZE *****/

// NavBar
document.addEventListener('DOMContentLoaded', function() {
    let elems = document.querySelectorAll('.sidenav');
    let instances = M.Sidenav.init(elems);
});

/***** INDEX *****/
//
const btn = document.getElementById('btnSearchInput');

// If browser can run Speech Recognition
if ('webkitSpeechRecognition' in window)
{
    // Declare webKitSpeechRecognition class
    let recognition = new webkitSpeechRecognition();
    // Define french language
    recognition.lang = 'fr-FR';

    // Use the interim Result
    recognition.continuous = false;
    recognition.interimResults = true;

    // Add event on the material icon 'micro'
    btn.addEventListener("click", function (event) {
        event.preventDefault();
        // Start recognition
        recognition.start();
    });

    // Recover the transcript results
    recognition.onresult = function (event){

        // Remove input value
        document.getElementById('searchInput').value = '';

        // Recover the index
        let i = event.resultIndex - 1;
        // While i inferior to the results length
        while (++i < event.results.length)
        {
            // Recovery of parts of transcription
            let transcript = event.results[i][0].transcript;
            // Add the new transcription with intermediates values
            document.getElementById('searchInput').value = (document.getElementById('searchInput').value + transcript);
        }

    }
    // Stop recognition
    recognition.stop();
}
else
{
    // If SpeechRecognition doesn't work in the browser, so hide him
    document.getElementById('speechBtn').style.display = 'none';
}