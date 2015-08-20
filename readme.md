# Craft Spectrum FieldType
A Craft fieldtype for the jQuery color picker [Spectrum](https://bgrins.github.io/spectrum/)

![Fieldtype image](http://itsalec.co.uk/assets/spectrum.gif) 


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

### Configuration
The fieldtype comes with a set of options you can utilise:

- **Show input** - Can a user input their own color code?
- **Show alpha?** - Will add a opacity slider
- **Show palette?** - Will add a palette selection to the side of the spectrum
- **Only show the palette?** - Users will only be able to select from a palette of colors
- **Preferred format** `HEX, HEX3, HSL, RGB, None` - Selecting none will go by whatever is put into the input field, if shown
- **Custom palette** - Add your own custom palette
