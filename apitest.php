<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <p id="response"></p>
    <button onclick="send()">Send</button>

    <script>
        function send() {
            /* fetch('https://wapi.wbbox.in/v2/wamessage/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'apikey': '1aa0a6ca-2ef7-11ef-ad4f-92672d2d0c2d',
                        'Access-Control-Allow-Origin': '*'
                    },
                    body: JSON.stringify({
                        "from": "919133663334",
                        "to": "919515744884",
                        "type": "template",
                        "message": {
                            "templateid": "300849",
                            "url": "https://victoryschools.in/Victory/Images/building.jpg"
                        }
                    }),
                }).then((response) => console.log(response))
                //.then((res) => document.getElementById('response').innerHTML = res)
                .catch((err) => console.log(err)) */
            $.ajax({
                url: 'https://wapi.wbbox.in/v2/wamessage/send',
                type: 'POST',
                data: JSON.stringify({
                    "from": "919133663334",
                    "to": "919515744884",
                    "type": "template",
                    "message": {
                        "templateid": "300849",
                        "url": "https://victoryschools.in/Victory/Images/building.jpg"
                    }
                }),
                contentType: 'application/json',
                headers: {
                    'Content-Type': 'application/json',
                    'apikey': '1aa0a6ca-2ef7-11ef-ad4f-92672d2d0c2d',
                    'Access-Control-Allow-Origin': '*'
                },
                success: function(data) {
                    console.log(data)
                },
                failure: function(err) {
                    console.log(err)
                }
            });
        }
    </script>
</body>

</html>