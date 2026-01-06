# Brands Grid Component Documentation

## Overview
The Brands Grid component is a reusable template part that displays a responsive grid of brand logos. It uses a CSS Grid layout (no carousel) and automatically handles data sources from ACF fields or WP_Query.

## File Location
`theme/template-parts/components/grid-brands.php`

## Usage

### Basic Usage
```php
<?php get_template_part( 'template-parts/components/grid-brands' ); ?>
```

### Where It's Currently Used
- **Home Page**: `template-home.php` (with section title in parent template)
- **Single Subsidiary**: `single-subsidiary.php` (with section title in parent template)
- **Single Solution**: `single-solution.php` (with section title in parent template)

## Data Source Logic

The component intelligently handles different data sources:

### Priority 1: ACF Field
- Checks for ACF field `brands` (Post Object or Relationship field)
- Used for solution and subsidiary posts
- Returns array of brand post IDs or objects

### Priority 2: WP_Query Fallback
- If no ACF field exists, queries all brands using WP_Query
- Used for homepage (where no ACF field is set)
- Queries all brands ordered by `menu_order` ASC
- Converts results to array of brand IDs

### Data Normalization
- Handles both post objects and IDs
- Normalizes to array of brand IDs
- Filters out empty values

## Filtering

### Thumbnail Filter
- Only displays brands that have featured images
- Uses `get_the_post_thumbnail_url( $brand_id, 'medium' )` to check
- Brands without thumbnails are excluded from display

### Conditional Display
- Component only renders if brands with images exist
- Uses `if ( ! empty( $brands_with_images ) )` check

## Grid Layout

### Responsive Columns
- **Mobile** (default): 2 columns (`grid-cols-2`)
- **Tablet** (md breakpoint): 3 columns (`md:grid-cols-3`)
- **Desktop** (lg breakpoint): 4 columns (`lg:grid-cols-4`)
- **Large Desktop** (xl breakpoint): 6 columns (`xl:grid-cols-6`)
- **Gap**: 4 units mobile (`gap-4`), 6 units tablet+ (`md:gap-6`)

## Card Structure

Each brand card includes:

### Container
- **Wrapper**: `flex items-center justify-center` (centers logo)
- **Link**: Wraps entire card, links to brand post
- **Card**: `bg-white p-4 rounded-full aspect-square`
- **Hover**: `hover:shadow-lg transition-shadow duration-300`

### Logo Image
- **Size**: `w-full h-full object-contain`
- **Aspect**: Square (`aspect-square`)
- **Image Source**: Featured image (`medium` size)
- **Alt Text**: Brand title

## Styling

### Component Structure
- **Container**: `container mx-auto px-4` (in component)
- **Wrapper**: Left to parent template (includes `bg-gray-100 py-16` and title)
- **Title**: Left to parent template (component doesn't include title)

### Card Styling
- **Background**: White (`bg-white`)
- **Padding**: 4 units (`p-4`)
- **Shape**: Rounded full (`rounded-full`)
- **Aspect Ratio**: Square (`aspect-square`)
- **Hover Effect**: Shadow on hover (`hover:shadow-lg`)

## Required ACF Fields (Optional)

| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| `brands` | Post Object or Relationship | No | Array of brand post IDs. Only used if field exists (for solution/subsidiary posts). Homepage doesn't need this field. |

## RTL/LTR Support

- Grid direction set via `dir="rtl"` attribute when RTL is active
- Text direction handled automatically by WordPress
- Layout adapts correctly for both directions

## Technical Implementation

### Query Reset
When using WP_Query fallback, component properly resets post data using `wp_reset_postdata()` to prevent conflicts with main loop.

### Self-Contained
- No parameters needed
- Fetches its own data
- Includes all necessary HTML structure
- Handles empty state internally

### Performance
- Efficient data source detection
- Only queries when needed (fallback only)
- Filters brands before rendering
- No unnecessary database calls

## Customization

### Changing Grid Columns
Modify the grid classes in the component:
```php
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 md:gap-6">
```

### Changing Card Styling
Modify classes in the component:
- Card wrapper classes
- Padding classes
- Hover effect classes
- Image sizing classes

### Changing Gap Sizes
Modify gap classes:
- Mobile: `gap-4`
- Tablet+: `md:gap-6`

## Dependencies

- **ACF Plugin**: Required for `brands` field and `get_field()` function (optional - only if using ACF)
- **WordPress**: Standard WordPress functions
- **Tailwind CSS**: Required for all styling classes

## Browser Support

- Modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile browsers (iOS Safari, Chrome Mobile)
- RTL language support (Hebrew, Arabic, etc.)

## Troubleshooting

### Component Not Displaying
1. Check that brands exist in database
2. Verify brands have featured images
3. Check that `brand` post type is registered
4. Verify ACF plugin is active (if using ACF field)
5. Check WordPress debug log for errors

### Brands Not Showing
1. Verify brands have thumbnails
2. Check that `get_the_post_thumbnail_url()` returns valid URLs
3. Verify brand posts are published
4. Check image sizes are correct

### Grid Not Styling Correctly
1. Verify Tailwind CSS is compiled
2. Check that custom classes exist in compiled CSS
3. Verify container classes are correct

## Related Files

- `.cursorrules` - Project rules and documentation
- `template-home.php` - Home page template using this component
- `single-subsidiary.php` - Single subsidiary template using this component
- `single-solution.php` - Single solution template using this component
- `grid-section.php` - Similar reusable component pattern
- `grid-subsidiaries.php` - Similar reusable component pattern

## Differences from Previous Carousel Implementation

### Removed
- Swiper carousel functionality
- Carousel navigation arrows
- Autoplay functionality
- Loop functionality
- Multiple carousel rows
- Carousel-specific JavaScript

### Added
- CSS Grid layout
- Responsive column system
- Simpler, cleaner structure
- Better performance (no JavaScript needed)

## Future Enhancements

Potential improvements:
- Add lazy loading for images
- Add animation/transition effects
- Add more customization options via filters
- Add accessibility improvements (ARIA labels)
- Add loading states

---

**Last Updated**: 2025-01-XX
**Component Version**: 1.0
**Author**: Theme Development Team

