# Brand Gallery Section

## Location

`theme/single-brand.php` (lines ~130-266)

## Purpose

Displays a Swiper carousel of brand gallery images with GLightbox integration. Automatically converts to a centered flexbox grid when there aren't enough images to require a carousel.

## Usage

Only appears on single brand post pages (`is_singular( 'brand' )`). Automatically displays if `brand_gallery` ACF field has images.

## Required ACF Fields

- `brand_gallery` (Gallery) - Array of image objects with `url`, `sizes`, and `alt` properties

## Behavior

### Carousel Mode (When Enough Images)

- **Initialization**: JavaScript checks if slide count > current breakpoint's `slidesPerView`
- **If true**: Initializes Swiper carousel with navigation and pagination
- **Centered Slides**: `centeredSlides: true` - centers active slide, shows partial slides on sides
- **Responsive Breakpoints**:
  - Mobile: `slidesPerView: 1.3`, `spaceBetween: 20`
  - Tablet (768px): `slidesPerView: 3`, `spaceBetween: 30`
  - Desktop (1024px): `slidesPerView: 4`, `spaceBetween: 30`
  - Large (1280px): `slidesPerView: 5`, `spaceBetween: 30`
- **Loop**: Enabled if more than 1 image
- **Navigation**: Prev/Next arrows, pagination dots
- **Lightbox**: GLightbox integration with `loop: true` for infinite navigation

### Grid Mode (When Not Enough Images)

- **Detection**: JavaScript compares slide count vs current breakpoint's `slidesPerView`
- **If slide count ≤ slidesPerView**: 
  - Swiper is NOT initialized
  - Adds `no-carousel` class to swiper element
  - CSS converts to flexbox grid with centered items
  - Navigation and pagination hidden via CSS
  - Images maintain same size as carousel would show (responsive widths)
  - Images centered horizontally

## Technical Details

### Swiper Configuration

- **Class**: `.brand-gallery-swiper`
- **Centered Slides**: `centeredSlides: true`
- **Auto Height**: `autoHeight: true`
- **Keyboard Navigation**: Enabled
- **Responsive**: Breakpoints match image sizing

### GLightbox Configuration

- **Library**: GLightbox (enqueued in `functions.php` for brand pages only)
- **Selector**: `.glightbox` class on gallery links
- **Gallery**: `data-gallery="brand-gallery"` attribute groups images
- **Loop**: `loop: true` - infinite navigation in lightbox
- **Enqueued**: CSS and JS loaded only on `is_singular( 'brand' )` pages

### JavaScript Logic

- **`getSlidesPerView()`**: Returns current breakpoint's slidesPerView value
- **`initCarousel()`**: 
  - Destroys existing Swiper instance if present
  - Checks if slide count > slidesPerView
  - Initializes Swiper if needed, adds `no-carousel` class if not
- **Resize Handler**: Debounced (250ms) to re-check on window resize
- **Dynamic**: Re-initializes carousel when breakpoint changes

### CSS Styling

- **Carousel Mode**:
  - Navigation buttons: 40px circle, primary/secondary colors
  - Pagination: Secondary color bullets, 8px default, 24px active
  - Slide images: Square aspect ratio (`aspect-ratio: 1 / 1`), `object-fit: contain`
- **Grid Mode** (`.no-carousel`):
  - Flexbox layout: `display: flex`, `justify-content: center`
  - Responsive widths matching carousel breakpoints
  - Gaps: 20px mobile, 30px tablet+
  - Navigation/pagination hidden via CSS

## Styling Details

- **Wrapper**: `bg-primary py-16`
- **Container**: Empty div (no padding, allows overflow)
- **Slide Images**: Square (`aspect-ratio: 1 / 1`), `object-fit: contain`
- **Hover**: `hover:opacity-90 transition-opacity` on images

## Important Notes

- **Conditional Carousel**: Carousel only initializes when needed (more images than slidesPerView)
- **Responsive Detection**: Checks slide count vs current breakpoint on load and resize
- **Lightbox Only**: GLightbox works in both carousel and grid modes
- **No Custom CSS Padding**: Uses Swiper's built-in `centeredSlides` for centering
- **Overflow**: Container allows overflow to show partial side slides
- **Performance**: Swiper only initialized when necessary, destroyed when not needed

## Related Files

- `functions.php` - Enqueues Swiper and GLightbox assets for brand pages
- `theme/template-parts/components/grid-brands.php` - Different component for brand logo grid

