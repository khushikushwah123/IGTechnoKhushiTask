<h2>Leave this Page</h2>
<p>Redirects you to the actual URL : {{ $generate_url->url }}</p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    setTimeout(() => {
        window.location = "{{ url($generate_url->url) }}"
    }, 3000);
</script>
