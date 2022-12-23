<!-- MVP.css quickstart template: https://github.com/andybrewer/mvp/ -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="https://via.placeholder.com/70x70/FF0000/FFFFFF?Text=S">
    <link rel="stylesheet" href="https://unpkg.com/mvp.css@1.12/mvp.css">

    <meta charset="utf-8">
    <meta name="description" content="My description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Experiment set cookies cross domain</title>
</head>

<body>
    <header>
        <h1>Experiment set cookies cross domain</h1>
        <br>

        <p>
          <label>Backend Base Url: </label>
          <input type="text" id="base_url_input" onchange="update_base_url()">
        </p>

        <p>
           <button type="button" onclick="try_get_cookies()">Get Cookies</button>
           <button type="button" onclick="try_set_cookies()">Set Cookies</button>
           <button type="button" onclick="try_set_cookies_and_redirect()">Set Cookies & Redirect Back</button>
        </p>

        <p>
          <pre id="display_result" style="max-width: 80%;text-align:left;background:#eee"></pre>
        </p>
    </header>

    <script>
        var base_url = localStorage.getItem('base_url') 
        ? localStorage.getItem('base_url')
        : 'https://experiment-cookies-be.example.com'; // endpoint local

        var display_result = document.querySelector('#display_result')
        var base_url_input = document.querySelector('#base_url_input')
        var set_cookies_and_redirect_url = null

        base_url_input.value = base_url

        function update_base_url() {
          base_url = base_url_input.value
          set_cookies_and_redirect_url = base_url + '/set_cookies_and_redirect?redirect_url=' + window.location

          localStorage.setItem('base_url', base_url)
        }
    
        async function fetch_with_cookie(url) {
            try {
              const r = await fetch(url, {
                // method: 'POST',
                headers: {
                    'content-type': 'application/json'
                },
                /* setting ini dibutuhkan agar cookie ikut dikirimkan ke 
                BE via AJAX. kalau menggunakan apollo client ada setting 
                sejenis juga.
                referensi: 
                - menggunakan fetch: https://stackoverflow.com/a/38935838
                - menggunakan apollo client: https://www.apollographql.com/docs/react/networking/authentication/#cookie
                */
                credentials: 'include',
              })
              const data = await r.json()
              return JSON.stringify(data, undefined, 4)
            } catch (e) {
              return e
            }
        }

        async function try_get_cookies() {
          display_result.textContent = 'loading...'
          const text = await fetch_with_cookie(base_url + '/get_cookies')

          console.log(text)
          display_result.textContent = text
        }

        async function try_set_cookies() {
          const text = await fetch_with_cookie(base_url + '/set_cookies')

          display_result.textContent = text
        }

        function try_set_cookies_and_redirect() {
          window.location = set_cookies_and_redirect_url
        }

        update_base_url()
        try_get_cookies()
      </script>
</body>

</html>
