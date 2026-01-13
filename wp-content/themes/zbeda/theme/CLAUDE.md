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

## JavaScript Event Listeners - Critical Rules

### ⚠️ NEVER Create Duplicate Event Listeners
**Problem:** Multiple event listeners on the same element cause conflicts and unpredictable behavior.

**What Happened:**
- Mobile menu toggle had TWO event listeners:
  1. One in `js/script.min.js` (toggling `hidden` class)
  2. One in `template-parts/layout/header-content.php` (toggling between `hidden` and `block`)
- Both fired on click, causing conflicts where classes weren't properly removed/added

**Solution:**
- **Single Source of Truth:** Each interactive element should have ONE event listener handler
- **Location:** Keep all header-related JavaScript in `template-parts/layout/header-content.php` (inline script)
- **Removed:** Duplicate code from `js/script.min.js`

**Best Practices:**
1. **Before adding event listeners:** Search the codebase for existing listeners on the same element
2. **Check both:** Inline scripts AND bundled JS files (`js/*.min.js`)
3. **Use `grep`:** Search for element IDs/classes before adding new listeners
4. **Mobile Menu Pattern:** Toggle between `hidden` and `block` classes (not just `hidden`), ensuring element always has explicit display value

**Mobile Menu Implementation:**
```javascript
// Correct pattern - toggle between hidden and block
if (mobileMenu.classList.contains('hidden')) {
    mobileMenu.classList.remove('hidden');
    mobileMenu.classList.add('block');
} else {
    mobileMenu.classList.remove('block');
    mobileMenu.classList.add('hidden');
}
```

**Why This Matters:**
- Tailwind's `hidden` class sets `display: none`
- Removing `hidden` doesn't automatically set a display value
- Element needs explicit `block` or `flex` class to be visible
- Always ensure element has a display class when showing

## About Page Template (`template-about.php`) - Patterns & Rules

### Template Structure
The About page template (`template-about.php`) is a custom page template that displays:
1. **Page Header** - Breadcrumbs + title in `bg-primary` bar
2. **Section 1** - Content left, media right (video/image)
3. **Section 2** - Content right, media left (video/image) 
4. **Team Section** - Grid of team member cards from `team` post type
5. **Values Section** - Three value cards with icons
6. **Contact Section** - Reusable component

### ACF Field Patterns

**Field Retrieval:**
```php
// Get fields at top of section
$section_1_title   = get_field( 'section_1_title' );
$section_1_content = get_field( 'section_1_content' );
$section_1_image   = get_field( 'section_1_image' );
$section_1_video   = get_field( 'section_1_video' );
```

**Field Types:**
- `text` → `esc_html()` for output
- `wysiwyg` → `wp_kses_post()` for HTML content
- `image` → Array with `['url']` and `['alt']` keys
- `video` → Array with `['url']` and `['mime_type']` keys

### Fallback Patterns

**Two Types of Fallbacks:**

1. **Empty Check Fallbacks** (for team contact info):
```php
$contact_email = get_field( 'contact_email' );
if ( empty( $contact_email ) ) {
    $contact_email = 'main@zbeda.com';
}
```

2. **Null Coalescing Fallbacks** (for values section):
```php
$values_section_title = get_field( 'values_section_title' ) ?: 'הערכים שלנו';
$value_1_title = get_field( 'value_1_title' ) ?: 'מקצועיות';
```

**Rule:** Use `empty()` check when you need to validate the value, use `?:` operator for simple default strings.

### Conditional Section Rendering

**Pattern:** Only render section if ANY content exists:
```php
<?php if ( $section_1_content || $section_1_image || $section_1_video ) : ?>
    <!-- Section HTML -->
<?php endif; ?>
```

**Rule:** Check for content OR media, not just content. Sections can be media-only.

### Media Handling Patterns

**Video Priority Over Image:**
```php
<?php if ( $section_1_video ) : ?>
    <video autoplay muted loop playsinline>
        <source src="<?php echo esc_url( $section_1_video['url'] ); ?>" 
                type="<?php echo esc_attr( $section_1_video['mime_type'] ); ?>">
        <?php esc_html_e( 'הדפדפן שלך אינו תומך בתג וידאו.', 'zbeda' ); ?>
    </video>
<?php elseif ( $section_1_image ) : ?>
    <img src="<?php echo esc_url( $section_1_image['url'] ); ?>" 
         alt="<?php echo esc_attr( $section_1_image['alt'] ?: $section_1_title ); ?>">
<?php endif; ?>
```

**Rules:**
- Always use `elseif` - video takes priority
- Video attributes: `autoplay muted loop playsinline` (required)
- Image alt fallback: Use title if alt is empty
- Always escape URLs and attributes

### Layout Patterns - Alternating Media Positions

**Section 1 - Media Right:**
```php
<div class="flex flex-col md:flex-row gap-8 items-center">
    <div class="md:w-1/2"><!-- Content --></div>
    <div class="md:w-1/2"><!-- Media --></div>
</div>
```

**Section 2 - Media Left:**
```php
<div class="flex flex-col md:flex-row-reverse gap-8 items-center">
    <div class="md:w-1/2"><!-- Content --></div>
    <div class="md:w-1/2"><!-- Media --></div>
</div>
```

**Rule:** Use `flex-row-reverse` to flip order, content always comes first in HTML (accessibility).

### WP_Query Patterns for Custom Post Types

**Team Members Query:**
```php
$team_members = new WP_Query(
    array(
        'post_type'      => 'team',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    )
);

if ( $team_members->have_posts() ) :
    while ( $team_members->have_posts() ) :
        $team_members->the_post();
        // Use standard WordPress functions: the_title(), get_field(), etc.
    endwhile;
    wp_reset_postdata();
endif;
```

**Rules:**
- Always use `wp_reset_postdata()` after custom queries
- Use `menu_order` for custom ordering
- Use `-1` for all posts (no pagination needed)
- Check `have_posts()` before rendering

### Team Member Card Patterns

**Contact Info Sanitization:**
```php
// Email - direct use (already validated by ACF)
<a href="mailto:<?php echo esc_attr( $contact_email ); ?>">
    <?php echo esc_html( $contact_email ); ?>
</a>

// Phone - strip non-numeric for tel: link
<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>">
    <?php echo esc_html( $contact_phone ); ?>
</a>
```

**Rules:**
- Email: Use as-is in `mailto:` and display
- Phone: Strip non-numeric chars for `tel:` link, but display original formatted version
- Always escape both URL and display value

### Section Title Pattern

**Consistent Pattern:**
```php
<div class="text-center mb-12">
    <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">
        <?php echo esc_html( $section_title ); ?>
    </h2>
    <div class="w-24 h-1 bg-primary mx-auto"></div>
</div>
```

**Rule:** All section titles use this pattern - title + decorative underline bar.

### Values Section Pattern

**Structure:**
- Background: `bg-secondary` (dark)
- Text: `text-white` with `text-primary` for headings
- Layout: `flex flex-col md:flex-row` with `flex-1` for equal columns
- Icons: Circular `bg-primary` containers with SVG icons

**Rule:** Values section always uses dark background (`bg-secondary`) for contrast.

### RTL Considerations

**Always Add RTL Support:**
```php
<div <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
```

**Rule:** Add `dir="rtl"` to all content containers, especially those with text or lists.

### Reusable Components

**Contact Section:**
```php
<?php get_template_part( 'template-parts/components/contact-section' ); ?>
```

**Rule:** Use `get_template_part()` for reusable sections, not inline includes.