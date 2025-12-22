# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview
This is the "zbeda" WordPress theme, built on the _tw (Underscore + Tailwind) framework. It's a custom theme for showcasing subsidiary companies with multilanguage (RTL/LTR) support.

## Tech Stack
- WordPress theme development
- PHP
- Tailwind CSS v4
- JavaScript (bundled with esbuild)
- Advanced Custom Fields (ACF) for custom post types and fields
- Swiper.js for mobile carousels

## Development Commands

### Build and Watch
```bash
# Initial build (run after fresh install)
npm install && npm run dev

# Development with file watching
npm run watch

# Production build
npm run production
# or
npm run prod

# Create deployable zip file
npm run bundle
```

### Individual Build Tasks
```bash
# Build frontend CSS
npm run development:tailwind:frontend

# Build editor CSS
npm run development:tailwind:editor

# Build JavaScript
npm run development:esbuild
```

### Linting
```bash
# Check code quality
npm run lint

# Auto-fix linting issues
npm run lint-fix
```

## Code Architecture

### Theme Structure
- **`/theme/`** - Main WordPress theme files
  - **`functions.php`** - Theme setup, enqueuing scripts/styles, hooks
  - **`inc/`** - Modular PHP includes
    - `template-tags.php` - Template helper functions
    - `template-functions.php` - WordPress filters and hooks
    - `post-types.php` - Custom post type definitions (currently minimal)
  - **`template-parts/`** - Reusable template components
  - **`acf-json/`** - ACF field group and post type definitions (JSON sync)
  - **`single-subsidiary.php`** - Single subsidiary post template
  - **`archive-subsidiary.php`** - Subsidiary archive listing template

### Tailwind Configuration
- **`/tailwind.css`** - Main entry point for CSS compilation
- **`/tailwind/tailwind-theme.css`** - Custom design tokens and theme variables
- **`/tailwind/custom/`** - Custom CSS organized by type:
  - `base.css` - Base styles
  - `components/` - Component styles (imported via glob)
  - `utilities.css` - Custom utility classes
  - `fonts.css` - Font-face declarations

### Theme Color System
The theme uses CSS custom properties from WordPress theme.json, accessed via Tailwind:
- `bg-primary` / `text-primary` - Primary brand color (amber/yellow)
- `bg-secondary` / `text-secondary` - Secondary brand color (dark/text)
- `bg-tertiary` / `text-tertiary` - Tertiary color

**Important:** Always use theme color variables (`bg-primary`, `text-secondary`, etc.) instead of hardcoded colors like `bg-gray-900` or `text-amber-400`.

### Custom Post Type: Subsidiary
Registered via ACF JSON (`acf-json/post_type_6948283e5dfac.json`). Key settings:
- Post type slug: `subsidiary`
- Archive enabled: `true`
- Archive slug: `subsidiary`

**Custom Fields** (defined in `acf-json/group_6948e43603f15.json`):
- `logo` - Image URL (not array) for company logo
- `brand_website` - Company website URL
- `grid_top_left`, `grid_top_right`, `grid_bottom_left`, `grid_bottom_right` - WYSIWYG content for 2x2 grid
- `grid_top_left_image`, `grid_bottom_right_image` - Background images for grid sections

### RTL/LTR Multilanguage Support
The theme is built for WPML with dynamic RTL/LTR support:
- Use `is_rtl()` to conditionally set `dir="rtl"` on containers
- Text strings use `__()`, `_e()`, `esc_html_e()` for translation readiness
- Grid and carousel slide order adapts based on text direction
- Icons and arrows rotate 180° in RTL mode

### Subsidiary Single Page Layout
1. **Header** - Yellow bar with breadcrumbs, page title, and logo
2. **Content Section** - Post content alongside featured image (60/40 split)
3. **Grid Section** - 2x2 grid on desktop, Swiper carousel on mobile:
   - Desktop: Full grid with background images on diagonal cells (top-left, bottom-right)
   - Mobile: Horizontal carousel at 70vh height
   - Styling: `bg-secondary` with `text-white`, h2 elements use `text-primary`

### JavaScript Bundling
- Entry points: `javascript/script.js`, `javascript/block-editor.js`
- Bundler: esbuild (fast, minimal configuration)
- Output: `theme/js/*.min.js`

## Code Style

### WordPress Standards
- Follow WordPress Coding Standards for PHP
- Use `zbeda_` prefix for all custom functions
- Escape all output: `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()`
- Sanitize all input data
- Use WordPress functions over PHP equivalents

### Tailwind Usage
- **IMPORTANT:** Use Tailwind utility classes exclusively for styling (no inline styles or separate CSS files for components)
- Use theme color variables consistently
- Responsive design: mobile-first with `md:` and `lg:` breakpoints
- Typography: Tailwind Typography classes defined in `ZBEDA_TYPOGRAPHY_CLASSES` constant

### Translation Ready
- All user-facing strings must use WordPress i18n functions
- Text domain: `'zbeda'`
- Example: `<?php esc_html_e( 'Read More', 'zbeda' ); ?>`

## Important Patterns

### ACF Field Management
Custom fields and post types are managed through ACF's UI and stored in JSON files under `theme/acf-json/`. Do not programmatically register ACF fields unless specifically requested.

### Permalink Flushing
After modifying custom post type settings (especially `has_archive`), permalinks must be flushed:
1. Go to Settings > Permalinks in WordPress admin
2. Click Save Changes (no changes needed)

### Swiper Integration
Swiper is conditionally enqueued only on subsidiary single pages:
```php
if ( is_singular( 'subsidiary' ) ) {
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css' );
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js' );
}
```

### RTL-Aware Layouts
Grid cells and carousel slides render in different orders for RTL vs LTR:
- **LTR**: top-left → top-right → bottom-left → bottom-right
- **RTL**: top-right → top-left → bottom-right → bottom-left

This ensures proper visual flow for different reading directions.
