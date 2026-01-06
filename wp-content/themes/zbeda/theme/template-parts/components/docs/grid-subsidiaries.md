# Subsidiaries Grid Component Documentation

## Overview
The Subsidiaries Grid component is a reusable template part that displays a responsive grid of subsidiary post cards. It always shows all subsidiaries ordered by menu_order, with no pagination.

## File Location
`theme/template-parts/components/grid-subsidiaries.php`

## Usage

### Basic Usage
```php
<?php get_template_part( 'template-parts/components/grid-subsidiaries' ); ?>
```

### Where It's Currently Used
- **Home Page**: `template-home.php` (with section title in parent template)
- **Subsidiary Archive**: `archive-subsidiary.php`

## Behavior

### Query
- Uses custom `WP_Query` to fetch all subsidiaries
- Post type: `subsidiary`
- Posts per page: `-1` (all posts)
- Order by: `menu_order`
- Order: `ASC` (ascending)
- No pagination - always displays all subsidiaries

### Grid Layout

#### Responsive Columns
- **Mobile** (default): 1 column (`grid-cols-1`)
- **Tablet** (md breakpoint, default): 2 columns (`md:grid-cols-2`)
- **Desktop** (lg breakpoint, default): 4 columns (`lg:grid-cols-4`)
- **Gap**: 8 units (`gap-8`)

#### Customization
Grid columns can be customized using WordPress filters:

```php
// Change mobile columns to 2
add_filter( 'grid_subsidiaries_mobile_cols', function() {
    return 2;
} );

// Change tablet columns to 3
add_filter( 'grid_subsidiaries_tablet_cols', function() {
    return 3;
} );

// Change desktop columns to 3
add_filter( 'grid_subsidiaries_desktop_cols', function() {
    return 3;
} );
```

## Card Structure

Each subsidiary card includes:

### Logo Section
- **Container**: `aspect-[4/3] bg-gray-50` with padding
- **Image**: Logo from ACF `logo` field
- **Hover Effect**: Scale transform (`group-hover:scale-105`)
- **Link**: Wraps entire logo area, links to subsidiary post

### Content Section
- **Title**: 
  - Heading level: `h2`
  - Styling: `text-2xl font-bold mb-3`
  - Link color: `text-secondary hover:text-primary`
- **Excerpt**:
  - Shows excerpt if available, otherwise trims content to 20 words
  - Styling: `text-gray-600 mb-4 line-clamp-3 min-h-24`
  - Maximum 3 lines with ellipsis
- **Read More Link**:
  - Text: "קרא עוד" (Read More)
  - Styling: `text-primary hover:text-secondary font-semibold`
  - Includes arrow icon with RTL rotation support

## Styling

### Wrapper
- Background: `bg-white`
- Padding: `py-16` (vertical)
- Border: `border-t-1 border-secondary` (top border)

### Container
- Max width: Container class
- Horizontal padding: `px-4`
- Centered: `mx-auto`

### Card
- Background: `bg-white`
- Border radius: `rounded-lg`
- Overflow: `overflow-hidden`
- Shadow: `shadow-md hover:shadow-xl`
- Transition: `transition-shadow duration-300`

## Empty State

When no subsidiaries are found:
- Displays message: "לא נמצאו חברות בקבוצה." (No subsidiaries found)
- Uses same wrapper styling as grid section
- Centered text with `text-xl text-gray-600`
- RTL/LTR support

## Required ACF Fields

| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| `logo` | Image | No | Subsidiary logo displayed in card (aspect ratio 4:3) |

## RTL/LTR Support

- Grid direction set via `dir="rtl"` attribute when RTL is active
- Arrow icon rotates 180 degrees in RTL mode
- Text direction handled automatically by WordPress

## Technical Implementation

### Query Reset
Component properly resets post data using `wp_reset_postdata()` after custom query to prevent conflicts with main loop.

### Self-Contained
- No parameters needed
- Fetches its own data
- Includes all necessary HTML structure
- Handles empty state internally

### Performance
- Uses efficient WP_Query
- No unnecessary database calls
- Proper post data reset prevents conflicts

## Customization

### Changing Grid Columns
Use WordPress filters as documented above.

### Changing Card Styling
Modify classes in the component file:
- Card wrapper classes
- Logo container classes
- Content section classes
- Link styling classes

### Changing Empty State Message
Modify the translatable string in the component:
```php
<?php esc_html_e( 'לא נמצאו חברות בקבוצה.', 'zbeda' ); ?>
```

## Dependencies

- **ACF Plugin**: Required for `logo` field and `get_field()` function
- **Tailwind CSS**: Required for all styling classes
- **WordPress**: Standard WordPress functions

## Browser Support

- Modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile browsers (iOS Safari, Chrome Mobile)
- RTL language support (Hebrew, Arabic, etc.)

## Troubleshooting

### Component Not Displaying
1. Check that subsidiaries exist in database
2. Verify `subsidiary` post type is registered
3. Check that ACF plugin is active
4. Verify `get_field()` function is available

### Cards Not Styling Correctly
1. Verify Tailwind CSS is compiled
2. Check that custom classes exist in compiled CSS
3. Verify container classes are correct

### Empty State Showing Incorrectly
1. Check that query is working correctly
2. Verify post type name is correct
3. Check WordPress debug log for errors

## Related Files

- `.cursorrules` - Project rules and documentation
- `template-home.php` - Home page template using this component
- `archive-subsidiary.php` - Subsidiary archive template using this component
- `grid-section.php` - Similar reusable component pattern

---

**Last Updated**: 2025-01-XX
**Component Version**: 1.0
**Author**: Theme Development Team

