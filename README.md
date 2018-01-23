In hardening forms against malformed input, we quickly discover that malformed input can cause the server to throw a 500.

An InputFilter can readily sanitize the bad input, it unfortunately doesn't help
you when you render the form in its failed state (typically with all your error messages).

To use this test case, you can use a tool like Echo or Postman to send this post:

```
Content-Type: application/x-www-form-urlencoded
Accept-Encoding: gzip
```

With POST body:

```
axis=12345'"\'\");|]*%00{%0d%0a<%00>%bf%27'ð©&csrf=4a37b6c4d24427c97c87fcaa5e851e2a-af6e275e332d20816424aca3da73bf34&email=sample%40email.tst&password=g00dPa%24%24w0rD
```

to /

You'll see that the filter is called, but your server throws a 500.

Any call to `$form->get('axis')->getValue()` used after the filter is run, attempts to print the data precisely as it was posted in its attack vector.