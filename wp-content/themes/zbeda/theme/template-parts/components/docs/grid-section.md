# Grid Section Component Documentation

## Overview
The Grid Section component is a reusable template part that displays content in a responsive 2x2 grid layout on desktop and a Swiper carousel on mobile devices.

## File Location
`theme/template-parts/components/grid-section.php`

## Usage

### Basic Usage
```php
<?php get_template_part( 'template-parts/components/grid-section' ); ?>
```

### Where It's Currently Used
- **Home Page**: `template-home.php` (line 86)
- **Single Subsidiary**: `single-subsidiary.php` (line 96)

## ACF Fields Required

The component requires the following Advanced Custom Fields (ACF) to be configured:

| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| `grid_top_left` | WYSIWYG/Text | No | Content for the top-left grid cell |
| `grid_top_left_image` | Image | No | Background image for top-left cell (displays at 30% opacity) |
| `grid_top_right` | WYSIWYG/Text | No | Content for the top-right grid cell |
| `grid_bottom_left` | WYSIWYG/Text | No | Content for the bottom-left grid cell |
| `grid_bottom_right` | WYSIWYG/Text | No | Content for the bottom-right grid cell |
| `grid_bottom_right_image` | Image | No | Background image for bottom-right cell (displays at 30% opacity) |
| `grid_mobile_carousel` | True/False (Checkbox) | No | Controls mobile carousel visibility. Exists for both homepage and subsidiary post types. If checked, mobile carousel displays. If unchecked or field doesn't exist, desktop grid shows on all screen sizes. |

**Note**: The component only displays if at least one of the content fields (`grid_top_left`, `grid_top_right`, `grid_bottom_left`, or `grid_bottom_right`) has content.

## Responsive Behavior

### Desktop (md breakpoint and above)
- **Layout**: 2x2 CSS Grid (`grid md:grid-cols-2`)
- **Visibility**: Hidden on mobile, visible on desktop (`hidden md:block`)
- **Styling**: 
  - RTL: Mixed colors (white background for top-right/bottom-left, secondary background for top-left/bottom-right)
  - LTR: All cells use secondary background (`bg-secondary`)
- **Images**: Display as background overlays with 30% opacity when image fields are set

### Mobile (below md breakpoint)
- **If `grid_mobile_carousel` checkbox is checked**: 
  - **Layout**: Swiper carousel
  - **Visibility**: Visible on mobile, hidden on desktop (`md:hidden`)
  - **Height**: Fixed at 70vh
  - **Slide Order**: Top Right → Top Left → Bottom Left → Bottom Right (same for RTL and LTR, matches mobile grid order)
  - **Colors**: Match desktop grid exactly
    - RTL: Top Right & Bottom Left = `bg-white text-secondary`, Top Left & Bottom Right = `bg-secondary text-white`
    - LTR: All slides = `bg-secondary text-white`
  - **Features**:
    - Navigation arrows (prev/next)
    - Pagination dots
    - Keyboard navigation enabled
    - Touch/swipe support
- **If checkbox is unchecked or doesn't exist**: 
  - Mobile carousel is hidden
  - Desktop grid displays on mobile too (`block` class - visible on all screen sizes)
  - **Mobile grid order**: Top Right → Top Left → Bottom Left → Bottom Right (using CSS order classes)
  - Grid uses flexbox column layout on mobile
- **Note**: `grid_mobile_carousel` field exists for both homepage and subsidiary post types

## RTL/LTR Support

The component fully supports both Right-to-Left (RTL) and Left-to-Right (LTR) layouts:

### RTL Layout
- **Desktop Grid Order**: Top Right → Top Left → Bottom Right → Bottom Left
- **Mobile Grid/Carousel Order**: Top Right → Top Left → Bottom Left → Bottom Right (consistent across both)
- **Carousel Colors**: Mixed (white/secondary backgrounds)
- **Text Direction**: Automatically set with `dir="rtl"` attribute

### LTR Layout
- **Desktop Grid Order**: Top Left → Top Right → Bottom Left → Bottom Right
- **Mobile Grid/Carousel Order**: Top Right → Top Left → Bottom Left → Bottom Right (consistent across both)
- **Carousel Colors**: All secondary background
- **Text Direction**: Default (no dir attribute needed)

## Swiper Configuration

### Carousel Settings
- **Class Name**: `grid-section-swiper`
- **Direction**: Horizontal
- **Slides Per View**: 1
- **Space Between**: 0
- **Keyboard Navigation**: Enabled
- **Pagination**: Clickable dots
- **Navigation**: Previous/Next arrows

### Swiper Styling
- **Arrows**: 
  - Dark color (#101828)
  - 40px × 40px circle
  - Amber background (#fbbf2480)
  - 18px font size for icons
- **Pagination Dots**:
  - Blue color (rgb(62, 93, 156))
  - 8px × 8px default size
  - 24px × 8px active size (wider)
  - 50% opacity default, 100% opacity active

## Grid Cell Styling

### Cells with Images
- Background images displayed at 30% opacity
- Primary heading color (`[&_h2]:text-primary`) applied
- Uses `prose prose-invert` classes

### Cells without Images
- Solid background color only
- Standard prose styling
- No special heading color

## Technical Implementation

### Conditional Rendering
The component only renders if at least one content field has a value:
```php
if ( $grid_top_left || $grid_top_right || $grid_bottom_left || $grid_bottom_right )
```

### Field Fetching
All ACF fields are fetched within the component itself using `get_field()`. No variables need to be passed when including the template part.

### Self-Contained
The component includes:
- HTML structure
- Swiper initialization JavaScript
- Swiper styling CSS
- All necessary classes and attributes

## Customization

### Changing Breakpoint
To change when the carousel switches to grid, modify:
- Mobile: `md:hidden` class
- Desktop: `hidden md:block` class
- Grid: `md:grid-cols-2` class

### Changing Colors
Colors are controlled by Tailwind classes:
- `bg-white` - White background
- `bg-secondary` - Secondary color background
- `text-secondary` - Secondary color text
- `text-white` - White text

### Changing Carousel Height
Modify the inline style on the mobile carousel container:
```html
<div class="md:hidden relative" style="height: 70vh;">
```

## Dependencies

- **Swiper.js**: Required for mobile carousel functionality
- **ACF Plugin**: Required for field management
- **Tailwind CSS**: Required for styling

## Browser Support

- Modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile browsers (iOS Safari, Chrome Mobile)
- RTL language support (Hebrew, Arabic, etc.)

## Troubleshooting

### Component Not Displaying
1. Check that at least one ACF field has content
2. Verify ACF fields are properly configured
3. Check that `get_field()` function is available (ACF plugin active)

### Carousel Not Working
1. Verify Swiper.js is loaded
2. Check browser console for JavaScript errors
3. Ensure Swiper initialization script runs after DOM is loaded

### Styling Issues
1. Verify Tailwind CSS is compiled
2. Check that custom classes exist in compiled CSS
3. Verify base.css loads last (check `tailwind.css` import order)

## Future Enhancements

Potential improvements:
- Add animation/transition effects
- Add autoplay option for carousel
- Add more customization options via parameters
- Add lazy loading for images
- Add accessibility improvements (ARIA labels)

## Related Files

- `.cursorrules` - Project rules and documentation
- `template-home.php` - Home page template using this component
- `single-subsidiary.php` - Single subsidiary template using this component

---

**Last Updated**: 2025-01-XX
**Component Version**: 1.0
**Author**: Theme Development Team

