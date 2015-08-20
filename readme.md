# Craft Spectrum FieldType
A Craft fieldtype for the jQuery color picker [Spectrum](https://bgrins.github.io/spectrum/)

### Installation
Download the repo and copy the `spectrum` folder into your plugins folder, install in the admin area.

Once installed you will have a `Spectrum color picker` fieldtype available to use.

### Templating
The value will be the HEX code representing the color chosen in the entry edit page, there is a `X` button which you can select to choose no color.

So:

```twig
{% if not entry.color %}
	No color!
{% else %}
	{{ entry.color }}
{% endif %}
```

That is basically it for now...any issues just open an issue and let me know! This fieldtype is in its infancy so any feature requests just add `[FR]` to the start of a github issue
