<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

</head>
<script>
    //Onclick Export to PDF
    function exportUserTablePdf() {
        // Fetch staff data from the server
        $.ajax({
            url: 'php_action/fetchStaffToPdf.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Staff data fetched successfully
                    const staffData = data.staff;

                    // Define the document definition for PDF
                    const docDefinition = {
                        content: [{
                                text: 'Staff Report',
                                style: 'header'
                            },
                            {
                                text: '\n'
                            },
                            {
                                table: {
                                    headerRows: 1,
                                    widths: ['*', '*', '*', '*'],
                                    body: [
                                        ['ID', 'Name', 'Email', 'Phone'],
                                        ...staffData.map(staff => [staff.id, staff.name, staff.email, staff.phone])
                                    ]
                                }
                            }
                        ],
                        styles: {
                            header: {
                                fontSize: 18,
                                bold: true,
                                alignment: 'center'
                            }
                        }
                    };

                    // Generate the PDF using pdfmake
                    pdfMake.createPdf(docDefinition).download('staff.pdf');
                } else {
                    // Error fetching staff data
                    console.log('Failed to fetch staff data:', data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }
</script>

<body>
    <button type="button" class="mt-2 mb-3 btn btn-secondary" id="userExportPdfBtn" onclick="exportUserTablePdf()">Export to PDF</button>
</body>


</html>