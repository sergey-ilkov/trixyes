<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test api final task</title>
</head>
<body>

    <h3>Test api final task</h3>



    <script>
        const base_path = 'http://127.0.0.1:8000';
        const url = `${base_path}/api/v1/callstream/task`;
       

        function sendTask() {

            

            const objSendData = {
                "result": true, // will be false if error occurred
                "message": { // All necessary info about task
                  "type": "task", // Always will be task
                  "id": "8526b440-9dd7-4a21-98e2-5851b09a8e2e", // Task ID
                  "attributes": {
                    "state": "done",
                    "phone": "380XXXXXXXXX", // Customer phone number
                    "call_from_number": "380XXXXXXXXX", // Your external phone number from which was made call
                    "callback_url": "https://your.api.server/api/call_log", // Your callback url where we'll send task info after call ends
                    "ivr_answer": 1, // Will be filled if customer press button, filled if you use first type of Call2FA, in other cause will be null 
                    // "ivr_answer": null, // Will be filled if customer press button, filled if you use first type of Call2FA, in other cause will be null 
                    "is_called": true, // True if system called to customer, in other cause will be false
                    "is_callback_sent": true, // True if system successfully send callback to your usl, False if system 5 times will receive from your server not status 200 on request
                    "is_error_happened": false, // Will be true if error occurred during the call to customer
                    "error_desc": null, // Error description
                    "created_at": "2022-07-26 07:41:15", // When task was created
                    "updated_at": "2022-07-26 07:41:15" // When task was updated
                  }
                },
                "error": null // will be filled if error occurred 
            }
        
            const options = {
                method: 'POST',
                headers: {
                    
                    'Content-Type': 'application/json',
                   
                },
                body: JSON.stringify(objSendData)
            
            
            };
        
        
            fetch(url, options)
                .then(async response => {
                    if (!response.ok) {
                    
                        throw new Error(`HTTP error, status = ${response.status}`);
                    }
                
                    return response;
                })
                .then(result => {
                
                    console.log(result);
                
                
                })
                .catch(error => {
                
                    console.error('Fetch error:', error);
                
                });
        }

        function testUrl(){

            fetch(url)
                .then( async response =>{
                    if (!response.ok) {
                    
                        throw new Error(`HTTP error, status = ${response.status}`);
                    }
                
                    return response;
                })
                .then(result => {
                
                    console.log(result);
                
                
                })
                .catch(error => {
                
                    console.error('Fetch error:', error);
                
                });

        }
        testUrl();
        

    </script>
    
</body>
</html>