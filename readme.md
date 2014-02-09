WP Enqueue Deferred Style
=======================

A WordPress plugin to defer CSS to the footer.

Functions
---------

### wp_register_deferred_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all')

### wp_enqueue_deffered_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all')

Use
---

### Add a deferred style

```php
wp_enqueue_deferred_style('deferred-style', 'http://www.site.com/path/to/style/deferred-style.css', array(), '1.0', 'all');
```

### Register a deferred style to be enqueued later

```php
wp_register_deferred_style('deferred-style', 'http://www.site.com/path/to/style/deferred-style.css', array(), '1.0', 'all');
```

### Register an existing style as deferred

```php
wp_register_deferred_style('existing-style');
```
