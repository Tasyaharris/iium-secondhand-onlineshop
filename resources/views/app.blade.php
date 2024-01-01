<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

       <title>Test Auth</title>

    </head>
    <body >
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            
         function getCookie(name){
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) {
            return parts.pop().split(';').shift();
        }
    }

    function request(url, options){
        // get cookie
        const csrfToken = getCookie('XSRF-TOKEN');
        return fetch(url, {
            headers: {
                'content-type': 'application/json',
                'accept': 'application/json',
                'X-XSRF-TOKEN': decodeURIComponent(csrfToken),
            },
            credentials: 'include',
            ...options,
        })
    }

    function logout(){
        return request('/logout', {
            method: 'POST'
        });
    }

    function login(){
        return request('/login', {
            method: "POST",
            body: JSON.stringify({
                email: 'luz72@example.net',
                'password': 'password'
            })
        })
    }

     
            axios.get('/sanctum/csrf-cookie',{ header: {
                    'content-type': 'application/json',
                    'accept': 'application/json'
                },
                credentials : 'include'
            }).then(response => {
                // Login...
            }).then(() => request('/api/v1/users'))

        </script>
    </body>
</html>
