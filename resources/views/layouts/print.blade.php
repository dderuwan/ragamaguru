<!DOCTYPE html>
<html>
<head>
    <title>Print Frame</title>
</head>
<body>
    <iframe id="print-frame" style="display:none;"></iframe>

    <script>
        function printAppointment(appointmentId) {
            const iframe = document.getElementById('print-frame');
            iframe.src = `/appointments/print-preview/${appointmentId}`;
            
            iframe.onload = function() {
                iframe.contentWindow.print();
                setTimeout(() => {
                    iframe.contentWindow.close();
                }, 1000); // Adjust delay as needed
            };
        }

        // Automatically trigger printAppointment function if appointmentId is available
        // For example, you might pass appointmentId from a Blade template or from URL params
        const appointmentId = {{ $appointmentId ?? 'null' }};
        if (appointmentId !== null) {
            printAppointment(appointmentId);
        }
    </script>
</body>
</html>
