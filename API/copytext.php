<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copy Div Content</title>
</head>
<body>

    <div id="contentToCopy">
        <h1>This is a heading</h1>
        <p>This is some text within a div. <strong>Bold text</strong> and <em>italic text</em>.</p>
        <img src="https://via.placeholder.com/150" alt="Placeholder Image">
    </div>

    <button onclick="copyDivContent()">Copy Div Content</button>

    <script>
        function copyDivContent() {
            // Get the div content
            const content = document.getElementById('contentToCopy');

            // Create a range object
            const range = document.createRange();
            range.selectNode(content);

            // Clear any existing selections
            window.getSelection().removeAllRanges();
            // Add the range to the selection
            window.getSelection().addRange(range);

            try {
                // Execute the copy command
                document.execCommand('copy');
                alert('Content copied!');
            } catch (err) {
                alert('Failed to copy content.');
            }

            // Clear the selection
            window.getSelection().removeAllRanges();
        }
    </script>

</body>
</html>
