# Project Rules

## Overview
This is the "zbeda" WordPress theme.

## Tech Stack
- WordPress theme development
- PHP
- JavaScript
- CSS/SCSS

## Code Style
- Follow WordPress Coding Standards for PHP
- Use meaningful function prefixes (e.g., `zbeda_`)
- Escape all output with appropriate WordPress functions (`esc_html`, `esc_attr`, `esc_url`, etc.)
- Sanitize all input data
- Use WordPress hooks and filters appropriately

## File Structure
- `style.css` - Main theme stylesheet with theme header
- `functions.php` - Theme functions and hooks
- `index.php` - Main template fallback
- `template-parts/` - Reusable template components
- `assets/` - CSS, JS, and images

## Security
- Never trust user input
- Always escape output
- Use nonces for form submissions
- Use `$wpdb->prepare()` for database queries

## WordPress Best Practices
- Use `wp_enqueue_script()` and `wp_enqueue_style()` for assets
- Prefer WordPress functions over raw PHP equivalents
- Support internationalization with `__()` and `_e()` functions
- Follow template hierarchy conventions

##STYLING
- **IMPORTANT** Use tailwind for the css/styling