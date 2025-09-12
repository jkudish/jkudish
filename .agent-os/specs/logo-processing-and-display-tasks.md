# Logo Processing and Display Update - Task List

## Phase 1: Image Processing

### Setup and Analysis
- [ ] Check for ImageMagick availability on system
- [ ] Verify current image formats and transparency status
- [ ] Create backup of original images folder

### Background Removal (JPEGs)
- [ ] Process `FSquared Marketing Images.jpeg` - remove background, convert to PNG
- [ ] Process `bcspca.jpg` - remove background, convert to PNG
- [ ] Process `trusted-advisors.jpeg` - remove background, convert to PNG

### WebP Conversion
- [ ] Generate WebP version for `automattic.png`
- [ ] Generate WebP version for `bcspca.png` (after conversion)
- [ ] Generate WebP version for `dvlop.png`
- [ ] Generate WebP version for `fedex.png`
- [ ] Generate WebP version for `fsquared.png` (after conversion)
- [ ] Generate WebP version for `image-salon.png`
- [ ] Generate WebP version for `metorik.png`
- [ ] Generate WebP version for `modern-tribe.png`
- [ ] Generate WebP version for `pantheon.png`
- [ ] Generate WebP version for `phaito.png`
- [ ] Generate WebP version for `smarterqueue.png`
- [ ] Generate WebP version for `sothebys.png`
- [ ] Generate WebP version for `spark-consulting.png`
- [ ] Generate WebP version for `techcrunch.png`
- [ ] Generate WebP version for `teelaunch.png`
- [ ] Generate WebP version for `telus-health.png`
- [ ] Generate WebP version for `the-events-calendar.png`
- [ ] Generate WebP version for `trusted-advisors.png` (after conversion)
- [ ] Generate WebP version for `turquoise-goat.png`
- [ ] Generate WebP version for `woo.png`
- [ ] Generate WebP version for `wp-vip.png`
- [ ] Keep existing `infrarouge.webp` as is

### Optimization
- [ ] Optimize all PNG files for size
- [ ] Verify all WebP files are under 50KB
- [ ] Ensure transparency is preserved in all conversions

### Cleanup
- [ ] Delete original JPEG files after successful conversion
- [ ] Rename files to consistent format if needed
- [ ] Verify final folder structure matches specification

## Phase 2: Component Update

### Add New Companies to Array
- [ ] Add FedEx to `$allCompanies` array
- [ ] Add BC SPCA to `$allCompanies` array
- [ ] Add FSquared Marketing to `$allCompanies` array
- [ ] Add Infrarouge to `$allCompanies` array
- [ ] Add Modern Tribe to `$allCompanies` array
- [ ] Add Spark Consulting to `$allCompanies` array
- [ ] Add TechCrunch to `$allCompanies` array
- [ ] Add Teelaunch to `$allCompanies` array
- [ ] Add The Events Calendar to `$allCompanies` array
- [ ] Add Trusted Advisors to `$allCompanies` array

### Update Display Logic
- [ ] Comment out shuffle logic in component
- [ ] Comment out array_slice to show all logos
- [ ] Adjust grid columns for larger number of logos
- [ ] Test responsive breakpoints

### Styling and Dark Mode
- [ ] Assign appropriate CSS class to each new company
- [ ] Test each logo in light mode
- [ ] Test each logo in dark mode
- [ ] Adjust individual logo classes as needed

## Phase 3: Testing and Verification

### Visual Testing
- [ ] Verify all 22 logos display on home page
- [ ] Check logo alignment in grid
- [ ] Test hover effects on all logos
- [ ] Verify no broken images

### Technical Testing
- [ ] Check browser console for errors
- [ ] Verify page load performance
- [ ] Test on mobile devices
- [ ] Test on different browsers

### Final Checks
- [ ] Ensure all logos have proper alt text
- [ ] Verify WebP fallback to PNG works
- [ ] Document any logos needing manual processing
- [ ] Prepare notes for future display strategy

## Notes

- If automated background removal doesn't work well, mark for manual processing
- Keep original files backed up until client approves results
- Document which logos need special CSS handling