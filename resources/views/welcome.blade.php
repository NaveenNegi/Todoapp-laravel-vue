<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{!! url('css/style.css') !!}">
        <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
        </script>
        <style>
            a{
                cursor: pointer;
            }
            .complete{
                text-decoration: line-through;
            }
        </style>
    </head>
    <body>
        <div class="full-width">
            <div id="app">
                <tasks></tasks>
            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
