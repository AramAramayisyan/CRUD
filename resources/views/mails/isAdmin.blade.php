<!DOCTYPE html>
<html>
    <head>
        <title>Product Deleted</title>
    </head>
    <body>
        <h1>Dear {{ $request['name'] }},</h1>
        <p>Your product {{ $request['productName'] }} has been deleted from {{ $request['nameFrom'] }}.</p>
    </body>
</html>
