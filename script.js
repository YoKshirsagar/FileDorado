document.addEventListener('DOMContentLoaded', () => {
    // Load the file list when the page loads
    loadFileList();

    // Function to fetch and display the file list
    function loadFileList() {
        fetch('files.php')
            .then(response => response.json())
            .then(files => {
                // Check if there was an error in the response
                if (files.error) {
                    console.error(files.error);
                    return;
                }

                const fileList = document.getElementById('fileList');
                fileList.innerHTML = ''; // Clear the existing list

                // If files are present
                if (files.length > 0) {
                    files.forEach(file => {
                        const li = document.createElement('li');
                        li.textContent = file;

                        const downloadLink = document.createElement('a');
                        downloadLink.href = `download.php?file=${file}`;
                        downloadLink.textContent = ' (Download)';
                        li.appendChild(downloadLink);

                        fileList.appendChild(li);
                    });
                } else {
                    fileList.innerHTML = '<li>No files found.</li>';
                }
            })
            .catch(error => {
                console.error('Error fetching file list:', error);
            });
    }
});
