<!DOCTYPE html>
<html lang="en">
<head>

    <script type = "module" src="{{ mix('resources/js/app.js') }}" defer></script>
</head>
<body>
    <!-- Your HTML content -->

    <!-- Mount the React component -->
    <div id="example"></div>
    
    <script>
        // Mount the React component
        import React from 'react';
        import ReactDOM from 'react-dom';
        import ExampleComponent from './components/ExampleComponent';

        ReactDOM.render(<ExampleComponent />, document.getElementById('example'));
    </script>
</body>
</html>
