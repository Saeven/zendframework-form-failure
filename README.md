In hardening forms against malformed input, we quickly discover that malformed input can cause the server to throw a 500.

* An InputFilter can readily sanitize the bad input, it unfortunately doesn't help
* A Validator can reject the value as invalid, but the initial input still gets printed when you render the form in its failed state (typically with all your error messages).

To use this test case, you can use a tool like Echo or Postman to send this post:

```
Content-Type: application/x-www-form-urlencoded
Accept-Encoding: gzip
```

With POST body:

```
axis=12345'"\'\");|]*%00{%0d%0a<%00>%bf%27'ð©
```

to 

```
/
```

You'll see that the filter and validator are called, but your server throws a 500 when it attempts to escape the bad input.

#### Zend\Escaper

The actual failure ultimately occurs in Zend\Escaper\Escaper.  An sprintf in toUtf8 is used when it correctly detects that the input is bad. A 
possible fix to preventing 500 dumps on bad input would be to silence escaping errors within \Zend\Form\View\Helper\AbstractHelper.  The form would 
silently omit attack vectors during bad input trials.


    /**
     * Create a string of all attribute/value pairs
     *
     * Escapes all attribute values
     *
     * @param  array $attributes
     * @return string
     */
    public function createAttributesString(array $attributes)
    {
        $attributes = $this->prepareAttributes($attributes);
        $escape     = $this->getEscapeHtmlHelper();
        $escapeAttr = $this->getEscapeHtmlAttrHelper();
        $strings    = [];

        foreach ($attributes as $key => $value) {
            $key = strtolower($key);

            if (! $value && isset($this->booleanAttributes[$key])) {
                // Skip boolean attributes that expect empty string as false value
                if ('' === $this->booleanAttributes[$key]['off']) {
                    continue;
                }
            }

            //check if attribute is translatable and translate it
            $value = $this->translateHtmlAttributeValue($key, $value);

            //@TODO Escape event attributes like AbstractHtmlElement view helper does in htmlAttribs ??
            try {
                $strings[] = sprintf('%s="%s"', $escape($key), $escapeAttr($value));
            }
            catch( Exception\RuntimeException $x ){
                
            }
        }

        return implode(' ', $strings);
    }


