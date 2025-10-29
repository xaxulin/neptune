# Neptune TV Theme Documentation

## Table of Contents
1. [Introduction](#introduction)
2. [Installation](#installation)
3. [Theme Structure](#theme-structure)
4. [Customization](#customization)
5. [Template Files](#template-files)
6. [Functions Reference](#functions-reference)
7. [Hooks and Filters](#hooks-and-filters)
8. [Best Practices](#best-practices)

## Introduction

Neptune TV is a modern WordPress theme designed for media and entertainment websites. It features a dark, sleek interface inspired by streaming platforms with full responsive design support.

### Key Features
- Modern dark design with customizable colors
- Fully responsive (mobile, tablet, desktop)
- WordPress Customizer integration
- Multiple widget areas
- Custom navigation menus
- Featured image support
- Comments system
- Search functionality
- Translation ready

## Installation

### Requirements
- WordPress 5.0 or higher
- PHP 7.0 or higher
- MySQL 5.6 or higher

### Steps
1. Download the theme package
2. Navigate to **Appearance > Themes** in WordPress admin
3. Click **Add New** > **Upload Theme**
4. Choose the theme zip file and click **Install Now**
5. Click **Activate** once installation completes

## Theme Structure

```
neptune-tv/
├── assets/
│   ├── css/
│   │   ├── editor-style.css
│   │   └── main.css
│   ├── js/
│   │   └── navigation.js
│   └── images/
├── inc/
│   └── template-tags.php
├── languages/
├── 404.php
├── archive.php
├── comments.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── page.php
├── README.md
├── screenshot.png
├── search.php
├── searchform.php
├── sidebar.php
├── single.php
└── style.css
```

## Customization

### Using the WordPress Customizer

Navigate to **Appearance > Customize** to access customization options:

#### Colors Section
- **Primary Color**: Main accent color (default: #0066ff)
- **Secondary Color**: Secondary accent color (default: #00d4ff)

#### Layout Section
- **Sidebar Position**: Choose left, right, or no sidebar

#### Footer Section
- **Footer Copyright Text**: Custom copyright message

#### Site Identity
- **Logo**: Upload custom logo (recommended: 200x60px)
- **Site Title & Tagline**: Set your site name and description

### CSS Variables

The theme uses CSS custom properties for easy customization:

```css
:root {
    --color-primary: #0066ff;
    --color-secondary: #00d4ff;
    --color-dark: #0a0e27;
    --color-dark-alt: #151932;
    --color-darker: #060818;
    --color-text: #ffffff;
    --color-text-muted: #9ca3af;
    --border-radius: 8px;
}
```

### Widget Areas

The theme provides four widget areas:

1. **Sidebar**: Main sidebar (appears on posts/pages if enabled)
2. **Footer 1**: First footer column
3. **Footer 2**: Second footer column
4. **Footer 3**: Third footer column

Navigate to **Appearance > Widgets** to manage widgets.

### Menus

Configure menus at **Appearance > Menus**:

- **Primary Menu**: Main navigation in header
- **Footer Menu**: Optional footer navigation

## Template Files

### Core Templates

#### index.php
Main template file displaying blog posts in a grid layout.

#### single.php
Template for individual blog posts. Shows full content, featured image, meta information, and comments.

#### page.php
Template for static pages. Displays page content with optional featured image.

#### archive.php
Template for category, tag, author, and date archives. Uses grid layout for posts.

#### search.php
Template for search results pages.

#### 404.php
Error page template with helpful navigation widgets.

### Partial Templates

#### header.php
Site header with navigation and logo.

#### footer.php
Site footer with widget areas and copyright information.

#### sidebar.php
Sidebar template for displaying widgets.

#### comments.php
Comments template for displaying and submitting comments.

#### searchform.php
Custom search form markup.

## Functions Reference

### Theme Setup Functions

#### neptune_tv_setup()
Main theme setup function. Registers theme support for various features.

#### neptune_tv_widgets_init()
Registers widget areas.

#### neptune_tv_scripts()
Enqueues stylesheets and JavaScript files.

### Template Tag Functions

#### neptune_tv_posted_on()
Displays post publication date.

#### neptune_tv_posted_by()
Displays post author with link to author archive.

#### neptune_tv_entry_footer()
Displays post categories, tags, and edit link.

#### neptune_tv_pagination()
Custom pagination function (defined in inc/template-tags.php).

#### neptune_tv_reading_time()
Calculates and returns estimated reading time.

### Customizer Functions

#### neptune_tv_customize_register($wp_customize)
Registers customizer settings and controls.

#### neptune_tv_sanitize_sidebar_position($input)
Sanitizes sidebar position option.

#### neptune_tv_get_custom_colors()
Outputs custom color CSS variables.

## Hooks and Filters

### Actions

- `after_setup_theme`: Theme setup
- `widgets_init`: Register widget areas
- `wp_enqueue_scripts`: Enqueue styles and scripts
- `wp_head`: Add custom colors and pingback header
- `customize_register`: Add customizer options

### Filters

- `excerpt_length`: Set excerpt word count (25 words)
- `excerpt_more`: Set excerpt more text ('...')
- `body_class`: Add custom body classes
- `post_class`: Add custom post classes

## Best Practices

### Performance
- Theme assets are versioned for cache busting
- Minimal JavaScript for fast loading
- Optimized CSS with CSS variables
- Lazy loading support for images

### Accessibility
- Semantic HTML5 markup
- ARIA labels on interactive elements
- Screen reader text for hidden elements
- Keyboard navigation support
- Skip to content link

### SEO
- Clean, semantic markup
- Proper heading hierarchy
- Meta information output
- Schema.org markup ready
- Automatic feed links

### WordPress Standards
- Follows WordPress coding standards
- Proper escaping and sanitization
- Translation ready with text domain
- No deprecated functions
- Proper enqueueing of assets

### Development

#### Child Theme
To create a child theme:

1. Create a new directory: `neptune-tv-child`
2. Create `style.css`:
```css
/*
Theme Name: Neptune TV Child
Template: neptune-tv
*/
```
3. Create `functions.php`:
```php
<?php
function neptune_tv_child_enqueue_styles() {
    wp_enqueue_style('neptune-tv-parent', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'neptune_tv_child_enqueue_styles');
```

#### Custom Templates
To create custom page templates, add to child theme:

```php
<?php
/*
Template Name: Custom Template
*/
get_header();
// Your custom code
get_footer();
```

## Troubleshooting

### Common Issues

**Theme doesn't display correctly**
- Clear browser cache
- Regenerate thumbnails
- Check for plugin conflicts

**Customizer changes don't save**
- Check file permissions
- Increase PHP memory limit
- Disable conflicting plugins

**Menu doesn't work on mobile**
- Clear cache
- Check JavaScript console for errors
- Ensure no plugin conflicts

## Support

For theme support and updates:
- Visit theme documentation
- Check WordPress.org forums
- Contact theme author

## Changelog

### Version 1.0.0 (2024)
- Initial release
- Dark theme design
- Responsive layout
- Customizer integration
- Multiple widget areas
- Custom menus
- Full template set

## Credits

Neptune TV theme developed by the Neptune Team.
Based on WordPress theme development best practices.

## License

Neptune TV WordPress Theme
Copyright 2024

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
