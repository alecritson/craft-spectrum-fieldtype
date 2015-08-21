# Craft Spectrum FieldType
A Craft fieldtype for the jQuery color picker [Spectrum](https://bgrins.github.io/spectrum/)

![Fieldtype image](http://itsalec.co.uk/assets/spectrum.gif) 


### Installation
Download the repo and copy the `spectrum` folder into your plugins folder, install in the admin area.

Once installed you will have a `Spectrum color picker` fieldtype available to use.


### Configuration
The fieldtype comes with a set of options you can utilise:

- **Show input** - Can a user input their own color code?
- **Show alpha?** - Will add a opacity slider
- **Show palette?** - Will add a palette selection to the side of the spectrum
- **Only show the palette?** - Users will only be able to select from a palette of colors
- **Preferred format** `HEX, HEX3, HSL, RGB, None` - Selecting none will go by whatever is put into the input field, if shown
- **Custom palette** - Add your own custom palette


### Templating
The color value will be whatever you chose as your preferred output in the fields config.

If you have chosen `null` (transparent) as a colour, then you can test against this:

```twig
{% if not entry.color %}
	No color!
{% else %}
	{{ entry.color }}
{% endif %}
```

#### Checking the brightness (experimental)

You can also check if a colour is light, good if you need to swap between light and dark text ( will only work on a hex value)

```twig
{% if entry.color.isLight() %} color:#000; {% else %} color:#fff {% endif %}
```

### Twig extensions
The spectrum has a couple of cool twig filters you can use as well, if you want darken or lighten a color (again these will only work with hex values)

The value is the number of steps between `-255` (to black) and `255` (to white)

```twig
{# Our color is #0090FF #}

{# Accepts a positive number, result is #CDFFFF #}
{% entry.color|lighten(205) %}

{# Accepts a negative number, result is #000032 #}
{% entry.color|darken(205) %}

{# Accepts either a positive or negative number #}
{% entry.color|brightness(155) %}
``` 

That is basically it for now...any issues just open an issue and let me know! This fieldtype is in its infancy so any feature requests just add `[FR]` to the start of a github issue


