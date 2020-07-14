<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Tailwind CSS -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <title>Technical Test</title>
</head>
<body>
    <div class="p-2">
        <form id="search">
            <div class="flex items-center border-b border-b-2 border-blue-500 py-2">
                <input name="q" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Search by location or invoice status" aria-label="Invoices">
                <button class="flex-shrink-0 bg-blue-500 hover:bg-blue-800 border-blue-500 hover:border-blue-800 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                    Search
                </button>
            </div>
        </form>
    </div>

    <div id="invoices" class="p-2 flex flex-wrap"></div>

    <div class="p-2">
        <form id="sum">
            <div class="flex items-center border-b border-b-2 border-blue-500 py-2">
                <input name="q" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Location ID" aria-label="Location">
                <button class="flex-shrink-0 bg-blue-500 hover:bg-blue-800 border-blue-500 hover:border-blue-800 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                    Total
                </button>
            </div>
        </form>
    </div>

    <div id="totalByStatus" class="p-2 flex flex-wrap"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $( document ).ready(function() {

            $( '#search' ).submit(function(e) {
                e.preventDefault();
                e.stopPropagation();

                $.get( '/api/invoices/search?' + $( '#search' ).serialize())
                    .done(function( invoices ) {
                        invoices = invoices.data
                        var invoiceHTML = '';
                        for(var i = 0; i < invoices.length; i++) {
                            var invoice = invoices[i];

                            var created_at = invoice.created_at.substr(8, 2) + '/' + invoice.created_at.substr(5, 2) + '/'  + invoice.created_at.substr(0, 4);

                            invoiceHTML += '<div class="max-w-1/3 m-4 rounded overflow-hidden shadow-lg">';
                            invoiceHTML += '<div class="px-6 py-4">';
                            invoiceHTML += '<div class="font-bold text-xl mb-2">Invoice #' + invoice.id +  '</div>';
                            invoiceHTML += '<p>Location: ' + invoice.location.name + '</p>';
                            invoiceHTML += '<p>Created At: ' + created_at + '</p>';
                            invoiceHTML += '<p>Status: ' + invoice.status + '</p>';
                            invoiceHTML += '<p>Total: £' + parseFloat(invoice.total).toFixed(2) + '</p>';
                            invoiceHTML += '</div>';
                            invoiceHTML += '</div>';
                        };

                        $( "#invoices" ).empty().append( invoiceHTML );
                    });
            });

            $( '#sum' ).submit(function(e) {
                e.preventDefault();
                e.stopPropagation();

                $.get( '/api/locations/total-by-status?' + $( '#sum' ).serialize())
                    .done(function( totalByStatus ) {
                        totalByStatus = totalByStatus.data
                        var totalByStatusHTML = '';

                        for(var i = 0; i < totalByStatus.length; i++) {
                            var invoices = totalByStatus[i];

                            totalByStatusHTML += '<div class="max-w-1/3 m-4 rounded overflow-hidden shadow-lg">';
                            totalByStatusHTML += '<div class="px-6 py-4">';
                            totalByStatusHTML += '<p>Location: ' + invoices.name + '</p>';
                            totalByStatusHTML += '<p>Status: ' + invoices.status + '</p>';
                            totalByStatusHTML += '<p>Total: £' + parseFloat(invoices.total).toFixed(2) + '</p>';
                            totalByStatusHTML += '</div>';
                            totalByStatusHTML += '</div>';
                        }

                        $( "#totalByStatus" ).empty().append( totalByStatusHTML );
                    });
            });
        });
    </script>
</body>
</html>
