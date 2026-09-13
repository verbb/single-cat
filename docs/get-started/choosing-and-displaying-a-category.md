# Choosing and Displaying a Category

Single Cat lets an editor choose one category from a dropdown. For example, a News entry can have a Topic such as Company News or Product Updates, without opening an element-selection dialog.

## Create the Field

Create a category group for your topics and add a few categories to it. In **Settings → Fields**, create a field named **Topic** with the handle `topic`, choose **Single Category**, and select that category group as its source. Add the field to the field layout used by your News entries.

Open a News entry, choose a topic and save it. Reopen the entry to check that the selected category was retained. If you allow a blank option, editors can leave the field without a category.

## Display the Selection

The field returns a category query. In the entry's Twig template, call `.one()` to obtain the selected category before accessing its title or URL:

```twig
{% set topic = entry.topic.one() %}

{% if topic %}
    {% if topic.url %}
        <a href="{{ topic.url }}">{{ topic.title }}</a>
    {% else %}
        <span>{{ topic.title }}</span>
    {% endif %}
{% endif %}
```

This example assumes the template has an `entry` variable and the field handle is `topic`. A category only has a URL when its group is configured to provide one; the plain-text branch handles categories used only for classification.

View the entry on your site and check that its topic appears. Then clear the selection and confirm the template still renders. The empty check is necessary even when editors normally select a category, because existing content may not have a value.
